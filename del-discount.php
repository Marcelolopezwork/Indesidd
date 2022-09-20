<?php
//QUITAR DESCUENTO DEL CARRITO
require 'cfg.inc.php';
if (isset($_GET['did'])) {
  //extract($_POST);
  $d = $_GET['did'];
  if ($d > 0) {
    $qrys = "UPDATE " . odo_DATA_DESC . " SET fechauso = NULL WHERE id = '$d' ";
    $rsul = $mysqli->query($qrys);
    unset($_SESSION['descuento']);
    unset($_SESSION['iddescto']);
    unset($_SESSION['dscto']);
  }
  header('location:' . $_SERVER['HTTP_REFERER']);
} else {
  header("location:index.php");
}
