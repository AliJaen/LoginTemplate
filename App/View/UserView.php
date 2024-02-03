<?php
class UserView {
    public function messageSuccess() {
        echo '<script>
                Swal.fire({
                    title: "Success",
                    text: "The user has registered.",
                    icon: "success"
                }).then(function() {
                    window.location = "createUser.php";
                });
            </script>';
    }

    public function messageDuplicatedUser() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "The USERNAME is already registered.",
                    icon: "error"
                }).then(function() {
                    window.location = "createUser.php";
                });
            </script>';
    }

    public function messageFail() {
        echo '<script>
                Swal.fire({
                    title: "Oops...",
                    text: "Error registering user.",
                    icon: "error"
                }).then(function() {
                    window.location = "createUser.php";
                });
            </script>';
    }

}