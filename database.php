<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "Silvee";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass,  $db_name); 

if($conn){
    echo "db is connected";
}else{
    echo "not connected"; 
}


$employees = mysqli_query($conn, "SELECT * FROM users"); 


?>


