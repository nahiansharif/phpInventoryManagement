<div class="infoBar">
                <p>
                    <?php

                    include("../database.php"); 

                    if (mysqli_num_rows($storeHouse) > 0){
                        
                        while ($row = $storeHouse->fetch_assoc()) {
                            echo "<strong>Plane: </strong> " . $row["plane"] . 
                            "&nbsp &nbsp <strong>Fuel: </strong>: " . $row["fuel"] . 
                            " &nbsp &nbsp <strong>Tire: </strong> " . $row["tire"] . 
                            " &nbsp &nbsp <strong>Engine: </strong>  " . $row["motor"] . "<br>";
                        }
                        


                    } else { 
                    echo "<strong>Plane: </strong> 23 &nbsp &nbsp 
                    <strong>Fuel: </strong> 500 gallons &nbsp &nbsp 
                    <strong>Tire: </strong> 60 &nbsp &nbsp 
                    <strong>Engine: </strong> 15"; 
                        
                    }

                    ?> 
                    
                </p>
        </div>