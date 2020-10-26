<?php require_once './functions/session_start.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- Local CSS -->
  <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
  <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #d46e68;">
    <div class="container">
      <a class="navbar-brand" href="./index.php"><h4>ipon<strong>Shop</strong></h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto mr-4" action="./index.php" method="get" autocomplete="off">
          <div class="input-group">
            <input type="text" class="form-control wide" name="search" placeholder="Cari Judul Buku, Penulis" aria-label="Cari Judul Buku, Penulis" aria-describedby="search-icon">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
          </div>
        </form>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" href="./login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">