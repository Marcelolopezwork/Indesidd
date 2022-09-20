<?php
//INGRESO AL SISTEMA
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) {
  header('location:index.php');
} else {
  if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
  if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
  if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
  $dndtoy = 5;
  $pdf = true;
  include 'header.php';
?>

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
              <nav class="primary-menu menu-spacing-margin">
                <ul class="menu-container">
                  <li class="menu-item">
                    <button class="button button-blue button-rounded button-small" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>REGISTRATE</span></button>
                  </li>
                  <li class="menu-item">
                    <button class="button button-border button-rounded button-small" onclick="window.location.href='index.php';"><i class="icon-line-home"></i><span>VOLVER AL INICIO</span></button>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="header-wrap-clone"></div>
      </header>
      <div id="content" class="align-content-center align-items-center d-flex flex-column justify-content-center h-75 p-4 topmargin">
        <h3 class="mb-0">Inicia sesión <span class="h3-text-blue">como alumno</span></h3>
        <p class="text-center mt-0">Si eres profesor registrado, <button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='ingreso-pro.php';"><span class="link-pro">haz click aquí</span></button></p>
        <form action="enter.php" method="post" name="ingresarweb" class="mb-0">
          <input type="hidden" name="cookie" value="<?php echo md5(micro()); ?>">
          <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
          <div class="form-group">
            <label for="user" class="w-100">Usuario<span class="text-danger">*</span><span id="userError" class="float-right"></span></label>
            <input class="form-control" id="user" name="user" placeholder="Nombre de usuario" required tabindex="1" type="email">
          </div>
          <div class="form-group">
            <label for="pass" class="w-100">Contraseña<span class="text-danger">*</span><span id="passError" class="float-right"></span></label>
            <input class="form-control" id="pass" name="pass" placeholder="Contraseña" required tabindex="2" type="password">
            <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#pass');"></i>
          </div>
          <div class="form-check mb-3 text-center">
            <input type="checkbox" required class="form-check-input" name="cond" checked tabindex="3">
            <label class="form-check-label" for="cond"><a href="condiciones" class="text-secondary" data-cg="condiciones" data-toggle="modal" data-target="#generales" title="Condiciones generales">Acepto las Condiciones Generales</a></label>
            <div id="condError"></div>
          </div>
          <div class="d-flex flex-column text-center">
            <button class="button button-blue button-rounded mt-1" tabindex="4" type="submit">INICIAR SESION</button>
          </div>
        </form>
        <div class="text-center">
          <p class="my-0"><button class="bg-transparent border-0 text-left" onclick="window.location.href='olvido.php?q=u';"><span class="link">¿Olvidaste tu contraseña?</span></button></p>
          <p>¿Aún no has creado una cuenta? <button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='registro.php';"><span class="link">Regístrate gratis</span></button></p>
        </div>
      </div>
      <?php /*Ventana modal */ ?>
      <div id="generales" class="modal dark" tabindex="-1" aria-labelledby="ventanaModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Condiciones Generales</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="condicion" class="pdf"></div>
            </div>
            <div class="modal-footer">
              <button class="button button-rounded button-small button-aqua" type="button" data-dismiss="modal" aria-label="Close">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <?php include 'footer.php'; ?>
    </div>
    <div id="gotoTop" class="icon-line-chevron-up"></div>
    <?php require 'scripts.php'; ?>
    <script>
      PDFObject.embed("pdf/270720_CCGG_Alumnxs.pdf", "#condicion");
    </script>
    <script>
      $("#user").focus();
      (function(_0x4d7600, _0xc6d9d7) {
        var _0x4bc580 = _0x25cb,
          _0x197cb0 = _0x4d7600();
        while (!![]) {
          try {
            var _0x28ab58 = parseInt(_0x4bc580(0x1ad)) / 0x1 + -parseInt(_0x4bc580(0x1ba)) / 0x2 * (-parseInt(_0x4bc580(0x19e)) / 0x3) + parseInt(_0x4bc580(0x1b5)) / 0x4 + -parseInt(_0x4bc580(0x1ac)) / 0x5 * (parseInt(_0x4bc580(0x19f)) / 0x6) + -parseInt(_0x4bc580(0x19d)) / 0x7 * (-parseInt(_0x4bc580(0x1a2)) / 0x8) + parseInt(_0x4bc580(0x1a4)) / 0x9 * (-parseInt(_0x4bc580(0x1af)) / 0xa) + parseInt(_0x4bc580(0x1a7)) / 0xb * (-parseInt(_0x4bc580(0x1a0)) / 0xc);
            if (_0x28ab58 === _0xc6d9d7) break;
            else _0x197cb0['push'](_0x197cb0['shift']());
          } catch (_0xbdef18) {
            _0x197cb0['push'](_0x197cb0['shift']());
          }
        }
      }(_0x44c1, 0xa996b), $(function() {
        var _0x29c2ec = _0x25cb;
        $(_0x29c2ec(0x1ab))[_0x29c2ec(0x1aa)]({
          'rules': {
            'user': {
              'required': !![],
              'email': !![]
            },
            'pass': {
              'required': !![]
            },
            'cond': {
              'required': !![]
            }
          },
          'messages': {
            'user': {
              'required': 'Ingrese\x20su\x20usuario',
              'email': _0x29c2ec(0x19c)
            },
            'pass': {
              'required': _0x29c2ec(0x1b1)
            },
            'cond': {
              'required': _0x29c2ec(0x1b9)
            }
          },
          'errorPlacement': function(_0x182955, _0xda7a66) {
            var _0x344762 = _0x29c2ec;
            if (_0xda7a66[_0x344762(0x1b0)](_0x344762(0x1a3)) == _0x344762(0x1a6)) _0x182955[_0x344762(0x1b6)](_0x344762(0x1b8));
            if (_0xda7a66['attr']('name') == 'pass') _0x182955[_0x344762(0x1b6)](_0x344762(0x1bb));
            if (_0xda7a66[_0x344762(0x1b0)](_0x344762(0x1a3)) == _0x344762(0x1ae)) _0x182955['appendTo']('#condError');
          },
          'submitHandler': function(_0x54f5f1) {
            var _0x274f86 = _0x29c2ec;
            _0x54f5f1[_0x274f86(0x1b7)]();
          }
        });
      }));

      function _0x44c1() {
        var _0x29a44b = ['password', 'hasClass', '5229880jwEvuI', 'appendTo', 'submit', '#userError', 'Debe\x20aceptar\x20las\x20condiciones\x20generales', '28IjctLz', '#passError', 'Ingrese\x20un\x20email\x20válido', '4333qamySP', '67884lZqJZk', '402MTAdjr', '153876gzhYKn', 'type', '1048rnStTb', 'name', '2934747LfxQvM', '#pass', 'user', '440RQfvBn', 'icon-line-eye-off', 'text', 'validate', 'form[name=\x27ingresarweb\x27]', '90795qqzhCh', '1044940kSqDpd', 'cond', '10VJRFBq', 'attr', 'No\x20puede\x20estar\x20en\x20blanco', 'toggleClass'];
        _0x44c1 = function() {
          return _0x29a44b;
        };
        return _0x44c1();
      }

      function _0x25cb(_0x4fec3d, _0x12582e) {
        var _0x44c151 = _0x44c1();
        return _0x25cb = function(_0x25cbad, _0x41a291) {
          _0x25cbad = _0x25cbad - 0x19c;
          var _0xbeef32 = _0x44c151[_0x25cbad];
          return _0xbeef32;
        }, _0x25cb(_0x4fec3d, _0x12582e);
      }
    </script>
    <?php include 'notify.php'; ?>
  </body>

  </html>
<?php
}
?>