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

        form {
           
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
    <form>
        <div class="plane-select">
            <label for="plane">Select a plane for inspection:</label>
            
            <select id="plane-list" name="plane-list">
                <option value="plane1">Plane 1</option>
                <option value="plane2">Plane 2</option>
                <option value="plane3">Plane 3</option>
            </select>
        </div>

        <label for="fuel">Fuel Level in Gallons:</label>
        <input type="number" id="fuel" name="fuel" placeholder="Gallons">

        <label for="tire1">tire 1 condition:</label>
        <select id="tire1" name="tire1">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire2">tire 2 condition:</label>
        <select id="tire2" name="tire2">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire3">tire 3 condition:</label>
        <select id="tire3" name="tire3">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire4">tire 4 condition:</label>
        <select id="tire4" name="tire4">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire5">tire 5 condition:</label>
        <select id="tire5" name="tire5">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="tire6">tire 6 condition:</label>
        <select id="tire6" name="tire6">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="engine">Engine Condition:</label>
        <select id="engine" name="engine">
            <option value="good">Good</option>
            <option value="mediocre">Mediocre</option>
            <option value="bad">Bad</option>
        </select>

        <label for="engine">How many staff needed for maintainance?</label>
        <select id="engine" name="engine">
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="8">8</option>
            <option value="-1">New Plane Needed!</option>
        </select>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" maxlength="397"></textarea>

        <input type="submit" value="Submit" class="approveButton">
    </form>
</div>


    </div>

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
