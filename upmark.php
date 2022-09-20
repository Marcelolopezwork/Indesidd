<?php
//Actualiza en que clase se quedo el alumno
//Lo que esta comentado filtraba que el curso este disponible y a la venta
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
  if ($_POST) {
    //$alumnos['id'] $alumnos['usuarioid'] $alumnos['cursoid'] $alumnos['claseid'] $alumnos['marca']
    $mark = filter_var(base64_decode($_POST['mark']), FILTER_UNSAFE_RAW);
    $clav = explode('-', $mark);
    $id = $clav[0];
    $usuario = $clav[1];
    $curso = $clav[2];
    $clase = $clav[3];
    $actual = $clav[4] + 0;
    $siguiente = $actual + 1;
    $c = ($curso);
    $s = ($siguiente);
    $a = ($actual);
    $ory = "SELECT * FROM " . odo_DATA_ALUM . " WHERE id = '$id' AND estado = 'A' ";
    $osl = $mysqli->query($ory);
    $oin = $osl->fetch_assoc();
    $aquiestoy = $oin['marca'];
    $pry = "SELECT count(cursoid) AS fin FROM " . odo_DATA_CLAS . " WHERE cursoid = '$curso' ";
    $psl = $mysqli->query($pry);
    $fin = $psl->fetch_assoc();
    $casi = $fin['fin'];
    $hasta = $casi - 1;
    if ($aquiestoy <= $actual) {
      if ($actual < $hasta) {
        $rry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE cursoid = '$curso' AND orden = '$s' ";
        $rsl = $mysqli->query($rry);
        $rin = $rsl->fetch_assoc();
        $r = $rin['slug'];
        $qry = "UPDATE " . odo_DATA_ALUM . " SET marca = '$s' WHERE id = '$id' ";
        $rsl = $mysqli->query($qry);
        header('location:classroom/' . $c . '/' . $s . '/' . $r);
      } else {
        //If $actual == $hasta
        $rry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE cursoid = '$curso' AND orden = '$a' ";
        $rsl = $mysqli->query($rry);
        $rin = $rsl->fetch_assoc();
        $r = $rin['slug'];
        //Nota es la fecha en la que se termina el curso y se genera el certificado
        $qry = "UPDATE " . odo_DATA_ALUM . " SET nota = '0', certificado = '$hoy', completado = 'S' WHERE id = '$id' ";
        $rsl = $mysqli->query($qry);
        header('location:classroom/' . $c . '/' . $a . '/' . $r);
      }
    } else {
      $rry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE cursoid = '$curso' AND orden = '$a' ";
      $rsl = $mysqli->query($rry);
      $rin = $rsl->fetch_assoc();
      $r = $rin['slug'];
      header('location:clasroom/' . $c . '/' . $a . '/' . $r);
    }
  } else {
    header('location:cursos.php');
  }
} else {
  header('location:index.php');
}
