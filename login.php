<?php

  require './functions/config.php';
  require './functions/session_start.php';
  
  // Cek status login
  if(isset($_SESSION["login"])) {
    header('Location: ./home.php');
  }

  // Verifikasi input
  if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek dari tabel admin
    $query_result = mysqli_query($db, "SELECT * FROM admin WHERE username = '$username';");
    if(mysqli_num_rows($query_result) === 1){
      $record = mysqli_fetch_assoc($query_result);
      if(password_verify($password, $record["password"])) {
        $_SESSION["admin"] = true;
        $_SESSION["username"] = $username;
        header('Location: ./admin.php');
        exit;
      } else{
        header('Location: ./login.php?error=password');
        exit;
      }
    }

    //Cek dari tabel user
    $query_result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username';");
    if(mysqli_num_rows($query_result) === 1){
      $record = mysqli_fetch_assoc($query_result);
      if(password_verify($password, $record["password"])) {
        // Set status login
        $_SESSION["login"] = true;
        $_SESSION["username"] = $username;
        header('Location: ./home.php');
        exit;
      } else{
        header('Location: ./login.php?error=password');
        exit;
      }
    } else{
      header('Location: ./login.php?error=user');
      exit;
    }
  }

  // Error massage
  if(isset($_GET['error'])){
    if($_GET['error'] == "user"){
      $error_msg = "Username tidak ditemukan!";
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

    <title>iponShop | Login Page</title>
  </head>
  <body class="vertical-center short">
    <div class="container">
        <h1 class="text-center">Login</h1>

        <!-- Alert -->
        <?php if(isset($_GET['error'])) : ?>
          <div class="alert alert-warning" role="alert">
            <?php echo $error_msg;?>
          </div>
        <?php endif;?>
        
        <!-- Form -->
        <form action="" method="post" autocomplete="off">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <button type="submit" name="login">Login</button>
          <a href="./register.php" class="redirect">Belum punya akun?</a>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>