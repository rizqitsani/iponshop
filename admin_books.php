<?php

  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  // Hapus data
  if(isset($_GET["isbn"])) {
    $book_isbn = $_GET["isbn"];
    mysqli_query($db, "DELETE FROM books WHERE book_isbn = '$book_isbn';");
    header("Location: ./admin_books.php");
  }

  // Searching
  if(isset($_GET["search"])) {
    $keyword = $_GET["search"];
    $keyword = mysqli_real_escape_string($db, $keyword);
    $query_result = mysqli_query($db, "SELECT * FROM books WHERE book_title LIKE '%$keyword%' OR book_author LIKE '%$keyword%' OR book_isbn LIKE '%$keyword%';");
  } else{
    $query_result = mysqli_query($db, "SELECT * FROM books;");
  }

  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  $i = 1;
  require_once './template/header_admin.php';

?>

<div class="inner-container">
  <!-- Judul  -->
  <h2 class="text-pink mb-3 font-weight-bold">Daftar Buku</h2>
  
  <!-- Searching dan tambah buku -->
  <div class="d-flex justify-content-between mb-3 align-items-end">
    <form class="form-inline" action="" method="get" autocomplete="off">
      <div class="input-group">
        <input type="text" class="form-control wide" name="search" placeholder="Cari ISBN, Judul Buku, Penulis" aria-label="Cari Judul Buku, Penulis" aria-describedby="search-icon">
        <div class="input-group-append">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
      </div>
    </form>    
    <h6><a href="admin_books_add.php" class="reg-link"><i class="fas fa-plus-circle mr-1"></i>Tambah Buku</a></h6>
  </div>

  <!-- Tabel -->
  <table class="table table-hover table-bordered shadow mb-5">
    <thead class="bg-pink text-white">
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col">Image</th>
        <th scope="col">ISBN</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($record = mysqli_fetch_assoc($query_result)):?>
        <tr>
          <th scope="row" class="text-center"><?= $i?></th>
          <td><img src="./images/<?= $record["book_image"]?>" alt="<?= $record["book_title"]?>" width="100px"></td>
          <td><?= $record["book_isbn"]?></td>
          <td><?= $record["book_title"]?></td>
          <td><?= $record["book_author"]?></td>
          <td><?= "Rp " . number_format($record["book_price"], 0, '', '.')?></td>
          <td>
            <a class="text-warning" href="./admin_books_edit.php?isbn=<?= $record["book_isbn"]?>"><i class="fas fa-edit"></i></a>
            <a class="text-danger" href="./admin_books.php?isbn=<?= $record["book_isbn"]?>"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      <?php 
        $i++;
        endwhile;
      ?>
    </tbody>
  </table>
  <a href="./admin.php"><button>Kembali</button></a>
</div>

<?php require_once './template/footer.php'; ?>