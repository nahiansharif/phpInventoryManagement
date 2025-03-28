<?php

include("../database.php"); 

$staffAvialability = mysqli_query($conn, 
    "SELECT status, 
    COUNT(*) AS staffCount
    FROM `users` 
    WHERE role='staff'
    GROUP BY status; 
    "); 

    $staffNum = []; 

while ($row = mysqli_fetch_assoc($staffAvialability)){ 
array_push($staffNum, $row['staffCount']); 
}

$taskAvialability = mysqli_query($conn, 
    "SELECT taskStatus, 
    COUNT(*) AS taskCount
    FROM `task` 
    GROUP BY taskStatus; 
    "); 

    $taskNum = []; 

while ($row = mysqli_fetch_assoc($taskAvialability)){ 
array_push($taskNum, $row['taskCount']); 
}




?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Panel</title>
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
        <h1>Manager Dashboard</h1>
        <a href="#" class="home">Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="tasks.php">Tasks</a>
        <a href="staffStatus.php">Staff Status</a>
        <a href="buy.php">Buy Components</a>
    </div>

    <div class="main-content">
        <div class="container">

        <?php 

        include '../python/pie.php'

        ?> 

            

            <div class="column">
                <div class="card">
                    <p>Task on hold</p>
                    <p> <?php echo $taskNum[0] ?> </p>
                </div>

                <div class="card">
                    <p>Task Approved</p>
                    <p> <?php echo $taskNum[1] ?> </p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <p>Staff Working</p>
                    <p><?php echo $staffNum[1]; ?></p>
                </div>

                <div class="card">
                    <p>Staff Available</p>
                    <p><?php echo $staffNum[0]; ?></p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <p>Task Rejected</p>
                    <p> <?php echo $taskNum[3] ?> </p>
                </div>

                <div class="card">
                    <p>Task Completed</p>
                    <p> <?php echo $taskNum[2] ?> </p>
                </div>
            </div>
            
        </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
