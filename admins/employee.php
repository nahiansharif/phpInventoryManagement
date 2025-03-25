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
    <title>Admin Employee</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .approveButton{
            font-size: 40px;
            font-weight: 500;
            padding: 15px;
            color: white; 
            text-decoration: none; 
            border-radius: 10px;
        }
    </style>

</head>
<body>
    <div class="sidebar">
        <h1>Admin Employee</h1>
        <a href="admin.php">Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="Approvals.php">Approvals</a>
        <a href="#" class="home">Employees</a>
    </div>
    <div class="main-content">

        <div class="infoBar">
            <p>
                <strong>Managers: </strong> <?php echo $employeeNums['manager_count']; ?>  &nbsp &nbsp 
                <strong>Staff: </strong> <?php echo $employeeNums['staff_count'];  ?> &nbsp &nbsp 
                <a href="addEmployee.php" class="approveButton">Add</a>
            </p>
            
        </div>

        <br>
        <div class="search-bar">
            <input type="text" placeholder="Search Employees" id="search-bar" list="search-suggestions" name="searchedTeacherName">
                <datalist id="search-suggestions">
                <!-- this is where I show all the plane names -->
                    <option value="478319">
                    <option value="478482">
                    <option value="478325">

                    <?php
              
                    ?>
                </datalist>

        </div>

        <div class="container">


            <?php
            while ($row = mysqli_fetch_assoc($employees)){   
                if($row["role"] != 'admin'){

                    echo '<div class="card">';
                    echo '<img src="../employee.png" alt="Plane Image" class="planePic">'; 
                    echo '<div>';
                    echo '<h1>' . $row["firstname"], " ", $row["lastname"] . '</h1>';
                    echo '<p>';
                    echo '<strong>Title</strong>: ' .$row["role"].  '  &nbsp &nbsp';
                    echo '<strong>ID#</strong>: ' .$row["userID"].  '  &nbsp &nbsp';
                    echo '<strong>Password#</strong>: ' .$row["password"].  '  &nbsp &nbsp';
                    echo '</p>';
                    echo '<button class="refuseButton employeeRemoveButton" value="'.$row['userID'].'">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }

            }
                
                   
            
                
            ?>

        </div>




        
    </div>
    

    <a href="../index.php" class="logout">Log Out</a>

<script>
        const removeButton = document.querySelector('.employeeRemoveButton');
        
        document.querySelectorAll(".employeeRemoveButton").forEach(button => {
            button.addEventListener("click", function() {

            // ajax 
            const data = {
            action: 'deleteEmployee', 
            userID: this.value, 
            };

            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../database.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        console.log('Data sent successfully:', xhr.responseText);
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if(response.success){
                                console.log("Database updated");
                                //Handle success response
                            } else{
                                console.error("Database error: ", response.error);
                                //Handle error response.
                            }

                        }catch (e){
                            console.error("Error parsing JSON: ", e);
                        }

                    } else {
                        // Error! Handle the error.
                        console.error('Error sending data:', xhr.status, xhr.statusText);
                        // Handle error response.
                    }
                };
                xhr.onerror = function(){
                    console.error("Network error occured.")
                }

                xhr.send(JSON.stringify(data));    

                alert("New Employee Added"); 
                location.reload(); 

            }); 

        }); 
</script>

    
</body>
</html>
