<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php

    require_once __DIR__ . '/../App/Controller/Auth/AuthController.php';
    require_once __DIR__ . '/../App/Model/Auth/Auth.php';
    require_once __DIR__ . '/../App/View/Auth/AuthView.php';

    // Create the instances of the model, view & controller
    $authModel = new Auth();
    $authView = new AuthView();
    $authController = new AuthController($authModel, $authView);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Call the controller to send the form using the login function
        $authController->login($_POST);
    }
    ?>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>