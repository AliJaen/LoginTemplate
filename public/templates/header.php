<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><i class="fa-solid fa-shield-cat" style="font-size: 1.5em;"></i> Mew Code</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Users
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Admon</a></li>
                    <li><a class="dropdown-item" href="createUser.php">Create</a></li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Reports
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Reports 1</a></li>
                    <li><a class="dropdown-item" href="#">Reports 2</a></li>
                    <li><a class="dropdown-item" href="#">Reports 3</a></li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Statistics
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Statistics 1</a></li>
                    <li><a class="dropdown-item" href="#">Statistics 2</a></li>
                    <li><a class="dropdown-item" href="#">Statistics 3</a></li>
                </ul>
                </div>
            </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse" style="max-width: 3em;">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" onclick="logout()">Logout</a></li>
                    </ul>
                </div>
                </li>
            </ul>
        </div>
        </div>
    </nav>
</header>
<script>
function logout() {
    // Show the message confirmation using SweetAlert
    Swal.fire({
        title: "Logout",
        text: "Are you sure you want to log out?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, log out",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // Make a request to the server to log out
            fetch('logout.php', {
                method: 'POST',
                credentials: 'include' //Send the cookies in the petition
            })
            .then(response => {
                if (response.ok) {
                    // Show the success message & redirect
                    Swal.fire({
                        title: "Bye",
                        text: "You logged out.",
                        icon: "success"
                    }).then(function() {
                        window.location.href = "login.html";
                    });
                } else {
                    // Show a error message
                    Swal.fire({
                        title: "Error",
                        text: "Failed to log out",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                // Show a network error message
                Swal.fire({
                    title: "Error",
                    text: "Network error",
                    icon: "error"
                });
            });
        }
    });
}
</script>
