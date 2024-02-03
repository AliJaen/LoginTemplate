<?php
session_name("logged");
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.html');
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
<!doctype html>
<html lang="es" class="h-100" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fontaswesome -->
  <link href="assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet">
  <link href="assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet">
  <link href="assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
  <!-- Begin page content -->
  <main role="main" class="flex-shrink-0 mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <h1 class="mt-2">Welcome</h1>
        </div>
      </div>
    </div>
  </main>

  <?php require_once 'templates/footer.php'; ?>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>