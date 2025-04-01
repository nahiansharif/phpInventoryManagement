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
            <input type="text" placeholder="Search Employees" id="search_employee_bar">
                

        </div>

        <div class="container" id="show_searched_employees">


            <?php
            while ($row = mysqli_fetch_assoc($employees)){   
                if($row["role"] != 'admin'){

                    echo '<div class="card">';
                    echo '<img src="../employee.png" alt="Plane Image" class="planePic">'; 
                    echo '<div>';
                    echo '<h1>' . $row["firstname"]. " ". $row["lastname"] . '</h1>';
                    echo '<p>';
                    echo '<strong>Title</strong>: ' .$row["role"].  '  &nbsp &nbsp';
                    echo '<strong>ID#</strong>: ' .$row["userID"].  '  &nbsp &nbsp';
                    echo '<strong>Password</strong>: ' .$row["password"].  '  &nbsp &nbsp';
                    echo '</p>';
                    echo '<button class="refuseButton employeeRemoveButton" value="'.$row['userID'].'">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }

            }
                
            ?>

        </div>




        
    </div>
    

    <?php include '../logout.php'; ?>

<script>
        const removeButton = document.querySelector('.employeeRemoveButton');

        document.getElementById('show_searched_employees').addEventListener('click', function(e) {
            if (e.target.classList.contains('employeeRemoveButton')) {
        // Retrieve the userID from the button's value attribute
        const userID = e.target.value;
            document.querySelectorAll(".employeeRemoveButton").forEach(button => {
                button.addEventListener("click", function() {

                // ajax 
                const data = {
                action: 'deleteEmployee', 
                userID: userID, 
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
                                    console.log("Database updated Employee Deleted");
                                    alert("Employee Deleted"); 
                                    location.reload(); 
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

                    

                }); 

            }); 
        }
        }); 


        //////////////////////////////////////////////////////////////////////////////

        const employeeSearchBar = document.getElementById('search_employee_bar');

        let searchValue = '';
        // show_searched_employees

        employeeSearchBar.addEventListener('input', () => {
            searchValue = employeeSearchBar.value;
            
            const data = {
            action: 'liveSearchAdminEmployee', 
            id: searchValue,
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
                                console.log("Live Search is working");
                                // Update the search results container with the server's response data
                                document.getElementById('show_searched_employees').innerHTML = response.data;
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
        }); 
</script>

    
</body>
</html>
