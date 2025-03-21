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
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const minusButton = card.querySelector('.minus');
            const plusButton = card.querySelector('.plus');
            const quantityDisplay = card.querySelector('.quantity');
            const buyButton = card.querySelector('.buy'); 
            const itemName = card.querySelector('.itemName'); 

            let quantity = parseInt(quantityDisplay.textContent.slice(1)); // Extract the number

            minusButton.addEventListener('click', () => {
                if (quantity > 0) {
                    quantity--;
                    quantityDisplay.textContent = `x${quantity}`;
                }
            });

            plusButton.addEventListener('click', () => {
                quantity++;
                quantityDisplay.textContent = `x${quantity}`;
            });

            buyButton.addEventListener('click', () => {
                console.log("bought " + quantity + " " + itemName.textContent); 
            });
        });
    </script>
</body>
</html>
