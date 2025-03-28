
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../style.css">
    <style>
        .card {
            height: 300px; /* Adjust height as needed */
            
        }

    </style>

</head>
<body>

    <div class="main-content">


        <div class="search-bar" >
        
            <input type="text" placeholder="Search Planes" id="plane_search_bar" >
           
            
   
        </div>

        <div class="container" id="showcase_Searched_planes">  
            

            <?php
            include("../database.php"); 

            while ($row = mysqli_fetch_assoc($planes)){  
                echo '<div class="card">';
                echo '<img src="../plane.png" alt="Plane Image" class="planePic">';
                echo '<div>';
                echo '<h1>' . $row['NameID'] . '</h1>';
                echo '<p><strong>Fuel</strong>: ' . $row["fuel"] . ' &nbsp &nbsp<strong>Engine</strong>: ' . $row["motor"] . '</p>';
                echo '<p> <strong>Tire 1</strong>: ' . $row["tire1"] .  '&nbsp &nbsp<strong>Tire 2</strong>: ' . $row["tire2"] . '&nbsp &nbsp<strong>Tire 3</strong>: ' . $row["tire3"] . '</p>';
                echo '<p> <strong>Tire 4</strong>: ' . $row["tire4"] .  '&nbsp &nbsp<strong>Tire 5</strong>: ' . $row["tire5"] . '&nbsp &nbsp<strong>Tire 6</strong>: ' . $row["tire6"] . '</p>';
                echo '</div>'; 
                echo '</div>'; 

            }
            ?>

            

            
        
        </div>

        
    
    </div> 



    
   
    <script type="text/javascript" src="../front.js"></script>

    <script>
        
        const planeSearchBar = document.getElementById('plane_search_bar');

        let searchValue = '';

        planeSearchBar.addEventListener('input', () => {
            searchValue = planeSearchBar.value; // Update the variable
            
            const data = {
            action: 'liveSearchPlane', 
            name: searchValue,
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
                                console.log("Live Search is working");
                                // Update the search results container with the server's response data
                                document.getElementById('showcase_Searched_planes').innerHTML = response.data;
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
