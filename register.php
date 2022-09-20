<?php
//Regístrese en el sistema
//Tipo: P = Profesor; U = Alumno; R = Referido;
//Estado: A = Activo; B = Baneado; P = Pendiente; X = Eliminado
require 'cfg.inc.php';
$error = "";
if ($_POST) {
    $_SESSION['verid'] = "";
    $_SESSION['vertype'] = "";
    $_SESSION['vertitle'] = "";
    $hash = md5(aleatoria(24));
    $foto = "nofoto.svg";
    if ((!isset($_POST['activity'])) || (empty($_POST['activity']))) header('location:' . $_SERVER['HTTP_REFERER']);
    //Alumnos
    if ($_POST['activity'] == sha1('alumno')) {
        if (!empty($_POST['firstname'])) $nombre = filter_var(mb_convert_case($_POST['firstname'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Ingresa nombre";
        if (!empty($_POST['lastname'])) $apellido = filter_var(mb_convert_case($_POST['lastname'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Ingresa apellidos";
        $largo = $nombre . ' ' . $apellido;
        if (!empty($_POST['email'])) $korreo = filter_var(mb_strtolower($_POST['email'], 'utf-8'), FILTER_SANITIZE_EMAIL);
        else $error .= "Ingresa correo electrónico";
        if (!empty($_POST['pass'])) $clave = sha1($_POST['pass']);
        else $error .= "Ingresa contraseña";
        if (!empty($_POST['category'])) $especial = filter_var($_POST['category'], FILTER_UNSAFE_RAW);
        else $error .= "Ingresa especialidad";
        if (!empty($_POST['level'])) $nivel = filter_var($_POST['level'], FILTER_UNSAFE_RAW);
        else $error .= "Ingresa nivel de estudios";
        if (!empty($_POST['gender'])) {
            $genero = filter_var($_POST['gender'], FILTER_UNSAFE_RAW);
            if ($genero == 'M') $gender = "Masculino";
            else $gender = "Femenino";
        } else {
            $error .= "Escoge género";
        }
        if (!empty($_POST['age'])) $edad = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Ingresa edad";
        if (!empty($_POST['phone'])) $telefono = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Ingresa teléfono";
        if (!empty($_POST['country'])) $pais = filter_var(mb_convert_case($_POST['country'], MB_CASE_UPPER, 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Escoja país";
        if (empty($error)) {
            $pry = "SELECT * FROM " . odo_DATA_PAIS . " WHERE iso = '$pais'  ORDER BY id";
            $psl = $mysqli->query($pry);
            $pai = $psl->fetch_assoc();
            $codpais = $pai['country'];
            $qry2 = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = '$korreo' AND verificado = '0' AND estado = 'P') ORDER BY correo";
            $rsl2 = $mysqli->query($qry2);
            $pum = $rsl2->num_rows;
            if ($pum == 1) $pendiente = true;
            else $pendiente = false;
            if ($pendiente) {
                /*ENVIA EMAIL OTRA VEZ AL ALUMNO*/
                $_SESSION['verid'] = "Te hemos enviado un correo electrónico";
                $_SESSION['vertitle'] = "Aviso";
                $_SESSION['vertype'] = "warning";
                $m = $rsl2->fetch_assoc();
                $id2 = $m['id'];
                $nom = $m['nombres'] . " " . $m['apellidos'];
                $correo = $m['correo'];
                $esp = $m['especialidad'];
                $niv = $m['nivelestudio'];
                $gen = $m['genero'];
                $eda = $m['edad'];
                $tel = $m['telefono'];
                $fec = $m['fecha'];
                $jas = $m['hash'];
                $body = eemail(
                    ['Necesitamos verificar tus datos enviados', 'Ingresaste los siguientes datos:'], //Texto largo
                    ['NOMBRES:', 'EMAIL/USUARIO:', 'TELÉFONO:', 'ESPECIALIDAD:', 'NIVEL DE ESTUDIOS:', 'GÉNERO:', 'EDAD:', 'PAÍS:', 'FECHA:'], //Campos
                    [$nom, preEmail($correo), $tel, $esp, $niv, $gen, $eda, $codpais, $fec], //Valores
                    ['Para completar tu registro necesitamos verificar tu dirección de correo electrónico. Por favor <a href="' . $rutaver . '?t=b&e=' . base64_encode($correo) . '&n=' . base64_encode($id2) . '&h=' . $jas . '" target="_blank" style="color:#ccc;text-decoration:none;">HAZ CLICK AQUÍ</a>'] //Pie
                );
                $titulo = odo_TITL . ": Necesitamos verificar tus datos";
                @mail($correo, $titulo, $body, $firm);
                $_SESSION['verifica'] = true;
                header('location:verify.php');
            } else {
                $qry = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = '$korreo' AND verificado = '1' AND estado = 'A') ORDER BY correo";
                $rsl = $mysqli->query($qry);
                $num = $rsl->num_rows;
                /*SI NO EXISTE SE ACEPTA SU INSCRIPCIÓN*/
                if ($num == 0) {
                    $ary = "INSERT INTO " . odo_DATA_USUA . " (nombres, apellidos, correo, clave, especialidad, nivelestudio, genero, edad, foto, pais, telefono, tipo, fecha, ultimoacceso, verificado, hash, estado) VALUES ('$nombre', '$apellido', '$korreo', '$clave', '$especial', '$nivel', '$genero', '$edad', '$foto', '$pais', '$telefono', 'U', '$hoy', '$ult', '0', '$hash', 'P')";
                    $asl = $mysqli->query($ary);
                    if ($asl) {
                        $_SESSION['top'] = $mysqli->insert_id;
                        $_SESSION['nom'] = ucwords($nombre);
                        /*ENVIA EMAIL NUEVO ALUMNO*/
                        $body = eemail(
                            ['Usted se ha registrado correctamente en la plataforma de INDESID', 'Con los siguientes datos:'], //Texto largo
                            ['NOMBRES:', 'EMAIL/USUARIO:', 'TELÉFONO:', 'ESPECIALIDAD:', 'NIVEL DE ESTUDIOS:', 'GÉNERO:', 'EDAD:', 'PAÍS:', 'FECHA:'], //Campos
                            [$largo, preEmail($korreo), $telefono, $especial, $nivel, $gender, $edad, $codpais, $hoydia], //Valores
                            ['Para completar su registro necesitamos verificar la dirección de correo electrónico consignada.<br>Por favor <a href="' . $rutaver . '?t=b&e=' . base64_encode($korreo) . '&n=' . base64_encode($_SESSION['top']) . '&h=' . $hash . '" target="_blank" style="color:#ccc;text-decoration:none;">HAGA CLICK AQUÍ</a>'] //Pie
                        );
                        $titulo = odo_TITL . ": Se ha registrado un nuevo alumno";
                        $correo = $korreo;
                        @mail($correo, $titulo, $body, $firm);
                        $_SESSION['verifica'] = true;
                        header('location:verify.php');
                    } else {
                        $_SESSION['verid'] = "No se ha podido ingresar la información";
                        $_SESSION['vertitle'] = "Alerta";
                        $_SESSION['vertype'] = "danger";
                        header('location:' . $_SERVER['HTTP_REFERER']);
                    }
                } else {
                    //Usuario ya existe
                    $_SESSION['verid'] = "Usuario ya existe!";
                    $_SESSION['vertitle'] = "Alerta";
                    $_SESSION['vertype'] = "danger";
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            $_SESSION['verid'] = "Llene todos los datos por favor.";
            $_SESSION['vertitle'] = "Aviso";
            $_SESSION['vertype'] = "warning";
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    //Profesores
    if ($_POST['activity'] == sha1('profesor')) {
        if (!empty($_POST['firstname'])) $nombre = filter_var(mb_convert_case($_POST['firstname'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Ingresa nombre.\n";
        if (!empty($_POST['lastname'])) $apellido = filter_var(mb_convert_case($_POST['lastname'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Ingresa apellidos.\n";
        $todojunto = $nombre . " " . $apellido;
        $slug = uri($todojunto);
        if (!empty($_POST['email'])) $korreo = filter_var(mb_strtolower($_POST['email'], 'utf-8'), FILTER_SANITIZE_EMAIL);
        else $error .= "Ingresa correo electrónico.\n";
        if (!empty($_POST['pass'])) {
            $clave = trim($_POST['pass']);
            $pattern = sha1($clave);
        } else {
            $error .= "Ingresa contraseña.\n";
        }
        if (!empty($_POST['dni'])) $documento = filter_var(mb_strtoupper($_POST['dni'], 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Ingresa documento de identidad.\n";
        if (!empty($_POST['university'])) $universidad = filter_var(mb_convert_case($_POST['university'], MB_CASE_TITLE, 'utf-8'), FILTER_UNSAFE_RAW);
        else $error .= "Ingresa universidad donde estudió.\n";
        if (!empty($_POST['category'])) $especial = filter_var($_POST['category'], FILTER_UNSAFE_RAW);
        else $error .= "Ingresa especialidad.\n";
        if (!empty($_POST['level'])) $nivel = filter_var($_POST['level'], FILTER_UNSAFE_RAW);
        else $error .= "Ingresa nivel de estudios.\n";
        if (!empty($_POST['phone'])) $telefono = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Ingresa teléfono.\n";
        if (!empty($_POST['gender'])) {
            $genero = filter_var($_POST['gender'], FILTER_UNSAFE_RAW);
            if ($genero == 'M') $gender = "Masculino";
            else $gender = "Femenino";
        } else {
            $error .= "Escoja género.\n";
        }
        if (!empty($_POST['age'])) $edad = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
        else $error .= "Ingresa edad.\n";
        if (!empty($_POST['country'])) {
            $pais = filter_var(mb_strtoupper($_POST['country'], 'utf-8'), FILTER_UNSAFE_RAW);
            $pry = "SELECT * FROM " . odo_DATA_PAIS . " WHERE iso = '$pais' ORDER BY id ";
            $psl = $mysqli->query($pry);
            $pai = $psl->fetch_assoc();
            $codpais = $pai['country'];
        } else {
            $error .= "Escoja país.\n";
        }
        if (!empty($_POST['aboutme'])) $sobremi = filter_var($_POST['aboutme'], FILTER_UNSAFE_RAW);
        else $error .= "Cuéntanos algo sobre tí.\n";
        if (empty($error)) {
            $qry = "SELECT * FROM " . odo_DATA_PROF . " WHERE (correo = '$korreo' AND (estado = 'A' OR estado = 'P' OR estado = 'X')) ORDER BY correo";
            $rsl = $mysqli->query($qry);
            $mum = $rsl->num_rows;
            $prf = $rsl->fetch_assoc();
            //Si no existe se acepta su postulación
            if ($mum == 0) {
                $kry = "INSERT INTO " . odo_DATA_PROF . " (nombres, apellidos, slug, documento, correo, clave, telefono, genero, edad, sobremi, universidad, especialidad, nivelestudio, foto, pais, tipo, fecha, pattern, rechazado, estado) VALUES ('$nombre', '$apellido', '$slug', '$documento', '$korreo', '$clave', '$telefono', '$genero', '$edad', '$sobremi', '$universidad', '$especial', '$nivel', '$foto', '$pais', 'P', '$hoy', '$pattern', NULL, 'P')";
                $ksl = $mysqli->query($kry);
                if ($ksl) {
                    $_SESSION['top'] = $mysqli->insert_id;
                    $_SESSION['nom'] = ucwords($nombre);
                    //Se registra como usuario para evitar que utilice el mismo correo de profesor
                    $ury = "INSERT INTO " . odo_DATA_USUA . " (nombres, apellidos, correo, clave, especialidad, nivelestudio, genero, edad, foto, pais, telefono, tipo, fecha, ultimoacceso, verificado, hash, estado) VALUES ('$nombre', '$apellido', '$korreo', '$pattern', '$especial', '$nivel', '$genero', '$edad', '$foto', '$pais', '$telefono', 'P', '$hoy', '$ult', '0', '$hash', 'P')";
                    $usl = $mysqli->query($ury);
                    $uzu = $mysqli->insert_id;
                    if ($uzu) { //clave es id de usuario
                        $aip = "UPDATE " . odo_DATA_PROF . " SET clave = '$uzu' WHERE id = '" . $_SESSION['top'] . "' ";
                        $asl = $mysqli->query($aip);
                    }
                    $titulo = odo_TITL . ": Se ha postulado un nuevo profesor";
                    /*ENVIA EMAIL*/
                    $body = eemail(
                        ['Usted se ha postulado como profesor en la plataforma de INDESID', 'Con los siguientes datos:'], //Texto largo
                        ['NOMBRES:', 'EMAIL/USUARIO:', 'TELÉFONO:', 'DOCUMENTO DE IDENTIDAD:', 'GÉNERO:', 'EDAD:', 'ESTUDIOS UNIVERSITARIOS:', 'ESPECIALIDAD:', 'NIVEL DE ESTUDIOS:', 'PAÍS:', 'ACERCA DE MI:', 'FECHA:'], //Campos
                        [$todojunto, preEmail($korreo), $telefono, $documento, $gender, $edad, $universidad, $especial, $nivel, $codpais, $sobremi, $hoydia], //Valores
                        ['Para completar su registro necesitamos verificar la dirección de correo electrónico. Por favor <a href="' . $rutaver . '?t=q&e=' . base64_encode($korreo) . '&n=' . base64_encode($_SESSION['top']) . '&h=' . $hash . '" target="_blank" style="color:#ccc;text-decoration:none;">HAZ CLICK AQUÍ</a>'] //Pie
                    );
                    $correo = $korreo;
                    @mail($correo, $titulo, $body, $firm);
                    $_SESSION['verifica'] = true;
                    header('location:verify.php');
                } else {
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
            }
            //Ya existe un usuario que ha postulado con ese correo electrónico
            if ($num >= 1) {
                if ($prf['estado'] == 'P') {
                    $_SESSION['verid'] = "Hola! ya recibimos tu solicitud y la estamos evaluando. Nos comunicaremos contigo a la brevedad posible. Gracias!";
                    $_SESSION['vertype'] = "success";
                    $_SESSION['vertitle'] = $prf['nombres'];
                }
                if ($prf['estado'] == 'A') {
                    $_SESSION['verid'] = "Profesor ya existe. No puede registrarse con este correo electrónico";
                    $_SESSION['vertype'] = "danger";
                    $_SESSION['vertitle'] = "Alerta";
                }
                if ($prf['estado'] == 'X') {
                    $_SESSION['verid'] = "Profesor ya postuló anteriormente";
                    $_SESSION['vertype'] = "warning";
                    $_SESSION['vertitle'] = "Aviso";
                }
                header('location:' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['verid'] = "Llene todos los datos por favor.";
            $_SESSION['vertype'] = "warning";
            $_SESSION['vertitle'] = "Aviso";
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    }
} else {
    header('location:index.php');
}
