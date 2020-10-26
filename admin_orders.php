<?php

  $title = "iponShop";
  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  // Delete data
  if(isset($_GET["id"])) {
    $order_id = $_GET["id"];
    mysqli_query($db, "DELETE FROM orders WHERE order_id = '$order_id';");
    header("Location: ./admin_orders.php");
  }

  // Searching
  if(isset($_GET["search"])) {
    $keyword = $_GET["search"];
    $keyword = mysqli_real_escape_string($db, $keyword);
    $query_result = mysqli_query($db, "SELECT o.order_id, u.name, s.status FROM orders o JOIN order_status s ON o.status = s.status_code JOIN users u ON o.user_id = u.id WHERE o.order_id LIKE '%$keyword%' ORDER BY o.order_id;");
  } else{
    $query_result = mysqli_query($db, "SELECT o.order_id, u.name, s.status FROM orders o JOIN order_status s ON o.status = s.status_code JOIN users u ON o.user_id = u.id ORDER BY o.order_id;");
  }

  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink mb-3 font-weight-bold">Daftar Pesanan</h2>
  
  <!-- Searching -->
  <form class="form-inline mb-3" action="" method="get" autocomplete="off">
    <div class="input-group">
      <input type="text" class="form-control wide" name="search" placeholder="Cari Order ID" aria-label="Cari Judul Buku, Penulis" aria-describedby="search-icon">
      <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
      </div>
    </div>
  </form>

  <!-- Tabel -->
  <table class="table table-hover table-bordered shadow mb-5">
    <thead class="bg-pink text-white">
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($record = mysqli_fetch_assoc($query_result)):?>
        <tr>
          <th scope="row"><?= $record["order_id"]?></th>
          <td><?= $record["name"]?></td>
          <td><?= $record["status"]?></td>
          <td>
            <a class="text-warning" href="./admin_orders_edit.php?id=<?= $record["order_id"]?>"><i class="fas fa-edit"></i></a>
            <a class="text-danger" href="./admin_orders.php?id=<?= $record["order_id"]?>"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      <?php endwhile;?>
    </tbody>
  </table>
  <a href="./admin.php"><button>Kembali</button></a>
</div>

<?php require_once './template/footer.php'; ?>