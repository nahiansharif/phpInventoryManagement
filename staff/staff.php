<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        
        .main-content {
            
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .container {
            display: flex;
        }

        .card {
            width: 200px; 
            height: 200px; 
            margin: 25px;
            flex-direction: column;
            padding:30px;
        }

        

    </style>
</head>
<body>

<div class="sidebar">
        <h1>Staff Dashboard</h1>
        <a href="#" class="home">Home</a>
        <a href="searchPlanes.php">Search Planes</a>
        <a href="report.php">Report</a>
        <a href="tasks.php">Tasks</a>
    </div>
    
    <div class="main-content">
        <div class="container">

            <div class="pieChart">
                <p>All Planes' Condition:</p>
                <img src="../pieChart.png" alt="">
                <p>62.5% Good <br><br> 35.5% Need Maintainance <br><br> 2% Critical</p>
            </div>

            <div class="card">
                <p>Task</p>
                <p>Not Available</p>
            </div>

            <div class="card">
                <p>Task Completed</p>
                <p>53</p>
            </div>

            <div class="card">
                <p>Report Submitted</p>
                <p>30</p>
            </div>




        </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
