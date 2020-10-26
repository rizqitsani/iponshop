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
      <a class="navbar-brand" href="./home.php"><h4>ipon<strong>Shop</strong></h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto mr-4" action="./home.php" method="get" autocomplete="off">
          <div class="input-group">
            <input type="text" class="form-control wide" name="search" placeholder="Cari Judul Buku, Penulis" aria-label="Cari Judul Buku, Penulis" aria-describedby="search-icon">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
          </div>
        </form>
        <ul class="navbar-nav ml-auto">
          <li class="navbar-item mr-2  my-auto">
            <a class="nav-link" href="./cart.php" class="mr-1">
              <button type="button" class="btn btn-light">
                <i class="fas fa-shopping-cart text-pink"></i>
                <?php if (isset($_SESSION["cart"])): ?>
                  <?php $count = count($_SESSION["cart"]);?>
                  <span class="badge badge-white"><?= $count?></span>
                <?php else:?>
                  <span class="badge badge-white">0</span>
                <?php endif;?>
              </button>
            </a>
            
          </li>
          <li class="nav-item dropdown my-auto">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $_SESSION["username"]?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="./profile_edit.php">Edit Profil</a>
              <a class="dropdown-item" href="./orderlist.php">Status Pesanan</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="./logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">