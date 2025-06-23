<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sree Hotel Admin Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <div class="page-wrapper d-flex" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <aside class="left-sidebar bg-light shadow-sm" style="min-width: 240px;">
      <div class="brand-logo d-flex align-items-center justify-content-center p-3">
        <img src="assets/images/logos/sree hotel.jpg" alt="Logo" width="50" class="me-2">
        <span class="fw-bold fs-5">Sree Hotel</span>
      </div>
      <nav class="sidebar-nav">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="demo.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="food-categories.php"><i class="bi bi-tags me-2"></i>Add Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="food-ingredients.php"><i class="bi bi-basket2-fill me-2"></i>Add Ingredients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_new_food.php"><i class="bi bi-plus-square me-2"></i>Add New Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dispaly_food.php"><i class="bi bi-list-ul me-2"></i>Display Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="allregister-user.php"><i class="bi bi-person-lines-fill me-2"></i>All Registered Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contactuser-form.php"><i class="bi bi-envelope-open me-2"></i>Contact Us Form</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all-userorder.php"><i class="bi bi-cart4 me-2"></i>All Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
          </li>
        </ul>
      </nav>
    </aside>
    <!-- Sidebar End -->

   <!-- Top Navbar -->
<nav class="navbar navbar-light bg-white shadow-sm fixed-top w-100 px-3 py-1" style="height: 48px; z-index: 1030;">
  <div class="container-fluid d-flex justify-content-between align-items-center h-100">
    <span class="fw-semibold small mb-0">Welcome to Admin Dashboard</span>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="assets/images/profile/user-1.jpg" alt="Profile" width="32" height="32" class="rounded-circle me-2">
        <span class="d-none d-md-inline small">Admin</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
        <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profile</a></li>
        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


  <!-- Scripts -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
