<?php

for($i = 1; $i <= $row['neededWorkers'] ; $i++){

    // this is where we show the name of all available staff
    echo "<p> select worker #". $i . "</p>"; 
    echo "<select class='worker-select-".$row['TaskID']."'>";

    mysqli_data_seek($employees, 0);
    while ($row3 = mysqli_fetch_assoc($employees)){   
        if(($row3["role"] === 'staff') && $row3["status"] === 'available'){
            echo "<option value='" . $row3["userID"] . "'>" . $row3["firstname"] . " " . $row3["lastname"] . "</option>"; 
        }
    }
    echo "</select> <br><br>"; 

}

?>

<script>

document.querySelectorAll(".approveOrder").forEach(button => {
            button.addEventListener("click", function() {

                const data = {
                action: 'approveTask', 
                taskID: this.value, 
                workers: [],
                };
            

                document.querySelectorAll('.worker-select-' + this.value).forEach((select) => {
                    console.log("does this even exists?"); 
                    console.log(select.value); 
                    data.workers.push(select.value); // Push values into the array
                });

                console.log(data)

            }); 
        });



</script>