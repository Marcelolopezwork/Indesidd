<?php
//GENERAR NUEVA CONTRASEÑA
require 'cfg.inc.php';
$dndtoy = 17;

if ((isset($_GET['e'])) && (isset($_GET['h'])) && (isset($_GET['t']))) {
  if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
  if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
  if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";

  $both = true;
  $buscador = false;

  if (!empty($_GET['o'])) $olv = $_GET['o'];
  else $olv = 0;

  if ($_GET['t'] == 'b') {
    $tipo = 'U';
    $land = 'cambiar.php';
  } elseif ($_GET['t'] == 'q') {
    $tipo = 'P';
    $land = 'cambiar-pro.php';
  } else {
    $tipo = 'G';
    $land = 'index.php';
  }

  $email = base64_decode($_GET['e']);
  $hash = base64_decode($_GET['h']);

  $query = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = '$email' AND verificado = '1' AND hash = '$hash' AND tipo = '$tipo' AND estado = 'A') ORDER BY id ";
  $result = $mysqli->query($query);
  $cierto = $result->num_rows;

  unset($_GET['t']);
  unset($_GET['e']);
  unset($_GET['h']);

  if ($cierto == 1) {
    $quien = $result->fetch_assoc();
    $nombre = ucwords(strtolower($quien['nombres']));
    include 'header.php';
?>

    <body class="stretched">
      <div id="wrapper" class="clearfix">
        <?php /* MENÚ */ ?>
        <header id="header" class="full-header dark">
          <div id="header-wrap" class="header-size-sm">
            <div class="container">
              <div class="header-row">
                <div id="logo">
                  <a href="index.php"><img src="img/logo-indesid.svg" alt="Logo Indesid"></a>
                </div>
                <div id="primary-menu-trigger">
                  <svg class="svg-trigger" viewBox="0 0 100 100">
                    <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                    <path d="m 30,50 h 40"></path>
                    <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="header-wrap-clone"></div>
        </header>
        <?php /* CONTENIDO */ ?>
        <section id="content">
          <div class="content-wrap bg-light pb-5">
            <div class="container clearfix">
              <h2 class="mb-0">Muchas gracias <span class="text-secondary"><?php echo $nombre; ?></span></h2>
              <p>Hemos verificado su solicitud de cambio de contraseña</p>
            </div>
            <div class="d-flex justify-content-center h-75 m-4 p-4">
              <form action="passport.php" method="post" name="cambiarcc" class="mb-0">
                <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                <input type="hidden" name="olv" value="<?php echo $olv; ?>">
                <input type="hidden" name="who" value="<?php echo base64_encode($quien['id']); ?>">
                <?php if ($tipo == 'U') { ?>
                  <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
                <?php } else { ?>
                  <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                <?php } ?>
                <h3 class="mb-0"><span class="h3-text-blue">Restablecer la</span> contraseña</h3>
                <div class="form-group">
                  <div class="text-left mb-1">
                    <label class="w-100" for="pass">Contraseña nueva<span class="float-right" id="npassError"></span></label>
                    <input class="form-control" id="npass" name="npass" placeholder="Escriba su nueva contraseña" tabindex="1" type="password">
                    <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#npass');"></i>
                  </div>
                  <button type="submit" class="button button-blue button-rounded ml-0 w-100" tabindex="2"><i class="icon-line-reload"></i><span>Restablecer</span></button>
                </div>
              </form>
            </div>
          </div>
        </section>
        <?php include 'footer.php'; ?>
      </div>
      <div id="gotoTop" class="icon-line-chevron-up"></div>
      <?php require 'scripts.php'; ?>
      <script>
        <?php /*Verificar campos del formulario*/ ?>
        $("#npass").focus();

        function _0x17f7(_0x43bd87, _0x2bd3f6) {
          var _0x1c26c6 = _0x1c26();
          return _0x17f7 = function(_0x17f7c0, _0x3ee80c) {
            _0x17f7c0 = _0x17f7c0 - 0x89;
            var _0x3d3ec0 = _0x1c26c6[_0x17f7c0];
            return _0x3d3ec0;
          }, _0x17f7(_0x43bd87, _0x2bd3f6);
        }
        var _0x285279 = _0x17f7;

        function _0x1c26() {
          var _0x54bedc = ['toggleClass', 'attr', 'validate', 'hasClass', '1118711lUbDaz', '8kLJRKd', '2234246bxOWzQ', '#npassError', '551nHrtgQ', 'password', 'npass', 'submit', '12RtjZeJ', '85dblyEM', 'validator', '20fhMuVQ', '1053akjFVw', '2096BPLMNv', 'form[name=\x27cambiarcc\x27]', 'appendTo', '2383695PbfGED', '2076csgWkA', '4040543dTdqPp', 'name', '810RcpfkS', 'icon-line-eye-off'];
          _0x1c26 = function() {
            return _0x54bedc;
          };
          return _0x1c26();
        }(function(_0x52c050, _0x1c50dc) {
          var _0x2923b9 = _0x17f7,
            _0x19ea75 = _0x52c050();
          while (!![]) {
            try {
              var _0x1f7d3d = parseInt(_0x2923b9(0x8d)) / 0x1 * (parseInt(_0x2923b9(0x9d)) / 0x2) + parseInt(_0x2923b9(0x95)) / 0x3 * (-parseInt(_0x2923b9(0x96)) / 0x4) + parseInt(_0x2923b9(0x92)) / 0x5 * (-parseInt(_0x2923b9(0x9a)) / 0x6) + parseInt(_0x2923b9(0x8b)) / 0x7 + -parseInt(_0x2923b9(0x8a)) / 0x8 * (parseInt(_0x2923b9(0x99)) / 0x9) + -parseInt(_0x2923b9(0x94)) / 0xa * (parseInt(_0x2923b9(0x89)) / 0xb) + -parseInt(_0x2923b9(0x91)) / 0xc * (-parseInt(_0x2923b9(0x9b)) / 0xd);
              if (_0x1f7d3d === _0x1c50dc) break;
              else _0x19ea75['push'](_0x19ea75['shift']());
            } catch (_0x8e86d4) {
              _0x19ea75['push'](_0x19ea75['shift']());
            }
          }
        }(_0x1c26, 0x2fa09), jQuery[_0x285279(0x93)]['setDefaults']({
          'errorPlacement': function(_0x5c66eb, _0x586251) {
            var _0x148e02 = _0x285279;
            if (_0x586251[_0x148e02(0xa0)](_0x148e02(0x9c)) == _0x148e02(0x8f)) _0x5c66eb[_0x148e02(0x98)](_0x148e02(0x8c));
          }
        }), $(function() {
          var _0x2beb95 = _0x285279;
          $(_0x2beb95(0x97))[_0x2beb95(0xa1)]({
            'rules': {
              'npass': {
                'required': !![],
                'minlength': 0x5
              }
            },
            'messages': {
              'npass': {
                'required': 'No\x20puede\x20estar\x20en\x20blanco',
                'minlength': 'Mínimo\x206\x20caracteres'
              }
            },
            'submitHandler': function(_0x1a095f) {
              var _0x3e5369 = _0x2beb95;
              _0x1a095f[_0x3e5369(0x90)]();
            }
          });
        }));
      </script>
    </body>

    </html>
<?php
  } else {
    header('location:index.php');
  }
} else {
  header('location:index.php');
}
