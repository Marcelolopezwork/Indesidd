<?php
//ENVIAR SOLICITUD DE DEVOLUCION
include 'cfg.inc.php';
if (isset($_SESSION['cod'])) {
    if (($_SESSION['tip'] == 'U') && ($_POST)) {
        $error = "";
        $_SESSION['verid'] = "";
        $_SESSION['vertype'] = "";
        $_SESSION['vertitle'] = "";

        if (!empty($_POST['zid'])) $z = base64_decode($_POST['zid']);
        else $error .= "No se ha indicado cual transacción\n";
        if (!empty($_POST['xid'])) $x = base64_decode($_POST['xid']);
        else $error .= "No se ha indicado cual curso\n";
        if (!empty($_POST['did'])) {
            $e = base64_decode($_POST['did']);
            $d = $e * (-1);
        } else {
            $error .= "No se ha indicado el monto\n";
        }
        if (!empty($_POST['motivo'])) $motivo = filter_var($_POST['motivo'], FILTER_UNSAFE_RAW);
        else $error .= "No se ha escrito el motivo de la solicitud\n";
        if (empty($error)) {
            $qry = "SELECT * FROM " . odo_DATA_TRAN . " WHERE id = '$z' AND estado = 'A' ";
            $rsl = $mysqli->query($qry);
            $num = $rsl->num_rows;
            if ($num == 1) {
                $t = $rsl->fetch_assoc();
                $curso = $t['curso'];
                $alumno = $_SESSION['lar'];
                $op = $t['id'];
                $us = $t['usuarioid'];
                $po = $t['profesorid'];
                $co = $t['comision'];
                $ory = "INSERT INTO " . odo_DATA_DEVO . " (transaccionid, monto, curso, cursoid, usuarioid, profesorid, comision, fecha, motivo, razon, estado) VALUES ('$op', '$e', '$curso', '$x', '$us', '$po', '$co', '$hoy', '$motivo', NULL, 'P')";
                $osl = $mysqli->query($ory);
                $ury = "SELECT correo FROM " . odo_DATA_USUA . " WHERE id = '$us' AND estado = 'A' ORDER BY id ";
                $usl = $mysqli->query($ury);
                $uma = $usl->fetch_assoc();
                $correo = $uma['correo'];
                $body = eemail(
                    ['Revisaremos su solicitud', 'Sobre la devolución del monto utilizado en la compra del curso'], //Texto largo
                    ['NOMBRES:', 'FECHA:', 'CURSO:', 'MOTIVO:'], //Campos
                    [$alumno, $hoydia, $curso, $motivo], //Valores
                    ['Hemos recibido la solicitud para la devolución de la compra del curso. Gracias.'] //Pie
                );
                $titulo = odo_TITL . ": Solicitud de devolución de compra";
                @mail($correo, $titulo, $body, $firm);
                $_SESSION['vertype'] = "success";
                $_SESSION['verid'] = "Solicitud enviada";
                $_SESSION['vertitle'] = "Aviso";
            } else {
                $error .= "Transacción no existe";
            }
        } else {
            $_SESSION['vertype'] = "error";
            $_SESSION['verid'] = $error;
            $_SESSION['vertitle'] = "Aviso";
        }
    }
    header("location:perfil.php");
} else {
    header("location:index.php");
}
