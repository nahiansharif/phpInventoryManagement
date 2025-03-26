

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Staff Status</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <div class="sidebar">
        <h1>Manager Staff Status</h1>
        <a href="manager.php" >Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="tasks.php">Tasks</a>
        <a href="#"class="home">Staff Status</a>
        <a href="buy.php">Buy Components</a>
    </div>
    <div class="main-content">

        <div class="infoBar">
            <p>
                <strong>Staff Busy: </strong> 230 &nbsp &nbsp 
                <strong>Staff Available: </strong> 500 &nbsp &nbsp 
            </p>
        </div>

        <br>
        <div class="search-bar">
            
            <input type="text" placeholder="Search Staff by ID" id="search-bar" list="search-suggestions" name="searchedTeacherName">
                <datalist id="search-suggestions">
                <!-- this is where I show all the plane names -->
                    <option value="478319">
                    <option value="478482">
                    <option value="478325">

                    <?php
                    foreach ($employees as $id => $details) {
                        echo "<option value=\"$id\">";
                    }
                    ?>
                </datalist>

        </div>

        <div class="container">
            

            
            <?php

            
            include("../database.php"); 

            while ($row = mysqli_fetch_assoc($employees)){   
                if($row["role"] != 'admin'){
                    if($row["role"] === "staff"){

                        echo '<div class="card">';
                        echo '<img src="../employee.png" alt="Plane Image" class="planePic"> <div>'; 
                        echo  '<div class="row">'; 
                        echo '<h1>' . $row["firstname"], " ", $row["lastname"] . '</h1> <p>is <strong>' . $row["status"] . '</strong></p>'; 
                        echo '</div> <br>';
                        echo '<p> <strong>Title</strong>: '. $row["role"]  .'&nbsp &nbsp <strong>ID#</strong>: '. $row["userID"] .'&nbsp &nbsp </p>'; 
                        
                        echo "</div></div>";
                    }



                }

            }


            ?>
            </div>

        </div>




        
    </div>
    

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
