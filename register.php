<?php

  require './functions/config.php';
  session_start();

  // Cek status login
  if(isset($_SESSION["login"])) {
    header('Location: ./home.php');
  }

  // Insert data
  if(isset($_POST["proceed"])) {
    //Simpan ke variabel
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);

    //Diubah
    $username = strtolower(stripslashes($username));
    $password = mysqli_real_escape_string($db, $password);
    $password2 = mysqli_real_escape_string($db, $password2);

    //Cek ketersediaan username
    $query_result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username';");
    if(mysqli_num_rows($query_result)) {
      header('Location: ./register.php?error=user');
      exit;
    }

    // Cek email
    $query_result = mysqli_query($db, "SELECT email FROM users WHERE email = '$email';");
    if(mysqli_num_rows($query_result)) {
      header('Location: ./register.php?error=email');
      exit;
    }

    // Cek kesamaan password
    if($password !== $password2) {
      header('Location: ./register.php?error=password');
      exit;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert ke database
    mysqli_query($db, "INSERT INTO users (username, name, email, password)
    VALUES ('$username', '$name', '$email', '$password');");
    
    // Redirect
    if(mysqli_affected_rows($db)){
      $_SESSION["username"] = $username;
      header('Location: ./register_advance.php');
      exit;
    }
    
  }

  // Error massage
  if(isset($_GET['error'])){
    if($_GET['error'] == "user"){
      $error_msg = "Username sudah dipakai!";
    }else if($_GET['error'] == "email"){
      $error_msg = "Email sudah dipakai!";
    }else if($_GET['error'] == "password"){
      $error_msg = "Password tidak sesuai!";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <!-- Local CSS -->
    <link rel="stylesheet" href="./styles/login_system.css">
    <title>iponShop | Register</title>
  </head>
  <body class="vertical-center short">
    <div class="container">
      <h1 class="text-center">Create Account</h1>

      <!-- Alert -->
      <?php if(isset($_GET['error'])) : ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $error_msg;?>
        </div>
      <?php endif;?>
      
      <form action="" method="post" autocomplete="off">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="form-group">
          <label for="password2">Confirm Password</label>
          <input type="password" class="form-control" name="password2" id="password2" required>
        </div>
        <a href="./register_advance.php">
          <button type="submit" name="proceed">Berikutnya</button>
        </a>
        <a href="./login.php" class="redirect">Sudah punya akun?</a>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="./bootstrap/js.bootstrap.js"></script>
  </body>
</html>
