<?php
//INGRESO AL SISTEMA PROFESORES
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) header('location:index.php');
if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
$dndtoy = 4;
$pro = true;
$pdf = true;
include 'header.php';
?>

<body class="stretched">
  <div id="wrapper" class="clearfix">
    <?php /* MENÚ */ ?>
    <header id="header" class="full-header dark">
      <div id="header-wrap">
        <div class="container">
          <div class="header-row">
            <div id="logo">
              <a href="index.php" class="py-2"><img src="img/logo-indesid.svg" alt="Logo Indesid"></a>
            </div>
            <nav class="primary-menu menu-spacing-margin">
              <ul class="menu-container">
                <li class="menu-item">
                  <button class="button button-rounded button-small button-aqua" onclick="window.location.href='profesores.php';"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
                </li>
                <li class="menu-item">
                  <button class="button button-aqua button-border button-rounded button-small" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i><span>POSTULATE</span></button>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="header-wrap-clone"></div>
    </header>
    <div id="content" class="align-content-center align-items-center d-flex flex-column justify-content-center h-75 p-4 topmargin">
      <h3 class="mb-0">Inicia sesión <span class="h3-text-aqua">como profesor</span></h3>
      <p class="text-center mt-0">Si eres alumno, <button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='ingreso.php';"><span class="link">haz click aquí</span></button></p>
      <form action="enter.php" method="post" name="ingresarweb" class="mb-0">
        <input type="hidden" name="cookie" value="<?php echo md5(micro()); ?>">
        <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
        <div class="form-group">
          <label for="user" class="w-100">Usuario<span class="text-danger">*</span><span id="userError" class="float-right"></span></label>
          <input class="form-control" id="user" name="user" placeholder="Nombre de usuario" required tabindex="1" type="email">
        </div>
        <div class="form-group">
          <label for="pass" class="w-100">Contraseña<span class="text-danger">*</span><span id="passError" class="float-right"></span></label><?php /* autocomplete="new-password" */ ?>
          <input class="form-control" id="pass" name="pass" placeholder="Contraseña" required tabindex="2" type="password">
          <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#pass');"></i>
        </div>
        <div class="form-check mb-3 text-center">
          <input type="checkbox" required class="form-check-input" checked name="cond" tabindex="3">
          <label class="form-check-label" for="cond"><a href="condiciones" class="text-secondary" data-cg="condiciones" data-toggle="modal" data-target="#generales" title="Condiciones generales">Acepto las Condiciones Generales</a></label>
          <div id="condError"></div>
        </div>
        <div class="d-flex flex-column text-center">
          <button class="button button-aqua button-rounded mt-1" tabindex="4" type="submit"><i class="icon-line-log-in"></i><span>INICIAR SESION</span></button>
        </div>
      </form>
      <div class="text-center">
        <p class="my-0"><button class="bg-transparent border-0 text-left" onclick="window.location.href='olvido.php?q=p';"><span class="link-pro">¿Olvidaste tu contraseña?</span></button></p>
        <p>¿Eres nuevo aún?&nbsp;&nbsp;<button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='registro-pro.php';"><span class="link-pro">Postúlate</span></button></p>
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
    PDFObject.embed("pdf/270720_CCGG_Profesorxs.pdf", "#condicion");
  </script>
  <script>
    $("#user").focus();

    function _0x3aa1(_0x51d35a, _0x2b5e1e) {
      var _0x28acac = _0x28ac();
      return _0x3aa1 = function(_0x3aa11e, _0xe48870) {
        _0x3aa11e = _0x3aa11e - 0x13a;
        var _0x5a5bdb = _0x28acac[_0x3aa11e];
        return _0x5a5bdb;
      }, _0x3aa1(_0x51d35a, _0x2b5e1e);
    }

    function _0x28ac() {
      var _0x33c7c7 = ['1fLBqYH', '215DruxTZ', 'submit', '1403274BrKwCi', 'pass', 'Ingrese\x20su\x20usuario', '15554JOQWWW', 'cond', 'attr', 'form[name=\x27ingresarweb\x27]', 'type', 'name', '1817364vVXFsI', '100449BiTscY', '732SJKCoV', '304KuyfKg', 'icon-line-eye-off', '1638579lzdOtk', 'appendTo', '#userError', '#passError', 'validate', '220hZyAbt', 'No\x20puede\x20estar\x20en\x20blanco', 'password', '388498knSNcZ', 'Ingrese\x20un\x20email\x20válido', '#condError', '#pass', '91036sQWZXz'];
      _0x28ac = function() {
        return _0x33c7c7;
      };
      return _0x28ac();
    }(function(_0x52645a, _0x3ad1d0) {
      var _0x4ec654 = _0x3aa1,
        _0x60efba = _0x52645a();
      while (!![]) {
        try {
          var _0x240aad = parseInt(_0x4ec654(0x149)) / 0x1 * (parseInt(_0x4ec654(0x14c)) / 0x2) + parseInt(_0x4ec654(0x13c)) / 0x3 + -parseInt(_0x4ec654(0x148)) / 0x4 * (-parseInt(_0x4ec654(0x14a)) / 0x5) + parseInt(_0x4ec654(0x155)) / 0x6 + parseInt(_0x4ec654(0x14f)) / 0x7 * (-parseInt(_0x4ec654(0x13a)) / 0x8) + parseInt(_0x4ec654(0x156)) / 0x9 * (parseInt(_0x4ec654(0x141)) / 0xa) + parseInt(_0x4ec654(0x144)) / 0xb * (-parseInt(_0x4ec654(0x157)) / 0xc);
          if (_0x240aad === _0x3ad1d0) break;
          else _0x60efba['push'](_0x60efba['shift']());
        } catch (_0x597593) {
          _0x60efba['push'](_0x60efba['shift']());
        }
      }
    }(_0x28ac, 0x82e05), $(function() {
      var _0x3c6661 = _0x3aa1;
      $(_0x3c6661(0x152))[_0x3c6661(0x140)]({
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
            'required': _0x3c6661(0x14e),
            'email': _0x3c6661(0x145)
          },
          'pass': {
            'required': _0x3c6661(0x142)
          },
          'cond': {
            'required': 'Debe\x20aceptar\x20las\x20condiciones\x20generales'
          }
        },
        'errorPlacement': function(_0x233a30, _0x3ef668) {
          var _0x4f90b3 = _0x3c6661;
          if (_0x3ef668['attr'](_0x4f90b3(0x154)) == 'user') _0x233a30[_0x4f90b3(0x13d)](_0x4f90b3(0x13e));
          if (_0x3ef668[_0x4f90b3(0x151)](_0x4f90b3(0x154)) == _0x4f90b3(0x14d)) _0x233a30[_0x4f90b3(0x13d)](_0x4f90b3(0x13f));
          if (_0x3ef668[_0x4f90b3(0x151)](_0x4f90b3(0x154)) == _0x4f90b3(0x150)) _0x233a30[_0x4f90b3(0x13d)](_0x4f90b3(0x146));
        },
        'submitHandler': function(_0x31a014) {
          var _0x2dce67 = _0x3c6661;
          _0x31a014[_0x2dce67(0x14b)]();
        }
      });
    }));
  </script>
  <?php include 'notify.php'; ?>
</body>

</html>