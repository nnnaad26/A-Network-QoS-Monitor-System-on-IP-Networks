<?php
require_once 'helper/connection.php';
session_start();
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM login WHERE username='$username' and password='$password' LIMIT 1";
  $result = mysqli_query($connection, $sql);

  $row = mysqli_fetch_assoc($result);
  if ($row) {
    $_SESSION['login'] = $row;
    header('Location: index.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login &mdash; QOS</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #f3f4f6, #e0e7ff);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .login-container {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }

    .login-container h4 {
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 10px;
    }

    .form-control:focus {
      box-shadow: 0 0 8px rgba(106, 17, 203, 0.3);
      border-color: #6a11cb;
    }

    .btn-primary {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .input-group-text {
      background: #f3f4f6;
      border: none;
      border-right: 1px solid #e0e7ff;
    }

    .input-group .form-control {
      border-left: none;
    }

    .remember-me {
      font-size: 14px;
    }

    .footer-text {
      font-size: 14px;
      color: #6b7280;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h4>ADMIN QOS</h4>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input id="username" type="text" class="form-control" name="username" required autofocus>
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input id="password" type="password" class="form-control" name="password" required>
        </div>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember-me" name="remember">
        <label class="form-check-label remember-me" for="remember-me">Ingat Saya</label>
      </div>
      <div class="d-grid">
        <button name="submit" type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    <p class="footer-text mt-3">© 2024 Admin QoS. All rights reserved.</p>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
