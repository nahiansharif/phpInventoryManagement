<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>python x php</title>
</head>
<body>
    <h1> python x php</h1>

<?php
$pythonScript = __DIR__ . '/python/generatePieChart.py';
$output = shell_exec('python ' .$pythonScript);

echo $output;
?>

    
</body>
</html>