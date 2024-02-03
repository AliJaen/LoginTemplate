<?php
session_name("logged");
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.html');
} elseif ($_SESSION['role'] !== 'admin') {
    header('Location: forbidden.html');
} elseif ($_SESSION['authenticated']) {
    $lastSession = $_SESSION["lastAccess"];
  $currentTime = date("Y-n-j H:i:s");
  $differenceTime = (strtotime($currentTime) - strtotime($lastSession));
  
  if ($differenceTime >= 600) {
      session_destroy();
      header('Location: login.html');
    } else {
        $_SESSION["lastAccess"] = $currentTime;
    }
}
?>
<!DOCTYPE html>
<html lang="es" class="h-100" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create User</title>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontaswesome -->
    <link href="assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
    }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <?php require_once 'templates/header.php'; ?>
    <main role="main" class="flex-shrink-0 mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h1 class="h2">Add user</h1>
                            </div>
                            <div class="card-text">
                                <form class="needs-validation" method="POST" action="addUser.php" novalidate>
                                    <div class="mb-3 form-floating">
                                        <input class="form-control form-control-md" type="text" name="username" id="username" placeholder="Username" required>
                                        <label for="username">Username</label>
                                        <div id="usernameError" class="invalid-feedback">Add a username.</div>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <input class="form-control form-control-md" type="mail" name="mail" id="mail" placeholder="Email" required>
                                        <label for="mail">Email</label>
                                        <div id="mailError" class="invalid-feedback">Add a valid email.</div>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="">Choose one</option>
                                            <option value="admin">Admin</option>
                                            <option value="partner">Partner</option>
                                            <option value="user">User</option>
                                        </select>
                                        <label for="floatingSelect">Select a role</label>
                                        <div id="roleError" class="invalid-feedback">Choose a role.</div>
                                    </div>
                                    <div class="mb-3 form-floating">    
                                        <input class="form-control form-control-md" type="password" name="pass" id="pass" placeholder="Password" required>
                                        <label for="pass">Password</label>
                                        <div id="passwordError" class="invalid-feedback">The password must contain at least 8 characters, one lowercase letter, one uppercase letter, and one number.</div>
                                    </div>
                                    <div class="mb-3 form-floating">    
                                        <input class="form-control form-control-md" type="password" name="confirmPass" id="confirmPass" placeholder="Confirm password" required>
                                        <label for="confirmPass">Confirm password</label>
                                        <div id="confirmPasswordError" class="invalid-feedback">Passwords have to match.</div>
                                    </div>
                                    <button class="btn btn-dark" type="submit" name="send" id="send">Create</button>
                                    <button class="btn btn-light border" type="button" name="cancel" id="cancel">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once 'templates/footer.php'; ?>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <!-- Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Valida formulario -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation');
            
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', event => {
                    let username = form.querySelector('#username').value;
                    let mail = form.querySelector('#mail').value;
                    let password = form.querySelector('#pass').value;
                    let confirmPassword = form.querySelector('#confirmPass').value;
                    let role = form.querySelector('#role').value;

                    let usernameError = form.querySelector('#usernameError');
                    let mailError = form.querySelector('#mailError');
                    let passwordError = form.querySelector('#passwordError');
                    let confirmPasswordError = form.querySelector('#confirmPasswordError');
                    let roleError = form.querySelector('#roleError');

                    // Validate username
                    if (username === '') {
                        event.preventDefault();
                        event.stopPropagation();
                        usernameError.textContent = "Add a valid username.";
                        usernameError.style.display = 'block';
                        form.classList.add('needs-validation');
                    } else {
                        usernameError.style.display = 'none';
                    }
                    // Validate mail
                    let validMail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
                    if (!validMail.test(mail)) {
                        event.preventDefault();
                        event.stopPropagation();
                        mailError.textContent = "Add a valid mail.";
                        mailError.style.display = 'block';
                        form.classList.add('needs-validation');
                    } else {
                        mailError.style.display = 'none';
                    }
                    // Validate the role SELECTED
                    if (role === "") {
                        event.preventDefault();
                        event.stopPropagation();
                        roleError.textContent = "Choose a role.";
                        roleError.style.display = 'block';
                        form.classList.add('needs-validation');
                    } else {
                        roleError.style.display = 'none';
                    }
                    // Validate the password
                    if (password.length < 8 || !(/[a-z]/.test(password)) || !(/[A-Z]/).test(password) || !(/\d/.test(password))) {
                        event.preventDefault();
                        event.stopPropagation();
                        passwordError.textContent = "The password must contain at least 8 characters, one lowercase letter, one uppercase letter, and one number.";
                        passwordError.style.display = 'block';
                        form.classList.add('needs-validation');
                    } else {
                        passwordError.style.display = 'none';
                    }
                    // Validate the passwords are the same
                    if (password !== confirmPassword){
                        event.preventDefault();
                        event.stopPropagation();
                        form.classList.add('needs-validation');
                        confirmPasswordError.textContent = "The passwords have to match.";
                        confirmPasswordError.style.display = 'block';
                    } else {
                        confirmPasswordError.style.display = 'none';
                    }
                    
                }, false)
            });
        })();
    </script>
</body>
</html>