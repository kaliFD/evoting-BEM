<?php
  session_start();
  if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "mahasiswa") {
        header('location:admin.php');
      } else {
        header('location:error.php');
      }
  } else {
    header('location:login.php');
  }

?>