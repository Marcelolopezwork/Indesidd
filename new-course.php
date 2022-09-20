<?php
//Profesor solicita nuevo curso
include 'cfg.inc.php';
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
            $largo = $_SESSION['lar'];
            $correo = base64_decode($_POST['cem']);
            if (!empty($_POST['course'])) {
                $curso = filter_var($_POST['course'], FILTER_UNSAFE_RAW);
                $slug = uri($curso);
            } else {
                $error .= "Ingresa nombre del curso.\n";
            }
            if (!empty($_POST['category'])) {
                $especialidad = filter_var($_POST['category'], FILTER_UNSAFE_RAW);
                $pry = "SELECT categoria FROM " . odo_DATA_CATE . " WHERE id = '" . $especialidad . "' ORDER BY categoria";
                $psl = $mysqli->query($pry);
                $cate = $psl->fetch_assoc();
                $kate = $cate['categoria'];
            } else {
                $error .= "Escoja especialidad.\n";
            }
            //Comisión 50% para profesores y 40% para referidos (el otro 10% del referido va para el refeerente)
            $fry = "SELECT tipo FROM " . odo_DATA_PROF . " WHERE id = '" . $_SESSION['pod'] . "' ORDER BY id";
            $fsl = $mysqli->query($fry);
            $comi = $fsl->fetch_assoc();
            if ($comi['tipo'] == 'P') $comision = '50';
            elseif ($comi['tipo'] == 'R') $comision = '40';
            if (!empty($_POST['description'])) $descripcion = filter_var($_POST['description'], FILTER_UNSAFE_RAW);
            else $error .= "Ingresa descripción.\n";
            if (!empty($_POST['module'])) $modulo = filter_var($_POST['module'], FILTER_SANITIZE_NUMBER_INT);
            else $error .= "Indique cantidad de módulos.\n";
            if (!empty($_POST['price'])) $precioventa = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
            else $error .= "Indique precio de venta.\n";
            if (!empty($_POST['sale'])) $preciooferta = filter_var($_POST['sale'], FILTER_SANITIZE_NUMBER_INT);
            else $error .= "Indique precio de oferta.\n";
            if (!empty($_POST['levelc'])) $nivel = filter_var($_POST['levelc'], FILTER_UNSAFE_RAW);
            else $error .= "Escoja nivel del curso.\n";
            if (!empty($_POST['language'])) $idioma = filter_var($_POST['language'], FILTER_UNSAFE_RAW);
            else $error .= "Escoja idioma del curso.\n";
            if (!empty($_POST['subtitle'])) $subtitulo = filter_var($_POST['subtitle'], FILTER_UNSAFE_RAW);
            else $error .= "Escoja subtítulos del curso.\n";
            if (!empty($_POST['trailer'])) $video = filter_var(mb_strtolower($_POST['trailer'], 'utf-8'), FILTER_SANITIZE_URL);
            else $video = "https://vimeo.com/502358843";
            $modcur = array();
            if ($_POST['nmodule']) {
                foreach ($_POST['nmodule'] as $valor) {
                    $value = filter_var($valor, FILTER_UNSAFE_RAW);
                    if (!empty($valor)) array_push($modcur, $value);
                    else $error .= "Hay un valor vacío" . "<br>";
                }
            }
            $curmod = array();
            if ($_POST['nclass']) {
                foreach ($_POST['nclass'] as $keyclass) {
                    $numc = filter_var($keyclass, FILTER_SANITIZE_NUMBER_INT);
                    if (is_numeric($numc)) array_push($curmod, $keyclass);
                    else $error .= 'Hay un valor no númerico' . "<br>";
                }
            }
            $clase = array_sum($curmod);
            if (empty($error)) {
                $qry = "INSERT INTO " . odo_DATA_CURS . " (curso, slug, categoriaid, descripcion, profesorid, modulos, clases, megusta, precioventa, preciooferta, ofertaactiva, estudiantes, nivel, duraciontotal, audio, subtitulos, fecha, fechalanzamiento, fechaactualizacion, publicado, novedad, comision, imagen, trailer, certificacion, principal, venta, estado)
                VALUES ('$curso', '$slug', '$especialidad', '$descripcion', '$profe', '$modulo', '$clase', '0', '$precioventa', '$preciooferta', 'N', '0', '$nivel', NULL, '$idioma', '$subtitulo', '$hoy', '$hoy', '$hoy', 'N', 'S', '$comision', '$logo', '$video', NULL, 'N', 'N', 'P')";
                $rsl = $mysqli->query($qry);
                $codcurso = $mysqli->insert_id;
                $target = [];
                for ($a = 0; $a < $modulo; $a++) {
                    $mdu = "INSERT INTO " . odo_DATA_MODU . " (categoriaid, cursoid, profesorid, modulo, clases, estado) VALUES ('$especialidad', '$codcurso', '$profe', '" . $modcur[$a] . "', '" . $curmod[$a] . "', 'P')";
                    $msl = $mysqli->query($mdu);
                    array_push($target, $mysqli->insert_id);
                }
                $cla = $_POST['nclass'];
                $b = 1;
                $c = 0;
                $d = 0;
                /* CREA LAS CLASES */
                foreach ($_POST['nmodule'] as $mod) {
                    $tar = $target[$c];
                    for ($v = 0; $v < $cla[$c]; $v++) {
                        $clase = "Clase " . $nombreclases[$d];
                        $acentos = acentos(strtolower($slug . "-" . $nombreclases[$d]));
                        $wry = "INSERT INTO " . odo_DATA_CLAS . " (categoriaid, cursoid, moduloid, orden, clase, slug, video, duracion, notas, archivos, estado) VALUES ('$especialidad', '$codcurso', '$tar', '$b', '$clase', '$acentos', NULL, NULL, NULL, NULL, 'P')";
                        $wsl = $mysqli->query($wry);
                        $d++;
                        $b++;
                    }
                    $c++;
                }
                $minkate = strtolower($kate);
                $mincurso = strtolower($curso);
                $minlargo = strtolower($largo);

                $try = "INSERT INTO " . odo_DATA_TAGS . " (tag, categoria, curso, cursoid, profesor, profesorid, estado) VALUES (null, '$minkate', '$mincurso', '$codcurso', '$minlargo', '$profe', 'P')";
                $tsl = $mysqli->query($try);
                /*ENVIA EMAIL*/
                if ($nivel == 'B') $renivel = 'Básico';
                if ($nivel == 'I') $renivel = 'Intermedio';
                if ($nivel == 'A') $renivel = 'Avanzado';
                $body = eemail(
                    ['Ha presentado la información para un nuevo curso:', $curso], //Texto largo
                    ['NOMBRE DEL CURSO:', 'DESCRIPCIÓN:', 'ESPECIALIDAD:', 'CANTIDAD DE MÓDULOS:', 'NIVEL:', 'IDIOMA:', 'SUBTÍTULOS:', 'PRECIO DE VENTA DESEADO:', 'PRECIO DE OFERTA DESEADO:', 'PORCENTAJE DE COMISIÓN:', 'FECHA:'], //Campos
                    [$curso, $descripcion, $especialidad, $modulo, $renivel, $idioma, $subtitulo, $moneda . ' ' . $precioventa, $moneda . ' ' . $preciooferta, $comision . ' %', $hoydia], //Valores
                    ['Revisaremos la solicitud y nos comunicaremos contigo a la brevedad posible '] //Pie

                );
                $_SESSION['verid'] = "Solicitud enviada. Revisaremos los datos y nos contactaremos contigo a la brevedad posible. Gracias!";
                $_SESSION['vertype'] = "success";
                $_SESSION['vertitle'] = "Aviso";
                $titulo = odo_TITL . ": Se ha presentado información para un nuevo curso";
                @mail($correo, $titulo, $body, $firm);
            } else {
                $_SESSION['verid'] = $error;
                $_SESSION['vertype'] = "error";
                $_SESSION['vertitle'] = "Alerta";
            }
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        header('location:index.php');
    }
}
