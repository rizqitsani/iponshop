<?php
  require './functions/config.php';
  require './functions/db_functions.php';
  require_once './functions/session_start.php';
  $title = "iponShop";

  // Cek status login
  if(!isset($_SESSION["login"])) {
    header('Location: login.php');
  }

  $user_id = getUserId($_SESSION["username"]);
  $query_result = mysqli_query($db, "SELECT o.order_id, s.status FROM orders o JOIN order_status s ON o.status = s.status_code WHERE user_id = '$user_id' AND o.status != '3' ORDER BY o.order_id;");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  require_once './template/header_white.php';

?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink mb-3 font-weight-bold">Status Pesanan</h2>

  <!-- Tabel -->
  <table class="table table-hover table-bordered shadow mb-5">
    <thead class="bg-pink text-white">
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while($record = mysqli_fetch_assoc($query_result)):?>
        <tr>
          <th scope="row"><?= $record["order_id"]?></th>
          <td><?= $record["status"]?></td>
          <td><a href="./order_detail.php?id=<?= $record["order_id"]?>" class="reg-link">Lihat Detail</a></td>
        </tr>
      <?php endwhile;?>
    </tbody>
  </table>
  <a href="./home.php"><button type="button">Kembali</button></a>
</div>

<?php require_once './template/footer.php'; ?>