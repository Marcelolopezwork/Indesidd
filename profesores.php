<?php
//PROFESORES HOME
require 'cfg.inc.php';
if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
$dndtoy = 2;

$pro = true;
$swiper = true;
$pdf = true;
include 'header.php';
//Con sesión iniciada
if (isset($_SESSION['cod'])) {
  //Para profesores ya registrados
  if ($_SESSION['tip'] == 'P') header('location:perfil-pro.php');
  //Para alumnos ya registrados
  if ($_SESSION['tip'] == 'U') {
    $lim = 8; //Cuantos profesores se muestran
?>

    <body class="stretched">
      <div id="wrapper" class="clearfix">
        <?php /* MENÚ */ ?>
        <header id="header" class="full-header dark">
          <?php include 'menu.php'; ?>
        </header>
        <?php /* HERO */ ?>
        <section id="hero" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header">
          <div class="slider-inner">
            <div class="swiper-container swiper-parent">
              <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                  <div class="container">
                    <div class="slider-caption">
                      <?php
                      $qry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'slider' AND pagina = 'profesores' AND posicion = '1' ORDER BY id";
                      $rsl = $mysqli->query($qry);
                      $hero = $rsl->fetch_assoc();
                      ?>
                      <h2 data-animate="fadeIn"><?php echo $hero['descripcion']; ?></h2>
                    </div>
                  </div>
                  <div class="swiper-slide-bg" style="background-image: url('img/slider/<?php echo $hero['foto']; ?>');"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php /* CONTENIDO */ ?>
        <section id="content">
          <div class="content-wrap-none bg-light">
            <?php
            $qry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS names FROM " . odo_DATA_PROF . " WHERE (estado = 'A') ORDER BY id LIMIT " . $lim;
            $rsl = $mysqli->query($qry);
            $rea = $rsl->num_rows;
            if ($rea > 0) {
            ?>
              <?php /* PROFESORES PRINCIPALES */ ?>
              <div class="container clearfix mt-4">
                <div class="heading-block center">
                  <?php
                  $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'staff' AND pagina = 'profesores' ORDER BY id";
                  $ssl = $mysqli->query($sry);
                  $sta = $ssl->fetch_assoc();
                  ?>
                  <h3 class="text-aqua"><?php echo $sta['titulo']; ?></h3>
                </div>
                <div id="teachers" class="row">
                  <?php
                  while ($profe = $rsl->fetch_assoc()) {
                  ?>
                    <div class="col-lg-3 col-md-6 bottommargin">
                      <div class="team rounded-lg shadow">
                        <a href="teacher.php?sid<?php echo ($profe['slug']); ?>">
                          <div class="team-image">
                            <?php if ($profe['foto'] == null) { ?>
                              <img class="border rounded-top" src="img/profesores/nofoto.svg" alt="<?php echo $profe['names']; ?>">
                            <?php } else { ?>
                              <img class="border grayscale rounded-top" src="img/profesores/<?php echo $profe['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $profe['names']; ?>">
                            <?php } ?>
                          </div>
                        </a>
                        <div class="team-desc team-desc-bg rounded-bottom">
                          <?php
                          $ury = "SELECT SUM(megusta) AS likes FROM " . odo_DATA_CURS . " WHERE (profesorid = '" . $profe['id'] . "' AND estado = 'A')";
                          $usl = $mysqli->query($ury);
                          $likes = $usl->fetch_assoc();
                          ?>
                          <h5 class="mb-0"><?php echo mb_convert_case($profe['names'], MB_CASE_TITLE, 'utf-8'); ?></h5>
                          <p class="font-weight-bold my-0 small text-grey"><?php echo mb_convert_case($profe['especialidad'], MB_CASE_TITLE, 'utf-8'); ?></p>
                          <?php if (($likes['likes'] < 1) || (is_null($likes['likes']))) { ?>
                            <p class="small my-0"><i class="icon-line-sun"></i> Profesor debutante</p>
                          <?php } else { ?>
                            <p class="small my-0"><i class="icon-line-heart"></i> <?php echo $likes['likes']; ?> me gusta</p>
                          <?php } ?>
                          <div class="small" data-readmore="true" data-readmore-trigger-open="<i class='icon-line-maximize'></i>" data-readmore-trigger-close="<i class='icon-line-minimize'></i>">
                            <p class="mt-4 px-4 small text-left"><?php echo $profe['sobremi']; ?></p>
                            <a href="#" class="button button-small button-aqua button-rounded px-2 read-more-trigger read-more-trigger-right"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                    $next = $profe['id'];
                  }
                  ?>
                </div>
                <div class="mb-3 text-center">
                  <button type="button" class="button button-dark button-large button-rounded vermas" data-lim="<?php echo $lim; ?>" id="<?php echo $next; ?>">Ver más profesores</button>
                  <button type="button" class="button button-dark button-large button-rounded loading" style="display: none;"><span class="d-flex">Cargando... <svg xmlns="http://www.w3.org/2000/svg" style="margin:auto;display:block" width="32" height="32" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <path d="M10 50a40 40 0 0 0 80 0 40 42 0 0 1-80 0" fill="#efefef">
                          <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51" />
                        </path>
                      </svg></span></button>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </section>
        <?php include 'footer.php'; ?>
      </div>
      <div id="gotoTop" class="icon-line-chevron-up"></div>
      <?php require 'scripts.php'; ?>
      <script>
        $(document).ready(function() {
          $(document).on('click', '.vermas', function() {
            const t = '#teachers';
            var idprofe = $(this).attr('id');
            var limites = $(this).attr('data-lim');
            $.ajax({
              type: 'POST',
              url: 'profesmas.php',
              data: {
                z: idprofe,
                l: limites
              },
              beforeSend: function() {
                $('.vermas').hide();
                $('.loading').show();
              },
              success: function(html) {
                $('.loading').hide();
                $(t).append(html);
              },
              error: function() {
                Toast.fire({
                  icon: 'error',
                  title: 'No se pudo actualizar la información',
                });
              },
            });
          });
        });
      </script>
    </body>
  <?php
  }
  //Para público en general
} else {
  ?>

  <body class="stretched">
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header transparent-header dark" data-sticky-class="dark">
        <?php include 'menu-pro.php'; ?>
      </header>
      <?php /* HERO */ ?>
      <section id="hero" class="slider-element swiper_wrapper min-vh-60 min-vh-md-100 include-header">
        <div class="slider-inner">
          <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
              <div class="swiper-slide dark">
                <div class="container">
                  <div class="slider-caption">
                    <?php
                    $qry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'slider' AND pagina = 'profesores' AND posicion = '0' ORDER BY id";
                    $rsl = $mysqli->query($qry);
                    $hero = $rsl->fetch_assoc();
                    ?>
                    <h2 data-animate="fadeIn"><?php echo $hero['descripcion']; ?></h2>
                  </div>
                </div>
                <div class="swiper-slide-bg" style="background-image: url('img/slider/<?php echo $hero['foto']; ?>');"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php if (!isset($_SESSION['cod'])) { ?>
        <?php /* CALL TO ACTION PROFESORES*/ ?>
        <div class="section bg-dark promo promo-full p-4 my-0">
          <div class="container clearfix">
            <div class="row align-items-center">
              <?php
              $qry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'calltoactionpagpro' AND pagina = 'profesores' ORDER BY id";
              $rsl = $mysqli->query($qry);
              $ctap = $rsl->fetch_assoc();
              ?>
              <div class="col-12 col-lg">
                <h4 class="pt-4 text-light"><?php echo $ctap['descripcion']; ?></h4>
              </div>
              <div class="col-12 col-lg-auto">
                <a href="registro-pro.php" class="button button-rounded button-aqua"><i class="icon-line-user-plus"></i>POSTULATE</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap bg-light">
          <?php /* INGRESAR y BENEFICIOS */ ?>
          <div class="bg-white container clearfix bottommargin">
            <div class="row align-items-center mx-auto">
              <?php
              $qry = "SELECT * FROM " . odo_DATA_INTE . " WHERE (tipo = 'beneficios' AND pagina = 'profesores' AND estado = 'A')";
              $rsl = $mysqli->query($qry);
              $cuentabene = $rsl->num_rows;
              if ($cuentabene > 0) {
              ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                  <form action="enter.php" method="post" name="ingresarweb" class="mb-0 px-4">
                    <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                    <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                    <h6 class="text-center my-0">Si ya eres profesor registrado</h6>
                    <h3 class="text-center mb-3"><span class="h3-text-aqua">INICIA SESION</span></h3>
                    <div class="form-group">
                      <label class="w-100" for="user">Usuario<span class="text-danger">*</span><span class="float-right" id="userError"></span></label>
                      <input autocomplete="off" class="form-control" id="user" name="user" required placeholder="Nombre de usuario" tabindex="1" type="email">
                    </div>
                    <div class="form-group">
                      <label class="w-100" for="pass">Contraseña<span class="text-danger">*</span><span class="float-right" id="passError"></span></label>
                      <input autocomplete="new-password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required tabindex="2" type="password">
                      <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#pass');"></i>
                    </div>
                    <div class="form-check mb-3 text-center">
                      <input class="form-check-input" checked name="cond" required type="checkbox" tabindex="3">
                      <label class="form-check-label" for="cond"><a href="condiciones" class="text-secondary" data-cg="condiciones" data-toggle="modal" data-target="#generales" title="Condiciones generales">Acepto las Condiciones Generales</a></label>
                      <div id="condError"></div>
                    </div>
                    <div class="d-flex flex-column text-center">
                      <button type="submit" class="button button-aqua button-rounded mt-1" role="button" tabindex="4"><i class="icon-line-log-in"></i><span>INICIA SESION</span></button>
                    </div>
                  </form>
                  <div class="center">
                    <p class="my-0 small"><button class="bg-transparent border-0 ml-n2 text-left" onclick="window.location.href='olvido.php?q=p';"><span class="link-pro">¿Olvidaste tu contraseña?</span></button></p>
                    <p class="small">¿Aún no eres miembro del staff? <button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='registro-pro.php';"><span class="link-pro">POSTULATE</span></button></p>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-8 py-5">
                  <?php
                  while ($benef = $rsl->fetch_assoc()) {
                  ?>
                    <h4 class="my-0"><?php echo $benef['titulo']; ?></h4>
                    <p class="px-2 text-secondary"><?php echo $benef['texto']; ?></p>
                  <?php
                  }
                  ?>
                </div>
              <?php
              } else {
              ?>
                <div class="col-12">
                  <form action="enter.php" method="post" name="ingresarweb" class="mb-0 px-4">
                    <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                    <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                    <h6 class="text-center my-0">Si ya eres profesor registrado</h6>
                    <h3 class="text-center mb-3"><span class="h3-text-aqua">Inicia sesión</span></h3>
                    <div class="form-group">
                      <label for="user">Usuario<span class="text-danger">*</span><span id="userError"></span></label>
                      <input autocomplete="off" class="form-control" id="user" name="user" placeholder="Nombre de usuario" type="email">
                    </div>
                    <div class="form-group">
                      <label for="pass">Contraseña<span class="text-danger">*</span><span id="passError"></span></label>
                      <input autocomplete="new-password" class="form-control" id="pass" name="pass" placeholder="Contraseña" type="password">
                      <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#pass');"></i>
                    </div>
                    <div class="form-check mb-3 text-center">
                      <input class="form-check-input" checked name="cond" required type="checkbox" tabindex="3">
                      <label class="form-check-label" for="cond"><a href="condiciones" class="text-secondary" data-cg="condiciones" data-toggle="modal" data-target="#generales" title="Condiciones generales">Acepto las Condiciones Generales</a></label>
                      <div id="condError"></div>
                    </div>
                    <div class="d-flex flex-column text-center">
                      <button type="submit" class="button button-aqua button-rounded mt-1">Inicia sesion</button>
                    </div>
                  </form>
                  <div class="center">
                    <p class="my-0 small"><button class="bg-transparent border-0 ml-n2 text-left" onclick="window.location.href='olvido.php?q=p';"><span class="link-pro">¿Olvidaste tu contraseña?</span></button></p>
                    <p class="small">¿Aún no eres miembro del staff? <button class="bg-transparent border-0 ml-n2 text-left" onclick="window.location.href='registro-pro.php';"><span class="link-pro">Postulate</span></button></p>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
          <?php /* PROFESORES PRINCIPALES */ ?>
          <div class="container clearfix">
            <?php
            $qry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'staff' AND pagina = 'profesores' ORDER BY id";
            $rsl = $mysqli->query($qry);
            $stf = $rsl->fetch_assoc();
            $cuantosmuestra = $stf['posicion'];
            if ($cuantosmuestra == 0) $limite = "";
            else $limite = " LIMIT " . $cuantosmuestra;
            $qry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS names FROM " . odo_DATA_PROF . " WHERE (estado = 'A') ORDER BY RAND() " . $limite;
            $rsl = $mysqli->query($qry);
            $hay = $rsl->num_rows;
            if ($hay > 0) {
            ?>
              <div class="heading-block center">
                <h3 class="text-aqua"><?php echo $stf['titulo']; ?></h3>
              </div>
              <div class="row">
                <?php
                while ($profe = $rsl->fetch_assoc()) {
                ?>
                  <div class="col-6 col-sm-6 col-md-4 col-lg-3 bottommargin">
                    <div class="team rounded-lg shadow">
                      <a href="teacher.php?sid=<?php echo ($profe['slug']); ?>">
                        <div class="team-image">
                          <?php if ($profe['foto'] == null) { ?>
                            <img class="border rounded-top" src="img/profesores/nofoto.svg" alt="<?php echo $profe['names']; ?>">
                          <?php } else { ?>
                            <img class="border grayscale rounded-top" src="img/profesores/<?php echo $profe['foto']; ?>" alt="<?php echo $profe['names']; ?>">
                          <?php } ?>
                        </div>
                      </a>
                      <div class="team-desc team-desc-bg rounded-bottom">
                        <?php
                        $ury = "SELECT SUM(megusta) AS likes FROM " . odo_DATA_CURS . " WHERE (profesorid = '" . $profe['id'] . "' AND estado = 'A')";
                        $usl = $mysqli->query($ury);
                        $likes = $usl->fetch_assoc();
                        ?>
                        <h5 class="mb-0"><?php echo mb_convert_case($profe['names'], MB_CASE_TITLE, 'utf-8'); ?></h5>
                        <p class="font-weight-bold my-0 small text-grey"><?php echo mb_convert_case($profe['especialidad'], MB_CASE_TITLE, 'utf-8'); ?></p>
                        <?php if (($likes['likes'] < 1) || (is_null($likes['likes']))) { ?>
                          <p class="small my-0"><i class="icon-line-sun"></i> Profesor debutante</p>
                        <?php } else { ?>
                          <p class="small my-0"><i class="icon-line-heart"></i> <?php echo $likes['likes']; ?> me gusta</p>
                        <?php } ?>
                        <div class="small" data-readmore="true" data-readmore-trigger-open="<i class='icon-line-maximize'></i>" data-readmore-trigger-close="<i class='icon-line-minimize'></i>">
                          <p class="mt-4 px-4 small text-left"><?php echo $profe['sobremi']; ?></p>
                          <a href="#" class="button button-small button-aqua button-rounded px-2 read-more-trigger read-more-trigger-right"></a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </section>
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
      (function(_0xc9922a, _0x121d02) {
        var _0x284fb8 = _0x1e99,
          _0x2cb9ae = _0xc9922a();
        while (!![]) {
          try {
            var _0x2cec9e = parseInt(_0x284fb8(0xf7)) / 0x1 * (parseInt(_0x284fb8(0xe6)) / 0x2) + parseInt(_0x284fb8(0xed)) / 0x3 + -parseInt(_0x284fb8(0xec)) / 0x4 * (parseInt(_0x284fb8(0xee)) / 0x5) + parseInt(_0x284fb8(0xef)) / 0x6 * (parseInt(_0x284fb8(0xfa)) / 0x7) + parseInt(_0x284fb8(0xf2)) / 0x8 * (-parseInt(_0x284fb8(0xe7)) / 0x9) + parseInt(_0x284fb8(0xfb)) / 0xa + -parseInt(_0x284fb8(0xf4)) / 0xb * (parseInt(_0x284fb8(0xe5)) / 0xc);
            if (_0x2cec9e === _0x121d02) break;
            else _0x2cb9ae['push'](_0x2cb9ae['shift']());
          } catch (_0xeb5106) {
            _0x2cb9ae['push'](_0x2cb9ae['shift']());
          }
        }
      }(_0x2641, 0x5ad55), $(function() {
        var _0x5f051f = _0x1e99;
        $(_0x5f051f(0xff))[_0x5f051f(0xea)]({
          'rules': {
            'user': {
              'required': !![],
              'email': !![]
            },
            'pass': {
              'required': !![],
              'minlength': 0x8
            },
            'cond': {
              'required': !![]
            }
          },
          'messages': {
            'user': {
              'required': _0x5f051f(0xe9)
            },
            'pass': {
              'required': _0x5f051f(0xf8),
              'minlength': _0x5f051f(0xf5)
            },
            'cond': {
              'required': _0x5f051f(0xfe)
            }
          },
          'errorPlacement': function(_0x4b7b1b, _0x1d2f82) {
            var _0x3c008c = _0x5f051f;
            if (_0x1d2f82[_0x3c008c(0x100)](_0x3c008c(0xf9)) == 'user') _0x4b7b1b[_0x3c008c(0xf1)]('#userError');
            if (_0x1d2f82['attr']('name') == 'pass') _0x4b7b1b['appendTo'](_0x3c008c(0xe8));
            if (_0x1d2f82[_0x3c008c(0x100)]('name') == _0x3c008c(0xf0)) _0x4b7b1b[_0x3c008c(0xf1)](_0x3c008c(0xeb));
          },
          'submitHandler': function(_0x2a308c) {
            _0x2a308c['submit']();
          }
        });
      }));

      function _0x2641() {
        var _0x49e17b = ['49189OEKNXG', '5405650TJGFmO', 'text', '.pass', 'Debe\x20aceptar\x20las\x20condiciones\x20generales', 'form[name=\x27ingresarweb\x27]', 'attr', '12UVCjvU', '2fUraGU', '71289oQViML', '#passError', 'Ingrese\x20su\x20usuario', 'validate', '#condError', '9752ukDGuW', '2013972buviRl', '1055FfBfeb', '114yGfzsp', 'cond', 'appendTo', '552SSTBQg', 'hasClass', '5422120duBgNg', 'Mínimo\x208\x20caracteres', 'password', '580538PNzyks', 'No\x20puede\x20estar\x20en\x20blanco', 'name'];
        _0x2641 = function() {
          return _0x49e17b;
        };
        return _0x2641();
      }

      function _0x1e99(_0x4343bf, _0x3ab370) {
        var _0x26413c = _0x2641();
        return _0x1e99 = function(_0x1e99ad, _0x3309af) {
          _0x1e99ad = _0x1e99ad - 0xe5;
          var _0x48cb51 = _0x26413c[_0x1e99ad];
          return _0x48cb51;
        }, _0x1e99(_0x4343bf, _0x3ab370);
      }
    </script>
    <?php include 'notify.php'; ?>
  </body>
<?php
}
?>

</html>