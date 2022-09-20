<?php
//Comentarios sobre un curso
require 'cfg.inc.php';
$error = "";
if ($_POST) {
    $_SESSION['verid'] = "";
    $_SESSION['vertype'] = "";
    $_SESSION['vertitle'] = "";
    //Alumnos
    if ($_POST['activity'] == sha1('alumno')) {
        if (!empty($_POST['couti'])) $curso = filter_var(base64_decode($_POST['couti']), FILTER_UNSAFE_RAW);
        else $error .= "Indique nombre del curso";
        if (!empty($_POST['cuote'])) $numerocurso = filter_var(base64_decode($_POST['cuote']), FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Indique número del curso";
        if (!empty($_POST['stkes'])) $quien = filter_var(base64_decode($_POST['stkes']), FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Indique alumno";
        if (!empty($_POST['eachr'])) $amauta = filter_var(base64_decode($_POST['eachr']), FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Indique profesor";
        if (!empty($_POST['comentario'])) $comentario = filter_var($_POST['comentario'], FILTER_UNSAFE_RAW);
        else $error .= "Indique comentario";
        if (empty($error)) {
            $qry = "SELECT * FROM " . odo_DATA_PROF . " WHERE (id = '$amauta') ORDER BY correo";
            $rsl = $mysqli->query($qry);
            $ama = $rsl->fetch_assoc();
            $largo = $_SESSION['lar'];
            $correo = $ama['correo'];
            $profesor = $ama['nombres'] . " " . $ama['apellidos'];
            /*ENVIA EMAIL*/
            $body = eemail(
                ['Hay un comentario sobre el curso de INDESID', $curso], //Texto largo
                ['CURSO:', 'USUARIO:', 'PROFESOR:', 'COMENTARIO:', 'FECHA:'], //Campos
                [$curso, $largo, $profesor, $comentario, $hoydia], //Valores
                ['Gracias por sus comentarios'] //Pie

            );
            $ary = "INSERT INTO " . odo_DATA_COME . " (comentario, usuarioid, cursoid, profesorid, fecha, revisado, respuesta, estado) VALUES ('$comentario', '$quien', '$numerocurso', '$amauta', '$hoy', NULL, NULL, 'P')";
            $asl = $mysqli->query($ary);
            if ($asl) {
                $_SESSION['verid'] = "Hemos recibido tus comentarios. Muchas gracias!";
                $_SESSION['vertitle'] = "Gracias";
                $_SESSION['vertype'] = "success";
                $titulo = odo_TITL . ": Hay un nuevo comentario de un curso";
                @mail($correo, $titulo, $body, $firm);
            }
        } else {
            $_SESSION['verid'] = "Llene todos los datos por favor.";
            $_SESSION['vertitle'] = "Aviso";
            $_SESSION['vertype'] = "warning";
        }
        header('location:' . $_SERVER['HTTP_REFERER']);
    }
} else {
    header('location:' . $_SERVER['HTTP_REFERER']);
}
