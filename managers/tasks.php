

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

        <?php
        include("../database.php"); 
            if(getShowTaskBasedOnStatus() === "on hold") {
                echo "<button class='approveButton' value='1'>On Hold</button>";
                echo "<button class='unselectedButton' value='2'>Approved</button>";
                echo "<button class='unselectedButton' value='3'>Completed</button>";
                echo "<button class='unselectedButton' value='4'>Rejected</button>";
            } else if(getShowTaskBasedOnStatus() === "approved") {
                echo "<button class='unselectedButton' value='1'>On Hold</button>";
                echo "<button class='approveButton' value='2'>Approved</button>";
                echo "<button class='unselectedButton' value='3'>Completed</button>";
                echo "<button class='unselectedButton' value='4'>Rejected</button>";
            } else if(getShowTaskBasedOnStatus() === "completed") {
                echo "<button class='unselectedButton' value='1'>On Hold</button>";
                echo "<button class='unselectedButton' value='2'>Approved</button>";
                echo "<button class='approveButton' value='3'>Completed</button>";
                echo "<button class='unselectedButton' value='4'>Rejected</button>";
            } else if(getShowTaskBasedOnStatus() === "rejected") {
                echo "<button class='unselectedButton' value='1'>On Hold</button>";
                echo "<button class='unselectedButton' value='2'>Approved</button>";
                echo "<button class='unselectedButton' value='3'>Completed</button>";
                echo "<button class='approveButton' value='4'>Rejected</button>";
            }else{

                echo "<button class='unselectedButton' value='1'>On Hold</button>";
                echo "<button class='unselectedButton' value='2'>Approved</button>";
                echo "<button class='approveButton' value='3'>Completed</button>";
                echo "<button class='unselectedButton' value='4'>Rejected</button>";
                

            }
        ?>


            
        </div>


        






            <?php
            
            while ($row = mysqli_fetch_assoc($tasks)){   
                if($row['taskStatus'] === getShowTaskBasedOnStatus()){

                    
                    $height = 350;

                    if ($row['neededWorkers'] == 2) {
                        $height = 700;
                    } elseif ($row['neededWorkers'] == 4) {
                        $height = 900;
                    } elseif ($row['neededWorkers'] == 8) {
                        $height = 1400;
                    }
            
                    // Apply the height as an inline style
                    echo '<div class="card" style="height: ' . $height . 'px;">';

                    

                    
                    
                
                
                
                echo '<div>';

                $fullname = mysqli_query($conn, "SELECT firstname, lastname FROM users WHERE userID = " .$row['reporter'] ); 
                while ($row2 = mysqli_fetch_assoc($fullname)){ 
                    echo "<h1> ". $row2["firstname"] . " " . $row2["lastname"] . "'s Task# " . $row['TaskID']. " report: </h1>";
                }

                // use for loop from 1 to 6
                // check if tire[i] is medicore or bad
                //if yes, increment
                $numOfBadTires = 0;
                
                
                echo "<p> Plane <strong>" . $row['TargetPlane'].
                "</strong>'s engine is <strong>". $row['motor'] ."</strong>, 
                Fuel Level is <strong>". $row['Fuel'] ."</strong>,
                and have <strong>". $numOfBadTires ."</strong> problematic Tires. </p>"; 

                echo "<p>Need <strong> " . $row['neededWorkers'] ."</strong> workers to finish the task. </p>"; 
                
                echo "<p><strong>Comments: </strong> " . $row['comments'] ."</p>"; 

                if($row['taskStatus'] === "on hold"){

                    //kulimuttta

                    for($i = 1; $i <= $row['neededWorkers'] ; $i++){

                        // this is where we show the name of all available staff
                        echo "<p> select worker #". $i . "</p>"; 
                        echo "<select class='worker-select-".$row['TaskID']."'>";
                    
                        mysqli_data_seek($employees, 0);
                        while ($row3 = mysqli_fetch_assoc($employees)){   
                            if(($row3["role"] === 'staff') && $row3["status"] === 'available'){
                                echo "<option value='" . $row3["userID"] . "'>" . $row3["firstname"] . " " . $row3["lastname"] . "</option>"; 
                            }
                        }
                        echo "</select> <br><br>"; 
                    
                    }
                

                echo "<button class='refuseButton refuseOrder'   value='". $row['TaskID'] ."'>Refuse</button>";
                echo "<button class='approveButton approveOrder' numOfWorkers='".$row['neededWorkers']."' value='". $row['TaskID'] ."'>Approve</button>"; 

                } else {

                    $names = mysqli_query($conn, "  SELECT u.firstname, u.lastname
                                                    FROM taskStaff ts
                                                    JOIN users u ON ts.staffUserID = u.userID
                                                    WHERE ts.taskID = " . $row['TaskID']);
                    echo "<p> Workers on this task is: </p>"; 
                    while ($row4 = mysqli_fetch_assoc($names)){   
                        echo "<p>". $row4['firstname'] . " " . $row4['lastname'] . "</p>";
                    }
                }


                    

                    echo '</div>';
                    echo '</div>';
                }
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
                

                const data = {
                action: 'showTaskStatus', 
                pageNum: this.value, 
                };

                console.log(data); 

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../database.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        console.log('Data sent successfully from showTaskStatus:', xhr.responseText);
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




            });
        });
    });
    </script>

    <!--  -->

    <script>

        //update status 

        document.querySelectorAll(".refuseOrder").forEach(button => {
            button.addEventListener("click", function() {

                //change the order status to rejected

                const data = {
                action: 'refuseTask', 
                taskID: this.value, 
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
                        
                        console.error('Error sending data:', xhr.status, xhr.statusText);
                        
                    }
                };
                xhr.onerror = function(){
                    console.error("Network error occured.")
                }

                xhr.send(JSON.stringify(data));    

                alert("Task " + this.value + " is refused"); 
                location.reload(); 

                

            }); 
        });

        document.querySelectorAll(".approveOrder").forEach(button => {
            button.addEventListener("click", function(event) {

                const numOfWorkers = event.target.getAttribute("numOfWorkers");

                const data = {
                action: 'approveTask', 
                taskID: this.value, 
                workers: [],
                };
                
                
                //kulimuttta

                document.querySelectorAll('.worker-select-' + this.value).forEach((select) => {
                    console.log("does this even exists?"); 
                    console.log(select.value); 
                    data.workers.push(select.value); // Push values into the array
                });

                

                console.log(data)
                

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

                alert("Task " + this.value + " is approved"); 
                location.reload(); 

            }); 
        });


    </script>
    
</body>
</html>
