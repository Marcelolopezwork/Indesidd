<?php
//REGISTRO AL SISTEMA
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) header('location:index.php');
if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
$dndtoy = 7;

$pro = true;
$numeric = true;
$select = true;
$telephone = true;

include 'header.php';
?>

<body class="stretched">
  <div id="wrapper" class="bg-light clearfix">
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
                  <button class="button button-border button-rounded button-small" onclick="window.location.href='ingreso.php';"><i class="icon-line-log-in"></i><span>INICIA SESION</span></button>
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
    <div id="content" class="bg-light container mx-auto p-4 topmargin">
      <h3 class="text-center mb-0"><span class="h3-text-blue">Regístrate</span> y se un especialista</h3>
      <div class="mb-3 small text-center"><span class="text-danger">*</span>Todos los campos son obligatorios</div>
      <form action="register.php" method="post" name="registroweb" class="container row">
        <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
        <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
        <div class="form-group col-12 col-lg-6">
          <label for="firstname" class="w-100">Nombres<span class="text-danger">*</span><span id="firstnameError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="firstname" minlength="2" name="firstname" placeholder="Nombres" required type="text" tabindex="1">
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="lastname" class="w-100">Apellidos<span class="text-danger">*</span><span id="lastnameError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="lastname" minlength="2" name="lastname" placeholder="Apellidos" required type="text" tabindex="2">
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="email" class="w-100">Email<span class="text-danger">*</span><span id="emailError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="email" name="email" placeholder="Correo electrónico" required type="email" tabindex="3">
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="pass" class="w-100">Contraseña<span class="text-danger">*</span><i class="added icon-line-help-circle" data-toggle="popover" data-content="La contraseña debe tener por lo menos 8 caracteres, al menos un número, una letra mayúscula y por lo menos uno de estos símbolos #$%^&()={*}.,:;+-_<>!" data-trigger="click"></i><span id="passError" class="float-right"></span></label>
          <input autocomplete="new-password" class="form-control" id="pass" minlength="8" name="pass" placeholder="Mínimo 8 caracteres" required type="password" tabindex="4">
          <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#pass');"></i>
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="phone" class="w-100">Teléfono<span class="text-danger">*</span><span id="phoneError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="phone" minlength="6" name="phone" placeholder="Número de teléfono" required type="tel" tabindex="5">
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="gender" class="w-100">Género<span class="text-danger">*</span><span id="genderError" class="float-right"></span></label>
          <select id="gender" name="gender" class="form-control selectpicker" required title="Indique género" tabindex="6">
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
          </select>
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="age" class="w-100">Edad<span class="text-danger">*</span><span id="ageError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="age" maxlength="2" minlength="2" name="age" placeholder="Edad" required type="text" tabindex="7">
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="category" class="w-100">Especialidad<span class="text-danger">*</span><span id="categoryError" class="float-right"></span></label>
          <select id="category" name="category" class="form-control selectpicker" required title="Indique especialidad" tabindex="8">
            <?php
            $pry = "SELECT * FROM " . odo_DATA_CATE . " ORDER BY categoria";
            $psl = $mysqli->query($pry);
            while ($cate = $psl->fetch_assoc()) {
            ?>
              <option value="<?php echo $cate['categoria']; ?>"><?php echo $cate['categoria']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="level" class="w-100">Nivel de Estudios<span class="text-danger">*</span><span id="levelError" class="float-right"></span></label>
          <select id="level" name="level" class="form-control selectpicker" required title="Indique nivel de estudios" tabindex="9">
            <?php
            $nry = "SELECT * FROM " . odo_DATA_NIVE . " ORDER BY nivel";
            $nsl = $mysqli->query($nry);
            while ($nive = $nsl->fetch_assoc()) {
            ?>
              <option value="<?php echo $nive['nivel']; ?>"><?php echo $nive['nivel']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group col-12 col-lg-6">
          <?php //Geolocalización
          require_once('geoplugin.class.php');
          $geoplugin = new geoPlugin();
          $geoplugin->locate();
          $codpais = $geoplugin->countryCode;
          ?>
          <label for="country" class="w-100">País<span class="text-danger">*</span><span id="countryError" class="float-right"></span></label>
          <select id="country" name="country" class="form-control selectpicker show-tick" data-live-search="true" data-size="3" tabindex="10" title="Indique país">
            <?php
            $pry = "SELECT * FROM " . odo_DATA_PAIS . " ORDER BY country";
            $psl = $mysqli->query($pry);
            while ($pais = $psl->fetch_assoc()) {
            ?>
              <option value="<?php echo $pais['iso']; ?>"><?php echo $pais['country']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="d-flex flex-column mx-auto">
          <button class="button button-blue button-rounded mt-1" tabindex="11" type="submit">Registrarse como Alumno</button>
          <p>¿Ya tienes una cuenta?&nbsp;&nbsp;<button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='ingreso.php';"><span class="link">Inicia sesión</span></button></p>
        </div>
      </form>
    </div>
    <?php include 'footer.php'; ?>
  </div>
  <div id="gotoTop" class="icon-line-chevron-up"></div>
  <?php require 'scripts.php'; ?>
  <script>
    $('#firstname').focus();
    $('#age').numerico();
    $('#phone').numerico();
    $('.selectpicker').selectpicker('val', '<?php echo $codpais; ?>');
    var _0x274e64 = _0x13fd;
    (function(_0x26690c, _0x3d87fc) {
      var _0x3672c7 = _0x13fd,
        _0x5092bc = _0x26690c();
      while (!![]) {
        try {
          var _0x44b6e7 = parseInt(_0x3672c7(0x186)) / 0x1 + parseInt(_0x3672c7(0x181)) / 0x2 + -parseInt(_0x3672c7(0x187)) / 0x3 + parseInt(_0x3672c7(0x173)) / 0x4 + parseInt(_0x3672c7(0x177)) / 0x5 * (parseInt(_0x3672c7(0x195)) / 0x6) + parseInt(_0x3672c7(0x178)) / 0x7 * (parseInt(_0x3672c7(0x193)) / 0x8) + -parseInt(_0x3672c7(0x170)) / 0x9;
          if (_0x44b6e7 === _0x3d87fc) break;
          else _0x5092bc['push'](_0x5092bc['shift']());
        } catch (_0x54d6c1) {
          _0x5092bc['push'](_0x5092bc['shift']());
        }
      }
    }(_0x2926, 0x43c46), $(_0x274e64(0x19a))[_0x274e64(0x17f)]({
      'hiddenInput': _0x274e64(0x16b),
      'initialCountry': _0x274e64(0x175),
      'allowDropdown': ![],
      'separateDialCode': !![],
      'utilsScript': _0x274e64(0x194),
      'geoIpLookup': function(_0x5aa9e8) {
        var _0x18d7dd = _0x274e64;
        $[_0x18d7dd(0x16d)]('https://ipinfo.io', function() {}, _0x18d7dd(0x168))[_0x18d7dd(0x19b)](function(_0x56bd52) {
          var _0x11baca = _0x18d7dd,
            _0x4d0027 = _0x56bd52 && _0x56bd52[_0x11baca(0x18c)] ? _0x56bd52['country'] : 'es';
          _0x5aa9e8(_0x4d0027);
        });
      }
    }), $(function() {
      var _0x17f475 = _0x274e64;
      $['validator'][_0x17f475(0x166)](_0x17f475(0x19f), function(_0x49dc95, _0x31236a) {
        var _0x8dc050 = _0x17f475;
        return this[_0x8dc050(0x196)](_0x31236a) || /^[a-z\s áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i [_0x8dc050(0x18f)](_0x49dc95);
      }, _0x17f475(0x19c)), $['validator']['addMethod'](_0x17f475(0x18d), function(_0x363e3f, _0x276cd6) {
        var _0x37d643 = _0x17f475;
        return this[_0x37d643(0x196)](_0x276cd6) || /^[a-zA-Z0-9!@#$%^&()={*};:\_\|,.<>+-]*$/i [_0x37d643(0x18f)](_0x363e3f) && /[A-Z]/ ['test'](_0x363e3f) && /[a-z]/ [_0x37d643(0x18f)](_0x363e3f) && /\d/i [_0x37d643(0x18f)](_0x363e3f) && /[!@#$%^&()={*};:\_\|,.<>+-]/i [_0x37d643(0x18f)](_0x363e3f);
      }, 'No\x20es\x20segura'), $(_0x17f475(0x16f))[_0x17f475(0x174)]({
        'rules': {
          'firstname': {
            'required': !![],
            'minlength': 0x2,
            'sololetras': !![]
          },
          'lastname': {
            'required': !![],
            'minlength': 0x2,
            'sololetras': !![]
          },
          'email': {
            'required': !![],
            'email': !![]
          },
          'pass': {
            'required': !![],
            'minlength': 0x8,
            'passeguro': !![]
          },
          'phone': {
            'required': !![],
            'minlength': 0x6
          },
          'gender': {
            'required': !![]
          },
          'age': {
            'required': !![],
            'maxlength': 0x2,
            'minlength': 0x2
          },
          'category': {
            'required': !![]
          },
          'level': {
            'required': !![]
          },
          'country': {
            'required': !![]
          }
        },
        'messages': {
          'firstname': {
            'required': _0x17f475(0x192),
            'minlength': _0x17f475(0x182)
          },
          'lastname': {
            'required': 'Ingrese\x20su\x20apellido',
            'minlength': 'Mínimo\x202\x20caracteres'
          },
          'email': {
            'required': _0x17f475(0x176),
            'email': _0x17f475(0x171)
          },
          'pass': {
            'required': _0x17f475(0x18b),
            'minlength': _0x17f475(0x198)
          },
          'phone': {
            'required': _0x17f475(0x1a0),
            'minlength': 'Mínimo\x206\x20dígitos'
          },
          'gender': {
            'required': _0x17f475(0x197)
          },
          'age': {
            'required': 'Ingrese\x20su\x20edad',
            'maxlength': 'Máximo\x202\x20dígitos',
            'minlenght': _0x17f475(0x183)
          },
          'category': {
            'required': _0x17f475(0x189)
          },
          'level': {
            'required': _0x17f475(0x19d)
          },
          'country': {
            'required': _0x17f475(0x18e)
          }
        },
        'errorPlacement': function(_0x2806a6, _0x3c41a9) {
          var _0x25a1ee = _0x17f475;
          if (_0x3c41a9['attr'](_0x25a1ee(0x185)) == _0x25a1ee(0x191)) _0x2806a6[_0x25a1ee(0x184)](_0x25a1ee(0x17c));
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == 'lastname') _0x2806a6['appendTo']('#lastnameError');
          if (_0x3c41a9['attr'](_0x25a1ee(0x185)) == _0x25a1ee(0x169)) _0x2806a6[_0x25a1ee(0x184)](_0x25a1ee(0x16a));
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == _0x25a1ee(0x199)) _0x2806a6[_0x25a1ee(0x184)]('#passError');
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == _0x25a1ee(0x16b)) _0x2806a6[_0x25a1ee(0x184)](_0x25a1ee(0x179));
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == 'gender') _0x2806a6[_0x25a1ee(0x184)](_0x25a1ee(0x172));
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == 'age') _0x2806a6[_0x25a1ee(0x184)]('#ageError');
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == _0x25a1ee(0x16c)) _0x2806a6[_0x25a1ee(0x184)]('#categoryError');
          if (_0x3c41a9['attr'](_0x25a1ee(0x185)) == _0x25a1ee(0x167)) _0x2806a6[_0x25a1ee(0x184)]('#levelError');
          if (_0x3c41a9[_0x25a1ee(0x180)](_0x25a1ee(0x185)) == 'country') _0x2806a6['appendTo'](_0x25a1ee(0x18a));
        },
        'submitHandler': function(_0xb1b91a) {
          var _0x1f9433 = _0x17f475;
          _0xb1b91a[_0x1f9433(0x17b)]();
        }
      });
    }));

    function _0x13fd(_0x1b2134, _0x3ea3ff) {
      var _0x2926fa = _0x2926();
      return _0x13fd = function(_0x13fd23, _0x3c807f) {
        _0x13fd23 = _0x13fd23 - 0x166;
        var _0x17c3c3 = _0x2926fa[_0x13fd23];
        return _0x17c3c3;
      }, _0x13fd(_0x1b2134, _0x3ea3ff);
    }

    function _0x2926() {
      var _0x4a981c = ['auto', 'Ingrese\x20su\x20email', '10hBPfRF', '1288kUdDnK', '#phoneError', 'text', 'submit', '#firstnameError', 'hasClass', 'icon-line-eye-off', 'intlTelInput', 'attr', '135542deBqHl', 'Mínimo\x202\x20caracteres', 'Mínimo\x202\x20dígitos', 'appendTo', 'name', '28220posyPU', '970617sGCpOV', 'password', 'Indique\x20su\x20especialidad', '#countryError', 'Ingrese\x20su\x20clave', 'country', 'passeguro', 'Indique\x20su\x20país', 'test', 'type', 'firstname', 'Ingrese\x20su\x20nombre', '10672MZgCYL', 'js/utils.min.js', '1385274jDDIQN', 'optional', 'Indique\x20su\x20género', 'Mínimo\x208', 'pass', '#phone', 'always', 'Sólo\x20letras', 'Indique\x20su\x20nivel\x20de\x20estudios', '#pass', 'sololetras', 'Ingrese\x20su\x20número', 'addMethod', 'level', 'jsonp', 'email', '#emailError', 'phone', 'category', 'get', 'toggleClass', 'form[name=\x27registroweb\x27]', '2491263WmKHKr', 'Email\x20no\x20válido', '#genderError', '298860vnwylT', 'validate'];
      _0x2926 = function() {
        return _0x4a981c;
      };
      return _0x2926();
    }
  </script>
  <?php include 'notify.php'; ?>
</body>

</html>