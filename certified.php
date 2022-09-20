<?php
//Genera certificado del curso para el alumno
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
	if ($_GET) {
		$c = base64_decode($_GET['rid']);
		$k = base64_decode($_GET['rus']);
		$qry = "SELECT * FROM " . odo_DATA_ALUM . " WHERE id = '$c' AND estado = 'A' ";
		$rsl = $mysqli->query($qry);
		if ($rsl->num_rows == 1) {
			$q = $rsl->fetch_assoc();
			header("Content-type: image/png");
			$curso = $k;
			$cat = $q['categoriaid'];
			$cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE id = '$cat' ";
			$csl = $mysqli->query($cry);
			$cua = $csl->fetch_assoc();
			$indesid = $cua['categoria'];
			$nombre = $_SESSION['lar'];
			$date = date_create($q['certificado']);
			$fecha = date_format($date, 'd M Y');
			$rutaFuente = __DIR__ . "/css/fonts/FuturaBT-Bold.ttf";
			$certi = acentos(strtolower($k . '-' . $nombre));
			$slug = $certi . ".png";
			$nombreImagen = "img/certificado.png";
			$imagen = imagecreatefrompng($nombreImagen);
			$angulo = 0;
			$color = imagecolorallocate($imagen, 96, 96, 96);
			//Nombre del Alumno
			$lineas = explode('|', wordwrap($nombre, 48, '|'));
			$y = 555;
			foreach ($lineas as $linea) {
				$linea = trim($linea);
				$marco = ImageTTFBBox(30, 0, $rutaFuente, $linea);
				$x = (1340 - ($marco[2] - $marco[0])) / 2;
				Imagettftext($imagen, 30, 0, $x, $y, $color, $rutaFuente, $linea);
			}
			//Curso
			$lineas = explode('|', wordwrap($curso, 64, '|'));
			$y = 620;
			foreach ($lineas as $linea) {
				$linea = trim($linea);
				$marco = ImageTTFBBox(18, 0, $rutaFuente, $linea);
				$x = (1340 - ($marco[2] - $marco[0])) / 2;
				Imagettftext($imagen, 18, 0, $x, $y, $color, $rutaFuente, $linea);
			}
			//Fecha
			$tamanio = 14;
			$x = 295;
			$y = 780;
			imagettftext($imagen, $tamanio, $angulo, $x, $y, $color, $rutaFuente, $fecha);
			//Categoria
			$tamanio4 = 14;
			$x = 896;
			$y = 780;
			imagettftext($imagen, $tamanio4, $angulo, $x, $y, $color, $rutaFuente, $indesid);
			header("Content-disposition: attachment; filename=$slug");
			$qry = "UPDATE " . odo_DATA_ALUM . " SET nota = nota + 1 WHERE id = '" . $c . "' ";
			$rsl = $mysqli->query($qry);
			imagepng($imagen);
			imagedestroy($imagen);
		}
	}
	header('location:' . $_SERVER['HTTP_REFERER']);
} else {
	header('location:index.php');
}
