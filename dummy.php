<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            text-align: center;
        }
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .plusMinusButtons {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="../engine.png" alt="" class="buyItemsIcon" width="200" height="200">
            <div class="row">
                <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus" data-item="engine" width="50" height="50">
                <p class="quantity" data-item="engine">x5</p>
                <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" data-item="engine" width="50" height="50">
            </div>
            <p>Engine</p>
            <button class="approveButton buy" data-item="engine">Buy</button>
        </div>

        <div class="card">
            <img src="../tire.png" alt="" class="buyItemsIcon" width="200" height="200">
            <div class="row">
                <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus" data-item="tire" width="50" height="50">
                <p class="quantity" data-item="tire">x5</p>
                <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" data-item="tire" width="50" height="50">
            </div>
            <p>Tire</p>
            <button class="approveButton buy" data-item="tire">Buy</button>
        </div>

        <div class="card">
            <img src="../fuel.png" alt="" class="buyItemsIcon" width="200" height="200">
            <div class="row">
                <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus" data-item="fuel" width="50" height="50">
                <p class="quantity" data-item="fuel">x5</p>
                <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" data-item="fuel" width="50" height="50">
            </div>
            <p>Fuel</p>
            <button class="approveButton buy" data-item="fuel">Buy</button>
        </div>

        <div class="card">
            <img src="../plane.png" alt="" class="buyItemsIcon" width="200" height="200">
            <div class="row">
                <img src="../minusButton.png" alt="minusButton.png" class="plusMinusButtons minus" data-item="plane" width="50" height="50">
                <p class="quantity" data-item="plane">x5</p>
                <img src="../plusButton.png" alt="plusButton.png" class="plusMinusButtons plus" data-item="plane" width="50" height="50">
            </div>
            <p>Plane</p>
            <button class="approveButton buy" data-item="plane">Buy</button>
        </div>
    </div>

    <script>
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const minusButton = card.querySelector('.minus');
            const plusButton = card.querySelector('.plus');
            const quantityDisplay = card.querySelector('.quantity');
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
        });
    </script>
</body>
</html>