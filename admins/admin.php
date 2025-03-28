<?php

include("../database.php"); 

$managersANDstaff = mysqli_query($conn, 
    "SELECT 
    SUM(CASE WHEN role = 'manager' THEN 1 ELSE 0 END) AS manager_count,
    SUM(CASE WHEN role = 'staff' THEN 1 ELSE 0 END) AS staff_count
    FROM users;
    "); 
$employeeNums = mysqli_fetch_assoc($managersANDstaff);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
        <h1>Admin Dashboard</h1>
        <a href="#" class="home">Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="Approvals.php">Approvals</a>
        <a href="employee.php">Employees</a>

        
    </div>
    <div class="main-content">
        <div class="container">

        <?php 

        include '../python/pie.php'

        ?> 


            <div class="card">
                <p>Manager</p>
                <p><?php echo $employeeNums['manager_count']; ?> </p>
            </div>

            <div class="card">
                <p>Staff</p>
                <p><?php echo $employeeNums['staff_count']; ?> </p>
            </div>




        </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
