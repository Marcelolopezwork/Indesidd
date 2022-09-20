<?php
//Cargar tabla de pagos de los profesores
require 'cfg.inc.php';
if ($_POST) {
    $cobro = filter_var($_POST['p'], FILTER_SANITIZE_NUMBER_INT);
    $tabla = '
        <table class="table-bordered w-100">
            <thead>
                <tr class="table-info small">
                    <th class="p-1 small">MES</th>
                    <th class="p-1 small">INSCRITOS</th>
                    <th class="p-1 small">PAGO TOTAL</th>
                    <th class="p-1 small">ESTADO</th>
                </tr>
            </thead>
            <tbody>';
                for ($mes = 1; $mes <= 12; $mes++) {
                    $sry = "SELECT count(profesorid) AS cuantos FROM ".odo_DATA_TRAN." WHERE (YEAR(fecha) = $cobro) AND (MONTH(fecha) = $mes) AND profesorid = '".$_SESSION['pod']."' AND estado = 'A' ";
                    $ssl = $mysqli->query($sry);
                    $pag = $ssl->fetch_assoc();
                    if ($pag['cuantos'] != 0) $cuantosalumno = $pag['cuantos']." alumnos";
                    else $cuantosalumno = "";
                    $try = "SELECT SUM(monto*comision/100) AS billete FROM ".odo_DATA_TRAN." WHERE (YEAR(fecha) = $cobro) AND (MONTH(fecha) = $mes) AND profesorid = '".$_SESSION['pod']."' AND estado = 'A' ";
                    $tsl = $mysqli->query($try);
                    $pay = $tsl->fetch_assoc();
                    if (!is_null($pay['billete'])) $porcobrar = $moneda.number_format($pay['billete'], 2);
                    else $porcobrar = "";
        $tabla .= '
                <tr class="small">
                    <td class="px-1">'.$meses[$mes].'</td>
                    <td class="px-1">'.$cuantosalumno.'</td>
                    <td class="px-1">'.$porcobrar.'</td>
                    <td class="px-1"></td>
                </tr>';
                }
        $tabla .= '
            </tbody>
        </table>';
    echo $tabla;
} else {
    header('location:index.php');
}
