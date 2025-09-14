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
        <header>
            <h1>Chapter Selection</h1>
            <a href="index.php" class="back-btn">Back to Home</a>
        </header>
        
        <div class="chapters-container">
            <div class="chapter-card" onclick="openModal('chapter1')">
                <h2>Chapter 1</h2>
                <p>Introduction to Graphics Programming</p>
            </div>
            
            <div class="chapter-card" onclick="openModal('chapter2')">
                <h2>Chapter 2</h2>
                <p>2D Graphics and Transformations</p>
            </div>
            
            <div class="chapter-card" onclick="openModal('chapter3')">
                <h2>Chapter 3</h2>
                <p>3D Graphics Fundamentals</p>
            </div>
            
            <div class="chapter-card" onclick="openModal('chapter4')">
                <h2>Chapter 4</h2>
                <p>Advanced Rendering Techniques</p>
            </div>
        </div>
        
        <footer>
            <p>&copy; 2023 Graphics On A Stick</p>
        </footer>
    </div>
    
    <!-- Chapter Modals -->
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
    
    <script>
        function openModal(chapterId) {
            document.getElementById(chapterId).style.display = 'flex';
        }
        
        function closeModal(chapterId) {
            document.getElementById(chapterId).style.display = 'none';
        }
        
        // Close modal when clicking outside of it
        window.onclick = function(event) {
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