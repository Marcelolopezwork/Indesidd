<?php
//Cambiar contraseña desde el perfil
require 'cfg.inc.php';
if ($_POST) {
	if ($_POST['cookie'] == sha1('cambiarcontrasena')) {
		$error = "";
		if (!empty($_POST['old'])) $old = filter_var($_POST['old'], FILTER_UNSAFE_RAW);
		else $error .= "No ha ingresado la contraseña actual";
		if (!empty($_POST['new'])) $new = filter_var($_POST['new'], FILTER_UNSAFE_RAW);
		else $error .= "No ha ingresado la nueva contraseña";
		if (!empty($_POST['again'])) $again = filter_var($_POST['again'], FILTER_UNSAFE_RAW);
		else $error .= "No ha ingresado nuevamente la nueva contraseña";
		$actual = sha1($old);
		if ($new == $again) {
			$pattern = sha1($_POST['new']);
		} else {
			$error .= "Claves no coinciden";
			echo $error;
		}
		if ($_POST['activity'] == sha1('alumno')) $qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE id = '" . $_SESSION['cod'] . "' AND clave = '" . $actual . "' AND tipo = 'U' AND estado = 'A' ORDER BY id";
		if ($_POST['activity'] == sha1('profesor')) $qry = "SELECT * FROM " . odo_DATA_PROF . " WHERE id = '" . $_SESSION['pod'] . "' AND pattern = '" . $actual . "' AND (tipo = 'P' OR tipo = 'R') AND (estado = 'A' OR estado = 'P') ORDER BY id";
		$rsl = $mysqli->query($qry);
		$num = $rsl->num_rows;
		if ($num == 1) {
			if (empty($error)) {
				$kod = $rsl->fetch_assoc();
				if ($kod['tipo'] == 'U') {
					//Si es alumno
					$qry = "UPDATE " . odo_DATA_USUA . " SET clave = '$pattern' WHERE id = '" . $_SESSION['cod'] . "' ";
					$rsl = $mysqli->query($qry);
				} else {
					//Si es profesor
					$qry = "UPDATE " . odo_DATA_PROF . " SET pattern = '$pattern' WHERE id = '" . $_SESSION['pod'] . "' ";
					$rsl = $mysqli->query($qry);
					$qry = "UPDATE " . odo_DATA_USUA . " SET clave = '$pattern' WHERE id = '" . $_SESSION['cod'] . "' ";
					$rsl = $mysqli->query($qry);
				}
				$usl = true;
				$mensaje = "Contraseña cambiada con éxito";
			} else {
				$usl = false;
				$mensaje = "Los datos enviados no son correctos";
			}
		} else {
			$usl = false;
			$mensaje = "Contraseña actual no es correcta";
		}
	}
}
$jsonarray = array($usl, $mensaje);
$json = json_encode($jsonarray);
echo $json;
