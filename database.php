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


if (!isset($_SESSION['ShowTaskBasedOnStatus'])) {
    $_SESSION['ShowTaskBasedOnStatus'] = "on hold"; 
}
function setShowTaskBasedOnStatus($ShowTaskBasedOnStatus){
    $_SESSION['ShowTaskBasedOnStatus'] = $ShowTaskBasedOnStatus;
}
function getShowTaskBasedOnStatus(){
    return $_SESSION['ShowTaskBasedOnStatus'];
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
        
        $role = htmlspecialchars($data['role']);
        $firstname =   htmlspecialchars($data['firstname']);
        $lastname =  htmlspecialchars($data['lastname']);
        $password =  htmlspecialchars($data['password']);
        $status = "available";
       


        // mysqli_query($conn, "INSERT INTO purchase (managerUserID, plane, fuel, tire, motor) 
        // VALUES ('" . getCurrentUser() . "', " . $plane . ", " . $fuel . ", " . $tire . ", " . $engine . ");");    

        mysqli_query($conn, "INSERT INTO users (password, firstname, lastname, role, status) VALUES
        ('". $password."',
         '".$firstname."',
         '".$lastname."',
         '".$role."',
         '". $status ."');");

        echo json_encode(['success' => true, 'message' => 'Employee Added']);      


    }else if (isset($data['action']) && $data['action'] === 'deleteEmployee'){

        $userID = $data['userID'];
        mysqli_query($conn, "DELETE FROM users  WHERE userID =" .  $userID);
        echo json_encode(['success' => true, 'message' => 'Order rejected']);

    }else if (isset($data['action']) && $data['action'] === 'createTasks'){

         

        mysqli_query($conn, "INSERT INTO task (TargetPlane, Fuel, 
        tire1, tire2, tire3, tire4, tire5, tire6, motor,  taskStatus, 
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
         'On Hold',
         '". htmlspecialchars($data['comments'] )."',         
         '". getCurrentUser() ."',
         '". $data['neededWorkers'] ."');");

        mysqli_query($conn, "UPDATE plane 
        SET fuel = ". $data['fuelNum'] .",
        tire1 = '". $data['tire1'] ."',
        tire2 = '". $data['tire2'] ."',
        tire3 = '". $data['tire3'] ."',
        tire4 = '". $data['tire4'] ."',
        tire5 = '". $data['tire5'] ."',
        tire6 = '". $data['tire6'] ."',
        motor = '". $data['engine'] ."'
        WHERE nameID = '". $data['planeName'] ."';"
        
        ); 
        
        

         echo json_encode(['success' => true, 'message' => 'Order rejected']);

    }else if (isset($data['action']) && $data['action'] === 'refuseTask'){

        mysqli_query($conn, "UPDATE task 
            SET taskStatus = 'rejected'
            WHERE taskID = " .$data['taskID']);

        echo json_encode(['success' => true, 'message' => 'Task Status updated to refused ']);

    }else if (isset($data['action']) && $data['action'] === 'approveTask'){

        mysqli_query($conn, "UPDATE task 
            SET taskStatus = 'approved'
            WHERE taskID = " .$data['taskID']);

        // insert task id and workers to the taskStaff table. 

        foreach($data['workers'] as $worker){

            mysqli_query($conn, "INSERT INTO taskstaff (TaskID, staffUserID) 
            VALUES (" . $data['taskID'] . ", " . $worker. ");");


            // update staff status from available to busy 
            mysqli_query($conn, "UPDATE users 
            SET status = 'busy'
            WHERE userID = " .$worker);

        }

        echo json_encode(['success' => true, 'message' => 'Task Status updated to approved ']);

    }else if (isset($data['action']) && $data['action'] === 'showTaskStatus'){
        

        switch ($data['pageNum']) {
            case 1:
                setShowTaskBasedOnStatus("on hold");
                break;
            case 2:
                setShowTaskBasedOnStatus("approved");
                break;
            case 3:
                setShowTaskBasedOnStatus("Completed");
                break;
            case 4:
                setShowTaskBasedOnStatus("rejected");
                break;
            
        }
        echo json_encode(['success' => true, 'message' => ' page changes successfully ']);

    }else if (isset($data['action']) && $data['action'] === 'staffCompletesTask') {

        mysqli_begin_transaction($conn);
    
        mysqli_query($conn, "UPDATE task SET taskStatus = 'Completed' WHERE taskID = " . $data['taskID']);
    
        mysqli_query($conn, "UPDATE storehouse SET fuel = fuel - " . $data['fuels'] . ", tire = tire - " . $data['tires'] . ", motor = motor - " . $data['engine']);
    
        mysqli_query($conn, "UPDATE plane SET fuel = 70000, tire1 = 'Good', tire2 = 'Good', tire3 = 'Good', tire4 = 'Good', tire5 = 'Good', tire6 = 'Good', motor = 'Good' WHERE NameID = '" . $data['planeName'] . "'");
    
        $sql1 = mysqli_query($conn, "SELECT staffUserID FROM taskstaff WHERE taskID = " . $data['taskID']);
    
        while ($row = mysqli_fetch_assoc($sql1)) {
            mysqli_query($conn, "UPDATE users SET status = 'available', completion = completion + 1 WHERE userID = " . $row['staffUserID']);
        }
    
        mysqli_commit($conn);
        echo json_encode(['success' => true, 'message' => 'Staff finished the task successfully']);
    }
    else if (isset($data['action']) && $data['action'] === 'liveSearchPlane'){

        $name = htmlspecialchars($data['name']); 

        $query = mysqli_query($conn, "SELECT * FROM plane WHERE NameID LIKE '$name%'"); 
        $data = '';

        $data = '';

        while ($row = mysqli_fetch_assoc($query)) {  
            $data .= '<div class="card">';
            $data .= '<img src="../plane.png" alt="Plane Image" class="planePic">';
            $data .= '<div>';
            $data .= '<h1>' . $row['NameID'] . '</h1>';
            $data .= '<p><strong>Fuel</strong>: ' . $row["fuel"] . ' &nbsp &nbsp<strong>Engine</strong>: ' . $row["motor"] . '</p>';
            $data .= '<p> <strong>Tire 1</strong>: ' . $row["tire1"] . '&nbsp &nbsp<strong>Tire 2</strong>: ' . $row["tire2"] . '&nbsp &nbsp<strong>Tire 3</strong>: ' . $row["tire3"] . '</p>';
            $data .= '<p> <strong>Tire 4</strong>: ' . $row["tire4"] . '&nbsp &nbsp<strong>Tire 5</strong>: ' . $row["tire5"] . '&nbsp &nbsp<strong>Tire 6</strong>: ' . $row["tire6"] . '</p>';
            $data .= '</div>'; 
            $data .= '</div>'; 
        }

        
        echo json_encode(['success' => true, 'data' => $data, 'message' => 'Live Search for plane is working']);
        
    

    }else if (isset($data['action']) && $data['action'] === 'liveSearchAdminEmployee'){

        $id = htmlspecialchars($data['id']); 

        $query = mysqli_query($conn, "SELECT * FROM users WHERE (firstname LIKE '$id%' OR lastname LIKE '$id%') AND role != 'admin';"); 
        $data = '';

        $data = '';

        while ($row = mysqli_fetch_assoc($query)) {  
            $data .= '<div class="card">';
            $data .= '<img src="../employee.png" alt="Plane Image" class="planePic">'; 
            $data .= '<div>';
            $data .= '<h1>' . $row["firstname"]. " ". $row["lastname"] . '</h1>';
            $data .= '<p>';
            $data .= '<strong>Title</strong>: ' .$row["role"].  '  &nbsp &nbsp';
            $data .= '<strong>ID#</strong>: ' .$row["userID"].  '  &nbsp &nbsp';
            $data .= '<strong>Password</strong>: ' .$row["password"].  '  &nbsp &nbsp';
            $data .= '</p>';
            $data .= '<button class="refuseButton employeeRemoveButton" value="'.$row['userID'].'">Delete</button>';
            $data .= '</div>';
            $data .= '</div>';
        }

        
        echo json_encode(['success' => true, 'data' => $data, 'message' => 'Live Search for employee by admin is working']);
        
    

    }if (isset($data['action']) && $data['action'] === 'liveSearchManagerStaff'){

        $id = htmlspecialchars($data['id']); 

        $query = mysqli_query($conn, "SELECT * FROM users WHERE (firstname LIKE '$id%' OR lastname LIKE '$id%') AND role = 'staff';"); 
        $data = '';

        $data = '';

        while ($row = mysqli_fetch_assoc($query)) {  
            $data .= '<div class="card">';
            $data .= '<img src="../employee.png" alt="Plane Image" class="planePic"> <div>'; 
            $data .=  '<div class="row">'; 
            $data .= '<h1>' . $row["firstname"]. " ". $row["lastname"] . '</h1> <p>is <strong>' . $row["status"] . '</strong></p>'; 
            $data .= '</div> <br>';
            $data .= '<p> <strong>Title</strong>: '. $row["role"]  .'&nbsp &nbsp <strong>ID#</strong>: '. $row["userID"] .'&nbsp &nbsp </p>'; 
            $data .= "</div></div>";
        }

        
        echo json_encode(['success' => true, 'data' => $data, 'message' => 'Live Search for staff by manager is working']);
        
    

    }

}


?>


