<?php
//CURSOS
require 'cfg.inc.php';

if (!isset($_SESSION['riq'])) $_SESSION['riq'] = "";
unset($_GET['pid']);

$dndtoy = 1;
$lim = 6; //Cuantos curso se muestran sin filtro

$buscador = false;
$swiper = true;
$both = true;

include 'header.php';
$qry = "SELECT * FROM " . odo_DATA_CURS . " WHERE (estado = 'A' AND publicado = 'S') ";
$rsl = $mysqli->query($qry);
$hay = $rsl->num_rows;
if ($hay > 0) {
  $cour = $rsl->fetch_assoc();
  $date = date_create($cour['fechaactualizacion']);
  $fecha = date_format($date, 'd M Y');
}
?>

<body class="stretched bg-light">
  <div id="wrapper" class="clearfix">
    <?php /* MENÚ */ ?>
    <header id="header" class="full-header dark">
      <?php include 'menu.php'; ?>
    </header>
    <?php /* HERO */ ?>
    <?php
    $hry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'hero' AND pagina = 'cursos' ORDER BY id";
    $hsl = $mysqli->query($hry);
    $herc = $hsl->fetch_assoc();
    ?>
    <section id="hero" class="slider-element swiper_wrapper vh-75 include-header">
      <div class="slider-inner">
        <div class="swiper-container swiper-parent">
          <div class="swiper-wrapper">
            <div class="dark w-100">
              <div class="container">
                <div class="slider-caption slider-caption-center">
                  <h2 class="mx-auto caption-curso"><?php echo $herc['descripcion']; ?></h2>
                  <form action="search.php" method="post" name="finder" class="form-inline justify-content-center">
                    <div class="align-items-center d-flex from-group mt-3 w-75">
                      <input autocomplete="off" class="form-control form-control-lg text-white w-100" id="busqueda" name="busqueda" minlength="2" placeholder="Ejemplo: odontología" required aria-label="Buscar" type="search">
                      <button class="button button-border button-rounded button-large"><i class="icon-line-search"></i><span>Buscar</span></button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="swiper-slide-bg" style="background-image: url('img/slider/<?php echo $herc['foto']; ?>');"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php /* CONTENIDO */ ?>
    <?php if ($hay > 0) { ?>
      <section id="content">
        <div class="bg-light pt-2 pt-sm-4">
          <?php /* RESULTADO DE BUSQUEDA */ ?>
          <?php
          if (!empty($_SESSION['riq'])) {
          ?>
            <h4 class="text-center"><?php echo $_SESSION['riq']; ?></h4>
            <div class="container clearfix">
              <div class="row posts-md">
                <?php
                foreach ($_SESSION['found'] as $key) {
                  $dry = "SELECT * FROM " . odo_DATA_CURS . " WHERE id = '$key' AND estado = 'A' AND publicado = 'S' ORDER BY id ";
                  $dsl = $mysqli->query($dry);
                  $qour = $dsl->fetch_assoc();
                  $kty = "SELECT categoria FROM " . odo_DATA_CATE . " WHERE id = '" . $qour['categoriaid'] . "' ORDER BY id ";
                  $kzl = $mysqli->query($kty);
                  $kate = $kzl->fetch_assoc();
                ?>
                  <article class="portfolio-item col-6 col-sm-6 col-md-6 col-lg-4">
                    <div class="grid-inner mb-5 shadow">
                      <?php /*Video*/ ?>
                      <div class="portfolio-image">
                        <div class="max-photo">
                          <img class="img-fluid" src="<?php echo "img/cursos/" . $qour['imagen']; ?>" alt="Video" width="410" height="270">
                        </div>
                        <div class="bg-overlay">
                          <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                            <?php
                            $trail = explode('/', $qour['trailer']);
                            ?>
                            <a href="https://player.vimeo.com/video/<?php echo $trail[3]; ?>" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                          </div>
                          <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                        </div>
                      </div>
                      <div class="entry mb-0">
                        <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                        <div class="bg-white min-h-curso px-4 py-3">
                          <div class="entry-title title-xs nott">
                            <h3 class="responsive"><?php echo $qour['curso']; ?></h3>
                          </div>
                          <?php
                          $pry = "SELECT CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $qour['profesorid'] . "')";
                          $psl = $mysqli->query($pry);
                          $prf = $psl->fetch_assoc()
                          ?>
                          <div class="py-1">
                            <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <?php echo $prf['profe']; ?></p>
                            <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $kate['categoria']; ?></span></p>
                            <?php if (($qour['megusta'] < 1) || (is_null($qour['megusta']))) { ?>
                              <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                            <?php } else { ?>
                              <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $qour['megusta']; ?> me gusta</span></p>
                            <?php } ?>
                            <?php /*Precios*/ ?>
                            <div class="d-flex">
                              <?php if ($qour['ofertaactiva'] == 'S') { ?>
                                <h5 class="mb-1 line-through"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $qour['precioventa']; ?></h5>
                                <h5 class="mb-1 ml-2 sales"><?php echo $moneda; ?><?php echo $qour['preciooferta']; ?></h5>
                              <?php } else { ?>
                                <h5 class="mb-1 sales"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $qour['precioventa']; ?></h5>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php /*Botones*/ ?>
                      <div class="bg-white d-flex justify-content-center pb-3 pt-1 rounded-bottom">
                        <?php
                        if (isset($_SESSION['cod'])) {
                          if ($_SESSION['tip'] == 'P') {
                        ?>
                            <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $qour['id']; ?>&sid=<?php echo $qour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                            <?php
                          } else {
                            $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $qour['id'] . "' AND estado = 'A' ";
                            $sbl = $mysqli->query($sby);
                            if ($sbl->num_rows == 1) {
                            ?>
                              <button class="button button-aqua button-small button-rounded mx-4 w-100" onclick="window.location.href='clase.php?pid=<?php echo ($qour['id']); ?>$qid=1&sid=<?php echo $qour['slug']; ?>'"><i class="icon-line-arrow-right"></i><span>IR AL CURSO</span></button>
                            <?php
                            } else {
                            ?>
                              <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $qour['id']; ?>&sid=<?php echo $qour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                          <?php
                            }
                          }
                        } else {
                          ?>
                          <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $qour['id']; ?>&sid=<?php echo $qour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </article>
                <?php
                }
                ?>
              </div>
            </div>
          <?php
            $_SESSION['riq'] = "";
          }
          ?>
          <?php /*CURSOS*/ ?>
          <?php
          $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'cursos' AND pagina = 'cursos' ORDER BY id";
          $slt = $mysqli->query($sry);
          $cou = $slt->fetch_assoc();
          if ($cou['estado'] == 'A') {
            //Con filtros activos
            $sryf = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'activafiltros' AND pagina = 'cursos' ORDER BY id";
            $sltf = $mysqli->query($sryf);
            $couf = $sltf->fetch_assoc();
            if ($couf['estado'] == 'A') {
          ?>
              <div class="container clearfix py-5">
                <h2 class="mt-2 text-center">Cursos</h2>
                <div class="grid-filter-wrap">
                  <ul class="grid-filter mx-auto" data-container="#portfolio">
                    <li class="activeFilter"><a href="#" data-filter="*">Todos los cursos</a></li>
                    <?php
                    $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE (estado = 'A')";
                    $csl = $mysqli->query($cry);
                    $numcate = $csl->num_rows;
                    $catexist = array('');
                    $catenomb = array('');
                    $cateslug = array('');
                    while ($catg = $csl->fetch_assoc()) {
                      $catexist[] = $catg['id'];
                      $catenomb[] = $catg['categoria'];
                      $cateslug[] = $catg['slug'];
                    ?>
                      <li><a href="#" data-filter=".<?php echo $catg['slug']; ?>"><?php echo $catg['categoria']; ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
                <div id="portfolio" class="portfolio row grid-container" data-layout="fitRows">
                  <?php
                  for ($curs = 1; $curs <= $numcate; $curs++) {
                    $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (categoriaid = '" . $catexist[$curs] . "' AND estado = 'A' AND publicado = 'S' AND venta = 'S') ";
                    $usl = $mysqli->query($ury);
                    $haycurso = $usl->num_rows;
                    if ($haycurso > 0) {
                      while ($cour = $usl->fetch_assoc()) {
                  ?>
                        <article class="portfolio-item col-6 col-sm-6 col-md-6 col-lg-4 <?php echo $cateslug[$curs]; ?>">
                          <div class="grid-inner mb-5 shadow">
                            <?php /*Video*/ ?>
                            <div class="portfolio-image">
                              <div class="max-photo">
                                <img class="img-fluid lazyload" src="img/placeholder.svg" data-src="img/cursos/<?php echo $cour['imagen']; ?>" alt="Video" loading="lazy" width="410" height="270">
                              </div>
                              <div class="bg-overlay">
                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                  <?php
                                  $trail = explode('/', $cour['trailer']);
                                  ?>
                                  <a href="https://player.vimeo.com/video/<?php echo $trail[3]; ?>" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                </div>
                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                              </div>
                            </div>
                            <div class="entry mb-0">
                              <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                              <div class="bg-white min-h-curso px-4 py-3">
                                <div class="entry-title title-xs nott">
                                  <h3 class="responsive"><?php echo $cour['curso']; ?></h3>
                                </div>
                                <?php
                                $pry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $cour['profesorid'] . "')";
                                $psl = $mysqli->query($pry);
                                $prf = $psl->fetch_assoc()
                                ?>
                                <div class="py-1">
                                  <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <a href="profesor/<?php echo ($prf['slug']); ?>" class="maestro"><?php echo $prf['profe']; ?></a></p>
                                  <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><a href="categorias/<?php echo $cateslug[$cour['categoriaid']]; ?>" class="categorias"><span class="small"><?php echo $catenomb[$cour['categoriaid']]; ?></span></a></p>
                                  <?php if (($cour['megusta'] < 1) || (is_null($cour['megusta']))) { ?>
                                    <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                                  <?php } else { ?>
                                    <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $cour['megusta']; ?> me gusta</span></p>
                                  <?php } ?>
                                  <?php /*Precios*/ ?>
                                  <div class="d-flex">
                                    <?php if ($cour['ofertaactiva'] == 'S') { ?>
                                      <h5 class="mb-1 line-through"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                      <h5 class="mb-1 ml-2 sales"><?php echo $moneda; ?><?php echo $cour['preciooferta']; ?></h5>
                                    <?php } else { ?>
                                      <h5 class="mb-1 sales"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php /*Botones*/ ?>
                            <div class="bg-white d-flex justify-content-center pb-3 pt-1 rounded-bottom">
                              <?php
                              if (isset($_SESSION['cod'])) {
                                if ($_SESSION['tip'] == 'P') {
                                  //Login como profesor
                              ?>
                                  <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                                  <?php
                                } else {
                                  //Login como alumno
                                  $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                                  $sbl = $mysqli->query($sby);
                                  if ($sbl->num_rows == 1) {
                                    //Como alumno que compró el curso
                                  ?>
                                    <button class="button button-aqua button-small button-rounded mx-4 w-100" onclick="window.location.href='clase.php?pid=<?php echo ($cour['id']); ?>&qid=1&sid=<?php echo ($cour['slug']); ?>'"><i class="icon-line-arrow-right"></i><span>IR AL CURSO</span></button>
                                  <?php
                                  } else {
                                    //Como alumno que NO compró el curso aún
                                  ?>
                                    <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                                <?php
                                  }
                                }
                              } else {
                                //No login en el sistema
                                ?>
                                <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                              <?php
                              }
                              ?>
                            </div>
                          </div>
                        </article>
                  <?php
                      }
                    }
                  }
                  ?>
                </div>
              </div>
            <?php
              //Con filtros desactivados
            } else {
            ?>
              <div class="container clearfix py-5">
                <h2 class="mt-2 text-center">Cursos</h2>
                <?php
                $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY id LIMIT " . $lim;
                $usl = $mysqli->query($ury);
                $haycurso = $usl->num_rows;
                if ($haycurso > 0) {
                ?>
                  <div id="portfolio" class="portfolio row">
                    <?php
                    while ($cour = $usl->fetch_assoc()) {
                      $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE (id = '" . $cour['categoriaid'] . "' AND estado = 'A')";
                      $csl = $mysqli->query($cry);
                      $catg = $csl->fetch_assoc();
                      $pry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $cour['profesorid'] . "')";
                      $psl = $mysqli->query($pry);
                      $prf = $psl->fetch_assoc()
                    ?>
                      <article class="portfolio-item col-6 col-sm-6 col-md-6 col-lg-4">
                        <div class="grid-inner mb-5 shadow">
                          <?php /*Video*/ ?>
                          <div class="portfolio-image">
                            <div class="max-photo">
                              <img class="img-fluid lazyload" src="img/placeholder.svg" data-src="img/cursos/<?php echo $cour['imagen']; ?>" alt="Video" loading="lazy" width="410" height="270">
                            </div>
                            <div class="bg-overlay">
                              <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                <?php
                                $trail = explode('/', $cour['trailer']);
                                ?>
                                <a href="https://player.vimeo.com/video/<?php echo $trail[3]; ?>" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                              </div>
                              <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                            </div>
                          </div>
                          <div class="entry mb-0">
                            <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                            <div class="bg-white min-h-curso px-4 py-3">
                              <div class="entry-title title-xs nott">
                                <h3 class="responsive"><?php echo $cour['curso']; ?></h3>
                              </div>
                              <div class="py-1">
                                <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <a href="teacher.php?sid=<?php echo ($prf['slug']); ?>" class="maestro"><?php echo $prf['profe']; ?></a></p>
                                <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><a href="categories.php?sid=<?php echo $catg['slug']; ?>" class="categorias"><span class="small"><?php echo $catg['categoria']; ?></span></a></p>
                                <?php if (($cour['megusta'] < 1) || (is_null($cour['megusta']))) { ?>
                                  <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                                <?php } else { ?>
                                  <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $cour['megusta']; ?> me gusta</span></p>
                                <?php } ?>
                                <?php /*Precios*/ ?>
                                <div class="d-flex">
                                  <?php if ($cour['ofertaactiva'] == 'S') { ?>
                                    <h5 class="mb-1 line-through"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                    <h5 class="mb-1 ml-2 sales"><?php echo $moneda; ?><?php echo $cour['preciooferta']; ?></h5>
                                  <?php } else { ?>
                                    <h5 class="mb-1 sales"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php /*Botones*/ ?>
                          <div class="bg-white d-flex justify-content-center pb-3 pt-1 rounded-bottom">
                            <?php
                            if (isset($_SESSION['cod'])) {
                              if ($_SESSION['tip'] == 'P') {
                                //Login como profesor
                            ?>
                                <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                                <?php
                              } else {
                                //Login como alumno
                                $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                                $sbl = $mysqli->query($sby);
                                if ($sbl->num_rows == 1) {
                                  //Como alumno que compró el curso
                                ?>
                                  <button class="button button-aqua button-small button-rounded mx-4 w-100" onclick="window.location.href='clase.php?pid=<?php echo ($cour['id']); ?>&qid=1&sid=<?php echo ($cour['slug']); ?>'"><i class="icon-line-arrow-right"></i><span>IR AL CURSO</span></button>
                                <?php
                                } else {
                                  //Como alumno que NO compró el curso aún
                                ?>
                                  <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                              <?php
                                }
                              }
                            } else {
                              //No login en el sistema
                              ?>
                              <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                      </article>
                    <?php
                      $next = $cour['id'];
                    }
                    ?>
                  </div>
                  <div class="text-center">
                    <button type="button" class="button button-dark button-large button-rounded vermas" data-lim="<?php echo $lim; ?>" id="<?php echo $next; ?>">Ver más cursos</button>
                    <button type="button" class="button button-dark button-large button-rounded loading" style="display: none;"><span class="d-flex">Cargando... <svg xmlns="http://www.w3.org/2000/svg" style="margin:auto;display:block" width="32" height="32" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                          <path d="M10 50a40 40 0 0 0 80 0 40 42 0 0 1-80 0" fill="#efefef">
                            <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51" />
                          </path>
                        </svg></span></button>
                  </div>
                <?php
                }
                ?>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </section>
    <?php } ?>
    <?php include 'footer.php'; ?>
  </div>
  <div id="gotoTop" class="icon-line-chevron-up"></div>
  <?php require 'scripts.php'; ?>
  <script>
    $(document).ready(function() {
      $(document).on('click', '.vermas', function() {
        var idcurso = $(this).attr('id');
        var limites = $(this).attr('data-lim');
        $.ajax({
          type: 'POST',
          url: 'cursosmas.php',
          data: {
            z: idcurso,
            l: limites
          },
          beforeSend: function() {
            $('.vermas').hide();
            $('.loading').show();
            Toast.fire({
              icon: 'warning',
              title: 'Espere...',
            });
          },
          success: function(html) {
            $('.loading').hide();
            $('#portfolio').append(html);
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

    function _0x21b6(_0x416288, _0x289458) {
      const _0x415480 = _0x4154();
      return _0x21b6 = function(_0x21b64e, _0x973740) {
        _0x21b64e = _0x21b64e - 0xe1;
        let _0x59e6c1 = _0x415480[_0x21b64e];
        return _0x59e6c1;
      }, _0x21b6(_0x416288, _0x289458);
    }

    function _0x4154() {
      const _0x36b77a = ['loading', 'submit', '3651osVDyw', 'form[name=\x27finder\x27]', 'Mínimo\x202\x20caracteres', '12rtMNXa', '1256650kJylJR', '1389525ZTrgzx', 'js/lazysizes.min.js', '18UiwwcV', '117CQqVFS', 'img.lazyload', '344HXuxxB', 'validate', '497380DjsqtY', 'init', 'querySelectorAll', 'forEach', '5892948WLeNFD', 'dataset', '1654QSJhwU', '98189RYbEsG', 'src', 'Ingrese\x20criterio\x20de\x20búsqueda', '25418602KEMRpG'];
      _0x4154 = function() {
        return _0x36b77a;
      };
      return _0x4154();
    }(function(_0x545f85, _0x3517d3) {
      const _0x31965f = _0x21b6,
        _0x9cf82a = _0x545f85();
      while (!![]) {
        try {
          const _0xc18f8b = parseInt(_0x31965f(0xf7)) / 0x1 + -parseInt(_0x31965f(0xeb)) / 0x2 * (-parseInt(_0x31965f(0xf2)) / 0x3) + parseInt(_0x31965f(0xe9)) / 0x4 + parseInt(_0x31965f(0xf6)) / 0x5 * (-parseInt(_0x31965f(0xf9)) / 0x6) + parseInt(_0x31965f(0xec)) / 0x7 * (parseInt(_0x31965f(0xe3)) / 0x8) + -parseInt(_0x31965f(0xe1)) / 0x9 * (parseInt(_0x31965f(0xe5)) / 0xa) + parseInt(_0x31965f(0xef)) / 0xb * (-parseInt(_0x31965f(0xf5)) / 0xc);
          if (_0xc18f8b === _0x3517d3) break;
          else _0x9cf82a['push'](_0x9cf82a['shift']());
        } catch (_0x1c4057) {
          _0x9cf82a['push'](_0x9cf82a['shift']());
        }
      }
    }(_0x4154, 0xb9cb8), $(function() {
      const _0x2c564b = _0x21b6;
      $(_0x2c564b(0xf3))[_0x2c564b(0xe4)]({
        'rules': {
          'busqueda': {
            'required': !![],
            'minlength': 0x2
          }
        },
        'messages': {
          'busqueda': {
            'required': _0x2c564b(0xee),
            'minlength': _0x2c564b(0xf4)
          }
        },
        'errorPlacement': function(_0xfb36a, _0x4c4726) {
          _0x4c4726['attr']('placeholder', _0xfb36a['text']());
        },
        'submitHandler': function(_0x18090b) {
          const _0x15d0f6 = _0x2c564b;
          _0x18090b[_0x15d0f6(0xf1)]();
        }
      });
    }), ((async () => {
      const _0x287b57 = _0x21b6;
      if (_0x287b57(0xf0) in HTMLImageElement['prototype']) {
        const _0x2433d6 = document[_0x287b57(0xe7)](_0x287b57(0xe2));
        _0x2433d6[_0x287b57(0xe8)](_0x4ca40a => {
          const _0x1be486 = _0x287b57;
          _0x4ca40a['src'] = _0x4ca40a[_0x1be486(0xea)][_0x1be486(0xed)];
        });
      } else {
        const _0x2302a2 = await import(_0x287b57(0xf8));
        lazySizes[_0x287b57(0xe6)]();
      }
    })()));
  </script>
</body>

</html>