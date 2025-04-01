

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
     
    <?php
include '../infoBar.php';
?>


        <div class="container">



            <?php

            include_once("../database.php"); 

            
            
            while ($row = mysqli_fetch_assoc($purchase)){  
                
                    $name = mysqli_query($conn, "SELECT firstname, lastname FROM users WHERE userID = ". $row['managerUserID']); 
                    if ($name) {
                        $rowName = mysqli_fetch_assoc($name); // Fetch the row as an associative array
                        $fullName = $rowName['firstname'] . ' ' . $rowName['lastname'];
                    
                        echo '<div class="card">';
                        echo '<div>';
                        echo '<h1>Manager ' . $fullName . " " . '</h1>';
                        echo '<p> wants to buy <br><strong>Plane:</strong> ' . $row['plane'] . '&nbsp&nbsp <strong>Fuel:</strong> ' . $row['fuel'] . ' &nbsp&nbsp<strong>Tire:</strong> ' . $row['tire'] .' &nbsp&nbsp<strong>Engine:</strong> ' . $row['motor'] .'</strong></p>';
                        echo '<button class="refuseButton RejectOrderButton" value="'.$row['purchaseID'].'">Refuse</button>';
                        echo '<button class="approveButton approveOrderButton" value="'.$row['purchaseID'].'">Approve</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } 
            ?>

        </div>
        


    </div>

    <?php include '../logout.php'; ?>
    <script>
        
    document.querySelectorAll(".RejectOrderButton").forEach(button => {
        button.addEventListener("click", function() {
            console.log("rejected Purchase ID:", this.value); 
            // ajax 
            const data = {
            action: 'reject_order', // Add an action field
            purchaseID: this.value, // Send the purchase ID
            };

            const xhr = new XMLHttpRequest();
                xhr.open('POST', '../database.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Success! Handle the response from the PHP file.
                        console.log('Data sent successfully:', xhr.responseText);
                        // Optionally, update the UI based on the response.
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

                location.reload();



            // mysqli_query($conn, "DELETE FROM purchase WHERE purchaseID = ". this.value);
        });
    });

    document.querySelectorAll(".approveOrderButton").forEach(button => {
        button.addEventListener("click", function() {
            
            console.log("accepted Purchase ID:", this.value); 

            // ajax 
            const data = {
            action: 'accept_order', 
            purchaseID: this.value, 
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
                            } else{
                                console.error("Database error: ", response.error);
                            }

                        }catch (e){
                            console.error("Error parsing JSON: ", e);
                        }

                    } else {
                        console.error('Error sending data:', xhr.status, xhr.statusText);
                    }
                };
                xhr.onerror = function(){
                    console.error("Network error occured.")
                }

                xhr.send(JSON.stringify(data));

            // mysqli_query($conn, "UPDATE storehouse SET plane = plane +" " WHERE purchaseID = " this.value);

            location.reload();


        });
    });



    </script>
    
</body>
</html>
