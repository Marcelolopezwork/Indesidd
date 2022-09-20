<?php
//Curso Me Gusta
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
    if ($_POST) {
        $z = $_POST['z'];
        //Likes tabla Alumnos
        $qry = "SELECT * FROM " . odo_DATA_ALUM . " WHERE id = '$z' ";
        $rsl = $mysqli->query($qry);
        $meg = $rsl->fetch_assoc();
        $c = $meg['cursoid'];
        $m = $meg['megusta'];
        if ($m == '1') $inv = '0';
        else $inv = '1';
        $qry = "UPDATE " . odo_DATA_ALUM . " SET megusta = '$inv' WHERE id = '$z' ";
        $rsl = $mysqli->query($qry);
        //Likes tabla Cursos
        $qry = "SELECT SUM(megusta) AS likes FROM " . odo_DATA_ALUM . " WHERE cursoid = '$c' ";
        $rsl = $mysqli->query($qry);
        $ike = $rsl->fetch_assoc();
        $i = $ike['likes'];
        $qry = "UPDATE " . odo_DATA_CURS . " SET megusta = '$i' WHERE id = '$c' ";
        $rsl = $mysqli->query($qry);
        echo $inv;
    } else {
        header('location:cursos.php');
    }
} else {
    header('location:index.php');
}
