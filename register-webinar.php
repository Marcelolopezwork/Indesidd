<?php
//Usuario se registra a webinar
require 'cfg.inc.php';
if ($_POST) {
    $error = "";
    $_SESSION['verid'] = "";
    $_SESSION['vertype'] = "";
    $_SESSION['vertitle'] = "";
    $webinar = base64_decode($_POST['wid']);
    $categor = base64_decode($_POST['wca']);
    if (!empty($_POST['nombre'])) $nombre = filter_var(mb_convert_case($_POST['nombre'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
    else $error .= "Ingresa nombre del usuario" . "<br>";
    if (!empty($_POST['email'])) $correo = filter_var(mb_strtolower($_POST['email'], 'utf-8'), FILTER_SANITIZE_EMAIL);
    else $error .= "Ingresa email" . "<br>";
    if (empty($error)) {
        $qry = "SELECT * FROM " . odo_DATA_REGW . " WHERE webinarid = '$webinar' AND email = '$correo' AND estado = 'A' ";
        $rsl = $mysqli->query($qry);
        $num = $rsl->num_rows;
        if ($num > 0) {
            $_SESSION['verid'] = "Ya se registró anteriormente en este webinar";
            $_SESSION['vertype'] = "info";
            $_SESSION['vertitle'] = "Aviso";
            header('location:' . $_SERVER['HTTP_REFERER']);
        } else {
            $qry = "SELECT * FROM " . odo_DATA_WEBI . " WHERE id = '$webinar' AND estado = 'A' ";
            $rsl = $mysqli->query($qry);
            $webi = $rsl->fetch_assoc();
            $evento = $webi['webinar'];
            $expositor = $webi['ponente'];
            $fecha = $webi['fecha'];
            $hora = $webi['horaini'];
            $plataforma = $webi['plataforma'];
            /*ENVIA EMAIL*/
            $body = eemail(
                ['Nuevo registro al webinar ' . $evento, $nombre . ' se ha registrado en nuestro próximo evento'], //Texto largo
                ['EVENTO:', 'ESPECIALIDAD:', 'PONENTE:', 'FECHA:', 'HORA:', 'PLATAFORMA:'], //Campos
                [$evento, $categor, $expositor, $fecha, $hora, $plataforma], //Valores
                ['Muchas gracias por su interés en nuestro webinar.'] //Pie
            );
            $qry = "INSERT INTO " . odo_DATA_REGW . " (webinarid, webinar, nombre, email, fecha, estado)
            VALUES ('$webinar', '$evento', '$nombre', '$correo', '$hoy', 'A')";
            $rsl = $mysqli->query($qry);
            $titulo = odo_TITL . ": Se ha registrado para el webinar";
            @mail($correo, $titulo, $body, $firm);
            /* MENSAJE PARA EL USUARIO */
            $_SESSION['verid'] = "Se ha registrado correctamente en el webinar";
            $_SESSION['vertype'] = "success";
            $_SESSION['vertitle'] = "Aviso";
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $_SESSION['verid'] = $error;
        $_SESSION['vertype'] = "error";
        $_SESSION['vertitle'] = "Alerta";
    }
} else {
    header('location:webinars.php');
}
