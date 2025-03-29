<div class="pieChart">
    <p>Planes' Condition:</p>
    <?php
    
    $pythonScript = __DIR__ . '/generate_piechart.py';
    $output = shell_exec('python ' . $pythonScript . ' 2>&1');
    $results = explode("|", $output); 
    
    
    echo "<img src='../python/pieChart2.png?v=" . time() . "' alt='pie chart image generated' class='pieImage' width='600px' height = '700px'>";

    
        echo "<div class='row'><p>" . $results[0] . "% </p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <p>" . $results[1] . "% </p> </div> "; 
        echo "<div class='row'><p>" . $results[2] . "% </p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <p>" . $results[3] . "% </p> </div> "; 
        echo "<div class='row'><p>" . $results[4] . "% </p> </div>"; 
    

    ?>
    
    
</div>

