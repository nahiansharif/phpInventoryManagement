<?php
// Create a hashmap (associative array)
$planes = array(
    "A3001" => array(
        "image" => "boeing_747.jpg",
        "condition" => "Good",
        "fuel" => "Full",
        "tire" => "New",
        "engine" => "Operational"
    ),
    "A380" => array(
        "image" => "airbus_a380.jpg",
        "condition" => "Excellent",
        "fuel" => "Half",
        "tire" => "Used",
        "engine" => "Operational"
    ),
    "A372" => array(
        "image" => "cessna_172.jpg",
        "condition" => "Fair",
        "fuel" => "Low",
        "tire" => "Worn",
        "engine" => "Requires Maintenance"
    ),
    "A378" => array(
        "image" => "cessna_172.jpg",
        "condition" => "Fair",
        "fuel" => "Low",
        "tire" => "Worn",
        "engine" => "Requires Maintenance"
    )
);

// Accessing the values
// echo "Boeing 747 Fuel Status: " . $planes["Boeing 747"]["fuel"] . "\n";
// echo "Airbus A380 Condition: " . $planes["Airbus A380"]["condition"] . "\n";
// echo "Cessna 172 Engine Status: " . $planes["Cessna 172"]["engine"] . "\n";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <div class="sidebar">
        <h1>Admin &nbsp &nbsp Planes</h1>
        <a href="admin.php" >Home</a>
        <a href="#" class="home">Planes</a>
        <a href="Approvals.php" >Approvals</a>
        <a href="employee.php">Employees</a>
    </div>
    <div class="main-content">





    
        <div class="search-bar">
        
            <input type="text" placeholder="Search Planes" id="search-bar" list="search-suggestions" name="searchedTeacherName">
            <datalist id="search-suggestions">
            <!-- this is where I show all the plane names -->
            <?php
            foreach ($planes as $plane_name => $details) {
                echo "<option value=\"$plane_name\">";
            }
            ?>
            </datalist>

        </div>

        <div class="container">



        
            <div class="card">
                <img src="../plane.png" alt="Plane Image">
                <div>
                    <h1>A300</h1>
                    <p><strong>Condition</strong>: great  &nbsp &nbsp<strong>Fuel</strong>: High  &nbsp &nbsp<strong>Tire</strong>: Good  &nbsp &nbsp<strong>Engine</strong>: Good</p>
                </div>
            </div>

            <?php
            foreach ($planes as $id => $plane) {
                echo '<div class="card">';
                echo '<img src="../plane.png" alt="Plane Image" class="planePic">';
                echo '<div>';
                echo '<h1>' . $id . '</h1>';
                echo '<p><strong>Condition</strong>: ' . $plane["condition"] . ' &nbsp &nbsp<strong>Fuel</strong>: ' . $plane["fuel"] . ' &nbsp &nbsp<strong>Tire</strong>: ' . $plane["tire"] . ' &nbsp &nbsp<strong>Engine</strong>: ' . $plane["engine"] . '</p>';
                echo '</div>'; 
                echo '</div>'; 

            }
            ?>

            

            
        
        </div>

        
    
    </div> 



    



    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
