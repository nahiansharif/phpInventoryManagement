<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 
include("database.php"); 

$id = 19; 

$sql1 = mysqli_query($conn, 
"SELECT staffUserID
    FROM taskstaff
    WHERE taskID = ". $id); 

while ($row = mysqli_fetch_assoc($sql1)){ 
    echo "<h1>". $row['staffUserID'] ."</h1>"; 

    mysqli_query($conn, "UPDATE users 
            SET status = 'available'
                WHERE userID = ". $row['staffUserID']); 

    }








?>



 
    
</body>
</html>