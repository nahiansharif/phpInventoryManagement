<?php

include_once("database.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    session_start();
    setCurrentUser($username);

   
    while ($row = mysqli_fetch_assoc($employees)){   
        if(($row["userID"] === $username) && ($row["password"] === $password)){
            

            switch($row["role"]){
                case 'admin':
                    header('Location:admins/admin.php'); 
                    exit; 
                case 'manager':
                    header('Location:managers/manager.php'); 
                    exit; 
                case 'staff':
                    header('Location:staff/staff.php'); 
                    exit;
                }
            

        }

    }


}


?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <main class="form-signin text-center">
        <form method="post" action = " <?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <img class="mb-4" src="logo.png" alt="" width="250" height="50">
            <h1 class="h3 mb-3 fw-normal title">Please sign in</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="username">
                <label for="floatingInput">User ID</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit" value="login">Sign in</button>
            <a href="admins/admin.php">admin</a>
            <a href="managers/manager.php">Manager</a>
            <a href="staff/staff.php">staff</a>
            <a href="dummy.php">dummy</a>
            <a href="database.php">db</a>
            <p class="mt-5 mb-3 text-body-secondary title">&copy; 2025</p>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
