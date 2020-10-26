<?php

  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  if(isset($_GET["isbn"])) {
    $book_isbn = $_GET["isbn"];
  }

  $query_result = mysqli_query($db, "SELECT * FROM books WHERE book_isbn = '$book_isbn';");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }
  $record = mysqli_fetch_assoc($query_result);

  // Update data
  if(isset($_POST["update"])) {
    $price = htmlspecialchars($_POST["price"]);
    $desc = htmlspecialchars($_POST["desc"]);

    mysqli_query($db, "UPDATE books SET book_price='$price', book_desc='$desc' WHERE book_isbn = '$book_isbn';");
    if(mysqli_affected_rows($db)) {
      header('Location: ./admin_books.php');
    }
  }

  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <!-- Judul -->
  <h2 class="text-pink font-weight-bold mb-4">Edit Buku</h2>
  
  <!-- Form -->
  <div class="row">
    <div class="col-md-2">
      <div class="card">
        <img class="card-img-top" src="./images/<?= $record["book_image"]?>" alt="Card image cap">
      </div>
    </div>
    <div class="col-md-10">
      <form action="" method="post" autocomplete="off">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">ISBN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $record["book_isbn"]?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $record["book_title"]?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $record["book_author"]?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $record["book_publisher"]?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tahun Terbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $record["book_publication"]?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="price" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price" value="<?= $record["book_price"]?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="desc" id="desc" rows="8" required><?= $record["book_desc"]?></textarea>
          </div>
        </div>
  
        <button type="submit" name="update" class="mt-3 mr-2">Simpan</button>
        <a href="./admin_books.php"><button type="button" class="btn-white">Kembali</button></a>
      </form>
    </div>
  </div>
</div>

<?php require_once './template/footer.php'; ?>