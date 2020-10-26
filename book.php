<?php

  require './functions/config.php';
  require_once './functions/session_start.php';
  unset($_SESSION["show"]);

  $book_isbn = $_GET["id"];
  $query_result = mysqli_query($db, "SELECT * FROM books WHERE book_isbn = '$book_isbn';");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  $record = mysqli_fetch_assoc($query_result);
  $title = "iponShop | " . $record["book_title"];

  // Add to cart
  if (isset($_POST["add"])) {
    // Jika sudah login tambahkan ke cart
    if(isset($_SESSION["login"])) {
      $index = $_POST["item_id"];
      // Jika sudah ada item di cart
      if(isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], "item_id");
        // Jika item sudah dimasukkan ke cart
        if(in_array($_POST["item_id"], $item_array_id)) {
          $_SESSION["show"] = "repeated";
        }else {
          $item_array = array("item_id" => $_POST["item_id"]);
          $_SESSION["cart"]["$index"] = $item_array;
          $_SESSION["show"] = "new";
        }
      } else{
        $item_array = array("item_id" => $_POST["item_id"]);
        $_SESSION["cart"]["$index"] = $item_array;
        $_SESSION["show"] = "new";
      }
    // Kalau belum, redirect
    } else{
      header('Location: ./login.php');
    }
  }

  // Header disesuaikan status login
  if(isset($_SESSION["login"])) {
    require_once './template/header.php';
  } else{
    require_once './template/header_nologin.php';
  }

?>

  <div class="inner-container">
    <div class="row mb-5">
      <!-- Thumbnail -->
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="./images/<?= $record["book_image"]?>" alt="Card image cap">
        </div>
      </div>
      <!-- Judul & Penulis -->
      <div class="col-md-6 pl-4">
        <h1 class="text-pink"><?= $record["book_title"]?></h1>
        <h5 class="text-muted"><?= $record["book_author"]?></h5>
      </div>
      <!-- Cart -->
      <div class="col-md-3">
        <div class="card mb-3" style="max-width: 18rem;">
          <div class="card-header">Harga</div>
          <div class="card-body">
            <h5 class="card-title text-pink"><?= "Rp " .  number_format($record["book_price"], 0, "", ".")?></h5>
          </div>
        </div>

        <form action="" method="post">
          <button type="submit" name="add" style="width: 100%;">
            Pesan Sekarang
          </button>
          <input type="hidden" name="item_id" value=<?= $book_isbn?>>
        </form>

        <!-- Modal New -->
        <div class="modal fade" id="confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Item berhasil ditambahkan ke keranjang</h5>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-3">
                    <img src="./images/<?= $record["book_image"]?>" class="card-img-top" alt="<?= $record["book_title"]?>">
                  </div>
                  <div class="col-md-9">
                    <h5><?= $record["book_title"]?></h5>
                    <h6 class="text-muted"><?= $record["book_author"]?></h6>
                    <br><br>
                    <p class="text-danger"><?= "Rp " .  number_format($record["book_price"], 0, "", ".")?></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer align-items-start">
                <a href="./home.php"><button class="btn-sm btn-white">Lanjut Berbelanja</button></a>
                <a href="./cart.php"><button class="btn-sm">Lanjut Ke Keranjang</button></a>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Repeated -->
        <div class="modal fade" id="repeat-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Produk sudah ada di keranjang</h5>
              </div>
              <div class="modal-footer align-items-start">
                <a href="./home.php"><button class="btn-sm btn-white">Lanjut Berbelanja</button></a>
                <a href="./cart.php"><button class="btn-sm">Lanjut Ke Keranjang</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <!-- Detail & Deskripsi -->
    <div class="row ml-1">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active text-pink" id="tab-deskripsi" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi</a>
          <a class="nav-item nav-link text-pink" id="tab-detail" data-toggle="tab" href="#detail" role="tab" aria-controls="nav-profile" aria-selected="false">Detail</a>
        </div>
      </nav>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active mt-3 text-muted" id="deskripsi" role="tabpanel" aria-labelledby="tab-deskripsi">
            <?= $record["book_desc"]?>
          </div>
          <div class="tab-pane fade mt-3" id="detail" role="tabpanel" aria-labelledby="tab-detail">
            <table class="table table-sm borderless text-muted">
              <tr>
                <td>Tahun Terbit</td>
                <td></td>
                <td></td>
                <th scope="row"><?= $record["book_publication"]?></th>
              </tr>
              <tr>
                <td>ISBN</td>
                <td></td>
                <td></td>
                <th scope="row"><?= $record["book_isbn"]?></th>
              </tr>
              <tr>
                <td>Penerbit</td>
                <td></td>
                <td></td>
                <th scope="row"><?= $record["book_publisher"]?></th>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./bootstrap/js/jquery-3.5.1.slim.min.js"></script>
  <script src="./bootstrap/js/popper.min.js"></script>
  <script src="./bootstrap/js/bootstrap.js"></script>
  <?php if(isset($_SESSION["show"]) && $_SESSION["show"] == "new"):?>  
    <script type="text/javascript">
      $(window).on('load',function(){
          $('#confirm-modal').modal('show');
      });
    </script>
  <?php elseif(isset($_SESSION["show"]) && $_SESSION["show"] == "repeated"):?>
    <script type="text/javascript">
      $(window).on('load',function(){
          $('#repeat-modal').modal('show');
      });
    </script>
  <?php endif;?>

</body>
</html>