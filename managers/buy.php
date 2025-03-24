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

    <?php
include '../infoBar.php';

?>


        <div class="container">

            <div class="card">
                <img src="../engine.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons engineMinus">
                    <p class="engineQuantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons enginePlus" >
                    
                </div>
                <p >Engine</p>
                

            </div>

            <div class="card">
                <img src="../tire.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons tireMinus">
                    <p class="tireQuantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons tirePlus" >
                    
                </div>
                <p >Tire</p>

            </div>

            <div class="card">
                <img src="../fuel.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons fuelMinus">
                    <p class="fuelQuantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons fuelPlus" >
                    
                </div>
                <p >Fuel</p>
                

            </div>

            <div class="card">
                <img src="../plane.png" alt="" class="buyItemsIcon" >
                <div class="row">
                    <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons planeMinus">
                    <p class="planeQuantity">x0</p>
                    <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons planePlus" >
                    
                </div>
                <p >Plane</p>

            </div>
            



        </div>

       <div class="container">
       <button class="approveButton buyButton" type="submit">Buy</button>
       </div>
    </div>

    <a href="../index.php" class="logout">Log Out</a>
    <?php
 

 include_once("../database.php"); 
 


// ... your PHP code ...



//... etc.
?>
 
 
    <script>

//   ENGINE STUFF
            const engineMinusButton = document.querySelector('.engineMinus');
            const enginePlusButton = document.querySelector('.enginePlus');
            const engineQuantityDisplay = document.querySelector('.engineQuantity');
            let engineQuantity = 0;

            engineMinusButton.addEventListener('click', () => {
                
                if (engineQuantity > 0) {
                    engineQuantity--;
                    engineQuantityDisplay.textContent = `x${engineQuantity}`;
                }
            });

            enginePlusButton.addEventListener('click', () => {
                
                engineQuantity++;
                engineQuantityDisplay.textContent = `x${engineQuantity}`;
            });

//   TIRE STUFF
  
            const tireMinusButton = document.querySelector('.tireMinus');
            const tirePlusButton = document.querySelector('.tirePlus');
            const tireQuantityDisplay = document.querySelector('.tireQuantity');
            let tireQuantity = parseInt(tireQuantityDisplay.textContent.slice(1)); // Extract the number

            tireMinusButton.addEventListener('click', () => {
                
                if (tireQuantity > 0) {
                    tireQuantity--;
                    tireQuantityDisplay.textContent = `x${tireQuantity}`;
                }
            });

            tirePlusButton.addEventListener('click', () => {
                
                tireQuantity++;
                tireQuantityDisplay.textContent = `x${tireQuantity}`;
            });

//   FUEL STUFF
  
            const fuelMinusButton = document.querySelector('.fuelMinus');
            const fuelPlusButton = document.querySelector('.fuelPlus');
            const fuelQuantityDisplay = document.querySelector('.fuelQuantity');
            let fuelQuantity = parseInt(fuelQuantityDisplay.textContent.slice(1)); // Extract the number

            fuelMinusButton.addEventListener('click', () => {
                
                if (fuelQuantity > 0) {
                    fuelQuantity = fuelQuantity - 1000;
                    fuelQuantityDisplay.textContent = `x${fuelQuantity}`;tireQuantityDisplay.textContent = `x${tireQuantity}`;engineQuantityDisplay.textContent = `x${engineQuantity}`;
                }
            });

            fuelPlusButton.addEventListener('click', () => {
                
                fuelQuantity = fuelQuantity + 1000;
                fuelQuantityDisplay.textContent = `x${fuelQuantity}`;
            });

//   plane STUFF
            const planeMinusButton = document.querySelector('.planeMinus');
            const planePlusButton = document.querySelector('.planePlus');
            const planeQuantityDisplay = document.querySelector('.planeQuantity');
            let planeQuantity = parseInt(planeQuantityDisplay.textContent.slice(1)); // Extract the number

            planeMinusButton.addEventListener('click', () => {
                
                if (planeQuantity > 0) {
                    planeQuantity--;
                    planeQuantityDisplay.textContent = `x${planeQuantity}`;
                }
            });

            planePlusButton.addEventListener('click', () => {
                
                planeQuantity++;
                planeQuantityDisplay.textContent = `x${planeQuantity}`;
            });

//buy items buyButton

            const buyButton = document.querySelector('.buyButton');
            buyButton.addEventListener('click', () => {
                const data = {
                    action: 'purchase', 
                    engine: engineQuantity,
                    tire: tireQuantity,
                    fuel: fuelQuantity,
                    plane: planeQuantity,
                };

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../database.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        console.log('Data sent successfully:', xhr.responseText);
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if(response.success){
                                console.log("Database updated");
                                //Handle success response
                            } else{
                                console.error("Database error: ", response.error);
                                //Handle error response.
                            }

                        }catch (e){
                            console.error("Error parsing JSON: ", e);
                        }

                    } else {
                        // Error! Handle the error.
                        console.error('Error sending data:', xhr.status, xhr.statusText);
                        // Handle error response.
                    }
                };
                xhr.onerror = function(){
                    console.error("Network error occured.")
                }

                xhr.send(JSON.stringify(data));

                // reset everything after 
                planeQuantity = 0; 
                fuelQuantity = 0;
                tireQuantity = 0; 
                engineQuantity = 0; 
                planeQuantityDisplay.textContent = `x${planeQuantity}`;
                fuelQuantityDisplay.textContent = `x${fuelQuantity}`;
                tireQuantityDisplay.textContent = `x${tireQuantity}`;
                engineQuantityDisplay.textContent = `x${engineQuantity}`;
                alert("Purchase order sent to Admin Successfully!"); 



            });


    </script>


</body>
</html>
