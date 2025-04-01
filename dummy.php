<?php 

if (isset($data['action']) && $data['action'] === 'purchase') {

    $engine = $data['engine'];
    $tire = $data['tire'];
    $fuel = $data['fuel'];
    $plane = $data['plane'];

    mysqli_query($conn, "INSERT INTO purchase (managerUserID, plane, fuel, tire, motor) 
    VALUES ('" . getCurrentUser() . "', " . $plane . ", " . $fuel . ", " . $tire . ", " . $engine . ");");    

    echo json_encode(['success' => true, 'message' => 'Purchase order created']);

}

?>