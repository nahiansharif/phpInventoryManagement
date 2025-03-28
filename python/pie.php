<div class="pieChart">
    <p>All Planes' Condition:</p>
    <?php
    $pythonScript = __DIR__ . '/generatePieChart.py';
    $output = shell_exec('python ' .$pythonScript);

    $results = explode("|", $output);

    echo "<img src='../python/pieChart.png' alt='pie chart image generated' class='pieImage' >"; 

    foreach($results as $result){
        echo "<p>". $result . "</p>"; 
    }

    ?>
    
    
</div>

