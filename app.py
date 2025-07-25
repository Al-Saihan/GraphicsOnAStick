import streamlit as st
import matplotlib.pyplot as plt
from io import StringIO

log = StringIO()  # To store detailed calculation logs


def log_print(*args, **kwargs):
    """Custom print to log details for web output"""
    print(*args, **kwargs, file=log)


def outcode(x, y, xmin, xmax, ymin, ymax):
    code = 0
    if y > ymax:
        code |= 0b1000
    if y < ymin:
        code |= 0b0100
    if x > xmax:
        code |= 0b0010
    if x < xmin:
        code |= 0b0001
    return code


def cohenClipping(x0, y0, x1, y1, xmin, xmax, ymin, ymax):
    log_print(
        f"Initial Endpoints: \nStarting Point: ({x0}, {y0})\nEnding Point: ({x1}, {y1})"
    )
    outcode0 = outcode(x0, y0, xmin, xmax, ymin, ymax)
    outcode1 = outcode(x1, y1, xmin, xmax, ymin, ymax)
    log_print(
        f"Initial Outcodes: \noutcode0 = {format(outcode0, '04b')}\noutcode1 = {format(outcode1, '04b')}"
    )
    log_print("-" * 40)

    accept = False

    while True:
        if not (outcode0 | outcode1):
            accept = True
            log_print("Both points inside. Line accepted!")
            log_print("-" * 40)
            break
        elif outcode0 & outcode1:
            log_print("Both points share an outside region. Line rejected.")
            log_print("-" * 40)
            break
        else:
            outcode_out = outcode0 if outcode0 else outcode1
            log_print(f"Clipping point with outcode: {format(outcode_out, '04b')}")
            x, y = 0.0, 0.0

            if outcode_out & 0b1000:
                log_print("Clipping with TOP edge")
                x = x0 + (x1 - x0) * (ymax - y0) / (y1 - y0) if y1 != y0 else x0
                y = ymax
            elif outcode_out & 0b0100:
                log_print("Clipping with BOTTOM edge")
                x = x0 + (x1 - x0) * (ymin - y0) / (y1 - y0) if y1 != y0 else x0
                y = ymin
            elif outcode_out & 0b0010:
                log_print("Clipping with RIGHT edge")
                y = y0 + (y1 - y0) * (xmax - x0) / (x1 - x0) if x1 != x0 else y0
                x = xmax
            elif outcode_out & 0b0001:
                log_print("Clipping with LEFT edge")
                y = y0 + (y1 - y0) * (xmin - x0) / (x1 - x0) if x1 != x0 else y0
                x = xmin

            x = round(x)
            y = round(y)
            log_print(f"New intersection point: ({x}, {y})")

            if outcode_out == outcode0:
                x0, y0 = x, y
                outcode0 = outcode(x0, y0, xmin, xmax, ymin, ymax)
                log_print(
                    f"Updated point 0: ({x0}, {y0}), outcode = {format(outcode0, '04b')}"
                )
            else:
                x1, y1 = x, y
                outcode1 = outcode(x1, y1, xmin, xmax, ymin, ymax)
                log_print(
                    f"Updated point 1: ({x1}, {y1}), outcode = {format(outcode1, '04b')}"
                )
            log_print("-" * 40)

    if accept:
        log_print(f"Final Clipped Line: ({x0}, {y0}) to ({x1}, {y1})")
        return (round(x0, 2), round(y0, 2), round(x1, 2), round(y1, 2))
    else:
        return None


def visualizeCohenClip(x0, y0, x1, y1, xmin, xmax, ymin, ymax):
    fig, axs = plt.subplots(1, 2, figsize=(10, 5))
    rect_x = [xmin, xmax, xmax, xmin, xmin]
    rect_y = [ymin, ymin, ymax, ymax, ymin]

    # Before clipping
    axs[0].plot(rect_x, rect_y, "k--", linewidth=1.5)
    axs[0].arrow(
        x0,
        y0,
        x1 - x0,
        y1 - y0,
        head_width=0.3,
        length_includes_head=True,
        color="blue",
    )
    axs[0].scatter([x0, x1], [y0, y1], color="blue")
    axs[0].set_title("Before Clipping")
    axs[0].set_aspect("equal")

    # After clipping
    clipped = cohenClipping(x0, y0, x1, y1, xmin, xmax, ymin, ymax)
    axs[1].plot(rect_x, rect_y, "k--", linewidth=1.5)
    if clipped:
        cx0, cy0, cx1, cy1 = clipped
        axs[1].arrow(
            cx0,
            cy0,
            cx1 - cx0,
            cy1 - cy0,
            head_width=0.3,
            length_includes_head=True,
            color="green",
        )
        axs[1].scatter([cx0, cx1], [cy0, cy1], color="green")
        axs[1].set_title("After Clipping")
    else:
        axs[1].text(
            0.5,
            0.5,
            "Line Outside",
            ha="center",
            va="center",
            transform=axs[1].transAxes,
        )
    axs[1].set_aspect("equal")

    return fig


# --- Streamlit UI ---

st.title("Cohen-Sutherland Line Clipping Visualization")

st.sidebar.header("Line Segment Points:")
x0 = st.sidebar.number_input("x0", value=2)
y0 = st.sidebar.number_input("y0", value=3)
x1 = st.sidebar.number_input("x1", value=12)
y1 = st.sidebar.number_input("y1", value=10)

st.sidebar.header("Clipping Window")
xmin = st.sidebar.number_input("x_min", value=4)
xmax = st.sidebar.number_input("x_max", value=10)
ymin = st.sidebar.number_input("y_min", value=4)
ymax = st.sidebar.number_input("y_max", value=8)

if st.button("Run 'Cohen-Sutherland'"):
    log.truncate(0)
    log.seek(0)

    fig = visualizeCohenClip(x0, y0, x1, y1, xmin, xmax, ymin, ymax)
    st.pyplot(fig)

    # Output calculation log
    st.subheader("Detailed Clipping Steps:")
    st.code(log.getvalue(), language="text")
