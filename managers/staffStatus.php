<?php

include("../database.php"); 

$staffAvialability = mysqli_query($conn, 
    "SELECT status, 
    COUNT(*) AS staffCount
    FROM `users` 
    WHERE role='staff'
    GROUP BY status; 
    "); 

    $staffNum = []; 

while ($row = mysqli_fetch_assoc($staffAvialability)){ 
array_push($staffNum, $row['staffCount']); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Staff Status</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <div class="sidebar">
        <h1>Manager Staff Status</h1>
        <a href="manager.php" >Home</a>
        <a href="searchPlanes.php">Planes</a>
        <a href="tasks.php">Tasks</a>
        <a href="#"class="home">Staff Status</a>
        <a href="buy.php">Buy Components</a>
    </div>
    <div class="main-content">

        <div class="infoBar">
            <p>
                <strong>Staff Busy: </strong> <?php echo $staffNum[1]; ?> &nbsp &nbsp 
                <strong>Staff Available: </strong> <?php echo $staffNum[0]; ?> &nbsp &nbsp 
            </p>
        </div>

        <br>
        <div class="search-bar">
            
            <input type="text" placeholder="Search Staff Name" id="search_staff_bar">
                

        </div>

        <div class="container" id="show_searched_staff">
            
        
            
            <?php

            
            

            while ($row = mysqli_fetch_assoc($employees)){   
                if($row["role"] != 'admin'){
                    if($row["role"] === "staff"){

                        echo '<div class="card">';
                        echo '<img src="../employee.png" alt="Plane Image" class="planePic"> <div>'; 
                        echo  '<div class="row">'; 
                        echo '<h1>' . $row["firstname"]. " ". $row["lastname"] . '</h1> <p>is <strong>' . $row["status"] . '</strong></p>'; 
                        echo '</div> <br>';
                        echo '<p> <strong>Title</strong>: '. $row["role"]  .'&nbsp &nbsp <strong>ID#</strong>: '. $row["userID"] .'&nbsp &nbsp </p>'; 
                        echo "</div></div>";
                    }



                }

            }


            ?>
            </div>

        </div>




        
    </div>
    

    <a href="../index.php" class="logout">Log Out</a>
    <script>
        //  

        const staffSearchBar = document.getElementById('search_staff_bar');

        let searchValue = '';
        // show_searched_employees

        staffSearchBar.addEventListener('input', () => {
            searchValue = staffSearchBar.value;
            
            const data = {
            action: 'liveSearchManagerStaff', 
            id: searchValue,
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
                                console.log("Live Search is working from manager page");
                                // Update the search results container with the server's response data
                                document.getElementById('show_searched_staff').innerHTML = response.data;
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
        }); 
    </script>
    
</body>
</html>
