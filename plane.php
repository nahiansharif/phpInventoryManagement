
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../style.css">
    <style>
        .card {
            height: 300px; /* Adjust height as needed */
            
        }

    </style>

</head>
<body>

    <div class="main-content">


        <div class="search-bar">
        
            <input type="text" placeholder="Search Planes" id="search-bar" >
           
            
   
        </div>

        <div class="container">  
            

            <?php
            include("../database.php"); 

            while ($row = mysqli_fetch_assoc($planes)){  
                echo '<div class="card">';
                echo '<img src="../plane.png" alt="Plane Image" class="planePic">';
                echo '<div>';
                echo '<h1>' . $row['NameID'] . '</h1>';
                echo '<p><strong>Condition</strong>: ' . $row["state"] . ' &nbsp &nbsp<strong>Fuel</strong>: ' . $row["fuel"] . ' &nbsp &nbsp<strong>Engine</strong>: ' . $row["motor"] . '</p>';
                echo '<p> <strong>Tire 1</strong>: ' . $row["tire1"] .  '&nbsp &nbsp<strong>Tire 2</strong>: ' . $row["tire2"] . '&nbsp &nbsp<strong>Tire 3</strong>: ' . $row["tire3"] . '</p>';
                echo '<p> <strong>Tire 4</strong>: ' . $row["tire4"] .  '&nbsp &nbsp<strong>Tire 5</strong>: ' . $row["tire5"] . '&nbsp &nbsp<strong>Tire 6</strong>: ' . $row["tire6"] . '</p>';
                echo '</div>'; 
                echo '</div>'; 

            }
            ?>

            

            
        
        </div>

        
    
    </div> 



    
   
    <script type="text/javascript" src="../front.js"></script>
</body>
</html>
