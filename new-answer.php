<?php
//RESPUESTA A COMENTARIO
include 'cfg.inc.php';
if (!isset($_SESSION['pod'])) {
    header("location:index.php");
} else {
    if (($_SESSION['tip'] == 'P') && ($_POST)) {
        $error = "";
        if (!empty($_POST['tid'])) $t = base64_decode($_POST['tid']);
        else $error .= "No se ha indicado que tipo de respuesta es\n";
        if (!empty($_POST['zid'])) $z = base64_decode($_POST['zid']);
        else $error .= "No se ha indicado a quien responder\n";
        if ($t == "indesid") {
            if (!empty($_POST['respuesta'])) $respuesta = filter_var($_POST['respuesta'], FILTER_UNSAFE_RAW);
            else $error .= "No se ha escrito respuesta\n";
            if (empty($error)) {
                $qry = "UPDATE ".odo_DATA_NOTI." SET fecharespuesta = '$hoy', respuesta = '$respuesta', estado = 'A' WHERE id = '$z' ";
                $rsl = $mysqli->query($qry);
                $_SESSION['vertype'] = "success";
                $_SESSION['verid'] = "Notificación respondida";
                $_SESSION['vertitle'] = "Aviso";
            } else {
                $_SESSION['vertype'] = "error";
                $_SESSION['verid'] = $error;
                $_SESSION['vertitle'] = "Aviso";
            }
        } else {
            if (!empty($_POST['respuesta'])) $respuesta = filter_var($_POST['respuesta'], FILTER_UNSAFE_RAW);
            else $respuesta = "";
            if (!empty($_POST['borrar'])) $borrar = "S";
            else $borrar = "N";
            if ($borrar == 'S') {
                $qry = "UPDATE ".odo_DATA_COME." SET revisado = '$hoy', respuesta = 'Ofensivo', estado = 'X' WHERE id = '".$z."' ";
                $_SESSION['vertype'] = "error";
                $_SESSION['verid'] = "Comentario eliminado";
            }
            if (!empty($respuesta) && ($borrar == 'N'))  {
                $qry = "UPDATE ".odo_DATA_COME." SET revisado = '$hoy', respuesta = '".$respuesta."', estado = 'A' WHERE id = '".$z."' ";
                $_SESSION['vertype'] = "success";
                $_SESSION['verid'] = "Comentario respondido";
            }
            if (empty($respuesta) && ($borrar == 'N')) {
                $qry = "UPDATE ".odo_DATA_COME." SET revisado = '$hoy', estado = 'A' WHERE id = '".$z."' ";
                $_SESSION['vertype'] = "success";
                $_SESSION['verid'] = "Comentario respondido";
            }
            $rsl = $mysqli->query($qry);
            $_SESSION['vertitle'] = "Aviso";
        }
    }
    header('location:perfil-pro.php');
}
