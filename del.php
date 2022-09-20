<?php
//QUITAR ITEM DEL CARRITO
require 'cfg.inc.php';
if (isset($_GET['pid'])) {
	extract($_REQUEST);
	$p = base64_decode($_GET['pid']);
	$d = base64_decode($_GET['did']);
	if ($d > 0) {
		$qrys = "UPDATE " . odo_DATA_DESC . " SET fechauso = NULL, utilizado = NULL WHERE id = '$d' ";
		$rsul = $mysqli->query($qrys);
	}
	unset($_SESSION['descuento']);
	unset($_SESSION['iddescto']);
	unset($_SESSION['dscto']);
	$carro = $_SESSION['carro'];
	unset($carro[base64_decode($pid)]);
	$_SESSION['carro'] = $carro;
	header('location:' . $_SERVER['HTTP_REFERER']);
} else {
	header('location:index.php');
}
