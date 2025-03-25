<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "Silvee";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass,  $db_name); 

// if ($conn) {
//     echo "<p style=\"display: none;\">db is connected</p>";
// }
// else{
//     echo "<p style=\"display: none;\">NOT connected</p>";
// }
session_start();
function setCurrentUser($username){
    $_SESSION['currentUser'] = $username;
}
function getCurrentUser(){
    return $_SESSION['currentUser'];
}

$employees = mysqli_query($conn, "SELECT * FROM users"); 
$storeHouse = mysqli_query($conn, "SELECT * FROM storehouse"); 
$planes = mysqli_query($conn, "SELECT * FROM plane"); 
$purchase = mysqli_query($conn, "SELECT * FROM purchase"); 
$tasks = mysqli_query($conn, "SELECT * FROM task"); 




$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode(['success' => false, 'error' => "Invalid JSON data: " . json_last_error_msg()]));
    }

    // putting bought stuff request in the database
    if (isset($data['action']) && $data['action'] === 'purchase') {

        $engine = $data['engine'];
        $tire = $data['tire'];
        $fuel = $data['fuel'];
        $plane = $data['plane'];
    
        mysqli_query($conn, "INSERT INTO purchase (managerUserID, plane, fuel, tire, motor) 
        VALUES ('" . getCurrentUser() . "', " . $plane . ", " . $fuel . ", " . $tire . ", " . $engine . ");");    

        echo json_encode(['success' => true, 'message' => 'Purchase order created']);

    } else if (isset($data['action']) && $data['action'] === 'reject_order'){
        $id = $data['purchaseID'];
        mysqli_query($conn, "DELETE FROM purchase  WHERE purchaseID =" .  $id);
        echo json_encode(['success' => true, 'message' => 'Order rejected']);
       
             
    } else if (isset($data['action']) && $data['action'] === 'accept_order'){
        $id = $data['purchaseID'];
        $order = mysqli_query($conn, "SELECT * FROM purchase WHERE purchaseID = " . $id);
        while ($row = mysqli_fetch_assoc($order)){ 
            mysqli_query($conn, "UPDATE storehouse 
            SET plane = plane + " . $row['plane'] . ", 
                fuel = fuel + " . $row['fuel'] . ", 
                tire = tire + " . $row['tire'] . ", 
                motor = motor + " . $row['motor']);
        }

        mysqli_query($conn, "DELETE FROM purchase  WHERE purchaseID =" .  $id);
        echo json_encode(['success' => true, 'message' => 'Order accepted and store updated']);      
        

    }else if (isset($data['action']) && $data['action'] === 'createEmployee'){
        
        $role = $data['role'];
        $firstname =   $data['firstname'];
        $lastname =  $data['lastname'];
        $password =  $data['password'];
        $status = "available";
        $tasks = -1; 


        // mysqli_query($conn, "INSERT INTO purchase (managerUserID, plane, fuel, tire, motor) 
        // VALUES ('" . getCurrentUser() . "', " . $plane . ", " . $fuel . ", " . $tire . ", " . $engine . ");");    

        mysqli_query($conn, "INSERT INTO users (password, firstname, lastname, role, status, tasks) VALUES
        ('". $password."',
         '".$firstname."',
         '".$lastname."',
         '".$role."',
         '". $status ."',
         '". $tasks ."');");

        echo json_encode(['success' => true, 'message' => 'Employee Added']);      


    }else if (isset($data['action']) && $data['action'] === 'deleteEmployee'){

        $userID = $data['userID'];
        mysqli_query($conn, "DELETE FROM users  WHERE userID =" .  $userID);
        echo json_encode(['success' => true, 'message' => 'Order rejected']);

    }else if (isset($data['action']) && $data['action'] === 'createTasks'){

        $stateCalculation = "N/A"; 

        mysqli_query($conn, "INSERT INTO task (TargetPlane, Fuel, 
        tire1, tire2, tire3, tire4, tire5, tire6, motor, state, taskStatus, 
         comments, reporter, neededWorkers ) VALUES
        ('". $data['planeName'] ."',
         '". $data['fuelNum'] ."',
         '". $data['tire1'] ."',
         '". $data['tire2'] ."',
         '". $data['tire3'] ."',
         '". $data['tire4'] ."',
         '". $data['tire5'] ."',
         '". $data['tire6'] ."',
         '". $data['engine'] ."', 
         '". $stateCalculation ."',
         'On Hold',
         '". $data['comments'] ."',         
         '". getCurrentUser() ."',
         '". $data['neededWorkers'] ."');");

         echo json_encode(['success' => true, 'message' => 'Order rejected']);

    }

}


?>


