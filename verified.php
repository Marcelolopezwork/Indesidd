<?php
//VERIFICAR HASH
@session_destroy();
require 'cfg.inc.php';
if ((!isset($_GET['e'])) or (!isset($_GET['h'])) or (!isset($_GET['n'])) or (!isset($_GET['t']))) {
  header('location:index.php');
} else {
  if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
  if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
  if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
  $dndtoy = 23;
  $buscador = false;
  $listo = false;
  if ($_GET['t'] == 'b') {
    $tipo = 'U'; //Alumno
    $land = 'perfil.php';
  } elseif ($_GET['t'] == 'q') {
    $tipo = 'P'; //Profesor
    $land = 'profesores.php';
  } else {
    $tipo = 'G'; //Cualquier otro intento
    $land = 'index.php';
  }
  $number = base64_decode($_GET['n']);
  $correo = base64_decode($_GET['e']);
  $hash = $_GET['h'];
  $query = "SELECT * FROM " . odo_DATA_USUA . " WHERE (correo = '$correo' AND verificado = '0' AND hash = '$hash' AND tipo = '$tipo' AND estado = 'P') ORDER BY id ";
  $result = $mysqli->query($query);
  $cierto = $result->num_rows;
  if ($cierto == 1) {
    $listo = true;
    $quien = $result->fetch_assoc();
    $nombre = ucwords(strtolower($quien['nombres']));
    //Si es alumno
    if ($tipo == 'U') {
      $qy = "UPDATE " . odo_DATA_USUA . " SET verificado = '1', hash = '000000000000000000x0', estado = 'A' WHERE id = '" . $quien['id'] . "' ";
      $rt = $mysqli->query($qy);
      $_SESSION['verid'] = "Hola! Ahora ya perteneces a nuestra comunidad! Gracias!";
      $_SESSION['vertype'] = "info";
      $_SESSION['vertitle'] = $nombre;
      //Si es profesor
    } elseif ($tipo == 'P') {
      $qy = "UPDATE " . odo_DATA_PROF . " SET rechazado = '" . $quien['id'] . "' WHERE id = '$number' ";
      $rt = $mysqli->query($qy);
      $qy = "UPDATE " . odo_DATA_USUA . " SET verificado = '1', hash = '000000000000000000x0' WHERE id = '" . $quien['id'] . "' ";
      $rt = $mysqli->query($qy);
      $_SESSION['verid'] = "Hola! Ya recibimos tu solicitud y la estamos evaluando. Nos comunicaremos contigo a la brevedad posible. Gracias!";
      $_SESSION['vertype'] = "info";
      $_SESSION['vertitle'] = $nombre;
    } else {
      $_SESSION['verid'] = "";
      $_SESSION['vertype'] = "";
      $_SESSION['vertitle'] = "";
    }
  } else {
    header('location:index.php');
  }
  unset($_GET['t']);
  unset($_GET['e']);
  unset($_GET['h']);
  include 'header.php';
?>

  <body class="stretched">
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header dark">
        <?php /* MENÚ */ ?>
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
              <nav class="primary-menu">
                <ul class="menu-container">
                  <li class="menu-item">
                    <button class="d-none d-lg-block button button-small button-light button-reveal button-rounded button-white text-right" onclick="window.location.href='cursos.php';"><i class="icon-line-paper-stack"></i><span>CURSOS</span></button>
                  </li>
                  <li class="menu-item">
                    <button class="d-none d-lg-block button button-aqua button-small button-reveal button-rounded text-right" onclick="window.location.href='profesores.php';"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="header-wrap-clone"></div>
      </header>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap bg-light pb-3">
          <div class="container clearfix">
            <h2 class="mb-1">Muchas gracias <?php echo $nombre; ?></h2>
            <p>Hemos verificado tu dirección de correo electrónico.<br>
          </div>
          <?php if ($tipo == 'U') { ?>
            <div class="align-content-center align-items-center d-flex flex-column justify-content-center h-75 pb-4 pt-2 px-4 topmargin">
              <form action="enter.php" method="post" name="ingresarweb" class="mb-0">
                <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
                <h3 class="mb-0"><span class="h3-text-blue">Inicia sesión</span> y se un especialista</h3>
                <div class="form-group">
                  <label for="user">Usuario<span id="userError"></span></label>
                  <input class="form-control" id="user" name="user" placeholder="Nombre de usuario" type="email">
                </div>
                <div class="form-group">
                  <label for="pass">Contraseña<span id="passError"></span></label>
                  <input class="form-control pass" id="pass" name="pass" placeholder="Contraseña" type="password">
                  <i class="float-right icon-line-eye mx-1 position-relative show-hide-eye togg"></i>
                </div>
                <div class="d-flex flex-column text-center">
                  <button type="submit" class="button button-blue button-rounded mt-1">Iniciar sesión</button>
                </div>
              </form>
            </div>
          <?php } else { ?>
            <div class="container clearfix">
              <p>Ahora que hemos verificado tu dirección de correo electrónico, vamos a revisar los datos de tu solicitud y nosotros nos pondremos en contacto contigo a la brevedad posible.</p>
              <button class="d-none d-lg-block button button-border button-reveal button-rounded button-small mx-auto text-right" onclick="window.location.href='index.php';"><i class="icon-line-log-in"></i><span>IR A LA PAGINA DE INICIO</span></button>
            </div>
          <?php } ?>
        </div>
      </section>
      <?php include 'footer.php'; ?>
    </div>
    <div id="gotoTop" class="icon-line-chevron-up"></div>
    <?php require 'scripts.php'; ?>
    <?php if ($tipo == 'U') { ?>
      <script>
        var _0x12fefa = _0x2541;

        function _0x2541(_0x5f13d8, _0x55084e) {
          var _0x29acaf = _0x29ac();
          return _0x2541 = function(_0x254151, _0x5b5830) {
            _0x254151 = _0x254151 - 0xae;
            var _0x11020b = _0x29acaf[_0x254151];
            return _0x11020b;
          }, _0x2541(_0x5f13d8, _0x55084e);
        }

        function _0x29ac() {
          var _0x2ed479 = ['482060JbsbZn', 'No\x20puede\x20estar\x20en\x20blanco', 'pass', '24355926FomCnc', 'name', '.pass', 'validator', 'text', 'Mínimo\x206\x20caracteres', 'appendTo', 'form[name=\x27ingresarweb\x27]', '758580zpFZZU', 'submit', '840CcKxxk', 'toggleClass', 'Ingrese\x20su\x20usuario', '7495494FxpOlV', '581SJpXTE', '1752928vUvESq', 'attr', '2666uOVQXe', 'icon-line-eye-off', '#userError', 'validate', '32024ArIWME', '#passError', 'user', 'password', 'type'];
          _0x29ac = function() {
            return _0x2ed479;
          };
          return _0x29ac();
        }(function(_0xb846e, _0x1449a2) {
          var _0x59e4bd = _0x2541,
            _0x13c1db = _0xb846e();
          while (!![]) {
            try {
              var _0x5e2c39 = parseInt(_0x59e4bd(0xb1)) / 0x1 + parseInt(_0x59e4bd(0xc5)) / 0x2 * (-parseInt(_0x59e4bd(0xbe)) / 0x3) + -parseInt(_0x59e4bd(0xc3)) / 0x4 + -parseInt(_0x59e4bd(0xbc)) / 0x5 + -parseInt(_0x59e4bd(0xc1)) / 0x6 + parseInt(_0x59e4bd(0xc2)) / 0x7 * (-parseInt(_0x59e4bd(0xc9)) / 0x8) + parseInt(_0x59e4bd(0xb4)) / 0x9;
              if (_0x5e2c39 === _0x1449a2) break;
              else _0x13c1db['push'](_0x13c1db['shift']());
            } catch (_0x4d8108) {
              _0x13c1db['push'](_0x13c1db['shift']());
            }
          }
        }(_0x29ac, 0x9d204), jQuery[_0x12fefa(0xb7)]['setDefaults']({
          'errorPlacement': function(_0x25c475, _0x2a640a) {
            var _0x17ba51 = _0x12fefa;
            if (_0x2a640a[_0x17ba51(0xc4)](_0x17ba51(0xb5)) == _0x17ba51(0xae)) _0x25c475[_0x17ba51(0xba)](_0x17ba51(0xc7));
            if (_0x2a640a[_0x17ba51(0xc4)](_0x17ba51(0xb5)) == _0x17ba51(0xb3)) _0x25c475[_0x17ba51(0xba)](_0x17ba51(0xca));
          }
        }), $(function() {
          var _0x3c9aae = _0x12fefa;
          $(_0x3c9aae(0xbb))[_0x3c9aae(0xc8)]({
            'rules': {
              'user': {
                'required': !![],
                'email': !![]
              },
              'pass': {
                'required': !![],
                'minlength': 0x5
              }
            },
            'messages': {
              'user': {
                'required': _0x3c9aae(0xc0),
                'email': 'Por\x20favor\x20ingrese\x20una\x20dirección\x20de\x20correo\x20válida'
              },
              'pass': {
                'required': _0x3c9aae(0xb2),
                'minlength': _0x3c9aae(0xb9)
              }
            },
            'submitHandler': function(_0x4e9c33) {
              var _0x574211 = _0x3c9aae;
              _0x4e9c33[_0x574211(0xbd)]();
            }
          });
        }));
      </script>
    <?php } ?>
  </body>

  </html>
<?php
  session_unset();
  session_destroy();
}
?>