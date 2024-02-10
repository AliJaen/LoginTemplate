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
          <h1 class="mt-2">Welcome <?php echo $_SESSION['user']; ?></h1>
        </div>
        <div class="row jsutify-content-start mt-3">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-10">
                    <h2 class="h4 card-title">Results 1</h2>
                    <div class="card-text">
                      <h3 class="h5">Data DB</h3>
                    </div>
                  </div>
                  <div class="col-md-2 text-center">
                    <h3 class="h3"><i class="fa-solid fa-check"></i></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-10">
                    <h2 class="h4 card-title">Results 2</h2>
                    <div class="card-text">
                      <h3 class="h5">Data DB</h3>
                    </div>
                  </div>
                  <div class="col-md-2 text-center">
                    <h3 class="h3"><i class="fa-solid fa-exclamation"></i></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-10">
                    <h2 class="h4 card-title">Results 3</h2>
                    <div class="card-text">
                      <h3 class="h5">Data DB</h3>
                    </div>
                  </div>
                  <div class="col-md-2 text-center">
                    <h3 class="h3"><i class="fa-solid fa-xmark"></i></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-start mt-4">
          <div class="col-md-2">
              <div class="card" style="width: 18 rem;">
                <div class="container-fluid" style="background-color: #48C9B0; color: #fff;">
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="font-size: 3em;" id="currentDate"></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="font-size: 2em;" id="currentMonth"></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="font-size: 1em;" id="currentDay"></h5>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="card-text">
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table">
                            <thead>
                              <tr>
                                <th style="color: #48C9B0; font-size: .7em;">Sun</th>
                                <th style="color: #48C9B0; font-size: .7em;">Mon</th>
                                <th style="color: #48C9B0; font-size: .7em;">Tue</th>
                                <th style="color: #48C9B0; font-size: .7em;">Wed</th>
                                <th style="color: #48C9B0; font-size: .7em;">Thu</th>
                                <th style="color: #48C9B0; font-size: .7em;">Fri</th>
                                <th style="color: #48C9B0; font-size: .7em;">Sat</th>
                              </tr>
                            </thead>
                            <tbody id="daysMonth"></tbody>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </main>

  <?php require_once 'templates/footer.php'; ?>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/calendar.js"></script>
</body>

</html>