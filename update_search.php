<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["searchedPlane"])) {
        $searchedPlane = $_POST["searchedPlane"];

        // Perform any server-side logic here (e.g., database query)
        // ...

        // Send the updated value back to the JavaScript
        echo htmlspecialchars($searchedPlane);
    }
}
?>