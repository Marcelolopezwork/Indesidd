<?php
//Cambiar contraseña
//Tipo: P = Profesor; U = Alumno; R = Referido;
//Estado: A = Activo; B = Baneado; P = Pendiente; X = Eliminado
require 'cfg.inc.php';
if ($_POST) {
	$_SESSION['verid'] = "";
	$_SESSION['vertype'] = "";
	$_SESSION['vertitle'] = "";
	$clave = filter_var($_POST['npass'], FILTER_UNSAFE_RAW);
	$pattern = sha1($clave);
	$quien = base64_decode($_POST['who']);
	$hash = "000000000000000000x0";
	if ($_POST['activity'] == sha1('alumno')) {
		$qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE id = '$quien' AND tipo = 'U' AND estado = 'A' ORDER BY id";
		$tpo = "ingreso.php";
	} else if ($_POST['activity'] == sha1('profesor')) {
		$qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE id = '$quien' AND tipo = 'P' AND estado = 'A' ORDER BY id";
		$tpo = "ingreso-pro.php";
	} else {
		header('location:index.php');
	}
	$rsl = $mysqli->query($qry);
	$num = $rsl->num_rows;
	if ($num == 0) {
		$_SESSION['verid'] = "Usuario no existe";
		$_SESSION['vertype'] = "error";
		$_SESSION['vertitle'] = "Alerta";
		header('location:' . $_SERVER['HTTP_REFERER']);
	}
	if ($num == 1) {
		$kod = $rsl->fetch_assoc();
		$correo = $kod['correo'];
		$nombre = $kod['nombres'];
		$apellido = $kod['apellidos'];
		$pais = $kod['pais'];
		$telefono = $kod['telefono'];
		//Resetea contraseña de profesor
		if ($kod['tipo'] == 'P') {
			$ury = "UPDATE " . odo_DATA_USUA . " SET clave = '$pattern', hash = '$hash' WHERE id = '$quien' ";
			$usl = $mysqli->query($ury);
			$pry = "UPDATE " . odo_DATA_PROF . " SET clave = '$clave ', pattern = '$pattern ' WHERE (nombres = '$nombre' AND apellidos = '$apellido' AND pais = '$pais' AND correo = '$correo ' AND telefono = '$telefono' AND estado = 'A') ";
			$psl = $mysqli->query($pry);
			//Resetea contraseña de alumno
		} else {
			$ary = "UPDATE " . odo_DATA_USUA . " SET clave = '$pattern', hash = '$hash' WHERE id = '$quien' ";
			$asl = $mysqli->query($ary);
		}
		if ($_POST['olv'] > 0) {
			$olv = $_POST['olv'];
			$cry = "UPDATE " . odo_DATA_CLAV . " SET verificado = '1', estado = 'V' WHERE (id = '$olv') ";
			$csl = $mysqli->query($cry);
		}
		$_SESSION['verid'] = "Su contraseña ha sido restablecida con éxito. Ingrese con sus nuevos datos.";
		$_SESSION['vertype'] = "info";
		$_SESSION['vertitle'] = "Aviso";
		header('location:' . $tpo);
	}
} else {
	header('location:index.php');
}
