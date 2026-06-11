<div class="navbar-bg" style="background: linear-gradient(to right, #6a11cb, #2575fc);"></div>
<nav class="navbar navbar-expand-lg main-navbar" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
  <!-- Sidebar toggle -->
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li>
        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>
  </form>

  <!-- User Profile -->
  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
        <!-- Menggunakan data-bs-toggle untuk Bootstrap 5 -->
        <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['login']['username'] ?></div>
        </a>
        <!-- Menggunakan ul untuk menampung dropdown items -->
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <li>
                <a href="../logout.php" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </li>
  </ul>
</nav>

<!-- jQuery (Jika dibutuhkan untuk elemen lain) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
