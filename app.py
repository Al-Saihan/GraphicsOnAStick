import streamlit as st
import matplotlib.pyplot as plt
from io import BytesIO

# --- Your core logic (paste your code here) ---
# Include outcode, cohenClipping, visualizeCohenClip, etc. as-is
# Just remove `plt.show()` and instead return the figure

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
    outcode0 = outcode(x0, y0, xmin, xmax, ymin, ymax)
    outcode1 = outcode(x1, y1, xmin, xmax, ymin, ymax)
    accept = False

    while True:
        if not (outcode0 | outcode1):
            accept = True
            break
        elif outcode0 & outcode1:
            break
        else:
            outcode_out = outcode0 if outcode0 else outcode1
            x, y = 0.0, 0.0

            if outcode_out & 0b1000:
                x = x0 + (x1 - x0) * (ymax - y0) / (y1 - y0) if y1 != y0 else x0
                y = ymax
            elif outcode_out & 0b0100:
                x = x0 + (x1 - x0) * (ymin - y0) / (y1 - y0) if y1 != y0 else x0
                y = ymin
            elif outcode_out & 0b0010:
                y = y0 + (y1 - y0) * (xmax - x0) / (x1 - x0) if x1 != x0 else y0
                x = xmax
            elif outcode_out & 0b0001:
                y = y0 + (y1 - y0) * (xmin - x0) / (x1 - x0) if x1 != x0 else y0
                x = xmin

            x, y = round(x), round(y)
            if outcode_out == outcode0:
                x0, y0 = x, y
                outcode0 = outcode(x0, y0, xmin, xmax, ymin, ymax)
            else:
                x1, y1 = x, y
                outcode1 = outcode(x1, y1, xmin, xmax, ymin, ymax)

    return (round(x0, 2), round(y0, 2), round(x1, 2), round(y1, 2)) if accept else None

def visualizeCohenClip(x0, y0, x1, y1, xmin, xmax, ymin, ymax):
    fig, axs = plt.subplots(1, 2, figsize=(10, 5))
    rect_x = [xmin, xmax, xmax, xmin, xmin]
    rect_y = [ymin, ymin, ymax, ymax, ymin]

    # Before clipping
    axs[0].plot(rect_x, rect_y, "k--", linewidth=1.5)
    axs[0].arrow(x0, y0, x1 - x0, y1 - y0, head_width=0.3, length_includes_head=True, color="blue")
    axs[0].scatter([x0, x1], [y0, y1], color="blue")
    axs[0].set_title("Before Clipping")
    axs[0].set_aspect("equal")

    # After clipping
    clipped = cohenClipping(x0, y0, x1, y1, xmin, xmax, ymin, ymax)
    axs[1].plot(rect_x, rect_y, "k--", linewidth=1.5)
    if clipped:
        cx0, cy0, cx1, cy1 = clipped
        axs[1].arrow(cx0, cy0, cx1 - cx0, cy1 - cy0, head_width=0.3, length_includes_head=True, color="green")
        axs[1].scatter([cx0, cx1], [cy0, cy1], color="green")
        axs[1].set_title("After Clipping")
    else:
        axs[1].text(0.5, 0.5, "Line Outside", ha="center", va="center", transform=axs[1].transAxes)
    axs[1].set_aspect("equal")

    return fig

# --- Streamlit UI ---

st.title("Cohen–Sutherland Line Clipping")

st.sidebar.header("Line Endpoints")
x0 = st.sidebar.number_input("x0", value=2)
y0 = st.sidebar.number_input("y0", value=3)
x1 = st.sidebar.number_input("x1", value=12)
y1 = st.sidebar.number_input("y1", value=10)

st.sidebar.header("Clipping Window")
xmin = st.sidebar.number_input("xmin", value=4)
xmax = st.sidebar.number_input("xmax", value=10)
ymin = st.sidebar.number_input("ymin", value=4)
ymax = st.sidebar.number_input("ymax", value=8)

if st.button("Run Clipping"):
    fig = visualizeCohenClip(x0, y0, x1, y1, xmin, xmax, ymin, ymax)
    st.pyplot(fig)
