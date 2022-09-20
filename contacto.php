<?php
//Formulario de contacto
require 'cfg.inc.php';
if ($_POST) {
    $error = "";
    $_SESSION['verid'] = "";
    $_SESSION['vertype'] = "";
    $_SESSION['vertitle'] = "";
    if (!empty($_POST['cNombre'])) $nombre = filter_var(mb_convert_case($_POST['cNombre'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
    else $error .= "Ingresa nombre";
    if (!empty($_POST['cEmail'])) $correo = filter_var(mb_strtolower($_POST['cEmail'], 'utf-8'), FILTER_SANITIZE_EMAIL);
    else $error .= "Ingresa correo electrónico";
    if (!empty($_POST['cFono'])) $telefono = filter_var($_POST['cFono'], FILTER_SANITIZE_NUMBER_INT);
    else $error .= "Ingresa teléfono";
    if (!empty($_POST['cPais'])) $pais = filter_var(mb_strtoupper($_POST['cPais'], 'utf-8'), FILTER_UNSAFE_RAW);
    else $error .= "Escoja país";
    if (!empty($_POST['cMensaje'])) $mensaje = filter_var(mb_strtoupper($_POST['cMensaje'], 'utf-8'), FILTER_UNSAFE_RAW);
    else $error .= "Indique mensaje";
    if (empty($error)) {
        /*ENVIA EMAIL*/
        $body = eemail(
            ['Muchas gracias por comunicarse con la plataforma de INDESID', 'Contacto web'], //Texto largo
            ['NOMBRES:', 'EMAIL:', 'TELÉFONO:', 'MENSAJE:', 'PAÍS:', 'FECHA:'], //Campos
            [$nombre, preEmail($correo), $telefono, $mensaje, $pais, $hoydia], //Valores
            [''] //Pie
        );
        $titulo = odo_TITL . ": Contacto web";
        $qry = "INSERT INTO " . odo_DATA_CONT . " (nombre, correo, telefono, pais, mensaje, fecha, respuesta, estado) VALUES ('$nombre', '$correo', '$telefono', '$pais', '$mensaje', '$hoy', NULL, 'P')";
        $rsl = $mysqli->query($qry);
        @mail($correo, $titulo, $body, $firm);
        $_SESSION['verid'] = "Hemos recibido su comunicación. Muchas gracias por contactarnos.";
        $_SESSION['vertype'] = "success";
        $_SESSION['vertitle'] = "Aviso";
    } else {
        $_SESSION['verid'] = "Llene todos los datos por favor";
        $_SESSION['vertype'] = "error";
        $_SESSION['vertitle'] = "Alerta";
    }
    header('location:' . $_SERVER['HTTP_REFERER']);
} else {
    header('location:index.php');
}
