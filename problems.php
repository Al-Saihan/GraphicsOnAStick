<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problems - Graphics On A Stick</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <header>
            <h1>Chapter Selection</h1>
            <a href="index.php" class="back-btn">Back to Home</a>
        </header>

        <!-- Mid Term Topics Section -->
        <h2 class="section-title"> Mid Term Topics</h2>

        <div class="chapters-container">
            <!-- Chapter 1 Card -->
            <div class="chapter-card" onclick="openModal('chapter1')">
                <h2>Chapter 1</h2>
                <p>Introduction</p>
            </div>

            <!-- Chapter 2 Card -->
            <div class="chapter-card" onclick="openModal('chapter2')">
                <h2>Chapter 2</h2>
                <p>Line Drawing</p>
            </div>

            <!-- Chapter 3 Card -->
            <div class="chapter-card" onclick="openModal('chapter3')">
                <h2>Chapter 3</h2>
                <p>Clipping</p>
            </div>

            <!-- Chapter 4 Card -->
            <div class="chapter-card" onclick="openModal('chapter4')">
                <h2>Chapter 4</h2>
                <p>Transformation</p>
            </div>
        </div>

        <!-- Final Topics Section -->
        <h2 class="section-title">Final Topics</h2>

        <div class="chapters-container">
            <!-- Chapter 5 Card -->
            <div class="chapter-card" onclick="openModal('chapter5')">
                <h2>Chapter 5</h2>
                <p>Projection</p>
            </div>

            <!-- Chapter 6 Card -->
            <div class="chapter-card" onclick="openModal('chapter6')">
                <h2>Chapter 6</h2>
                <p>Color Models</p>
            </div>

            <!-- Chapter 7 Card -->
            <div class="chapter-card" onclick="openModal('chapter7')">
                <h2>Chapter 7</h2>
                <p>Lighting Models</p>
            </div>

            <!-- Chapter 8 Card -->
            <div class="chapter-card" onclick="openModal('chapter8')">
                <h2>Chapter 8</h2>
                <p>Curves</p>
            </div>
        </div>

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2023 Graphics On A Stick</p>
        </footer>
    </div>

    <!-- Chapter Modals Section -->
    <!-- Chapter 1 Modal -->
    <div id="chapter1" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter1')">&times;</button>
            <h2 class="modal-title">Chapter 1 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Create a basic shape renderer</li>
                <li>Problem 2: Implement a color blending function</li>
                <li>Problem 3: Develop a simple animation system</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 2 Modal -->
    <div id="chapter2" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter2')">&times;</button>
            <h2 class="modal-title">Chapter 2 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Implement translation and rotation</li>
                <li>Problem 2: Create a scaling transformation</li>
                <li>Problem 3: Develop a matrix transformation system</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 3 Modal -->
    <div id="chapter3" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter3')">&times;</button>
            <h2 class="modal-title">Chapter 3 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Create a 3D wireframe renderer</li>
                <li>Problem 2: Implement basic lighting</li>
                <li>Problem 3: Develop a simple 3D object loader</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 4 Modal -->
    <div id="chapter4" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter4')">&times;</button>
            <h2 class="modal-title">Chapter 4 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Implement texture mapping</li>
                <li>Problem 2: Create a shadow rendering system</li>
                <li>Problem 3: Develop a basic shader system</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 5 Modal -->
    <div id="chapter5" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter5')">&times;</button>
            <h2 class="modal-title">Chapter 5 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Implement perspective projection</li>
                <li>Problem 2: Create an orthographic projection system</li>
                <li>Problem 3: Develop a viewport transformation function</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 6 Modal -->
    <div id="chapter6" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter6')">&times;</button>
            <h2 class="modal-title">Chapter 6 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Implement RGB to HSV color conversion</li>
                <li>Problem 2: Create a color interpolation function</li>
                <li>Problem 3: Develop a color picker tool</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 7 Modal -->
    <div id="chapter7" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter7')">&times;</button>
            <h2 class="modal-title">Chapter 7 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Implement Phong lighting model</li>
                <li>Problem 2: Create a basic shadow calculation</li>
                <li>Problem 3: Develop a specular highlight effect</li>
            </ul>
        </div>
    </div>

    <!-- Chapter 8 Modal -->
    <div id="chapter8" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('chapter8')">&times;</button>
            <h2 class="modal-title">Chapter 8 - Problems</h2>
            <ul class="problems-list">
                <li>Problem 1: Implement Bezier curve drawing</li>
                <li>Problem 2: Create a B-spline curve editor</li>
                <li>Problem 3: Develop a curve fitting algorithm</li>
            </ul>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        // Open the modal for the selected chapter
        function openModal(chapterId) {
            document.getElementById(chapterId).style.display = 'flex';
        }

        // Close the modal for the selected chapter
        function closeModal(chapterId) {
            document.getElementById(chapterId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function (event) {
            const modals = document.getElementsByClassName('modal');
            for (let i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>