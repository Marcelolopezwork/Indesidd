<?php
//AGREGA ITEM AL CARRITO CON CÓDIGO DE DESCUENTO
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) {
  if ($_POST) {
    unset($_SESSION['descuento']);
    unset($_SESSION['iddescto']);
    unset($_SESSION['dscto']);
    $quehago = base64_decode($_POST['cid']);
    $cursoid = base64_decode($_POST['pid']);
    $dsct = $_POST['descuento'];
    $user = $_SESSION['cod'];
    //Aplica descuento
    if ($quehago == 'Aplicar') {
      $qhace = base64_encode('Quitar');
      $qrys = "SELECT * FROM " . odo_DATA_DESC . " WHERE id = '$dsct' AND usuarioid = '$user' AND estado = 'A' ORDER BY id";
      $rsul = $mysqli->query($qrys);
      $existe = $rsul->num_rows;
      $dcto = $rsul->fetch_assoc();
      $dscto = $dcto['descuento'];
      $codig = $dcto['codigo'];

      if ($existe == 1) {
        $aplica = number_format($dscto / 100, 2);

        $qrys = "SELECT * FROM " . odo_DATA_CURS . " WHERE id = '$cursoid' ORDER BY id ";
        $rsul = $mysqli->query($qrys);
        $row = $rsul->fetch_array(MYSQLI_ASSOC);

        if (isset($_SESSION['carro'])) $carro = $_SESSION['carro'];
        if ($row['ofertaactiva'] == 'S') $precio = $row['preciooferta'];
        else $precio = $row['precioventa'];

        $prize = $precio - ($precio * $aplica);

        $_SESSION['descuento'] = $prize; //Precio del curso con descuento
        $_SESSION['iddescto'] = $dsct; //Si se aplico código de descuento
        $_SESSION['dscto'] = $dscto; //Monto del descuento en %

        $qrys = "UPDATE " . odo_DATA_DESC . " SET fechauso = '$hoy' WHERE id = '$dsct' ";
        $rsul = $mysqli->query($qrys);

        $usl = true;
        $accion = "aplica";
        $mensaje = "Descuento aplicado del " . $dscto . "%";
        $boton = '<a href="del-discount.php?did=' . $dsct . '" class="mx-1 mt-2">' . $codig . '<i class="icon-line-circle-cross"></i></a>';
      }
      //Quita descuento
    } else {
      $qhace = base64_encode('Aplicar');
      $qrys = "UPDATE " . odo_DATA_DESC . " SET fechauso = NULL WHERE id = '$dsct' ";
      $rsul = $mysqli->query($qrys);
      unset($_SESSION['descuento']);
      unset($_SESSION['iddescto']);
      unset($_SESSION['dscto']);

      $usl = true;
      $accion = "quita";
      $mensaje = "Descuento quitado";
      $boton = "";
    }
    $jsonarray = array($usl, $accion, $mensaje, $boton, $qhace);
    $json = json_encode($jsonarray);
    echo $json;
  } else {
    header("location:index.php");
  }
} else {
  header("location:index.php");
}
