<?php

  $title = "iponShop";
  $count_column = 0;
  require './functions/config.php';
  require_once './functions/session_start.php';

  // Searching
  if(isset($_GET["search"])) {
    $keyword = $_GET["search"];
    $keyword = mysqli_real_escape_string($db, $keyword);
    $query_result = mysqli_query($db, "SELECT book_isbn, book_image, book_title, book_author, book_price FROM books WHERE book_title LIKE '%$keyword%' OR book_author LIKE '%$keyword%';");
  } else{
    $query_result = mysqli_query($db, "SELECT book_isbn, book_image, book_title, book_author, book_price FROM books;");
  }

  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  require_once './template/header_nologin.php';


?>

<div class="main-container">

  <?php for($i=0; $i<mysqli_num_rows($query_result); $i++): ?>
    <div class="row">  
      <?php while($record = mysqli_fetch_assoc($query_result)): ?>
        <div class="col-md-3">
          <div class="card shadow mt-3 mb-3">
            <!-- Image -->
            <a href="./book.php?id=<?= $record["book_isbn"];?>">
              <img src="./images/<?= $record["book_image"]?>" class="card-img-top" alt="<?= $record["book_title"]?>">
            </a>
            <!-- Detail Singkat -->
            <div class="card-body">
              <a href="./book.php?id=<?= $record["book_isbn"];?>" class="reg-link"><h5 class="card-title"><?= $record["book_title"]?></h5>
              </a>
              <h6 class="card-subtitle mb-2 text-muted"><?= $record["book_author"]?></h6>
              <p class="card-text text-danger"><?= "Rp " .  number_format($record["book_price"], 0, "", ".")?></p>
            </div>
          </div>
        </div>
        <!-- Ganti baris -->
        <?php
          $count_column++;
          if($count_column >= 4){
            $count_column = 0;
            break;
          }
        ?>
      <?php endwhile;?>
    </div>
  <?php endfor;?>
</div>

<?php require_once './template/footer.php'; ?>