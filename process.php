<?php
  require './functions/config.php';
  require_once './functions/session_start.php';
  require_once "./functions/db_functions.php";
  $title = "iponShop";

  // Cek status login
  if(!isset($_SESSION["login"])) {
    header('Location: ./login.php');
  }

  $tmp_username = $_SESSION["username"];

  // Proses pesanan
  if(isset($_POST["order"])) {
    $user_id = getUserId($tmp_username);
    $date = date("Y-m-d H:i:s");
    // Masukkan ke tabel order
    insertIntoOrder($user_id, $_SESSION["total"], $date);

    $order_id = getOrderId($user_id, $date);
    $item_id = array_column($_SESSION["cart"], "item_id");
    
    // Masukkan ke tabel order_items
    foreach($item_id as $id) {
      $book_price = getBookPrice($id);
      $query_result = mysqli_query($db, "INSERT INTO order_items (order_id, book_isbn, book_price) VALUES ('$order_id', '$id', '$book_price');");
      // Error massage
      if(!$query_result){
        echo mysqli_error($conn);
        exit;
      }
    }
  } else{
    header('Location: ./home.php');
  }

  // Unset semua session kecuali status login dan username
  session_unset();
  $_SESSION["login"] = true;
  $_SESSION["username"] = $tmp_username;

  require_once './template/header_white.php';
?>

  <!-- Modal Konfirmasi pesanan -->
  <div class="modal fade show" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pesanan Anda Sudah Diproses</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Order ID Anda adalah <?= $order_id?>. Silahkan lihat menu Status Pesanan untuk melihat detail pemesanan.
        </div>
        <div class="modal-footer">
          <a href="./home.php">
            <button>Kembali Berbelanja</button>
          </a>
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
  <script type="text/javascript">
    $(window).on('load',function(){
      $('#success').modal('show');
    });
  </script>
</body>
</html>