<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Report</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        

        .container {
            display: flex;
        }

        .card {
            width: 200px; 
            height: 200px; 
            margin: 25px;
            flex-direction: column;
            padding:30px;
        }

        .form {
           
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #00aaff;
            width: 350px;
            padding: 40px;
            border-radius:6px;
        }

        label, input, select, textarea {
            display: block;
            margin-bottom: 10px;
            width: calc(100% - 22px); /* Adjust for padding and border */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }

        textarea {
            resize: vertical; /* Allow vertical resizing */
            height: 150px;
        }

        

        

    </style>
</head>
<body>

<div class="sidebar">
        <h1>Staff &nbsp &nbsp Report</h1>
        <a href="staff.php">Home</a>
        <a href="searchPlanes.php">Search Planes</a>
        <a href="#"  class="home">Report</a>
        <a href="tasks.php">Tasks</a>
    </div>
    
    <div class="main-content">

    <div class="infoBar">
            <p>
                <strong> Plane Inspection Report Form </strong>
            </p>
        </div>

<div class="container">
    <div class="form">
        <div class="plane-select">
            <label for="plane">Select a plane for inspection:</label>
            
            <select id="plane-list" name="plane-list">

            <?php 
                include("../database.php"); 

                while ($row = mysqli_fetch_assoc($planes)){
                    echo "<option value=" . $row['NameID'] . "> " . $row['NameID'] . "</option>"; 
                }
            ?>
                
            </select>
        </div>

        <label for="fuel">Fuel Level (70,000 Gallons Max):</label>
        <input type="number" id="fuel" name="fuel" value="0" placeholder="Gallons" min="0" max="70000">
        
        <label for="tire1">tire 1 condition:</label>
        <select id="tire1" name="tire1">
            <option value="good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire2">tire 2 condition:</label>
        <select id="tire2" name="tire2">
            <option value="good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire3">tire 3 condition:</label>
        <select id="tire3" name="tire3">
            <option value="good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire4">tire 4 condition:</label>
        <select id="tire4" name="tire4">
            <option value="good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire5">tire 5 condition:</label>
        <select id="tire5" name="tire5">
            <option value="good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire6">tire 6 condition:</label>
        <select id="tire6" name="tire6">
            <option value="good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>
       
        <label for="engine">Engine Condition:</label>
        <select id="engine" name="engine">
            <option value="Good">Good</option>
            <option value="medicore">medicore</option>
            <option value="bad">Bad</option>
        </select>
        
        <label for="engine">How many staff needed for maintainance?</label>
        <select id="neededWorkers" name="neededWorkers">
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="8">8</option>
            <option value="-1">New Plane Needed!</option>
        </select>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments"  maxlength="397">N/A</textarea>

        <button class="approveButton submitTask"> Submit </button>
    </div>
</div>


    </div>

    <a href="../index.php" class="logout">Log Out</a>

    <script>

        const createTaskButton = document.querySelector('.submitTask');
        createTaskButton.addEventListener('click', () => { 

                

            const planeName = document.getElementById("plane-list").value; 
            const fuelNum = document.getElementById("fuel").value;
            
            const tire1 = document.getElementById("tire1").value;
            const tire2 = document.getElementById("tire2").value;
            const tire3 = document.getElementById("tire3").value;
            const tire4 = document.getElementById("tire4").value;
            const tire5 = document.getElementById("tire5").value;
            const tire6 = document.getElementById("tire6").value;
            const engine = document.getElementById("engine").value;
            
            const neededWorkers = document.getElementById("neededWorkers").value;
            const comments = document.getElementById("comments").value;
            
            const data = {
                action: 'createTasks', 
                planeName: planeName, 
                fuelNum: fuelNum, 
                tire1: tire1,
                tire2: tire2,
                tire3: tire3,
                tire4: tire4,
                tire5: tire5,
                tire6: tire6,
                engine: engine, 
                neededWorkers: neededWorkers,
                comments: comments,
            };
            
            console.log(data)

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

             alert("New task Added"); 
             location.reload(); 
                
            

        }); 



    </script>
    
</body>
</html>
