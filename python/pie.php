<div class="pieChart">
    <p>All Planes' Condition:</p>
    <?php

    
$output = shell_exec('python generate_chart.py');
echo '<img src="data:image/png;base64,'.$output.'">';

    // echo "<img src='../python/pieChart.png' alt='pie chart image generated' class='pieImage' >"; 

    // $pythonScript = __DIR__ . '/generatePieChart.py';
    // $output = shell_exec('python ' .$pythonScript);
    //$results = explode("|", $output)
    // foreach($results as $result){
    //     echo "<p>". $result . "</p>"; 
    // }

    ?>
    
    
</div>

