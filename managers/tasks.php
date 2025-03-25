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
    <title>Manager Tasks</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .card {
            height: 1400px; 
            /* 
            0 = 350

            2 = 500

            4 = 700

            8 = 1400
            */
        }

        .card div {
            flex-grow: 0; 
        }

        .menu{
            display:flex; 
            background-color: #d3d3d3; 
            justify-content: center;
            width:550px; 
            margin-left:60px; 
            border-radius: 10px; 
            
        }

        .menu button{
            margin:8px; 
        }


    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Manager Tasks</h1>
        <a href="manager.php" >Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="#" class="home">Tasks</a>
        <a href="staffStatus.php">Staff Status</a>
        <a href="buy.php">Buy Components</a>
    </div>
    <div class="main-content">
     
        <div class="infoBar">
            <p>
                <strong>Tasks </strong>
            </p>
        </div>


        <div class="container">

        <div class="menu">
            <button class="approveButton" value="1" >On Hold</button>
            <button class="unselectedButton" value="2">Approved</button>
            <button class="unselectedButton" value="3">Completed</button>
            <button class="unselectedButton" value="4">Rejected</button>
        </div>


        





        
            <div class="card">
                
                <div>
                    <h1>"Full Name" reports: </h1> <!-- display name here -->
                    <p> Plane <strong>A372</strong>'s <strong>Engine</strong> is <strong>dead</strong></p> <!-- display integer first, and then the tex inside of the strong tag only, "wants to buy" will remain there outside of strong tag always -->
                    <p><strong>Comments: </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>

                    <button class="refuseButton">Refuse</button>
                    <button class="approveButton">Approve</button>
                </div>
                
                    
                
            </div>

            <?php
            include("../database.php"); 
            while ($row = mysqli_fetch_assoc($tasks)){   
                
                echo '<div class="card">';
                echo '<div>';

                $fullname = mysqli_query($conn, "SELECT firstname, lastname FROM users WHERE userID = " .$row['reporter'] ); 
                while ($row2 = mysqli_fetch_assoc($fullname)){ 
                    echo "<h1> ". $row2["firstname"] . " " . $row2["lastname"] . "'s Task# " . $row['TaskID']. " report: </h1>";
                }

                $numOfBadTires = 3; 
                echo "<p> Plane <strong>" . $row['TargetPlane'].
                "</strong>'s engine is <strong>". $row['motor'] ."</strong>, 
                Fuel Level is <strong>". $row['Fuel'] ."</strong>,
                and have <strong>". $numOfBadTires ."</strong> problematic Tires. </p>"; 

                echo "<p>Need <strong>  " . $row['neededWorkers'] ."</strong> workers to finish the task. </p>"; 

                echo "<p><strong>Comments: </strong> " . $row['comments'] ."</p>"; 

                for($i = 1; $i <= $row['neededWorkers'] ; $i++){

                    // this is where we show the name of all available staff
                    echo "<p> select worker #". $i . "</p>"; 
                    echo "<select id=worker".$i." >"; 

                    mysqli_data_seek($employees, 0);
                    while ($row3 = mysqli_fetch_assoc($employees)){   
                        if(($row3["role"] === 'staff') && $row3["status"] === 'available'){
                            echo "<option> ". $row3["firstname"] ." " . $row3["lastname"] ." </option>"; 
                        }
                    }
                    echo "</select> <br><br>"; 

                }
                

                echo "<button class='refuseButton refuseOrder'>Refuse</button>";
                echo "<button class='approveButton approveOrder'>Approve</button>"; 
                    
                    
                    // echo '<h1>' . $approval['name'] . '</h1>';
                    // echo '<p> wants to buy <strong>' . $approval['amount'] . ' ' . $approval['text'] . '</strong></p>';
                    // echo '<button class="refuseButton">Refuse</button>';
                    // echo '<button class="approveButton">Approve</button>';
                    echo '</div>';
                    echo '</div>';
                } 
            ?>

        
        </div>
        


    </div>
    
    <a href="../index.php" class="logout">Log Out</a>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".menu button");
    
        buttons.forEach(button => {
            button.addEventListener("click", function() {
                // Remove "approveButton" from all buttons
                buttons.forEach(btn => {
                btn.classList.remove("approveButton");
                btn.classList.add("unselectedButton");
                });
        
                // Add "approveButton" to the clicked button
                this.classList.remove("unselectedButton");
                this.classList.add("approveButton");


                const buttonValue = button.value;
                console.log(`Button "${button.textContent}" clicked. Value: ${buttonValue}`);
            });
        });
    });
    </script>

    <!--  -->

    <script>

        //update status 

        document.querySelectorAll(".refuseOrder").forEach(button => {
            button.addEventListener("click", function() {

                


            }); 
        });


    </script>
    
</body>
</html>
