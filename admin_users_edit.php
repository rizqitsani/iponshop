<?php

  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  if(isset($_GET["id"])) {
    $user_id = $_GET["id"];
  }

  $query_result = mysqli_query($db, "SELECT * FROM users WHERE id = '$user_id';");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }
  $record = mysqli_fetch_assoc($query_result);

  if(isset($_POST["update"])) {
    $username = $_POST["username"];
    $email = htmlspecialchars($_POST["email"]);

    $username = strtolower(stripslashes($username));
    
    // Cek ketersediaan username
    $query_result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username' AND id != '$user_id';");
    if(mysqli_num_rows($query_result)) {
      header('Location: ./admin_users_edit.php?id='.$user_id.'&error=user');
      exit;
    }

    mysqli_query($db, "UPDATE users SET username='$username', email='$email' WHERE id = '$user_id';");
    if(mysqli_affected_rows($db)) {
      header('Location: ./admin_users.php');
    }

    
  }

  // Error massage
  if(isset($_GET['error']) && $_GET['error'] == "user"){
    $error_msg = "Username sudah dipakai!";
  }

  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink font-weight-bold mb-4">Edit User</h2>

  <!-- Alert -->
  <?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error_msg;?>
    </div>
  <?php endif;?>

  <!-- Form -->
  <form action="" method="post" autocomplete="off">
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="username" id="username" value="<?= $record["username"]?>" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= $record["name"]?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="email" value="<?= $record["email"]?>" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Telepon</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?= $record["phone"]?>" readonly>
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

    <button type="submit" name="update" class="mt-3 mr-2">Simpan</button>
    <a href="./admin_users.php"><button type="button" class="btn-white">Kembali</button></a>
  </form>
</div>

<?php require_once './template/footer.php'; ?>