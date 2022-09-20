<?php
//REGISTRO DE PROFESORES PARA POSTULAR AL SISTEMA
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) header('location:index.php');
if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
$dndtoy = 6;

$pro = false;
$numeric = true;
$select = true;
$telephone = true;

include 'header.php';
?>

<body class="stretched">
  <div id="wrapper" class="bg-light clearfix">
    <?php /* MENÚ */ ?>
    <header id="header" class="full-header dark">
      <div id="header-wrap">
        <div class="container">
          <div class="header-row">
            <div id="logo">
              <a href="index.php" class="py-2"><img src="img/logo-indesid.svg" alt="Logo Indesid"></a>
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
                  <button class="button button-rounded button-small button-aqua" onclick="window.location.href='profesores.php';"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
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
    <div id="content" class="bg-light container mx-auto h-75 pb-4 px-4 pt-5">
      <h3 class="text-center mb-0">Postula y se parte del <span class="h3-text-aqua">staff de profesores</span></h3>
      <div class="mb-3 small text-center"><span class="text-danger">*</span>Todos los campos son obligatorios</div>
      <?php /* Formulario de registro para postular al staff de profesores */ ?>
      <form action="register.php" method="post" name="registroweb" class="container row">
        <input type="hidden" name="cookie" value="<?php echo md5(micro()); ?>">
        <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
        <div class="form-group col-12 col-lg-6">
          <label for="firstname" class="w-100">Nombres<span class="text-danger">*</span><span id="firstnameError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="firstname" name="firstname" placeholder="Nombres" required tabindex="1" type="text">
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="lastname" class="w-100">Apellidos<span class="text-danger">*</span><span id="lastnameError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required tabindex="2" type="text">
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="email" class="w-100">Email<span class="text-danger">*</span><span id="emailError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="email" name="email" placeholder="Email" required tabindex="3" type="email">
        </div>
        <div class="form-group col-12 col-lg-6">
          <label for="pass" class="w-100">Contraseña<span class="text-danger">*</span><i class="added icon-line-help-circle" data-toggle="popover" data-content="La contraseña debe tener por lo menos 8 caracteres, al menos un número, una letra mayúscula y por lo menos alguno de éstos símbolos #$%^&()={*}.,:;+-_<>!" data-trigger="click"></i><span id="passError" class="float-right"></span></label>
          <input autocomplete="new-password" class="form-control" id="pass" name="pass" minlength="8" placeholder="Contraseña" required tabindex="4" type="password">
          <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#pass');"></i>
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="phone" class="w-100">Teléfono<span class="text-danger">*</span><span id="phoneError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="phone" name="phone" minlength="6" placeholder="Número de teléfono" required tabindex="5" type="tel">
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="dni" class="w-100">Documento<span class="text-danger">*</span><span id="dniError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="dni" name="dni" placeholder="Documento de identidad" required tabindex="6" type="text">
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="gender" class="w-100">Género<span class="text-danger">*</span><span id="genderError" class="float-right"></span></label>
          <select id="gender" name="gender" class="form-control selectpicker" required tabindex="7" title="Indique género">
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
          </select>
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="age" class="w-100">Edad<span class="text-danger">*</span><span id="ageError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="age" maxlength="2" name="age" placeholder="Edad" required tabindex="8" type="text">
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="university" class="w-100">Universidad<span class="text-danger">*</span><span id="universityError" class="float-right"></span></label>
          <input autocomplete="off" class="form-control" id="university" name="university" placeholder="Universidad donde estudió" required tabindex="9" type="text">
        </div>
        <div class="form-group col-12 col-lg-3">
          <label for="category" class="w-100">Especialidad<span class="text-danger">*</span><span id="categoryError" class="float-right"></span></label>
          <select id="category" name="category" class="form-control selectpicker" required tabindex="10" title="Indique especialidad">
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
        <div class="form-group col-12 col-lg-3">
          <label for="level" class="w-100">Nivel de Estudios<span class="text-danger">*</span><span id="levelError" class="float-right"></span></label>
          <select id="level" name="level" class="form-control selectpicker" required tabindex="11" title="Indique nivel de estudios">
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
        <div class="form-group col-12 col-lg-3">
          <?php //Geolocalización
          require_once('geoplugin.class.php');
          $geoplugin = new geoPlugin();
          $geoplugin->locate();
          $codpais = $geoplugin->countryCode;
          ?>
          <label for="country" class="w-100">País<span class="text-danger">*</span><span id="countryError" class="float-right"></span></label>
          <select class="form-control selectpicker show-tick" data-live-search="true" data-size="3" id="country" name="country" required tabindex="12" title="Indique país">
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
        <div class="form-group col-12">
          <label for="aboutme" class="w-100">Acerca de mi<span class="text-danger">*</span><span id="aboutmeError" class="float-right"></span></label>
          <textarea autocomplete="off" class="form-control" id="aboutme" name="aboutme" placeholder="Cuéntanos algo sobre ti" required rows="3" tabindex="13"></textarea>
        </div>
        <div class="mx-auto text-center">
          <button class="button button-aqua button-rounded mt-1 px-5" tabindex="14" type="submit"><i class="icon-line-user-plus"></i><span>POSTULATE</span></button>
          <p class="mb-0 text-center">¿Ya eres parte del staff de profesores?&nbsp;&nbsp;<button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='ingreso-pro.php';"><span class="link-pro">Inicia sesión</span></button></p>
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
    var _0x2d4dde = _0x4483;

    function _0x59af() {
      var _0x46da8c = ['#ageError', '#passError', 'validate', 'attr', '#categoryError', 'Indique\x20su\x20género', '2631606MlCQeH', 'auto', 'name', 'Indique\x20su\x20nivel\x20de\x20estudios', '2JEtRgH', 'dni', 'type', 'icon-line-eye-off', '#genderError', 'DNI', 'https://ipinfo.io', 'lastname', 'Cuentános\x20algo\x20sobre\x20ti', '#universityError', 'Ingrese\x20su\x20correo\x20electrónico', 'Máximo\x202\x20dígitos', '#firstnameError', '#lastnameError', 'country', '5GXiEDB', 'Sólo\x20letras', 'Indique\x20su\x20especialidad', 'Mínimo\x208\x20caracteres', 'validator', 'Ingrese\x20su\x20edad', '23219ceFpxJ', '258268jNSRjk', '496IaOyPF', 'university', '#countryError', 'level', 'Mínimo\x206\x20dígitos', 'email', 'aboutme', 'text', 'No\x20puede\x20estar\x20en\x20blanco', 'phone', 'addMethod', 'pass', '2270376rfzoXF', '#phoneError', 'js/utils.min.js', 'firstname', 'No\x20es\x20segura', 'category', '1588124pBavVh', '#dniError', '#pass', 'Número\x20de\x20teléfono', 'jsonp', 'submit', '1143438kIfzKP', 'always', '10dVBope', 'Indique\x20por\x20favor\x20su\x20país\x20de\x20procedencia', 'test', 'passeguro', 'hasClass', 'sololetras', 'appendTo', '4473667RHmcmH', 'password', 'age', 'gender'];
      _0x59af = function() {
        return _0x46da8c;
      };
      return _0x59af();
    }

    function _0x4483(_0x42e0b6, _0x66c302) {
      var _0x59afed = _0x59af();
      return _0x4483 = function(_0x448306, _0x10a738) {
        _0x448306 = _0x448306 - 0x1ca;
        var _0x29377b = _0x59afed[_0x448306];
        return _0x29377b;
      }, _0x4483(_0x42e0b6, _0x66c302);
    }(function(_0x2cd618, _0x337a80) {
      var _0x12fb64 = _0x4483,
        _0x23d5f1 = _0x2cd618();
      while (!![]) {
        try {
          var _0x2df3e8 = parseInt(_0x12fb64(0x1d2)) / 0x1 * (parseInt(_0x12fb64(0x202)) / 0x2) + parseInt(_0x12fb64(0x1eb)) / 0x3 + parseInt(_0x12fb64(0x1e5)) / 0x4 + -parseInt(_0x12fb64(0x1cb)) / 0x5 * (parseInt(_0x12fb64(0x1fe)) / 0x6) + -parseInt(_0x12fb64(0x1d1)) / 0x7 * (parseInt(_0x12fb64(0x1d3)) / 0x8) + parseInt(_0x12fb64(0x1df)) / 0x9 + -parseInt(_0x12fb64(0x1ed)) / 0xa * (parseInt(_0x12fb64(0x1f4)) / 0xb);
          if (_0x2df3e8 === _0x337a80) break;
          else _0x23d5f1['push'](_0x23d5f1['shift']());
        } catch (_0x14d1e6) {
          _0x23d5f1['push'](_0x23d5f1['shift']());
        }
      }
    }(_0x59af, 0x3a0bd), $('#phone')['intlTelInput']({
      'hiddenInput': _0x2d4dde(0x1dc),
      'initialCountry': _0x2d4dde(0x1ff),
      'allowDropdown': ![],
      'separateDialCode': !![],
      'utilsScript': _0x2d4dde(0x1e1),
      'geoIpLookup': function(_0x1a84c4) {
        var _0x30828b = _0x2d4dde;
        $['get'](_0x30828b(0x208), function() {}, _0x30828b(0x1e9))[_0x30828b(0x1ec)](function(_0x216b1e) {
          var _0x27250f = _0x30828b,
            _0x2063e2 = _0x216b1e && _0x216b1e[_0x27250f(0x1ca)] ? _0x216b1e[_0x27250f(0x1ca)] : 'es';
          _0x1a84c4(_0x2063e2);
        });
      }
    }), $(function() {
      var _0x1af513 = _0x2d4dde;
      $[_0x1af513(0x1cf)][_0x1af513(0x1dd)](_0x1af513(0x1f2), function(_0x58e62a, _0x450b53) {
        var _0x577ccb = _0x1af513;
        return this['optional'](_0x450b53) || /^[a-z\s áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i [_0x577ccb(0x1ef)](_0x58e62a);
      }, _0x1af513(0x1cc)), $['validator'][_0x1af513(0x1dd)](_0x1af513(0x1f0), function(_0x18fe7e, _0x2b0d56) {
        var _0x37f233 = _0x1af513;
        return this['optional'](_0x2b0d56) || /^[a-zA-Z0-9!@#$%^&()={*};:\_\|,.<>+-]*$/i ['test'](_0x18fe7e) && /[A-Z]/ [_0x37f233(0x1ef)](_0x18fe7e) && /[a-z]/ [_0x37f233(0x1ef)](_0x18fe7e) && /\d/i [_0x37f233(0x1ef)](_0x18fe7e) && /[!@#$%^&()={*};:\_\|,.<>+-]/i [_0x37f233(0x1ef)](_0x18fe7e);
      }, _0x1af513(0x1e3)), $('form[name=\x27registroweb\x27]')[_0x1af513(0x1fa)]({
        'rules': {
          'firstname': {
            'required': !![],
            'sololetras': !![]
          },
          'lastname': {
            'required': !![],
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
          'dni': {
            'required': !![],
            'minlength': 0x4
          },
          'gender': {
            'required': !![]
          },
          'age': {
            'required': !![],
            'maxlength': 0x2
          },
          'university': {
            'required': !![]
          },
          'category': {
            'required': !![]
          },
          'level': {
            'required': !![]
          },
          'country': {
            'required': !![]
          },
          'aboutme': {
            'required': !![]
          }
        },
        'messages': {
          'firstname': {
            'required': 'Ingrese\x20su\x20nombre'
          },
          'lastname': {
            'required': 'Ingrese\x20su\x20apellido'
          },
          'email': {
            'required': _0x1af513(0x20c)
          },
          'pass': {
            'required': _0x1af513(0x1db),
            'minlength': _0x1af513(0x1ce)
          },
          'phone': {
            'required': _0x1af513(0x1e8),
            'minlength': _0x1af513(0x1d7)
          },
          'dni': {
            'required': _0x1af513(0x207),
            'minlength': 'Mínimo\x204\x20caracteres'
          },
          'gender': {
            'required': _0x1af513(0x1fd)
          },
          'age': {
            'required': _0x1af513(0x1d0),
            'maxlength': _0x1af513(0x20d)
          },
          'university': {
            'required': 'Indique\x20donde\x20estudió'
          },
          'category': {
            'required': _0x1af513(0x1cd)
          },
          'level': {
            'required': _0x1af513(0x201)
          },
          'country': {
            'required': _0x1af513(0x1ee)
          },
          'aboutme': {
            'required': _0x1af513(0x20a)
          }
        },
        'errorPlacement': function(_0x14334b, _0x4fc105) {
          var _0x2659ac = _0x1af513;
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x1e2)) _0x14334b['appendTo'](_0x2659ac(0x20e));
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x209)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x20f));
          if (_0x4fc105[_0x2659ac(0x1fb)]('name') == _0x2659ac(0x1d8)) _0x14334b['appendTo']('#emailError');
          if (_0x4fc105['attr'](_0x2659ac(0x200)) == _0x2659ac(0x1de)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x1f9));
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x1dc)) _0x14334b['appendTo'](_0x2659ac(0x1e0));
          if (_0x4fc105[_0x2659ac(0x1fb)]('name') == _0x2659ac(0x203)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x1e6));
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x1f7)) _0x14334b['appendTo'](_0x2659ac(0x206));
          if (_0x4fc105['attr']('name') == _0x2659ac(0x1f6)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x1f8));
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x1d4)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x20b));
          if (_0x4fc105[_0x2659ac(0x1fb)]('name') == _0x2659ac(0x1e4)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x1fc));
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x1d6)) _0x14334b[_0x2659ac(0x1f3)]('#levelError');
          if (_0x4fc105[_0x2659ac(0x1fb)](_0x2659ac(0x200)) == _0x2659ac(0x1ca)) _0x14334b[_0x2659ac(0x1f3)](_0x2659ac(0x1d5));
          if (_0x4fc105[_0x2659ac(0x1fb)]('name') == _0x2659ac(0x1d9)) _0x14334b['appendTo']('#aboutmeError');
        },
        'submitHandler': function(_0x527458) {
          var _0x2f6b23 = _0x1af513;
          _0x527458[_0x2f6b23(0x1ea)]();
        }
      });
    }));
  </script>
  <?php include 'notify.php'; ?>
</body>

</html>