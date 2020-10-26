<?php

  $title = "iponShop | Edit Profil";
  require './functions/config.php';
  require_once './template/header.php';

  // Cek status login
  if(!isset($_SESSION["login"])) {
    header('Location: login.php');
  }

  $username = $_SESSION["username"];

  $query_result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username';");
  $record = mysqli_fetch_assoc($query_result);
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  // Update dari tab profil
  if(isset($_POST["update1"])) {
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);

    mysqli_query($db, "UPDATE users SET name='$name', phone='$phone' WHERE username='$username';");
    if(mysqli_affected_rows($db)) {
      $success = true;
    }
  }

  // Update dari tab alamat
  if(isset($_POST["update2"])) {
    $provinsi = htmlspecialchars($_POST["provinsi"]);
    $kota = htmlspecialchars($_POST["kota"]);
    $kelurahan = htmlspecialchars($_POST["kelurahan"]);
    $kode_pos = htmlspecialchars($_POST["kode_pos"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    mysqli_query($db, "UPDATE users SET provinsi='$provinsi', kota='$kota', kelurahan='$kelurahan', kode_pos='$kode_pos', alamat='$alamat' WHERE username = '$username';");
    if(mysqli_affected_rows($db)) {
      $success = true;
    }
  }

  // Update dari tab password
  if(isset($_POST["update3"])) {
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    $password = mysqli_real_escape_string($db, $password);
    $password2 = mysqli_real_escape_string($db, $password2);

    if($password === $password2) {
      $password = password_hash($password, PASSWORD_DEFAULT);

      mysqli_query($db, "UPDATE users SET password='$password' WHERE username = '$username';");
      if(mysqli_affected_rows($db)) {
        $success = true;
      }
    } else {
      $success = false;
    }

  }

?>

<div class="inner-container">
  <div class="row mb-3">
    <!-- Nav Tab -->
    <div class="col-md-2">
      <nav>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link text-pink active" id="tab-profil" data-toggle="pill" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profil</a>
          <a class="nav-link text-pink" id="tab-alamat" data-toggle="pill" href="#alamat" role="tab" aria-controls="alamat" aria-selected="false">Alamat</a>
          <a class="nav-link text-pink" id="tab-password" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
        </div>
      </nav>
    </div>
    <!-- Content -->
    <div class="col-md-10">
      <!-- Alert -->
      <?php if(isset($success) && $success): ?>
        <div class="alert alert-success" role="alert">
          Data berhasil diubah, silahkan refresh halaman!
        </div>
      <?php elseif(isset($success) && !$success): ?>
        <div class="alert alert-danger" role="alert">
          Password tidak sesuai!
        </div>
      <?php endif;?>
      
      <!-- Tab Content -->
      <div class="tab-content" id="v-pills-tabContent">
        <!-- Profil -->
        <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="tab-profil">
          <form action="" method="post" autocomplete="off">
            <div class="form-group row">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" value="<?= $record["username"]?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" value="<?= $record["name"]?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" value="<?= $record["email"]?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-sm-2 col-form-label">Telepon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" id="phone" value="<?= $record["phone"]?>">
              </div>
            </div>

            <button type="submit" name="update1" class="form-button">Simpan</button>
          </form>
        </div>
        <!-- Alamat -->
        <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="tab-alamat">
          <form action="" method="post" autocomplete="off">
            <div class="form-group row">
              <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="provinsi" id="provinsi" value="<?= $record["provinsi"]?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="kota" class="col-sm-2 col-form-label">Kota</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kota" id="kota" value="<?= $record["kota"]?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kelurahan" id="kelurahan" value="<?= $record["kelurahan"]?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kode_pos" id="kode_pos" value="<?= $record["kode_pos"]?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="alamat" id="alamat" rows="8" required><?= $record["alamat"]?></textarea>
              </div>
            </div>
        
            <button type="submit" name="update2" class="form-button">Simpan</button>
          </form>
        </div>
        <!-- Password -->
        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="tab-password">
          <form action="" method="post" autocomplete="off">
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password2" id="password2" required>
              </div>
            </div>

            <button type="submit" name="update3" class="form-button">Simpan</button>
          </form>
        </div>
  </div>
</div>

<?php
  require "./template/footer.php";
?>
