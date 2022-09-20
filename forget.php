<?php
//Resetear contraseña para generar una nueva
//Tipo: P = Profesor; U = Alumno; R = Referido;
//Estado: A = Activo; B = Baneado; P = Pendiente; X = Eliminado
require 'cfg.inc.php';

if ($_POST) {
	$error = "";
	$_SESSION['verid'] = "";
	$_SESSION['vertype'] = "";
	$_SESSION['vertitle'] = "";

	if (!empty($_POST['user'])) $correo = filter_var(mb_strtolower($_POST['user'], 'utf-8'), FILTER_SANITIZE_EMAIL);
	else $error .= "No ha ingresado su correo electrónico";
	if (empty($_POST['activity'])) {
		$num = 0;
		$error .= "No se ha indicado el tipo de usuario";
	} else {
		if (!empty($_POST['vip'])) $vip = filter_var($_POST['vip'], FILTER_UNSAFE_RAW);
		if (!empty($_POST['vci'])) $vci = filter_var($_POST['vci'], FILTER_UNSAFE_RAW);
		if (!empty($_POST['vco'])) $vco = filter_var($_POST['vco'], FILTER_UNSAFE_RAW);
		if ((!empty($vci)) && (!empty($vco))) $desde = "Desde " . $vci . ", " . $vco . ". dirección IP: " . $vip;
		else $desde = "Desde IP: " . $vip;

		if ($_POST['activity'] == sha1('alumno')) $qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = '$correo' AND tipo = 'U' AND verificado = '1' AND estado = 'A') ORDER BY id";
		elseif ($_POST['activity'] == sha1('profesor')) $qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = '$correo' AND tipo = 'P' AND verificado = '1' AND estado = 'A') ORDER BY id";
		else $qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = 'xxxx' AND tipo = 'Z') ORDER BY id";
		$rsl = $mysqli->query($qry);

		$num = $rsl->num_rows;
		$kod = $rsl->fetch_assoc();
	}
	if (empty($error)) {
		if ($num == 0) {
			$_SESSION['verid'] = "Usuario no existe. Revise la dirección de correo electrónico ingresada.";
			$_SESSION['vertype'] = "error";
			$_SESSION['vertitle'] = "Alerta";
			header('location:' . $_SERVER['HTTP_REFERER']);
		}
		if ($num == 1) {
			$hash = micro();
			$hash64 = base64_encode($hash);
			$correo64 = base64_encode($correo);
			$clave = $kod['clave'];
			$nombre = $kod['nombres'];
			$apellido = $kod['apellidos'];
			$kodigo = $kod['id'];
			$largo = $nombre . ' ' . $apellido;
			$_SESSION['top'] = $kodigo;
			$_SESSION['tip'] = $kod['tipo'];
			$_SESSION['nom'] = $nombre;
			if ($kod['tipo'] == 'U') $tipo = 'b';
			if ($kod['tipo'] == 'P') $tipo = 'q';

			$dbh = new PDO('mysql:' . odo_HOST . '=localhost;dbname=' . odo_BASE, odo_USER, odo_PASS);
			$tmt = $dbh->prepare("INSERT INTO " . odo_DATA_CLAV . " (correo, clave, usuarioid, ip, verificado, hash, fecha, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			try {
				$dbh->beginTransaction();
				$tmt->execute(array($correo, $clave, $kodigo, $vip, '0', $hash, $hoy, 'P'));
				$olv = $dbh->lastInsertId();
				$dbh->commit();
				/*ENVIA EMAIL*/
				$body = eemail(
					['Usted ha solicitado cambiar su contraseña de INDESID', 'Si no ha solicitado ningún cambio, haga caso omiso a este correo electrónico.'], //Texto largo
					['NOMBRES:', 'EMAIL:', 'SOLICITUD ENVIADA:', 'FECHA:'], //Campos
					[$largo, preEmail($correo), $desde, $hoydia], //Valores
					['Para generar una nueva contraseña, <a href="' . $rutaolv . '?t=' . $tipo . '&e=' . $correo64 . '&h=' . $hash64 . '&o=' . $olv . '" target="_blank" style="color:#ccc;text-decoration:none;">HAGA CLICK AQUÍ</a><br>Si no ha solicitado el cambio de contraseña, sólo omita éste correo electrónico.'] //Pie
				);
				/*REGISTRA LA SOLICITUD EN EL HASH. SI NO HA SOLICITADO EL HASH IGUAL SE ACTUALIZA*/
				$ury = "UPDATE " . odo_DATA_USUA . " SET hash = '$hash' WHERE (id = '$kodigo') ";
				$usl = $mysqli->query($ury);
				$titulo = odo_TITL . " - Recuperar contraseña";
				@mail($correo, $titulo, $body, $firm);
				header('location:forgotten.php');
			} catch (PDOException $er) {
				$dbh->rollback();
				$_SESSION['verid'] = "Ha ocurrido un error" . $er->getMessage() . "<br>";
				$_SESSION['vertype'] = "error";
				$_SESSION['vertitle'] = "Alerta";
			}
		}
	} else {
		header('location:' . $_SERVER['HTTP_REFERER']);
	}
} else {
	header('location:index.php');
}
