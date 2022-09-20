<?php
//Ingresa al sistema
require 'cfg.inc.php';
if ($_POST) {
	$_SESSION['verid'] = "";
	$_SESSION['vertype'] = "";
	$_SESSION['vertitle'] = "";
	$error = "";
	if (!empty($_POST['user'])) $correo = filter_var(mb_strtolower($_POST['user'], 'utf-8'), FILTER_SANITIZE_EMAIL);
	else $error .= "No ha ingresado usuario";
	if (!empty($_POST['pass'])) $clave = sha1($_POST['pass']);
	else $error .= "No ha ingresado contraseña";
	if (empty($error)) {
		//Alumno
		if ($_POST['activity'] == sha1('alumno')) {
			$bry = "SELECT * FROM " . odo_DATA_USUA . " WHERE correo = '$correo' AND clave = '$clave' AND tipo = 'U' AND estado = 'B' ORDER BY id";
			$bsl = $mysqli->query($bry);
			$bum = $bsl->num_rows;
			if ($bum == 1) {
				$_SESSION['verid'] = "Su usuario ha sido baneado";
			} elseif ($bum == 0) {
				$qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE correo = '$correo' AND clave = '$clave' AND tipo = 'U' AND verificado = '1' AND estado = 'A' ORDER BY id";
				$rsl = $mysqli->query($qry);
				$num = $rsl->num_rows;
				if ($num == 1) {
					$kod = $rsl->fetch_assoc();
					$id = $kod['id'];
					//ALUMNOS: Quita cupón de descuento en caso sólo se haya escogido pero no aplicado a algún curso
					$qry = "UPDATE " . odo_DATA_DESC . " SET utilizado = NULL WHERE utilizado = 'T' AND estado = 'A' AND usuarioid = '$id' ";
					$rsl = $mysqli->query($qry);
					//ALUMNOS: Actualiza último acceso
					$qry = "UPDATE " . odo_DATA_USUA . " SET ultimoacceso = '$ult' WHERE id = '$id' ";
					$rsl = $mysqli->query($qry);
					$_SESSION['cod'] = $id;
					$_SESSION['tip'] = $kod['tipo'];
					$_SESSION['nom'] = $kod['nombres'];
					$_SESSION['lar'] = $kod['nombres'] . " " . $kod['apellidos'];
					$_SESSION['xta'] = $kod['estado'];
					if (!empty($_SESSION['carro'])) header("location:compra.php");
					else header('location:cursos.php');
				} else {
					$_SESSION['verid'] = "Su usuario o contraseña no son correctos";
				}
			} else {
				$_SESSION['verid'] = "Su usuario o contraseña no son correctos";
			}
			$_SESSION['vertype'] = "error";
			$_SESSION['vertitle'] = "Alerta";
		}
		//Profesor
		if ($_POST['activity'] == sha1('profesor')) {
			$qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE correo = '$correo' AND clave = '$clave' AND tipo = 'P' AND (estado = 'A' OR estado = 'P') ORDER BY id";
			$rsl = $mysqli->query($qry);
			$num = $rsl->num_rows;
			$kod = $rsl->fetch_assoc();
			$_SESSION['verid'] = "Su usuario o contraseña no son correctos";
		}
		if ($num == 0) {
			$_SESSION['vertype'] = "error";
			$_SESSION['vertitle'] = "Alerta";
			header('location:' . $_SERVER['HTTP_REFERER']);
		}
		if ($num == 1) {
			//Revisa si es PROFESOR autorizado
			if ($kod['tipo'] == 'P') {
				$pry = "SELECT * FROM " . odo_DATA_PROF . " WHERE correo = '" . $correo . "' AND pattern = '" . $clave . "' AND (estado = 'A' OR estado = 'P') ORDER BY id";
				$psl = $mysqli->query($pry);
				$pod = $psl->fetch_assoc();
				if ($pod['estado'] == 'P') {
					$_SESSION['verid'] = "Hola! ya recibimos tu solicitud y la estamos evaluando. Nos comunicaremos contigo a la brevedad posible. Gracias!";
					$_SESSION['vertype'] = "info";
					$_SESSION['vertitle'] = $pod['nombres'];
					header('location:profesores.php');
				} elseif ($pod['estado'] == 'A') {
					$qry = "UPDATE " . odo_DATA_USUA . " SET ultimoacceso = '" . $ult . "' WHERE id = '" . $kod['id'] . "' ";
					$rsl = $mysqli->query($qry);
					$_SESSION['pod'] = $pod['id']; //id tabla profesor
					$_SESSION['cod'] = $kod['id']; //id tabla usuario
					$_SESSION['tip'] = $kod['tipo'];
					$_SESSION['nom'] = $kod['nombres'];
					$_SESSION['lar'] = $kod['nombres'] . " " . $kod['apellidos'];
					$_SESSION['xta'] = $kod['estado'];
					header('location:perfil-pro.php');
				} else {
					header('location:ingreso-pro.php');
				}
			} else {
				//ALUMNOS: Actualiza último acceso
				$qry = "UPDATE " . odo_DATA_DESC . " SET utilizado = NULL WHERE utilizado = 'T' AND estado = 'A' AND usuarioid = '" . $kod['id'] . "' ";
				$rsl = $mysqli->query($qry);
				$qry = "UPDATE " . odo_DATA_USUA . " SET ultimoacceso = '" . $ult . "' WHERE id = '" . $kod['id'] . "' ";
				$rsl = $mysqli->query($qry);
				$_SESSION['cod'] = $kod['id'];
				$_SESSION['tip'] = $kod['tipo'];
				$_SESSION['nom'] = $kod['nombres'];
				$_SESSION['lar'] = $kod['nombres'] . " " . $kod['apellidos'];
				$_SESSION['xta'] = $kod['estado'];
				if (!empty($_SESSION['carro'])) header("location:compra.php");
				else header('location:cursos.php');
			}
		}
	}
} else {
	header('location:index.php');
}
