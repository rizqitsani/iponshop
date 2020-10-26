<?php

  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  // Hapus data
  if(isset($_GET["id"])) {
    $user_id = $_GET["id"];
    mysqli_query($db, "DELETE FROM users WHERE id = '$user_id';");
    header("Location: ./admin_users.php");
  }

  // Searching
  if(isset($_GET["search"])) {
    $keyword = $_GET["search"];
    $keyword = mysqli_real_escape_string($db, $keyword);
    $query_result = mysqli_query($db, "SELECT * FROM users WHERE username LIKE '%$keyword%' OR name LIKE '%$keyword%';");
  } else{
    $query_result = mysqli_query($db, "SELECT * FROM users;");
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
  <h2 class="text-pink mb-3 font-weight-bold">Daftar User</h2>
  <!-- Search bar -->
  <form class="form-inline mb-3" action="" method="get" autocomplete="off">
    <div class="input-group">
      <input type="text" class="form-control wide" name="search" placeholder="Cari Username, Nama" aria-label="Cari Judul Buku, Penulis" aria-describedby="search-icon">
      <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
      </div>
    </div>
  </form>

  <!-- Tabel -->
  <table class="table table-hover table-bordered shadow mb-5">
    <thead class="bg-pink text-white">
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">Username</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Telepon</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($record = mysqli_fetch_assoc($query_result)):?>
        <tr>
          <th scope="row"><?= $record["id"]?></th>
          <td><?= $record["username"]?></td>
          <td><?= $record["name"]?></td>
          <td><?= $record["email"]?></td>
          <td><?= $record["phone"]?></td>
          <td>
            <a class="text-success" href="./admin_users_process.php?id=<?= $record["id"]?>"><i class="fas fa-check-circle">
            </i></a>
            <a class="text-warning" href="./admin_users_edit.php?id=<?= $record["id"]?>"><i class="fas fa-edit"></i></a>
            <a class="text-danger" href="./admin_users.php?id=<?= $record["id"]?>"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      <?php endwhile;
      ?>
    </tbody>
  </table>
  <a href="./admin.php"><button>Kembali</button></a>
</div>

<?php require_once './template/footer.php'; ?>