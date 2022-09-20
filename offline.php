<?php
//Profesor solicita darse de baja
// Tipo de Profesor: P = profesor, R = referido, Q = Solicitó su baja, X = Despedido
include 'cfg.inc.php';
if (!isset($_SESSION['cod'])) {
	header('location:index.php');
} else {
	if ($_POST) {
		$_SESSION['verid'] = "";
		$_SESSION['vertype'] = "";
		$_SESSION['vertitle'] = "";
		if ((!isset($_POST['activity'])) || (empty($_POST['activity']))) header('location:' . $_SERVER['HTTP_REFERER']);
		if ($_POST['activity'] == sha1('darsedebaja')) {
			$c = sha1(micro());
			$d = strtoupper($_POST['darsedebaja']);
			$u = $_SESSION['cod'];
			$z = $_SESSION['pod'];
			if ($d == 'INDESID') {
				if (!empty($_POST['actua'])) $a = filter_var($_POST['actua'], FILTER_UNSAFE_RAW);
				else $error .= "No ha indicado su contraseña actual";
				if (!empty($_POST['motivo'])) $m = filter_var($_POST['motivo'], FILTER_UNSAFE_RAW);
				else $error .= "No ha indicado el motivo de desaprobación";
				$qry = "SELECT * FROM " . odo_DATA_PROF . " WHERE id = '$z' ";
				$rsl = $mysqli->query($qry);
				$qti = $rsl->fetch_assoc();
				if ($qti['tipo'] == 'R') {
					$qry = "UPDATE " . odo_DATA_REFE . " SET estado = 'X' WHERE referidoid = '$z' ";
					$rsl = $mysqli->query($qry);
				}
				$qry = "UPDATE " . odo_DATA_PROF . " SET correo = sha1(correo), clave = '$c', estado = 'X', pattern = '$c', rechazado = '$m', slug = 'x-x-x', tipo = 'Q' WHERE id = '$z' ";
				$rsl = $mysqli->query($qry);
				$qry = "UPDATE " . odo_DATA_USUA . " SET correo = sha1(correo), clave = '$c', estado = 'X', hash = '000000000000000000x1', tipo = 'Q', verificado = '9' WHERE id = '$u' ";
				$rsl = $mysqli->query($qry);
				$qry = "UPDATE " . odo_DATA_CURS . " SET principal = 'N', venta = 'N' WHERE profesorid = '$z' ";
				$rsl = $mysqli->query($qry);
				$qry = "UPDATE " . odo_DATA_TAGS . " SET estado = 'X' WHERE profesorid = '$z' ";
				$rsl = $mysqli->query($qry);
				$_SESSION['verid'] = "Lamentamos tu decisión. Buena suerte!";
				$_SESSION['vertype'] = "success";
				$_SESSION['vertitle'] = "Aviso";
			}
		}
	}
	unset($carro);
	unset($_SESSION['cod']);
	unset($_SESSION['carro']);
	unset($_SESSION['pod']);
	unset($_SESSION['tip']);
	unset($_SESSION['nom']);
	unset($_SESSION['lar']);
	header('location:profesores.php');
}
