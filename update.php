<?php
//Actualiza los datos del profesor
//Tipo: P = Profesor; A = Alumno
//Estado: A = Alumno; B = Baneado; P = Profesor; X = Eliminado
require 'cfg.inc.php';
if ($_POST) {
    if ((!isset($_POST['activity'])) || (empty($_POST['activity']))) header('location:' . $_SERVER['HTTP_REFERER']);
    $nuevoq = "";
    $nuevot = "";
    if ($_POST['activity'] == sha1('alumno')) {
        //Alumnos
        if (!empty($_POST['level'])) {
            $nivel = filter_var($_POST['level'], FILTER_UNSAFE_RAW);
            $nuevoq .= "nivelestudio = '$nivel', ";
        }
        if (!empty($_POST['phone'])) {
            $telefono = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            $nuevoq .= "telefono = '$telefono', ";
        }
        $nuevoq .= " estado = 'A' ";
        $qry = "UPDATE " . odo_DATA_USUA . " SET " . $nuevoq . " WHERE id = '" . $_SESSION['cod'] . "' ";
        $rsl = $mysqli->query($qry);
        $usl = true;
        $mensaje = "Datos actualizados";
    } elseif ($_POST['activity'] == sha1('profesor')) {
        //Profesores
        if (!empty($_POST['aboutmes'])) {
            $acercademi = filter_var($_POST['aboutmes'], FILTER_UNSAFE_RAW);
            $nuevoq .= "sobremi = '$acercademi', ";
        }
        if (!empty($_POST['level'])) {
            $nivel = filter_var($_POST['level'], FILTER_UNSAFE_RAW);
            $nuevoq .= "nivelestudio = '$nivel', ";
            $nuevot .= $nuevoq;
        }
        if (!empty($_POST['phone'])) {
            $telefono = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            $nuevoq .= "telefono = '$telefono', ";
            $nuevot .= $nuevoq;
        }
        $nuevot .= " estado = 'A' ";
        $qry = "UPDATE " . odo_DATA_USUA . " SET " . $nuevot . " WHERE id = '" . $_SESSION['cod'] . "' ";
        $rsl = $mysqli->query($qry);
        if (!empty($_POST['dni'])) {
            $dni = filter_var($_POST['dni'], FILTER_UNSAFE_RAW);
            $nuevoq .= "documento = '$dni', ";
        }
        $nuevoq .= " estado = 'A' ";
        $qry = "UPDATE " . odo_DATA_PROF . " SET " . $nuevoq . " WHERE id = '" . $_SESSION['pod'] . "' ";
        $rsl = $mysqli->query($qry);
        $usl = true;
        $mensaje = "Datos actualizados";
    } else {
        $usl = false;
        $mensaje = "Los datos enviados no son correctos";
    }
}
$jsonarray = array($usl, $mensaje);
$json = json_encode($jsonarray);
echo $json;
