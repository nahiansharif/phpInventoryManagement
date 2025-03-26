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

            $details = mysqli_query($conn, "SELECT TargetPlane, Fuel, motor, tire1, tire2, tire3, tire4, tire5, tire6 FROM task WHERE taskID =" . $row['taskID']);    

            $
            while ($row2 = mysqli_fetch_assoc($details)){ 

                echo "<p>Plane <strong class=''>".$row2['TargetPlane']." </strong> needs <strong  class=''>".$row2['motor']." </strong>  engine, <strong  class=''>".$row2['tire1']." </strong>  tires, <strong  class=''>". 70000 - $row2['Fuel']." </strong>  gallons of fuel </p>"; 

            }
            



            }

            




            ?>

            





                
        
            
        </div>
        <div class="container">      
              <button class="approveButton"> complete the Task </button>
        </div>
        



    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
