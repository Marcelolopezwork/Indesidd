<?php
//AGREGA ITEM AL CARRITO
require 'cfg.inc.php';

if (isset($_GET['pid'])) {
	extract($_GET);
	$myid = base64_decode($pid);
	$qrys = "SELECT * FROM " . odo_DATA_CURS . " WHERE id = '$myid' ORDER BY id";
	$rsul = $mysqli->query($qrys);
	$row = $rsul->fetch_array(MYSQLI_ASSOC);

	if (isset($_SESSION['carro'])) $carro = $_SESSION['carro'];
	if ($row['ofertaactiva'] == 'S') $prize = $row['preciooferta'];
	else $prize = $row['precioventa'];
	$dscto = 0;
	$iddescto = 0;

	if ((isset($_SESSION['descuento'])) && (!empty($_SESSION['descuento']))) $prize = $_SESSION['descuento'];
	if ((isset($_SESSION['iddescto'])) && (!empty($_SESSION['iddescto']))) $iddescto = $_SESSION['iddescto'];
	if ((isset($_SESSION['dscto'])) && (!empty($_SESSION['dscto']))) $dscto = $_SESSION['dscto'];

	unset($_SESSION['descuento']);
	unset($_SESSION['iddescto']);
	unset($_SESSION['dscto']);

	$carro[$myid] = array(
		'categoria' => $row['categoriaid'],
		'curso' => $row['curso'],
		'newid' => $row['id'],
		'slug' => $row['slug'],
		'imagen' => $row['imagen'],
		'precio' => $prize,
		'descuento' => $dscto,
		'iddescto' => $iddescto,
		'comica' => $row['comision'],
		'profe' => $row['profesorid']
	);
	$_SESSION['carro'] = $carro;
	header("location:compra.php");
} else {
	header("location:index.php");
}
