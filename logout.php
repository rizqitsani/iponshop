<?php

  session_start();
  // Unset dan destroy semua session
  session_unset();
  session_destroy();

  header('Location: ./login.php');
  exit;

?>