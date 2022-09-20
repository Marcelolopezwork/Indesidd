<?php
//Profesor solicita nuevo referido
require 'cfg.inc.php';
if (!isset($_SESSION['cod'])) {
    header('location:index.php');
} else {
    if ($_POST) {
        $error = "";
        $_SESSION['verid'] = "";
        $_SESSION['vertype'] = "";
        $_SESSION['vertitle'] = "";
        $hash = md5(aleatoria(24));
        if ((!isset($_POST['activity'])) || (empty($_POST['activity']))) header('location:' . $_SERVER['HTTP_REFERER']);
        if ($_POST['activity'] == sha1('referido')) {
            $profe = $_SESSION['pod'];
            $quien = base64_decode($_POST['qask']);
            $correo = base64_decode($_POST['rem']);
            if (!empty($_POST['email'])) $email = filter_var(mb_convert_case($_POST['email'], MB_CASE_LOWER, 'utf-8'), FILTER_SANITIZE_EMAIL);
            else $error .= "Indique el email del referido" . "<br>";
            $qry = "SELECT correo FROM " . odo_DATA_PROF . " WHERE (correo = '" . $email . "' AND (estado = 'A' OR estado = 'P' OR estado = 'R')) ORDER BY correo";
            $rsl = $mysqli->query($qry);
            $num = $rsl->num_rows;
            if ($num > 0) {
                header('location:' . $_SERVER['HTTP_REFERER']);
            } else {
                if (!empty($_POST['firstname'])) $nombre = filter_var(mb_convert_case($_POST['firstname'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
                else $error .= "Ingresa nombre del referido" . "<br>";
                if (!empty($_POST['lastname'])) $apellido = filter_var(mb_convert_case($_POST['lastname'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
                else $error .= "Ingresa apellido del referido" . "<br>";
                $todojunto = $nombre . " " . $apellido;
                $slug = uri($todojunto);
                if (!empty($_POST['telephone'])) $telefono = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
                else $error .= "Indique número de teléfono" . "<br>";
                if (!empty($_POST['gender'])) {
                    $genero = filter_var($_POST['gender'], FILTER_UNSAFE_RAW);
                    if ($genero == 'M') $gender = "Masculino";
                    else $gender = "Femenino";
                } else {
                    $error .= "Elija género" . "<br>";
                }
                if (!empty($_POST['age'])) $edad = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
                else $error .= "Indique edad del referido" . "<br>";
                if (!empty($_POST['specialty'])) $especial = filter_var($_POST['specialty'], FILTER_UNSAFE_RAW);
                else $error .= "Elija especialidad" . "<br>";
                if (!empty($_POST['studies'])) $nivel = filter_var(mb_convert_case($_POST['studies'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
                else $error .= "Elija especialidad" . "<br>";
                if (!empty($_POST['country'])) $pais = filter_var($_POST['country'], FILTER_UNSAFE_RAW);
                else $error .= "Elija país" . "<br>";
                if (!empty($_POST['aboutit'])) $acercade = filter_var($_POST['aboutit'], FILTER_UNSAFE_RAW);
                else $error .= "Cuéntenos su opinión del referido" . "<br>";
                $clave = aleatoria(10);
                $clave = "I*" . $clave . "2d";
                $pattern = sha1($clave);
                $foto = "nofoto.svg";
                if (empty($error)) { //clave es id de usuario
                    $qry = "INSERT INTO " . odo_DATA_PROF . " (nombres, apellidos, slug, documento, correo, clave, telefono, genero, edad, sobremi, universidad, especialidad, nivelestudio, foto, pais, tipo, fecha, pattern, rechazado, estado) VALUES ('$nombre', '$apellido', '$slug', NULL, '$email', '$profe', '$telefono', '$genero', '$edad', '$acercade', NULL, '$especial', '$nivel', '$foto', '$pais', 'R', '$hoy', '$pattern', NULL, 'P')";
                    $rsl = $mysqli->query($qry);
                    if ($rsl) {
                        $referid = $mysqli->insert_id;
                        $ury = "INSERT INTO " . odo_DATA_USUA . " (nombres, apellidos, correo, clave, especialidad, nivelestudio, genero, edad, foto, pais, telefono, tipo, fecha, ultimoacceso, verificado, hash, estado) VALUES ('$nombre', '$apellido', '$email', '$pattern', '$especial', '$nivel', '$genero', '$edad', '$foto', '$pais', '$telefono', 'P', '$hoy', '$ult', '0', '$hash', 'P')";
                        $usl = $mysqli->query($ury);
                        if ($usl) { //clave es id de usuario
                            $userid = $mysqli->insert_id;
                            $aip = "UPDATE " . odo_DATA_PROF . " SET clave = '$userid' WHERE id = '$referid' ";
                            $asl = $mysqli->query($aip);
                        }
                        $rry = "INSERT INTO " . odo_DATA_REFE . " (referente, profesorid, referido, referidoid, correoreferido, clave, fecha, estado) VALUES ('$quien', '$profe', '$todojunto', '$referid', '$email', '$clave', '$hoy', 'R')";
                        $rrl = $mysqli->query($rry);
                        /*ENVIA EMAIL*/
                        $titulo = odo_TITL . ": Se ha referido a un nuevo profesor";
                        //Para el Referente
                        $body = eemail(
                            ['Hola ' . $quien, 'Nos has enviado información para un nuevo profesor referido.'], //Texto largo
                            ['REFERIDO:', 'EMAIL:', 'TELÉFONO:', 'GÉNERO:', 'EDAD:', 'ESPECIALIDAD:', 'NIVEL ESTUDIOS:', 'PAÍS:', 'ACERCA DEL REFERIDO:', 'FECHA:'], //Campos
                            [$todojunto, preEmail($email), $telefono, $gender, $edad, $especial, $nivel, $pais, $acercade, $hoydia], //Valores
                            ['Revisaremos tu solicitud y nos comunicaremos con tu referido a la brevedad posible.'] //Pie
                        );
                        @mail($correo, $titulo, $body, $firm);
                        //Para el Referido
                        $cuerpo = eemail(
                            ['Hola ' . $todojunto, '<strong>' . $quien . '</strong> te ha referido para ser parte del staff de profesores de INDESID'], //Texto largo
                            ['REFERENTE:', 'EMAIL:', 'TELÉFONO:', 'GÉNERO:', 'EDAD:', 'ESPECIALIDAD:', 'NIVEL ESTUDIOS:', 'PAÍS:', 'ACERCA DEL REFERIDO:', 'FECHA:'], //Campos
                            [$quien, preEmail($email), $telefono, $gender, $edad, $especial, $nivel, $pais, $acercade, $hoydia], //Valores
                            ['Para dar su conformidad con la referencia enviada por favor <a href="' . $rutaver . '?t=q&e=' . base64_encode($email) . '&n=' . base64_encode($referid) . '&h=' . $hash . '" target="_blank" style="color:#ccc;text-decoration:none;">HAGA CLICK AQUÍ</a>. Nos comunicaremos a la brevedad posible con usted ' . $nombre . '. Si no está de acuerdo con la referencia por favor haga caso omiso a este correo electrónico.'] //Pie

                        );
                        @mail($email, $titulo, $cuerpo, $firm);
                        /* MENSAJE PARA EL USUARIO */
                        $_SESSION['verid'] = "Solicitud enviada. Revisaremos los datos enviados y nos pondremos en contacto con el referido a la brevedad posible. Gracias!";
                        $_SESSION['vertype'] = "success";
                        $_SESSION['vertitle'] = "Aviso";
                    } else {
                        $_SESSION['verid'] = "Ha ocurrido un error y no se ha podido agregar al referido";
                        $_SESSION['vertype'] = "error";
                        $_SESSION['vertitle'] = "Alerta";
                    }
                } else {
                    $_SESSION['verid'] = $error;
                    $_SESSION['vertype'] = "error";
                    $_SESSION['vertitle'] = "Alerta";
                }
            }
        }
        header('location:' . $_SERVER['HTTP_REFERER']);
    } else {
        header('location:index.php');
    }
}
