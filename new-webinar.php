<?php
//Profesor solicita nuevo webinar
require 'cfg.inc.php';
if (!isset($_SESSION['cod'])) {
    header('location:index.php');
} else {
    $error = "";
    if ($_POST) {
        $_SESSION['verid'] = "";
        $_SESSION['vertype'] = "";
        $_SESSION['vertitle'] = "";
        $logo = "logo.jpg";
        if ((!isset($_POST['activity'])) || (empty($_POST['activity']))) header('location:' . $_SERVER['HTTP_REFERER']);
        if ($_POST['activity'] == sha1('profesor')) {
            $profe = $_SESSION['pod'];
            $correo = base64_decode($_POST['wem']);
            if (!empty($_POST['event'])) {
                $evento = filter_var($_POST['event'], FILTER_UNSAFE_RAW);
                $slug = uri($evento);
            } else {
                $error .= "Ingresa nombre del webinar.\n";
            }
            if (!empty($_POST['special'])) {
                $especialidad = filter_var($_POST['special'], FILTER_UNSAFE_RAW);
                $cat = "SELECT categoria FROM " . odo_DATA_CATE . " WHERE id = '$especialidad' ";
                $csl = $mysqli->query($cat);
                $cate = $csl->fetch_assoc();
                $categoria = $cate['categoria'];
            } else {
                $error .= "Escoja especialidad.\n";
            }
            if (!empty($_POST['wdescription'])) $descripcion = filter_var($_POST['wdescription'], FILTER_UNSAFE_RAW);
            else $error .= "Ingresa descripción.\n";
            if (isset($_POST['wplatform'])) $plataforma = filter_var($_POST['wplatform'], FILTER_UNSAFE_RAW);
            else $error .= "Indique plataforma donde se realizará el webinar.\n";
            if (!empty($_POST['expo'])) $expositor = filter_var(mb_convert_case($_POST['expo'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
            else $error .= "Indique el nombre del expositor.\n";
            if (!empty($_POST['datew'])) {
                $f = DateTime::createFromFormat('d/m/Y', $_POST['datew']);
                $fecha = $f->format('Y-m-d');
            } else {
                $error .= "Ingrese fecha del evento.\n";
            }
            if (!empty($_POST['time'])) $hora = filter_var((preg_replace("([^0-9:])", "", $_POST['time'])), FILTER_UNSAFE_RAW);
            else $error .= "Ingrese hora del evento.\n";
            if (empty($error)) {
                $qry = "INSERT INTO " . odo_DATA_WEBI . " (webinar, slug, categoriaid, descripcion, profesorid, ponente, fecha, plataforma, imagen, url, horaini, solicitud, publicado, estado)
                VALUES ('$evento', '$slug', '$especialidad', '$descripcion', '$profe', '$expositor', '$fecha', '$plataforma', '$logo', NULL, '$hora', '$hoy', 'N', 'P')";
                $rsl = $mysqli->query($qry);
                /*ENVIA EMAIL*/
                $body = eemail(
                    ['Has solicitado la convocatoria para un nuevo Webinar', 'Con los siguientes datos:'], //Texto largo
                    ['EVENTO:', 'DESCRIPCIÓN:', 'ESPECIALIDAD:', 'PONENTE:', 'FECHA:', 'HORA:', 'PLATAFORMA:'], //Campos
                    [$evento, $descripcion, $categoria, $expositor, $fecha, $hora, $plataforma], //Valores
                    ['Revisaremos tu solicitud y nos comunicaremos contigo a la brevedad posible.'] //Pie
                );
                /* MENSAJE PARA EL USUARIO */
                $_SESSION['verid'] = "Solicitud enviada. Revisaremos la información y nos pondremos en contacto a la brevedad posible. Gracias!";
                $_SESSION['vertype'] = "success";
                $_SESSION['vertitle'] = "Aviso";
                $titulo = odo_TITL . ": Se ha presentado información para un nuevo webinar";
                @mail($correo, $titulo, $body, $firm);
            } else {
                $_SESSION['verid'] = $error;
                $_SESSION['vertype'] = "error";
                $_SESSION['vertitle'] = "Alerta";
            }
        }
    }
    header('location:' . $_SERVER['HTTP_REFERER']);
}
