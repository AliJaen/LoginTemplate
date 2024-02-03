<?php
session_start();

// Validate the user is AUTHENTICATED and is an ADMIN
if (isset($_SESSION['name'])) {
    header('Location: login.html');
} else {
    /*if ($_SESSION['rol'] !== 'admin') {
        header('Location: forbidden.html');
    }
    else {
        $userAuth = $_SESSION['name'];
    }*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php

    require_once __DIR__ . '/../App/Controller/UserController.php';
    require_once __DIR__ . '/../App/Model/User.php';
    require_once __DIR__ . '/../App/View/UserView.php';

    // Create the instances of the model, view & controller
    $userModel = new User();
    $userView = new UserView();
    $userController = new UserController($userModel, $userView);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Call the controller to send the form using the creteUser function
        $userController->createUser($_POST);
    }
    ?>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>