<?php

  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  if(isset($_GET["id"])) {
    $order_id = $_GET["id"];
  }

  // Ambil data order
  $query_result = mysqli_query($db, "SELECT * FROM orders o JOIN order_status s ON o.status = s.status_code JOIN users u ON o.user_id = u.id WHERE o.order_id = '$order_id';");

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

  // Update data
  if(isset($_POST["update"])) {
    $status = htmlspecialchars($_POST["status"]);
    // Cek apakah input valid
    if($status < 0 || $status > 2) {
      header('Location: ./admin_orders_edit.php?id='.$order_id.'&error=status');
      die;
    }

    mysqli_query($db, "UPDATE orders SET status='$status' WHERE order_id = '$order_id';");
    if(mysqli_affected_rows($db)) {
      header('Location: ./admin_orders.php');
    }
  }

  // Error massage
  if(isset($_GET['error'])){
    $error_msg = "Status yang diinputkan tidak valid!";
  }

  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink font-weight-bold mb-4">Edit Order</h2>

  <!-- Alert -->
  <?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error_msg;?>
    </div>
  <?php endif;?>
  
  <!-- Form -->
  <form action="" method="post" autocomplete="off">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Customer Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= $record["name"]?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Alamat</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"
          value="<?= $record["alamat"] . ", " . $record["kelurahan"] . ", " . $record["kota"] . ", " . $record["provinsi"] . 
          " - " . $record["kode_pos"]?>"
        readonly>
      </div>
    </div>
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
      <label class="col-sm-2 col-form-label">Tanggal Diterima</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= $record["date"]?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="status" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="status" id="status" value="<?= $record["status_code"]?>" required>
      </div>
    </div>

    <p class="text-muted">0 = Diterima, 1 = Dikemas, 2 = Dikirim</p>

    <button type="submit" name="update" class="mt-3 mr-2">Simpan</button>
    <a href="./admin_orders.php"><button type="button" class="btn-white">Kembali</button></a>
  </form>
</div>

<?php require_once './template/footer.php'; ?>