<?php
require 'cfg.inc.php';
if (!isset($_SESSION['cod'])) header("location:ingreso.php");
if (isset($_SESSION['carro'])) $carro = $_SESSION['carro'];
if (!empty($carro)) {
  $sum = 0;
  foreach ($carro as $h) {
    $sum += $h['precio'];
  };
  $total = $sum * 100;
  $charge = false;
  if ($charge) header('location:success.php');
  else header('location:cancel.php');
}
