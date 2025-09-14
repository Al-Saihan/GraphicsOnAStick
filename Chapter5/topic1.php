<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projection Concepts</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #130b1b 0%, #2a1a1a 100%);
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            text-align: center;
            padding: 30px;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(45deg, #6a5acd, #6a0dad);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-bottom: 30px;
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(106, 90, 205, 0.4);
        }

        header {
            margin-bottom: 40px;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #daa2eb;
            text-shadow: 0 2px 10px rgba(106, 176, 222, 0.3);
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #a0aec0;
            max-width: 600px;
            margin: 0 auto;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 30px;
        }

        .theory-section, .visualization-section {
            background: rgba(40, 44, 52, 0.6);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .theory-section h2, .theory-section h3, .visualization-section h3 {
            color: #daa2eb;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .theory-section h3 {
            font-size: 1.5rem;
            margin-top: 30px;
        }

        .terminology-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .term-card {
            background: rgba(30, 34, 42, 0.7);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #6a5acd;
            transition: transform 0.3s ease;
        }

        .term-card:hover {
            transform: translateY(-3px);
        }

        .term-card h4 {
            color: #9e68c3;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .term-card p {
            color: #a0aec0;
            font-size: 0.95rem;
        }

        .types-diagram {
            margin: 25px 0;
            position: relative;
            padding-left: 20px;
        }

        .diagram-node {
            background: rgba(30, 34, 42, 0.7);
            padding: 12px 15px;
            border-radius: 8px;
            margin: 8px 0;
            color: #e0e0e0;
            font-weight: 500;
            position: relative;
            border: 1px solid rgba(106, 90, 205, 0.3);
        }

        .main-node {
            background: linear-gradient(45deg, #6a5acd, #6a0dad);
            font-weight: 600;
        }

        .branch, .sub-branch {
            position: relative;
            margin-left: 30px;
        }

        .branch::before, .sub-branch::before {
            content: "";
            position: absolute;
            left: -20px;
            top: 15px;
            height: calc(100% - 30px);
            width: 2px;
            background: rgba(106, 90, 205, 0.5);
        }

        .comparison-table {
            margin: 25px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .comparison-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            background: linear-gradient(45deg, #6a5acd, #6a0dad);
        }

        .comparison-title {
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: white;
        }

        .comparison-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            background: rgba(40, 44, 52, 0.7);
        }

        .comparison-row:nth-child(even) {
            background: rgba(40, 44, 52, 0.9);
        }

        .comparison-category {
            padding: 12px 15px;
            font-weight: 600;
            color: #daa2eb;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .comparison-cell {
            padding: 12px 15px;
            color: #a0aec0;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .comparison-cell:last-child, .comparison-category:last-child {
            border-right: none;
        }

        .visualization-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        .projection-demo h4 {
            color: #9e68c3;
            margin-bottom: 15px;
            text-align: center;
        }

        .demo-box {
            background: rgba(30, 34, 42, 0.8);
            height: 200px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
        }

        .projection-visual {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #6a5acd, #9e68c3);
            border-radius: 10px;
            transition: transform 0.5s ease;
            transform-style: preserve-3d;
            position: relative;
        }

        .projection-visual::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #6a0dad, #5727a4);
            border-radius: 10px;
            transform: translateZ(-20px);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .control-btn {
            padding: 10px 20px;
            background: linear-gradient(45deg, #6a5acd, #6a0dad);
            border: none;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(106, 90, 205, 0.4);
        }

        .notes-section {
            background: rgba(30, 34, 42, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-top: 25px;
        }

        .notes-section h4 {
            color: #daa2eb;
            margin-bottom: 15px;
        }

        .notes-section ul {
            list-style-type: none;
        }

        .notes-section li {
            padding: 8px 0;
            color: #a0aec0;
            position: relative;
            padding-left: 20px;
        }

        .notes-section li::before {
            content: "•";
            color: #9e68c3;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        footer {
            margin-top: 40px;
            color: #718096;
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
            
            .terminology-grid {
                grid-template-columns: 1fr;
            }
            
            .visualization-container {
                grid-template-columns: 1fr;
            }
            
            .comparison-header, .comparison-row {
                grid-template-columns: 1fr;
            }
            
            .comparison-category, .comparison-cell {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .branch, .sub-branch {
                margin-left: 15px;
            }
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2.2rem;
            }
            .subtitle {
                font-size: 1rem;
            }
            .features {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.html" class="back-btn">← Back to Main Menu</a>
        
        <header>
            <h1>Projection Concepts</h1>
            <p class="subtitle">Understanding how 3D objects are represented on 2D surfaces</p>
        </header>

        <div class="content-wrapper">
            <div class="theory-section">
                <h2>Introduction to Projection</h2>
                <p>Projection is a type of transformation where all the coordinates of a point in dimension N are converted to a point of dimension M where N > M.</p>
                
                <div class="terminology-section">
                    <h3>Common Terminologies</h3>
                    <div class="terminology-grid">
                        <div class="term-card">
                            <h4>Object/Target Point</h4>
                            <p>The point we are projecting</p>
                        </div>
                        <div class="term-card">
                            <h4>Projected Point</h4>
                            <p>The new coordinate of the point after projection</p>
                        </div>
                        <div class="term-card">
                            <h4>Projectors</h4>
                            <p>Projection rays</p>
                        </div>
                        <div class="term-card">
                            <h4>Projection Plane</h4>
                            <p>The main view plane where the projection will be shown</p>
                        </div>
                        <div class="term-card">
                            <h4>Center of Projection</h4>
                            <p>Where all the projectors converge</p>
                        </div>
                        <div class="term-card">
                            <h4>Direction of Projection</h4>
                            <p>The forward direction of all the parallel projectors</p>
                        </div>
                    </div>
                </div>
                
                <div class="projection-types">
                    <h3>Projection Types</h3>
                    <div class="types-diagram">
                        <div class="diagram-node main-node">Projection</div>
                        
                        <div class="branch">
                            <div class="diagram-node">Planar</div>
                            <div class="sub-branch">
                                <div class="diagram-node">Parallel</div>
                                <div class="sub-branch">
                                    <div class="diagram-node">Oblique</div>
                                    <div class="sub-branch">
                                        <div class="diagram-node">Cabinet</div>
                                        <div class="diagram-node">Cavalier</div>
                                    </div>
                                </div>
                                <div class="sub-branch">
                                    <div class="diagram-node">Orthographic</div>
                                    <div class="sub-branch">
                                        <div class="diagram-node">Top (Plan)</div>
                                        <div class="diagram-node">Front (Elevation)</div>
                                        <div class="diagram-node">Side (Elevation)</div>
                                        <div class="diagram-node">Axonometric</div>
                                        <div class="sub-branch">
                                            <div class="diagram-node">Isometric</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="branch">
                            <div class="diagram-node">Perspective</div>
                            <div class="sub-branch">
                                <div class="diagram-node">One Point</div>
                                <div class="diagram-node">Two Point</div>
                                <div class="diagram-node">Three Point</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="comparison-section">
                    <h3>Perspective vs Parallel Projection</h3>
                    <div class="comparison-table">
                        <div class="comparison-header">
                            <div class="comparison-title"></div>
                            <div class="comparison-title">Perspective</div>
                            <div class="comparison-title">Parallel</div>
                        </div>
                        <div class="comparison-row">
                            <div class="comparison-category">Projectors</div>
                            <div class="comparison-cell">Aren't parallel and converge at COP</div>
                            <div class="comparison-cell">Are parallel and never converge</div>
                        </div>
                        <div class="comparison-row">
                            <div class="comparison-category">Configuration</div>
                            <div class="comparison-cell">By COP and distance between COP and PP</div>
                            <div class="comparison-cell">By angle that controls DOP</div>
                        </div>
                        <div class="comparison-row">
                            <div class="comparison-category">Realism</div>
                            <div class="comparison-cell">More familiar to human eyes</div>
                            <div class="comparison-cell">Less realistic</div>
                        </div>
                        <div class="comparison-row">
                            <div class="comparison-category">Types</div>
                            <div class="comparison-cell">1-point, 2-point, 3-point</div>
                            <div class="comparison-cell">Cabinet, Cavalier, Orthographic</div>
                        </div>
                        <div class="comparison-row">
                            <div class="comparison-category">Vanishing Points</div>
                            <div class="comparison-cell">Has vanishing points</div>
                            <div class="comparison-cell">No vanishing points</div>
                        </div>
                        <div class="comparison-row">
                            <div class="comparison-category">Foreshortening</div>
                            <div class="comparison-cell">Has foreshortening</div>
                            <div class="comparison-cell">No foreshortening</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="visualization-section">
                <h3>Projection Visualization</h3>
                <div class="visualization-container">
                    <div class="projection-demo">
                        <h4>Parallel Projection</h4>
                        <div class="demo-box" id="parallel-demo">
                            <div class="projection-visual"></div>
                        </div>
                    </div>
                    <div class="projection-demo">
                        <h4>Perspective Projection</h4>
                        <div class="demo-box" id="perspective-demo">
                            <div class="projection-visual"></div>
                        </div>
                    </div>
                </div>
                
                <div class="controls">
                    <button id="rotate-btn" class="control-btn">Rotate View</button>
                    <button id="reset-btn" class="control-btn">Reset View</button>
                </div>
                
                <div class="notes-section">
                    <h4>Key Notes</h4>
                    <ul>
                        <li>Perspective projection creates a more realistic view with depth perception</li>
                        <li>Parallel projection maintains true dimensions but lacks depth cues</li>
                        <li>Vanishing points occur in perspective projection when parallel lines converge</li>
                        <li>Foreshortening makes objects appear smaller as they get farther away</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <footer>
            <p>Computer Graphics Projection Concepts | Designed for Educational Purposes</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rotateBtn = document.getElementById('rotate-btn');
            const resetBtn = document.getElementById('reset-btn');
            const demos = document.querySelectorAll('.projection-visual');
            
            let rotated = false;
            
            rotateBtn.addEventListener('click', function() {
                demos.forEach(demo => {
                    if (rotated) {
                        demo.style.transform = 'rotateY(0deg)';
                    } else {
                        demo.style.transform = 'rotateY(45deg)';
                    }
                });
                rotated = !rotated;
            });
            
            resetBtn.addEventListener('click', function() {
                demos.forEach(demo => {
                    demo.style.transform = 'rotateY(0deg)';
                });
                rotated = false;
            });
        });
    </script>
</body>
</html>