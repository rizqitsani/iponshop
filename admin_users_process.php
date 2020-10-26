<?php

  require './functions/config.php';
  require_once './functions/session_start.php';

  // Cek apakah login sebagai admin
  if(!isset($_SESSION["admin"])) {
    header('Location: ./login.php');
  }

  // Ubah akses user menjadi administrator
  if(isset($_GET["id"])) {
    $user_id = $_GET["id"];

    $query_result = mysqli_query($db, "SELECT * FROM users WHERE id = '$user_id';");
    $record = mysqli_fetch_assoc($query_result);
    // Error massage
    if(!$query_result){
      echo mysqli_error($conn);
      exit;
    }
    
    // Pindah data dari tabel users ke admin, lalu hapus data di table users
    mysqli_query($db, "INSERT INTO admin (username, password, name, email, phone) SELECT username, password, name, email, phone FROM users WHERE users.id = '$user_id';");
    if(mysqli_affected_rows($db)) {
      mysqli_query($db, "DELETE FROM users WHERE id = '$user_id';");
    }
  }

  require_once './template/header_admin.php';
?>

  <!-- Modal -->
  <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          Database admin sudah diubah.
        </div>
        <div class="modal-footer">
          <a href="./admin_users.php">
            <button>Kembali</button>
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