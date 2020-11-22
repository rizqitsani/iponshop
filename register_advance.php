<?php

  require './functions/config.php';
  session_start();

  // Cek status login
  if(isset($_SESSION["login"])) {
    header('Location: ./home.php');
    exit;
  }

  // Cek apakah registrasi awal sudah selesai
  if(!isset($_SESSION["username"])) {
    header('Location: ./register.php');
    exit;
  } else {
    $temp_username = $_SESSION["username"];
  }

  // Insert data
  if(isset($_POST["register"])) {
    //Simpan ke variabel
    $phone = htmlspecialchars($_POST["phone"]);
    $provinsi = htmlspecialchars($_POST["provinsi"]);
    $kota = htmlspecialchars($_POST["kota"]);
    $kelurahan = htmlspecialchars($_POST["kelurahan"]);
    $kode_pos = htmlspecialchars($_POST["kode_pos"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    // Insert ke database
    mysqli_query($db, "UPDATE users SET phone='$phone', provinsi='$provinsi', kota='$kota', kelurahan='$kelurahan', kode_pos='$kode_pos', alamat='$alamat' WHERE username = '$temp_username';");

    // Redirect
    if(mysqli_affected_rows($db)){
      // Set status login
      $_SESSION["login"] = true;
      header('Location: ./home.php');
      exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">    <!-- Local CSS -->
    <link rel="stylesheet" href="./styles/login_system.css">

    <title>iponShop | Register</title>
    
  </head>
  <body class="vertical-center">
    <div class="container" style="width: 40%; margin: 80px 0;">
      <h1 class="text-center">Create Account</h1>
      <form action="" method="post" autocomplete="off">
        <div class="form-group">
          <label for="phone">Telepon</label>
          <input type="text" class="form-control" name="phone" id="phone" required>
        </div>
        <div class="form-group">
          <label for="provinsi">Provinsi</label>
          <input type="text" class="form-control" name="provinsi" id="provinsi" required>
        </div>
        <div class="form-group">
          <label for="kota">Kota</label>
          <input type="text" class="form-control" name="kota" id="kota" required>
        </div>
        <div class="form-group">
          <label for="kelurahan">Kelurahan</label>
          <input type="text" class="form-control" name="kelurahan" id="kelurahan" required>
        </div>
        <div class="form-group">
          <label for="kode_pos">Kode Pos</label>
          <input type="text" class="form-control" name="kode_pos" id="kode_pos" required>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control" name="alamat" id="alamat" rows="8" required></textarea>
        </div>

        <button type="submit" name="register">Daftar</button>
      </form>      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
