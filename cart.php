<?php
  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek status login
  if(!isset($_SESSION["login"])) {
    header('Location: ./login.php');
  }

  // Cek jumlah barang di cart
  if(count($_SESSION["cart"]) == 0) {
    header('Location: ./home.php');
  }

  $title = "iponShop | Keranjang Belanja";
  $_SESSION["total"] = 0;

  $query_result = mysqli_query($db, "SELECT * FROM books;");
  // Error massage
  if(!$query_result){
    echo mysqli_error($conn);
    exit;
  }

  // Remove item dari cart
  if (isset($_POST["remove"])){
    foreach ($_SESSION["cart"] as $key => $value){
      if($value["item_id"] == $_POST["id"]){
        unset($_SESSION["cart"][$key]);
        header('Location: ./cart.php');
      }
    }
  }
  
  require_once './template/header.php';

?>

<div class="inner-container">
    <!-- Judul  -->
    <h2 class="text-pink mb-4 font-weight-bold">Keranjang Belanja</h2>
    <div class="row">
      <!-- Cart Items -->
      <div class="col-md-8">
        <?php $item_id = array_column($_SESSION["cart"], "item_id");?>
        <?php while($record = mysqli_fetch_assoc($query_result)):?>
          <?php foreach($item_id as $id):?>
            <?php if($record["book_isbn"] == $id):?>
              <div class="card shadow mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="./images/<?= $record["book_image"]?>" class="card-img" alt="<?= $record["book_title"]?>">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?= $record["book_title"]?></h5>
                      <h6 class="card-subtitle mb-2 text-muted"><?= $record["book_author"]?></h6>
                      <p class="card-text text-danger"><?= "Rp " .  number_format($record["book_price"], 0, "", ".")?></p>
                      <form action="" method="post">
                        <button class="btn btn-outline-danger" name="remove"><i class="fas fa-trash-alt"></i></button>
                        <input type="hidden" name="id" value=<?= $record["book_isbn"]?>>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php $_SESSION["total"]+=$record["book_price"];?>
            <?php endif;?>
          <?php endforeach;?>
        <?php endwhile;?>
      </div>
      <!-- Price Details -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <?php
              if (isset($_SESSION['cart'])){
                $count  = count($_SESSION['cart']);
                echo "<h5 class='card-title'>Price ($count items)</h5>";
              }
            ?>
            <p class="card-text text-danger"><?= "Rp " .  number_format($_SESSION["total"], 0, "", ".")?></p>
            <a href="./checkout.php" class="reg-link"><button style="width: 100%;">Checkout</button></a>
            <a href="./home.php" class="reg-link"><button class="btn-white mt-2" style="width: 100%;">Kembali Berbelanja
            </button></a>
          </div>
        </div>
      </div>
    </div>
</div>

<?php require_once './template/footer.php'; ?>