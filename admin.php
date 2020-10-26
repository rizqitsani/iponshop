<?php

  $count_column = 0;
  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <h2 class="text-pink mb-5">Selamat Datang, <?= $_SESSION["username"]?>!</h2>
  <div class="card-deck">
    <div class="card border-pink">
      <div class="card-body">
        <h5 class="card-title">Manage Users</h5>
        <p class="card-text">Edit data user, hapus data user, dan beri akses administrator.</p>
        <a href="./admin_users.php" class="text-pink"><i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="card border-pink">
      <div class="card-body">
        <h5 class="card-title">Manage Books</h5>
        <p class="card-text">Edit data buku, hapus data buku, dan tambah buku baru.</p>
        <a href="./admin_books.php" class="text-pink"><i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="card border-pink">
      <div class="card-body">
        <h5 class="card-title">Manage Orders</h5>
        <p class="card-text">Update status order.</p>
        <a href="./admin_orders.php" class="text-pink"><i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</div>

<?php require_once './template/footer.php'; ?>