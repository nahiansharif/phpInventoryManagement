<?php 

include("../database.php"); 

$task = mysqli_query($conn, "SELECT taskID FROM taskstaff WHERE staffUserID =" . getCurrentUser()); 
$completion = mysqli_query($conn, "SELECT completion FROM `users` WHERE userID =" . getCurrentUser()); 
$taskAvailable = "Not Available"; 
$taskCompleted = 0; 
$reports = 0; 
            
while ($row = mysqli_fetch_assoc($task)){ 
    
        $details = mysqli_query($conn, "SELECT taskStatus  FROM task WHERE taskID =" . $row['taskID']);    


        while ($row2 = mysqli_fetch_assoc($details)){ 

            if($row2['taskStatus'] == 'approved'){

                $taskAvailable = "Available"; 

            }

            

        }

    }

    $reporter = mysqli_query($conn, 
    "SELECT COUNT(*) AS rowCount
        FROM task 
        WHERE reporter = ". getCurrentUser() ."
    "); 

    while ($row = mysqli_fetch_assoc($reporter)){ 

        $reports = $row['rowCount']; 

    }

    while ($row = mysqli_fetch_assoc($completion)){ 
        $taskCompleted = $row['completion'];

    }





?>




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

        <?php 

        include '../python/pie.php'

        ?> 


            <div class="card">
                <p>Task</p>
                <p><?php echo $taskAvailable; ?></p>
            </div>

            <div class="card">
                <p>Task Completed</p>
                <p><?php echo $taskCompleted; ?></p>
            </div>

            <div class="card">
                <p>Report Submitted</p>
                <p><?php echo $reports; ?></p>
            </div>




        </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
