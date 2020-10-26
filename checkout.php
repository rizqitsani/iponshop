<?php

  $title = "iponShop | Checkout";
  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek status login
  if(!isset($_SESSION["login"])) {
    header('Location: ./login.php');
  }

  // Cek jumlah item di cart
  if(count($_SESSION["cart"]) == 0) {
    header('Location: ./home.php');
  }

  $tmp_username = $_SESSION["username"];

  $query_result = mysqli_query($db, "SELECT * FROM users WHERE username = '$tmp_username';");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  $record = mysqli_fetch_assoc($query_result);
  
  require_once './template/header_white.php';

?>

<div class="inner-container">
  <div class="row">
    <!-- Pengiriman -->
    <div class="col-md-7">
      <div class="card shadow">
        <h3 class="card-header p-4 text-white" style="background: #d46e68; font-weight: bold;">Pengiriman</h3>
        <div class="card-body">
          <p class="card-text mb-1 font-weight-bold"><?= $record["name"]?></p>
          <p class="card-text my-1"><?= $record["alamat"]?></p>
          <p class="card-text my-1"><?= $record["kelurahan"] . " - " . $record["kota"]?></p>
          <p class="card-text my-1"><?= $record["provinsi"] . " " . $record["kode_pos"]?></p>
          <p class="card-text my-1"><?= $record["phone"]?></p>
        </div>
      </div>
    </div>
    <!-- Pembayaran -->
    <div class="col-md-4 offset-1">
    <form action="./process.php" method="post">
      <div class="card shadow">
        <h3 class="card-header p-4 text-white" style="background: #d46e68; font-weight: bold;">Ringkasan Pemesanan</h3>
        <div class="card-body">
          <h5 class="card-title font-weight-bold text-muted">Total</h5>
          <h3 class="card-text mt-1 mb-3 text-danger font-weight-bold"><?= "Rp " . number_format($_SESSION["total"], 0, "", ".")?></h3>
          <button type="submit" name="order" style="width: 100%;">Pesan Sekarang</button>
        </div>
      </div>
    </form>
  </div>
</div

<?php require_once './template/footer.php'; ?>