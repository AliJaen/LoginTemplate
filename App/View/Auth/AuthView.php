<?php

class AuthView {
    public function messageAuthenticated() {
        echo '<script>
                Swal.fire({
                    title: "Welcome",
                    icon: "success"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>';
    }

    public function messageErrorPassword() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "The password is wrong.",
                    icon: "error"
                }).then(function() {
                    window.location = "login.html";
                });
            </script>';
    }

    public function messageUserNotFound() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "User not registered.",
                    icon: "error"
                }).then(function() {
                    window.location = "login.html";
                });
            </script>';
    }

    public function messageUserFail() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "Error.",
                    icon: "error"
                }).then(function() {
                    window.location = "login.html";
                });
            </script>';
    }

    public function messageSuccess() {
        echo '<script>
                Swal.fire({
                    title: "Success",
                    text: "Password updated.",
                    icon: "success"
                }).then(function() {
                    window.location = "index.php";
                });
            </script>';
    }

    public function messageRetry() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "Your current password is wrong.",
                    icon: "error"
                }).then(function() {
                    window.location = "newPass.php";
                });
            </script>';
    }

    public function messageFail() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "Error.",
                    icon: "error"
                }).then(function() {
                    window.location = "newPass.php";
                });
            </script>';
    }


}