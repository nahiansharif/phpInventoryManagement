<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Buy</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        
        

        .container {
            display: flex;
        }

        .card {
            width: 300px; 
            height: 400px; 
            margin: 25px;
            flex-direction: column;
            padding:30px;
        }

       



        

    </style>
</head>
<body>

    <div class="sidebar">
        <h1>Manager Buy Components</h1>
        <a href="manager.php">Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="tasks.php">Tasks</a>
        <a href="staffStatus.php">Staff Status</a>
        <a href="#" class="home">Buy Components</a>
    </div>

    <div class="main-content">

    <div class="infoBar">
            <p>
                <strong>Plane: </strong> 23 &nbsp &nbsp 
                <strong>Fuel: </strong> 500 gallons &nbsp &nbsp 
                <strong>Tire: </strong> 60 &nbsp &nbsp 
                <strong>Engine: </strong> 15 
            </p>
        </div>
        <div class="container">

            <div class="card">
                <img src="../engine.png" alt="" class="buyItemsIcon" width="200" height="200">
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons" width="50" height="50">
                    <p>x5</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons"  width="50" height="50">
                    
                </div>
                <p>Engine</p>
                <button class="approveButton">Buy</button>

            </div>

            <div class="card">
                <img src="../tire.png" alt="" class="buyItemsIcon" width="200" height="200">
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons">
                    <p>x5</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons"  width="50" height="50">
                    
                </div>
                <p>Tire</p>
                <button class="approveButton">Buy</button>

            </div>

            <div class="card">
                <img src="../fuel.png" alt="" class="buyItemsIcon" width="200" height="200">
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons" width="50" height="50">
                    <p>x5</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons"  width="50" height="50">
                    
                </div>
                <p>Fuel</p>
                <button class="approveButton">Buy</button>

            </div>

            <div class="card">
                <img src="../plane.png" alt="" class="buyItemsIcon" width="200" height="200">
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons" width="50" height="50">
                    <p>x5</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons"  width="50" height="50">
                    
                </div>
                <p>Plane</p>
                <button class="approveButton">Buy</button>

            </div>
            




        </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
