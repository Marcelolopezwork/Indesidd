<?php
//Profesor sube material para clase
require 'cfg.inc.php';
if (!isset($_SESSION['cod'])) {
    header('location:index.php');
} else {
    if ($_POST) {
        $error = "";
        $_SESSION['verid'] = "";
        $_SESSION['vertype'] = "";
        $_SESSION['vertitle'] = "";
        $pid = base64_decode($_POST['prfs']);
        $vid = base64_decode($_POST['linu']);
        $curso = base64_decode($_POST['cors']);
        $logo = "img/cursos/logo.jpg";
        $ruta = "img/material/";
        if (!file_exists($ruta)) mkdir($ruta, 0755, true);
        else chmod($ruta, 0755);
        $tipoarchivo = array(
            ".zip",
            "application/zip",
            "application/x-zip",
            "application/octet-stream",
            "application/x-zip-compressed"
        );
        $extension = array("zip", "7zip");
        if ((!isset($_POST['activity'])) || (empty($_POST['activity']))) header('location:' . $_SERVER['HTTP_REFERER']);
        if ($_POST['activity'] == sha1('profesor')) {
            if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
                $varname = $_FILES['archivo']['name'];
                $vartemp = $_FILES['archivo']['tmp_name'];
                $vartype = $_FILES['archivo']['type'];
                if (in_array($vartype, $tipoarchivo) && $varname != "") {
                    $arrname = explode(".", $varname);
                    $e = strtolower(end($arrname));
                    if (in_array($e, $extension)) {
                        $varname = "mat-" . $vid . "." . $e;
                        $archivo = $ruta . $varname;
                        if (copy($vartemp, $archivo)) {
                            $try = "UPDATE " . odo_DATA_CLAS . " SET archivos = '$varname' WHERE id = '$vid' AND estado = 'A' ";
                            $tsl = $mysqli->query($try);
                            $qry = "SELECT * FROM " . odo_DATA_PROF . " WHERE id = '$pid'";
                            $rsl = $mysqli->query($qry);
                            $prf = $rsl->fetch_assoc();
                            $correo = $prf['correo'];
                            $profesor = $prf['nombres'] . " " . $prf['apellidos'];
                            $body = eemail(
                                ['Muchas gracias por actualizar el material del curso', ''], //Texto largo
                                ['PROFESOR:', 'CURSO', 'FECHA:'], //Campos
                                [$profesor, $curso, $hoydia], //Valores
                                ['Hemos recibido el material para la clase. Gracias.'] //Pie
                            );
                            $titulo = odo_TITL . ": Se ha subido material nuevo al curso";
                            @mail($correo, $titulo, $body, $firm);
                            $_SESSION['verid'] = "Material actualizado para esta clase.";
                            $_SESSION['vertype'] = "info";
                            $_SESSION['vertitle'] = "Aviso";
                        } else {
                            $_SESSION['verid'] = "No se pudo subir el material elegido.";
                            $_SESSION['vertype'] = "error";
                            $_SESSION['vertitle'] = "Alerta";
                        }
                    }
                }
            }
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        header('location:index.php');
    }
}
