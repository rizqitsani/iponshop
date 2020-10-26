<?php

  $title = "iponShop";
  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek status login
  if(!isset($_SESSION["login"])) {
    header('Location: ./login.php');
  }

  if(isset($_GET["id"])) {
    $order_id = $_GET["id"];
  }

  // Konfirmasi barang sampai
  if(isset($_POST["confirm"])) {
    mysqli_query($db, "UPDATE orders SET status='3' WHERE order_id = '$order_id';");
    if(mysqli_affected_rows($db)) {
      header('Location: ./orderlist.php');
    }
  }

  // Ambil data pesanan
  $query_result = mysqli_query($db, "SELECT * FROM orders o JOIN order_status s ON o.status = s.status_code WHERE o.order_id = '$order_id';");

  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  $record = mysqli_fetch_assoc($query_result);

  // Ambil data buku yang dipesan
  $query_result = mysqli_query($db, "SELECT b.book_title FROM order_items i JOIN books b ON b.book_isbn = i.book_isbn  WHERE order_id = '$order_id';");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  require_once './template/header_white.php';
?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink font-weight-bold mb-4">Detail Pesanan #<?= $order_id?></h2>
  <!-- Tabel -->
  <form action="" method="post" autocomplete="off">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Item</label>
      <div class="col-sm-10">
        <textarea class="form-control" rows="8" readonly><?php
            while($record2 = mysqli_fetch_assoc($query_result)){
              echo $record2["book_title"] . " - ";
            }                  
          ?>
        </textarea>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Total</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= "Rp " . number_format($record["total"], 0, '', '.')?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tanggal Dipesan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= $record["date"]?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= $record["status"]?>" readonly>
      </div>
    </div>

    <button type="submit" name="confirm" class="mt-3 mr-2">Pesanan Diterima</button>
    <a href="./orderlist.php"><button type="button" class="btn-white">Kembali</button></a>
  </form>
</div>

<?php require_once './template/footer.php'; ?>