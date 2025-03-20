<?php

$employees = [
    101 => [
        'full_name' => 'John Doe',
        'title' => 'Software Engineer',
        'password' => 'password123', // Remember: never store passwords like this!
    ],
    102 => [
        'full_name' => 'Jane Smith',
        'title' => 'Project Manager',
        'password' => 'securepass',
    ],
    103 => [
        'full_name' => 'David Lee',
        'title' => 'Data Analyst',
        'password' => 'data456',
    ],
    104 => [
        'full_name' => 'Emily Chen',
        'title' => 'UX Designer',
        'password' => 'design789',
    ],
    105 => [
        'full_name' => 'Robert Garcia',
        'title' => 'Sales Representative',
        'password' => 'salespass',
    ],
];
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
                <strong>Managers: </strong> 23 &nbsp &nbsp 
                <strong>Staff: </strong> 500 &nbsp &nbsp 
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
                    foreach ($employees as $id => $details) {
                        echo "<option value=\"$id\">";
                    }
                    ?>
                </datalist>

        </div>

        <div class="container">
            <div class="card">
                <img src="../employee.png" alt="Plane Image" class="planePic">
                    <div>
                        <h1>Kash Naplique</h1>
                        <p>
                            <strong>Title</strong>: Manager  &nbsp &nbsp
                            <strong>ID#</strong>: 401253  &nbsp &nbsp
                            <strong>Password</strong>: !dsldsjd  &nbsp &nbsp
                        </p>
                        <button class="refuseButton">Delete</button>
                    </div>
            </div>

            <?php
                foreach ($employees as $id => $details) {
                    echo '<div class="card">';
                    echo '<img src="../employee.png" alt="Plane Image" class="planePic">'; 
                    echo '<div>';
                    echo '<h1>' . $details["full_name"] . '</h1>';
                    echo '<p>';
                    echo '<strong>Title</strong>: ' .$details["title"].  '  &nbsp &nbsp';
                    echo '<strong>ID#</strong>: ' .$id.  '  &nbsp &nbsp';
                    echo '<strong>Password#</strong>: ' .$details["password"].  '  &nbsp &nbsp';
                    echo '</p>';
                    echo '<button class="refuseButton">Delete</button>';
                    echo '</div>';
                    echo '</div>';

                }
            ?>

        </div>




        
    </div>
    

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
