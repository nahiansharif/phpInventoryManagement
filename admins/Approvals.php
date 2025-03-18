<?php

$approvals = [
    [
        'name' => 'Manager 365',
        'amount' => 3,
        'text' => 'engine',
        'status' => null,
    ],
    [
        'name' => 'Supervisor Alpha',
        'amount' => 10,
        'text' => 'project proposal',
        'status' => false,
    ],
    [
        'name' => 'Director Beta',
        'amount' => 50,
        'text' => 'budget request',
        'status' => true,
    ],
    [
        'name' => 'Team Lead Gamma',
        'amount' => 1,
        'text' => 'time off',
        'status' => false,
    ],
    [
        'name' => 'VP Delta',
        'amount' => 100,
        'text' => 'strategic plan',
        'status' => null,
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .card {
            width: 600px; /* Adjust width as needed */
            height: 250px; /* Adjust height as needed */
            
        }

        .card div {
            flex-grow: 0; 
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Admin Approvals</h1>
        <a href="admin.php" >Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="#" class="home">Approvals</a>
        <a href="employee.php">Employees</a>
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
                
                <div>
                    <h1>Manager 365</h1> <!-- display name here -->
                    <p> wants to buy <strong>15 tires</strong></p> <!-- display integer first, and then the tex inside of the strong tag only, "wants to buy" will remain there outside of strong tag always -->

                    <button class="refuseButton">Refuse</button>
                    <button class="approveButton">Approve</button>
                </div>
                
                    
                
            </div>

            <?php
                foreach ($approvals as $approval) {
                    echo '<div class="card">';
                    echo '<div>';
                    echo '<h1>' . $approval['name'] . '</h1>';
                    echo '<p> wants to buy <strong>' . $approval['amount'] . ' ' . $approval['text'] . '</strong></p>';
                    echo '<button class="refuseButton">Refuse</button>';
                    echo '<button class="approveButton">Approve</button>';
                    echo '</div>';
                    echo '</div>';
                } 
            ?>


            

            

            
        
        </div>
        


    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
