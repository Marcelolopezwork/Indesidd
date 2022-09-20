<?php
//Buscador de cursos
require 'cfg.inc.php';
if ($_POST) {
    $_SESSION['riq'] = "";
    if (!empty($_POST['busqueda'])) $b = filter_var(mb_convert_case(trim($_POST['busqueda']), MB_CASE_LOWER, 'utf-8'), FILTER_UNSAFE_RAW);
    $busca = explode(" ", strtolower($b));
    $cuantos = count($busca);
    $quita = $cuantos - 1;
    $kuery = "SELECT * FROM ".odo_DATA_CURS." WHERE publicado = 'S' AND venta = 'S' AND estado = 'A' ORDER BY id ";
    $kesul = $mysqli->query($kuery);
    $habil = [];
    while ($habiles = $kesul->fetch_assoc()) array_push($habil, $habiles['id']);
    $matriz = [];
    foreach ($habil AS $key) {
        $query = "SELECT * FROM ".odo_DATA_TAGS." WHERE cursoid = '$key' AND estado = 'A' AND (";
        for ($i = 0; $i < $cuantos; $i++) {
            if (!empty($busca[$i])) {
                $query .= "((tag LIKE '%$busca[$i]%') OR (curso LIKE '%$busca[$i]%') OR (categoria LIKE '%$busca[$i]%') OR (profesor LIKE '%$busca[$i]%')) ";
                if ($quita > $i) $query .= " OR ";
            }
        }
        $query .= ") ORDER BY id ";
        $rsl = $mysqli->query($query);
        $num = $rsl->num_rows;
        if ($num > 0) while ($fnd = $rsl->fetch_assoc()) array_push($matriz, $fnd['id']);
    }
    $encontro = count($matriz);
    $_SESSION['found'] = [];
    if ($encontro == 0) {
        $_SESSION['riq'] = "No hay resultados pero tenemos éstas opciones";
    } else {
        $_SESSION['found'] = $matriz;
        if ($encontro == 1) $_SESSION['riq'] = "Se encontró 1 resultado";
        else $_SESSION['riq'] = "Se encontraron ".$encontro." resultados";
    }
    header('location:cursos.php');
} else {
    header('location:index.php');
}
