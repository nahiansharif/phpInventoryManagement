<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Tasks</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>

<div class="sidebar">
        <h1>Staff <br> Task</h1>
        <a href="staff.php" >Home</a>
        <a href="searchPlanes.php">Search Planes</a>
        <a href="report.php">Report</a>
        <a href="#" class="home">Tasks</a>
    </div>
    
    <div class="main-content">

    <?php
include '../infoBar.php';
?>
        <div class="infoBar">
            

            <?php
            include_once '../database.php';

            $task = mysqli_query($conn, "SELECT taskID FROM taskstaff WHERE staffUserID =" . getCurrentUser()); 

            
                while ($row = mysqli_fetch_assoc($task)){ 
                    
                        $details = mysqli_query($conn, "SELECT TargetPlane, Fuel, motor, tire1, tire2, tire3, tire4, tire5, tire6, taskStatus  FROM task WHERE taskID =" . $row['taskID']);    

                        $tires = 0; 
                        $engines = 0; 

                    


                        while ($row2 = mysqli_fetch_assoc($details)){ 

                            if($row2['taskStatus'] == 'approved'){

                                if(($row2['motor'] == "Medicore") || ($row2['motor'] == "Bad")){
                                    $engines += 1; 
                                }
                    
                                if(($row2['tire1'] == "Medicore") || ($row2['tire1'] == "Bad")){
                                    $tires += 1; 
                                }
    
                                if(($row2['tire2'] == "Medicore") || ($row2['tire2'] == "Bad")){
                                    $tires += 1; 
                                }
    
                                if(($row2['tire3'] == "Medicore") || ($row2['tire3'] == "Bad")){
                                    $tires += 1; 
                                }
    
                                if(($row2['tire4'] == "Medicore") || ($row2['tire1'] == "Ba4")){
                                    $tires += 1; 
                                }
    
                                if(($row2['tire5'] == "Medicore") || ($row2['tire5'] == "Bad")){
                                    $tires += 1; 
                                }
    
                                if(($row2['tire6'] == "Medicore") || ($row2['tire6'] == "Bad")){
                                    $tires += 1; 
                                }
    
    
                                echo "<p>Plane <strong class=''>".$row2['TargetPlane']." </strong> needs <strong  class=''>".$engines." </strong>  engine, <strong  class=''>".$tires." </strong>  tires, <strong  class=''>". 70000 - $row2['Fuel']." </strong>  gallons of fuel </p>"; 
    
    
                                echo"</div><div class='container'>  ";  
    
                                echo "<button class='approveButton completedTask' 
                                taskID ='". $row['taskID'] ."' 
                                planeName='".$row2['TargetPlane']."' 
                                engine='".$engines."' 
                                tires='".$tires."' 
                                fuels='". 70000 - $row2['Fuel']."'>
                                Complete the Task </button>"; 
                                
                            
    
                                echo "</div>  ";

                            }

                            
                            

                            
                            
                            
                        
                        }

                    

                }

            ?>




                
        
            
        

        



    </div>

    <a href="../index.php" class="logout">Log Out</a>

    <script>
// Query the button with the class "completedTask"
const button = document.querySelector('.completedTask');

// Print the values of the button's attributes



  button.addEventListener('click', () => {

                const data = {
                    action: 'staffCompletesTask', 
                    planeName: button.getAttribute('planeName'),
                    engine: button.getAttribute('engine'),
                    tires: button.getAttribute('tires'),
                    fuels: button.getAttribute('fuels'),
                    taskID: button.getAttribute('taskID'),
                };

                console.log(data);

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
                alert("Task Completed");
                // location.reload(); 

  });




</script>
    
</body>
</html>
