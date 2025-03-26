<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Buy</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        
        

        .container {
            display: flex;
        }

        .card {
            width: 300px; 
            height: 400px; 
            margin: 25px;
            flex-direction: column;
            padding:30px;
        }

        .plusMinusButtons{
    width: 50px;
    height: 50px;
    cursor: pointer;
}

       



        

    </style>
</head>
<body>

    <div class="sidebar">
        <h1>Manager Buy Components</h1>
        <a href="manager.php">Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="tasks.php">Tasks</a>
        <a href="staffStatus.php">Staff Status</a>
        <a href="#" class="home">Buy Components</a>
    </div>

    <div class="main-content">

    <div class="infoBar">
            <p>
                <strong>Plane: </strong> 23 &nbsp &nbsp 
                <strong>Fuel: </strong> 500 gallons &nbsp &nbsp 
                <strong>Tire: </strong> 60 &nbsp &nbsp 
                <strong>Engine: </strong> 15 
            </p>
        </div>
        <div class="container">

            <div class="card">
                <img src="../engine.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus">
                    <p class="quantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" >
                    
                </div>
                <p class="itemName">Engine</p>
                <button class="approveButton buy" >Buy</button>

            </div>

            <div class="card">
                <img src="../tire.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus">
                    <p class="quantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" >
                    
                </div>
                <p class="itemName">Tire</p>
                <button class="approveButton buy" >Buy</button>

            </div>

            <div class="card">
                <img src="../fuel.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus">
                    <p class="quantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" >
                    
                </div>
                <p class="itemName">Fuel</p>
                <button class="approveButton buy" >Buy</button>

            </div>

            <div class="card">
                <img src="../plane.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus">
                    <p class="quantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" >
                    
                </div>
                <p class="itemName">Plane</p>
                <button class="approveButton buy" >Buy</button>

            </div>
            




        </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    <script>


            const bbuyButton = document.querySelector('.buyButton');
            bbuyButton.addEventListener('click', () => {

                console.log("buying \nEngine: " + engineQuantity + " Tire: " + tireQuantity + " Fuel: " + fuelQuantity + " Plane: " + planeQuantity); 

                <?php 

                session_start();
                $username = $_SESSION['username'];
                $currentManager = mysqli_query($conn, "SELECT * FROM users WHERE userID =" + $username); 
                mysqli_query($conn, "INSERT INTO purchase(managerUserID, plane, fuel, tire, motor) VALUES (" + $username +","+ planeQuantity+","+fuelQuantity +","+tireQuantity +","+engineQuantity +")");

                ?> 

                
                
                
            });

            <?php
// ... (your PHP code to fetch data and generate HTML) ...

for ($i = 1; $i <= $row['neededWorkers']; $i++) {
    echo "<p>select worker #" . $i . "</p>";
    echo "<select class='worker-select'>"; // Added class for easier selection

    mysqli_data_seek($employees, 0);
    while ($row3 = mysqli_fetch_assoc($employees)) {
        if (($row3["role"] === 'staff') && $row3["status"] === 'available') {
            echo "<option value='" . $row3["firstname"] . " " . $row3["lastname"] . "'>" . $row3["firstname"] . " " . $row3["lastname"] . "</option>"; // Added value attribute
        }
    }
    echo "</select> <br><br>";
}

echo "<button class='refuseButton refuseOrder' value='" . $row['TaskID'] . "'>Refuse</button>";
echo "<button class='approveButton approveOrder' value='" . $row['TaskID'] . "'>Approve</button>";
?>

<script>
    document.querySelectorAll(".approveOrder").forEach(button => {
        button.addEventListener("click", function() {
            const data = {
                action: 'approveTask',
                taskID: this.value,
                workers: {} // Initialize an object to store worker selections
            };

            // Get all worker selections
            document.querySelectorAll('.worker-select').forEach((select, index) => {
                data.workers[`worker${index + 1}`] = select.value;
            });

            console.log(data); // Log the data object to see the worker selections

            // ... (your AJAX or fetch request to send the data) ...
        });
    });
</script>


    </script>
        
</body>
</html>










<?php
// database.php

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);



    if (isset($data['action']) && $data['action'] === 'purchase') {
        handlePurchase($conn, $data);
    } else if (isset($data['action']) && $data['action'] === 'reject_order') {
        handleRejectOrder($conn, $data);
    } else if (isset($data['action']) && $data['action'] === 'accept_order') {
        handleAcceptOrder($conn, $data);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
    }
}

function handlePurchase($conn, $data) {
    $engine = $data['engine'];
    $tire = $data['tire'];
    $fuel = $data['fuel'];
    $plane = $data['plane'];

    mysqli_query($conn, "INSERT INTO purchase (managerUserID, plane, fuel, tire, motor) VALUES ('" . getCurrentUser() . "', " . $plane . ", " . $fuel . ", " . $tire . ", " . $engine . ");");
    echo json_encode(['success' => true, 'message' => 'Purchase order created']);
}

function handleRejectOrder($conn, $data) {
    $id = $data['purchaseID'];
    mysqli_query($conn, "DELETE FROM purchase WHERE purchaseID = " . $id);
    echo json_encode(['success' => true, 'message' => 'Order rejected']);

}

function handleAcceptOrder($conn, $data) {
    $id = $data['purchaseID'];
    $order = mysqli_query($conn, "SELECT * FROM purchase WHERE purchaseID = " . $id);

    while ($row = mysqli_fetch_assoc($order)) {
        mysqli_query($conn, "UPDATE storehouse SET plane = plane + " . $row['plane'] . ", fuel = fuel + " . $row['fuel'] . ", tire = tire + " . $row['tire'] . ", motor = motor + " . $row['motor']);
    }

    mysqli_query($conn, "DELETE FROM purchase WHERE purchaseID = " . $id);
    echo json_encode(['success' => true, 'message' => 'Order accepted and store updated']);
}
?>
