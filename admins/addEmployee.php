
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

        label, input, select {
            display: block;
            margin-bottom: 10px;
            width: calc(100% - 22px); /* Adjust for padding and border */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
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
                <strong> Add New Employee </strong>
            </p>
            <a href="employee.php" class="refuseButton">Back</a>
        </div>

<div class="container">
    <form>
        <div class="plane-select">
            <label for="plane">Select Employee Type:</label>
            
            <select id="employee-role-list" name="plane-list" class="employeeRole">
                <option>Manager</option>
                <option>Staff</option>
            </select>
        </div>

        <label>First Name:</label>
        <input type="text"  placeholder="First Name" id="employeeFN">


        <label>Last Name:</label>
        <input type="text" placeholder="Last Name" id="employeeLN">

        <label>Password:</label>
        <input type="text" placeholder="Password" id="employeePass">


        <button type="button" class="approveButton employeeAddButton"> Add New Employee</button>
    </form>
</div>



        
    </div>
    

    <a href="../index.php" class="logout">Log Out</a>

    <script>
    // Create variables and store the values from the form


    // Example: Logging the values to the console (you can use these values as needed)
    
    const addButton = document.querySelector('.employeeAddButton');
    addButton.addEventListener('click', () => {
    
        const employeeRole = document.getElementById("employee-role-list").value; 
        const firstName = document.getElementById("employeeFN").value; 
        const lastName = document.getElementById("employeeLN").value; 
        const password = document.getElementById("employeePass").value; 

        const data = {
            action: 'createEmployee', 
            role: employeeRole, 
            firstname: firstName, 
            lastname: lastName,
            password: password,
        };


        console.log(data);

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

                alert("New Employee Added"); 
                location.reload(); 
                
                
    }); 

</script>
    
</body>
</html>
