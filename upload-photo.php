<?php
require 'cfg.inc.php';
if (!isset($_SESSION['cod'])) header('location:index.php');
ini_set("memory_limit", "99M");
ini_set('post_max_size', '4M');
ini_set('max_execution_time', 600);
function createDir($path) {
    if (!file_exists($path)) {
        $old_mask = umask(0);
        mkdir($path, 0755, true);
        umask($old_mask);
    } else {
        chmod($path, 0755);
    }
}
function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = '') {
    $source_image = false;
    if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
        $source_image = imagecreatefromjpeg($path1);
    } elseif (preg_match("/png|PNG/", $file_type)) {
        if (!$source_image = @imagecreatefrompng($path1)) {
            $source_image = imagecreatefromjpeg($path1);
        }
    }
    if ($source_image == false) {
        $source_image = imagecreatefromjpeg($path1);
    }
    $orig_w = imageSX($source_image);
    $orig_h = imageSY($source_image);
    if ($orig_w < $new_w && $orig_h < $new_h) {
        $desired_width = $orig_w;
        $desired_height = $orig_h;
    } else {
        $scale = min($new_w / $orig_w, $new_h / $orig_h);
        $desired_width = ceil($scale * $orig_w);
        $desired_height = ceil($scale * $orig_h);
    }
    if ($squareSize != '') {
        $desired_width = $desired_height = $squareSize;
    }
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    $kek = imagecolorallocate($virtual_image, 255, 255, 255);
    imagefill($virtual_image, 0, 0, $kek);
    if ($squareSize == '') {
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
    } else {
        $wm = $orig_w / $squareSize;
        $hm = $orig_h / $squareSize;
        $h_height = $squareSize / 2;
        $w_height = $squareSize / 2;
        if ($orig_w > $orig_h) {
            $adjusted_width = $orig_w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
        } elseif (($orig_w <= $orig_h)) {
            $adjusted_height = $orig_h / $wm;
            $half_height = $adjusted_height / 2;
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
        } else {
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
        }
    }
    if (@imagejpeg($virtual_image, $path2, 80)) {
        imagedestroy($virtual_image);
        imagedestroy($source_image);
        return true;
    } else {
        return false;
    }
}
if ($_POST) {
    if ($_POST['activity'] == sha1('profesor')) {
        define('IMAGE_SMALL_DIR', 'img/profesores/');
        define('IMAGE_MEDIUM_DIR', 'img/profesores/md/');
        $doble = true;
    }
    if ($_POST['activity'] == sha1('alumno')) {
        define('IMAGE_SMALL_DIR', 'img/usuarios/');
        define('IMAGE_MEDIUM_DIR', 'img/usuarios/md/');
        $doble = false;
    }
    define('IMAGE_SMALL_SIZE', 250);
    define('IMAGE_MEDIUM_SIZE', 500);
    if (isset($_FILES['perfilfoto'])) {
        $output['status'] = false;
        set_time_limit(0);
        $allowedImageType = array(
            "image/jpeg",
            "image/jpg",
            "image/png",
            "image/x-png"
        );
        if ($_FILES['perfilfoto']["error"] > 0) {
            $output['error'] = "Error en imagen";
        } elseif (!in_array($_FILES['perfilfoto']["type"], $allowedImageType)) {
            $output['error'] = "Sólo puedes subir un archivo JPG o PNG";
        } elseif (round($_FILES['perfilfoto']["size"] / 1024) > 4096) {
            $output['error'] = "Archivo máximo de 4 MB";
        } else {
            createDir(IMAGE_SMALL_DIR);
            createDir(IMAGE_MEDIUM_DIR);
            $path[0]     = $_FILES['perfilfoto']['tmp_name'];
            $file        = pathinfo($_FILES['perfilfoto']['name']);
            $fileType    = $file["extension"];
            $fileNameNew = uri($_POST['quien']).".".$fileType; //Nombre del profesor
            $path[1]     = IMAGE_MEDIUM_DIR.$fileNameNew;
            $path[2]     = IMAGE_SMALL_DIR.$fileNameNew;
            if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE)) {
                if (createThumb($path[1], $path[2], $fileType, IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE)) {
                    $output['status']       = true;
                    $output['image_medium'] = $path[1];
                    $output['image_small']  = $path[2];
                    if ($doble) {
                        $try = "UPDATE ".odo_DATA_USUA." SET foto = '".$fileNameNew."' WHERE id = '".$_SESSION['cod']."' AND estado = 'A' ";
                        $tsl = $mysqli->query($try);
                        $try = "UPDATE ".odo_DATA_PROF." SET foto = '".$fileNameNew."' WHERE id = '".$_SESSION['pod']."' AND estado = 'A' ";
                        $tsl = $mysqli->query($try);
                    } else {
                        $try = "UPDATE ".odo_DATA_USUA." SET foto = '".$fileNameNew."' WHERE id = '".$_SESSION['cod']."' AND estado = 'A' ";
                        $tsl = $mysqli->query($try);
                    }
                }
            }
        }
    }
    header('location:'.$_SERVER['HTTP_REFERER']);
}