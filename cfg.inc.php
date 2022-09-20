<?php
header('Set-Cookie: cross-site-cookie=bar; SameSite=None; Secure');
@session_start();
date_default_timezone_set("America/Lima");
define('odo_BASE', 'dbvrrvv3bc7d6e'); //Esta base es para pruebas. Base real 'dbhdp346dnncyd', 'db2hyqgtm7mcam'
define('odo_DOMA', $_SERVER['HTTP_HOST']); //Nombre de dominio
define('odo_ENVI', 'admision@indesid.com'); //Usuario web
define('odo_HOST', '127.0.0.1'); //Localhost
define('odo_MSG1', 'Falló la conexión a la base de datos.'); //Mensaje de error
define('odo_PASS', 'yd6sxgwohig1'); //Clave Anterior: 'alt3rnat1v0$'
define('odo_TITL', 'Indesid'); //Nombre de la página
define('odo_USER', 'uialpnrqkqwec'); //Usuario. Anterior: 'un55jjc4wwcv6'
define('odo_DATA_ALUM', 'alumnos'); //tabla categorías
define('odo_DATA_BANE', 'adm_baneadas'); //tabla categorías
define('odo_DATA_DESC', 'adm_descuentos'); //tabla descuentos
define('odo_DATA_DEVO', 'devoluciones'); //tabla devoluciones
define('odo_DATA_CATE', 'categorias'); //tabla categorías
define('odo_DATA_CLAS', 'clases'); //tabla clases
define('odo_DATA_CLAV', 'claves'); //tabla olvido clave
define('odo_DATA_COME', 'comentarios'); //tabla comentarios
define('odo_DATA_CONT', 'contacto'); //tabla contacto web
define('odo_DATA_CURS', 'cursos'); //tabla cursos
define('odo_DATA_INTE', 'adm_interfaz'); //tabla interfaz
define('odo_DATA_MODU', 'modulos'); //tabla módulos
define('odo_DATA_NIVE', 'niveles'); //tabla niveles de estudio
define('odo_DATA_NOTI', 'adm_notificaciones'); //tabla notificaciones
define('odo_DATA_NOTY', 'notificaciones'); //tabla notificaciones
define('odo_DATA_PAGO', 'adm_pagos'); //tabla pagos
define('odo_DATA_PAIS', 'paises'); //tabla paises
define('odo_DATA_PREC', 'precios'); //tabla precios
define('odo_DATA_PROF', 'profesores'); //tabla profesores
define('odo_DATA_REFE', 'referidos'); //tabla referidos
define('odo_DATA_REGW', 'registrawebinar'); //tabla registrawebinar
define('odo_DATA_TAGS', 'tags'); //tabla tags
define('odo_DATA_TRAN', 'transacciones'); //tabla transacciones
define('odo_DATA_USUA', 'usuarios'); //tabla usuarios
define('odo_DATA_VISI', 'visitantes'); //tabla visitantes
define('odo_DATA_WEBI', 'webinars'); //tabla webinars
define('odo_VIDE_CLNT', '7Dy+G29WhMjyvIK0sdvGvobwjAichYY22MutRH291GbouzvVXRg531YyY4/nBxM4+0r8yb4f417YfPIDDnp0rOREq/73GKOhqJWMjbBVz2O6daj74/HWVOrqtkaeOfE1');
define('odo_VIDE_IDES', '5fcfe8e94eace23883dab98a204ed3ac9c705b86');
define('odo_VIDE_ACTK', '943db0a2ea8d555c47bc5db36454045b'); //768bb04a42e526cae88d5a1ac34e4e21
$contra_usuario_prueba = "sistemaOdontologico2020";

$mysqli = new mysqli(odo_HOST, odo_USER, odo_PASS, odo_BASE);
$mysqli->set_charset('utf8');
if (mysqli_connect_errno()) {
  printf(odo_MSG1 . ' %s', $mysqli->connect_error);
  die();
}

$development = false; //web en desarrollo
$both = false; //Activa detalles para profesores y alumnos
$pro = false; //Activa detalles sólo para profesores

$buscador = true; //Muestra el buscador en el menú principal
$datetime = false; //plugin muestra calendario
$datatable = false; //plugin muestra tablas
$fileinput = false; //plugin muestra subir archivos
$masks = false;  //plugin muestra formatos para numeros, fechas, máscaras
$numeric = false; //plugin sólo números
$pdf = false; //plugin muestra pdf en modal
$select = false; //plugin muestra select
$swiper = false; //plugin muestra carrusel
$telephone = false; //plugin código telefónico
$svg = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 3'%3E%3C/svg%3E";

$moneda = "US$ ";
$today = getdate();
$nummes = date('m', time());
$anioini = 2021; //Año de inicio del servicio
$num_profes = 4; //Número de profesores que se muestran en la pantalla inicial
$dias_devolucion = "+ 2 days"; //Número de días que un alumno tiene para solicitar una devolución del dinero de una compra de un curso
$monto_devolucion = 0; //Porcentaje de devolución sobre el precio de venta de un curso que retiene la plataforma por gastos administrativos
$numanio = date('Y', time());
$year = $today['year'];
$hoy = date('Y-m-d', time());
$nuevodia = new DateTime($hoy);
$hoydia = $nuevodia->format('d-m-Y');
$ult = date('Y-m-d h:i:s', time());
$txtBtn = "Ver curso";
$txtBtnBuy = "Comprar";
$txtBtnProf = "Ver el Curso";
$monto_descuento = 300; //Monto mínimo para generar cupones de descuento
$txtdcto = "Comprando cursos obtendrás códigos de descuentos. Por cada " . $moneda . number_format($monto_descuento, 2) . " dólares obtendrás un código para que puedas aplicarlo en alguno de nuestros cursos.";
$redes = ['Facebook', 'Instagram', 'Twitter', 'YouTube', 'Vimeo', 'Twitch'];
$meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$nombreclases = array('Introductoria', 'Uno', 'Dos', 'Tres', 'Cuatro', 'Cinco', 'Seis', 'Siete', 'Ocho', 'Nueve', 'Diez', 'Once', 'Doce', 'Trece', 'Catorce', 'Quince', 'Dieciseis', 'Diecisiete', 'Dieciocho', 'Diecinueve', 'Veinte', 'Veintiuno', 'Veintidos', 'Veintitres', 'Veinticuatro', 'Veinticinco', 'Veintiseis', 'Veintisiete', 'Veintiocho', 'Veintinueve', 'Treinta', 'Treintaiuno', 'Treintaidos', 'Treintitres', 'Treinticuatro', 'Treinticinco', 'Treintiseis', ' Treintisiete', 'Treintiocho', 'Treintinueve', 'Cuarenta', 'Cuareintaiuno', 'Cuarentaidos', 'Cuarentaitres', 'Cuarentaicuatro', 'Cuarentaicinco', 'Cuarentaiseis', 'Cuarentaisiete', 'Cuarentaiocho', 'Cuarentainueve', 'Cincuenta', 'Cincuentaiuno', 'Cincuentaidos', 'Cincuentaitres', 'Cincuentaicuatro', 'Cincuentaicinco', 'Cincuentaiseis', 'Cincuentaisiete', 'Cincuentaiocho', 'Cincuentainueve', 'Sesenta', 'Sesentaiuno', 'Sesentaidos', 'Sesentaitres', 'Sesentaicuatro', 'Sesentaicinco', 'Sesentaiseis', 'Sesentaisiete', 'Sesentaiocho', 'Sesentainueve', 'Setenta', 'Setentaiuno', 'Setentaidos', 'Setentaitres', 'Setentaicuatro', 'Setentaicinco', 'Setentaiseis', 'Setentaisiete', 'Setentaiocho', 'Setentainueve', 'Ochenta', 'Ochentaiuno', 'Ochentaidos', 'Ochentaitres', 'Ochentaicuatro', 'Ochentaicinco', 'Ochentaiseis', 'Ochentaisiete', 'Ochentaiocho', 'Ochentainueve', 'Noventa', 'Noventaiuno', 'Noventaidos', 'Noventaitres', 'Noventaicuatro', 'Noventaicinco', 'Noventaiseis', 'Noventaisiete', 'Noventaiocho', 'Noventainueve', 'Cien');
$rutaima = "https://indesid.com/img/logo-indesid.svg";
$rutaver = "https://indesid.com/verified.php";
$rutaolv = "https://indesid.com/forgot.php";
$rutarel = "";
//Cabecera de Emails enviados
$firm  = "MIME-Version: 1.0" . "\r\n";
$firm .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$firm .= "From: " . odo_ENVI . "\r\n";
$firm .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$firm .= "Return-Path: " . odo_ENVI . "\r\n";
$firm .= "Reply-To: " . odo_ENVI . "\r\n";
$firm .= "CC: " . odo_ENVI . "\r\n";
//Quitar acentos, poner en minúsculas y quitar espacios
function acentos($string)
{
  $string = trim(strtolower($string));
  $string = str_replace(
    array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
    array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
    $string
  );
  $string = str_replace(
    array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
    array('e', 'e', 'e', 'e', 'e', 'e', 'e', 'e'),
    $string
  );
  $string = str_replace(
    array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
    array('i', 'i', 'i', 'i', 'i', 'i', 'i', 'i'),
    $string
  );
  $string = str_replace(
    array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
    array('o', 'o', 'o', 'o', 'o', 'o', 'o', 'o'),
    $string
  );
  $string = str_replace(
    array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
    array('u', 'u', 'u', 'u', 'u', 'u', 'u', 'u'),
    $string
  );
  $string = str_replace(
    array('ñ', 'Ñ', 'ç', 'Ç', ' '),
    array('n', 'n', 'c', 'c', '-'),
    $string
  );
  return $string;
}
//Genera claves aleatorias
function aleatoria($longpass)
{
  $alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-abcdefghijklmnopqrstuvwxyz";
  $stringer = "";
  for ($i = 0; $i < $longpass; $i++) {
    $stringer .= substr($alpha, rand(0, strlen($alpha)), 1);
  }
  return $stringer;
}
//Debuguear
function dd($var)
{
  echo "<pre>";
  var_dump($var);
  echo "</pre>";
  exit;
}
//Enviar email
function eemail($val_title = [], $val_pre_names = [], $val_pre_value = [], $val_foot = [])
{
  $val_body = array_combine($val_pre_names, $val_pre_value);
  $credits = "Indesid";
  $fondo = "https://www.indesid.com/img/email.png?i=" . micro();
  $logo = "https://www.indesid.com/img/logo-indesid.png?i=" . micro();
  $ehead = "
    <div style='color:#333!important;font-family:Arial,helvetica,sans-serif;'>
      <div style='max-width:780px;margin:2rem auto 1rem auto;'>
        <div style='background-color:#2e1180;padding:1.4rem 0;text-align:center;width:100%;'><img src='" . $logo . "' alt='Indesid'></div>
        <div style='background-image:url(" . $fondo . ");background-color:rgba(90, 193, 212, .25);background-position:center;background-size:cover;margin-top:0;'>
  ";
  $etitle = "
          <table style='width:100%;'>
            <tr>
              <td style='padding:2rem 2rem 0.5rem 2rem;'>
                <h3 style='color:#111!important;font-size:1.2rem;line-height:1.2;margin:0;text-align:center;width:100%;'>" . $val_title[0] . "</h3>
                <p style='color:#333!important;font-size:0.9rem;margin:0.5rem 0;'>" . $val_title[1] . "</p>
              </td>
            </tr>
            <tr>
              <td>
                <table border='0' cellpadding='2' cellmargin='0' align='center' style='border-collapse:collapse;margin-bottom:2rem;width:100%;'>
            ";
  $ebody = "";
  foreach ($val_body as $k => $v) {
    $ebody .= "
                  <tr>
                      <td style='color:#222!important;font-size:0.75rem;text-align:right;vertical-align:top;'>" . $k . "</td>
                      <td style='color:#444!important;font-size:0.75rem;font-weight:bold;width:50%;'>" . $v . "</td>
                  </tr>
    ";
  }
  $efoot = "
                </table>
              </td>
            </tr>
          </table>
        </div>
        <footer style='padding:1.6rem 3rem 2.4rem 3rem;background-color:#282828;color:#ddd'>
          <table style='width:100%;'>
            <tr>
              <td style='text-align:center;'>
                <p style='color:#aaa!important;font-size:0.875rem;line-height:1.4'>" . $val_foot[0] . "</p>
              </td>
            </tr>
            <tr>
              <td style='text-align:center;'>
                <h4 style='color:#ccc!important;font-size:1rem;margin:0.6rem 0 0.2rem 0;'>Puedes escribirnos al email</h4>
                <h2 style='color:#7cc7cf!important;font-size:1.5rem;margin:0.2rem 0;'><a href='mailto:" . odo_ENVI . "' style='color:#7cc7cf!important;text-decoration:none;'>" . odo_ENVI . "</a></h2>
              </td>
            </tr>
          </table>
          <div style='color:#aaa;text-align:center;width:100%;margin-top:10px;'>Ingresa a nuestra página web haciendo <a href='https://www.indesid.com/' style='text-decoration:none;color:#ccc' onMouseOver='this.style.color=`#7cc7cf`' onMouseOut='this.style.color=`#ccc`' target='_blank'>CLICK AQUÍ</a></div>
        </footer>
        <p style='color:#999!important;font-size:0.5rem;text-align:center;'>" . $credits . "</p>
      </div>
  ";
  $todo = $ehead . $etitle . $ebody . $efoot;
  return $todo;
}
//Separa email en partes para enviarlo
function preEmail($correo)
{
  $sep = explode('@', $correo);
  $pto = explode('.', $sep[1]);
  $cor = '<span style="color:#333!important;">' . $sep[0] . '</span><span>&#64;</span><span>' . $pto[0] . '</span><span>&#46;</span><span>' . $pto[1] . '</span>';
  return $cor;
}
//Resalta palabras
function highlightWords($text, $word)
{
  $text = preg_replace('#' . preg_quote($word) . '#i', '<span class="highlight">\0</span>', $text);
  return $text;
}
//Tiempo
function micro()
{
  $m = md5(substr(microtime(), 0, 9));
  return $m;
}
//URLs amigables
function uri($string, $separator = '-')
{
  $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|Grave|lig|orn|ring|slash|th|tilde|uml);~i';
  $special_cases = array('&' => 'and', "'" => '');
  $string = mb_strtolower(trim($string), 'utf-8');
  $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
  $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'utf-8'));
  $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
  $string = preg_replace("/[$separator]+/u", "$separator", $string);
  return $string;
}
//Ventana Modal
function vmodalsm($mid, $mtitulo, $tamano, $mvariable)
{
  //id, modal-lg, title, id-script
  $ventanasm = '<div id="' . $mid . '" class="modal" tabindex="-1" aria-labelledby="ventanaModal" aria-hidden="true">
    <div class="modal-dialog ' . $tamano . ' modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">' . $mtitulo . '</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="' . $mvariable . '"></div>
      </div>
    </div>
  </div>';
  return $ventanasm;
}
//Agrega ceros antes
function zero($valor, $long = 0)
{
  return str_pad($valor, $long, '0', STR_PAD_LEFT);
}
