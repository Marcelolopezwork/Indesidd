<?php
//ALUMNO OLVIDO CONTRASEÑA
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) {
  header('location:index.php');
} else {
  $dndtoy = 8;

  if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
  if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
  if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
  include 'header.php';
  if ($_GET) {
    if ($_GET['q'] == "u") {
?>
      <?php /* ALUMNOS */ ?>

      <body class="stretched">
        <div id="wrapper" class="clearfix">
          <?php /* MENÚ */ ?>
          <header id="header" class="full-header">
            <div id="header-wrap">
              <div class="container">
                <div class="header-row">
                  <div id="logo">
                    <a href="index.php" class="py-2"><img src="img/logo-indesid-dark.svg" alt="Logo Indesid"></a>
                  </div>
                  <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                      <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                      <path d="m 30,50 h 40"></path>
                      <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                    </svg>
                  </div>
                  <nav class="primary-menu menu-spacing-margin">
                    <ul class="menu-container">
                      <li class="menu-item">
                        <button class="button button-blue button-rounded button-small" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>REGISTRATE</span></button>
                      </li>
                      <li class="menu-item">
                        <button class="button button-border button-rounded button-small" onclick="window.location.href='ingreso.php';"><i class="icon-line-log-in"></i><span>INICIA SESION</span></button>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <div class="header-wrap-clone"></div>
          </header>
          <div id="content" class="align-content-center align-items-center d-flex flex-column justify-content-center h-75 p-4 topmargin">
            <form action="forget.php" method="post" name="olvidarweb" class="mb-0">
              <input type="hidden" name="cookie" value="<?php echo md5(micro()); ?>">
              <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
              <?php
              require_once 'geoplugin.class.php';
              $geoplugin = new geoPlugin();
              $geoplugin->locate();
              $vip = $geoplugin->ip;
              $vcity = $geoplugin->city;
              $vcountry = $geoplugin->countryName;
              ?>
              <input type="hidden" name="vip" value="<?php echo $vip; ?>">
              <input type="hidden" name="vci" value="<?php echo $vcity; ?>">
              <input type="hidden" name="vco" value="<?php echo $vcountry; ?>">
              <h3 class="mb-0"><span class="h3-text-blue">Olvidaste</span> tu contraseña</h3>
              <p class="mb-2 mt-0 px-3">Si has olvidado tu contraseña, no te preocupes te<br>enviaremos un correo electrónico con las<br>instrucciones necesarias para generar una nueva.</p>
              <div class="form-group">
                <label for="user" class="w-100">Email<span class="text-danger">*</span><span id="userError" class="float-right"></span></label>
                <input autocomplete="off" class="form-control" id="user" required name="user" placeholder="Correo electrónico" type="email" tabindex="1">
              </div>
              <div class="d-flex flex-column text-center">
                <button type="submit" class="button button-blue button-rounded mt-1" tabindex="2">Restablecer contraseña</button>
              </div>
            </form>
            <div class="text-center">
              <p>¿Aún no has creado una cuenta?&nbsp;&nbsp;&nbsp;<button class="bg-transparent border-0 ml-n2 text-left" onclick="window.location.href='registro.php';"><span class="link">Regístrate gratis</span></button></p>
            </div>
          </div>
          <?php include 'footer.php'; ?>
        </div>
        <div id="gotoTop" class="icon-line-chevron-up"></div>
        <?php require 'scripts.php'; ?>
        <script>
          function _0x32a9() {
            var _0x3f6b0c = ['validate', '20pfjCnb', '487030rQPDiL', '394950XdMbig', '5RrbVpL', 'appendTo', '3303464nPKrSd', '50wGxKQt', 'setDefaults', 'validator', '2394728ctGxsG', '698706CaepPp', 'user', '#userError', 'attr', '367101bvjeQh', 'No\x20puede\x20estar\x20en\x20blanco', '3965268bdzSFe'];
            _0x32a9 = function() {
              return _0x3f6b0c;
            };
            return _0x32a9();
          }

          function _0x5ae4(_0x58d88c, _0x1df518) {
            var _0x32a932 = _0x32a9();
            return _0x5ae4 = function(_0x5ae447, _0x1af6aa) {
              _0x5ae447 = _0x5ae447 - 0x186;
              var _0x2ad3eb = _0x32a932[_0x5ae447];
              return _0x2ad3eb;
            }, _0x5ae4(_0x58d88c, _0x1df518);
          }
          var _0x280ab6 = _0x5ae4;
          (function(_0x3d6b8f, _0x45dbe6) {
            var _0x5c4609 = _0x5ae4,
              _0x2266fc = _0x3d6b8f();
            while (!![]) {
              try {
                var _0x1ffdc3 = -parseInt(_0x5c4609(0x190)) / 0x1 + -parseInt(_0x5c4609(0x187)) / 0x2 + -parseInt(_0x5c4609(0x191)) / 0x3 * (-parseInt(_0x5c4609(0x18f)) / 0x4) + -parseInt(_0x5c4609(0x192)) / 0x5 * (-parseInt(_0x5c4609(0x18d)) / 0x6) + -parseInt(_0x5c4609(0x186)) / 0x7 + parseInt(_0x5c4609(0x194)) / 0x8 + parseInt(_0x5c4609(0x18b)) / 0x9 * (-parseInt(_0x5c4609(0x195)) / 0xa);
                if (_0x1ffdc3 === _0x45dbe6) break;
                else _0x2266fc['push'](_0x2266fc['shift']());
              } catch (_0x491d50) {
                _0x2266fc['push'](_0x2266fc['shift']());
              }
            }
          }(_0x32a9, 0x555bd), jQuery[_0x280ab6(0x197)][_0x280ab6(0x196)]({
            'errorPlacement': function(_0x25645f, _0x1d9ea0) {
              var _0x2e000e = _0x280ab6;
              if (_0x1d9ea0[_0x2e000e(0x18a)]('name') == _0x2e000e(0x188)) _0x25645f[_0x2e000e(0x193)](_0x2e000e(0x189));
            }
          }), $(function() {
            var _0x995617 = _0x280ab6;
            $('form[name=\x27olvidarweb\x27]')[_0x995617(0x18e)]({
              'rules': {
                'user': {
                  'required': !![],
                  'email': !![]
                }
              },
              'messages': {
                'user': {
                  'required': _0x995617(0x18c),
                  'email': 'Ingrese\x20una\x20dirección\x20de\x20correo\x20válida'
                }
              },
              'submitHandler': function(_0xdde50e) {
                _0xdde50e['submit']();
              }
            });
          }));
        </script>
        <?php include 'notify.php'; ?>
      </body>
    <?php
    } else {
      $pro = true;
    ?>
      <?php /* PROFESORES */ ?>

      <body class="stretched">
        <div id="wrapper" class="clearfix">
          <?php /* MENÚ */ ?>
          <header id="header" class="full-header">
            <div id="header-wrap">
              <div class="container">
                <div class="header-row">
                  <div id="logo">
                    <a href="index.php" class="py-2"><img src="img/logo-indesid-dark.svg" alt="Logo Indesid"></a>
                  </div>
                  <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                      <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                      <path d="m 30,50 h 40"></path>
                      <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                    </svg>
                  </div>
                  <nav class="primary-menu menu-spacing-margin">
                    <ul class="menu-container">
                      <li class="menu-item">
                        <button class="button button-aqua button-border button-rounded button-small" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i><span>POSTULATE</span></button>
                      </li>
                      <li class="menu-item">
                        <button class="button button-border button-rounded button-small" onclick="window.location.href='ingreso-pro.php';"><i class="icon-line-log-in"></i><span>INICIA SESION</span></button>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <div class="header-wrap-clone"></div>
          </header>
          <div id="content" class="align-content-center align-items-center d-flex flex-column justify-content-center h-75 p-4 topmargin">
            <form action="forget.php" method="post" name="olvidarweb" class="mb-0">
              <input type="hidden" name="cookie" value="<?php echo md5(micro()); ?>">
              <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
              <?php
              require_once 'geoplugin.class.php';
              $geoplugin = new geoPlugin();
              $geoplugin->locate();
              $vip = $geoplugin->ip;
              $vcity = $geoplugin->city;
              $vcountry = $geoplugin->countryName;
              ?>
              <input type="hidden" name="vip" value="<?php echo $vip; ?>">
              <input type="hidden" name="vci" value="<?php echo $vcity; ?>">
              <input type="hidden" name="vco" value="<?php echo $vcountry; ?>">
              <h3 class="mb-0"><span class="h3-text-aqua">Olvidaste</span> tu contraseña</h3>
              <p class="mb-2 mt-0 px-3">Si has olvidado tu contraseña, no te preocupes te<br>enviaremos un correo electrónico con las<br>instrucciones necesarias para generar una nueva.</p>
              <div class="form-group">
                <label for="user" class="w-100">Email<span class="text-danger">*</span><span id="userError" class="float-right"></span></label>
                <input autocomplete="off" class="form-control" id="user" name="user" placeholder="Correo electrónico" required type="email" tabindex="1">
              </div>
              <div class="d-flex flex-column text-center">
                <button class="button button-aqua button-rounded mt-1" tabindex="2" type="submit">Restablecer contraseña</button>
              </div>
            </form>
            <div class="text-center">
              <p>¿Eres nuevo aún?&nbsp;&nbsp;&nbsp;<button class="bg-transparent border-0 ml-n2 text-left" onclick="window.location.href='registro-pro.php';"><span class="link-pro">Postúlate</span></button></p>
            </div>
          </div>
          <?php include 'footer.php'; ?>
        </div>
        <div id="gotoTop" class="icon-line-chevron-up"></div>
        <?php require 'scripts.php'; ?>
        <script>
          function _0x337e() {
            var _0x32fed8 = ['300648QFFyWx', 'validate', 'Ingrese\x20su\x20usuario', '75uzuwIx', 'appendTo', '565018vtynha', '1140249NKNcoa', '2514659iznXQf', 'attr', 'Ingrese\x20una\x20dirección\x20de\x20correo\x20válida', 'name', '#userError', '206292AUVBQl', 'submit', '1282297XdjHrP', '17490808uXQtDi'];
            _0x337e = function() {
              return _0x32fed8;
            };
            return _0x337e();
          }

          function _0x348b(_0x5a9890, _0x340d1d) {
            var _0x337e34 = _0x337e();
            return _0x348b = function(_0x348b52, _0x3a2007) {
              _0x348b52 = _0x348b52 - 0x10f;
              var _0x452fc6 = _0x337e34[_0x348b52];
              return _0x452fc6;
            }, _0x348b(_0x5a9890, _0x340d1d);
          }(function(_0x567ae3, _0x158873) {
            var _0x3745b5 = _0x348b,
              _0x3120af = _0x567ae3();
            while (!![]) {
              try {
                var _0x4ef0d3 = -parseInt(_0x3745b5(0x11b)) / 0x1 + parseInt(_0x3745b5(0x112)) / 0x2 + -parseInt(_0x3745b5(0x113)) / 0x3 + parseInt(_0x3745b5(0x11d)) / 0x4 + -parseInt(_0x3745b5(0x110)) / 0x5 * (parseInt(_0x3745b5(0x119)) / 0x6) + parseInt(_0x3745b5(0x114)) / 0x7 + parseInt(_0x3745b5(0x11c)) / 0x8;
                if (_0x4ef0d3 === _0x158873) break;
                else _0x3120af['push'](_0x3120af['shift']());
              } catch (_0xabcfd0) {
                _0x3120af['push'](_0x3120af['shift']());
              }
            }
          }(_0x337e, 0xb109d), $(function() {
            var _0x300f9a = _0x348b;
            $('form[name=\x27olvidarweb\x27]')[_0x300f9a(0x11e)]({
              'rules': {
                'user': {
                  'required': !![],
                  'email': !![]
                }
              },
              'messages': {
                'user': {
                  'required': _0x300f9a(0x10f),
                  'email': _0x300f9a(0x116)
                }
              },
              'errorPlacement': function(_0x510219, _0x519bdf) {
                var _0x3bb975 = _0x300f9a;
                if (_0x519bdf[_0x3bb975(0x115)](_0x3bb975(0x117)) == 'user') _0x510219[_0x3bb975(0x111)](_0x3bb975(0x118));
              },
              'submitHandler': function(_0x4ffd70) {
                var _0x2397ab = _0x300f9a;
                _0x4ffd70[_0x2397ab(0x11a)]();
              }
            });
          }));
        </script>
        <?php include 'notify.php'; ?>
      </body>
    <?php
    }
    ?>

    </html>
<?php
  } else {
    header('location:index.php');
  }
}
