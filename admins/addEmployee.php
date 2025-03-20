
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Add Employee</title>
    <link rel="stylesheet" href="../style.css">
    <style>
           
        .refuseButton{
            font-size: 40px;
            font-weight: 500;
            padding: 30px;
            color: white; 
            text-decoration: none; 
            border-radius: 10px;
            margin-left: 20px; 
        }
   
        

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
        <h1>Admin Employee</h1>
        <a href="admin.php">Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="Approvals.php">Approvals</a>
        <a href="#" class="home">Employees</a>
    </div>
    <div class="main-content">

    <div class="infoBar">
            <p>
                <strong> Plane Inspection Report Form </strong>
            </p>
            <a href="employee.php" class="refuseButton">Back</a>
        </div>

<div class="container">
    <form>
        <div class="plane-select">
            <label for="plane">Select Employee Type:</label>
            
            <select id="plane-list" name="plane-list">
                <option value="plane1">Manager</option>
                <option value="plane2">Staff</option>
            </select>
        </div>

        <label for="fuel">First Name:</label>
        <input type="number" id="fuel" name="fuel" placeholder="First Name">


        <label for="fuel">Last Name:</label>
        <input type="number" id="fuel" name="fuel" placeholder="Last Name">

        <label for="fuel">Password:</label>
        <input type="number" id="fuel" name="fuel" placeholder="Password">

        <label for="fuel">Retype Password:</label>
        <input type="number" id="fuel" name="fuel" placeholder="Retype Password">

        <input type="submit" value="Submit" class="approveButton">
    </form>
</div>



        
    </div>
    

    <a href="../index.php" class="logout">Log Out</a>
    
</body>
</html>
