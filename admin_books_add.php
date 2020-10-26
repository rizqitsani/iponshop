<?php

  require './functions/config.php';
  require_once './functions/session_start.php';
  require_once './functions/db_functions.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  // Insert data
  if(isset($_POST["insert"])) {
    $isbn = htmlspecialchars($_POST["isbn"]);
    $title = htmlspecialchars($_POST["title"]);
    $author = htmlspecialchars($_POST["author"]);
    $publisher = htmlspecialchars($_POST["publisher"]);
    $publication = htmlspecialchars($_POST["publication"]);
    $price = htmlspecialchars($_POST["price"]);
    $desc = htmlspecialchars($_POST["desc"]);

    $image = uploadImage();

    mysqli_query($db, "INSERT INTO books VALUES ('', '$isbn', '$image', '$title', '$author', '$publisher', '$publication'
    , '$price', '$desc') ;");

    if(mysqli_affected_rows($db)){
      $success = true;
    }
  }

  // Error massage
  if(isset($_GET['error'])){
    if($_GET['error'] == "ext"){
      $error_msg = "Ekstensi file tidak sesuai!";
    }else if($_GET['error'] == "size"){
      $error_msg = "Ukuran file terlalu besar!";
    }
  }

  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink font-weight-bold">Tambah Buku</h2>
  
  <!-- Alert -->
  <?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error_msg;?>
    </div>
  <?php elseif(isset($success) && $success): ?>
    <div class="alert alert-success" role="alert">
      Buku berhasil ditambahkan!
    </div>
  <?php endif;?>
  
  <!-- Form -->
  <div class="row mt-4">
    <div class="col-md-10">
      <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="isbn" id="isbn" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="author" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="author" id="author" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="publisher" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="publisher" id="publisher" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="publication" class="col-sm-2 col-form-label">Tahun Terbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="publication" id="publication" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="price" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="desc" id="desc" rows="8" required></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="image" class="col-sm-2 col-form-label">Gambar</label>
          <div class="col-sm-10">
            <input type="file" class="form-control-file mb-1" name="image" id="image" required>
            <p class="text-muted">Ukuran file kurang dari 2MB. Ekstensi jpg, jpeg, png.</p>
          </div>
        </div>
  
        <button type="submit" name="insert" class="mt-3 mr-2">Tambah</button>
        <a href="./admin_books.php" class="btn"><button type="button" class="btn-white">Kembali</button></a>
      </form>
    </div>
  </div>
</div>

<?php require_once './template/footer.php'; ?>