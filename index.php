<?php
//PÁGINA INICIAL INDESID
require 'cfg.inc.php';

$dndtoy = 0;
if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";

$swiper = true;
$both = true;
$numeric = true;
$select = true;
$telephone = true;

include 'header.php';
?>

<body class="stretched">
  <div id="wrapper" class="clearfix">
    <?php /* MENÚ */ ?>
    <header id="header" class="full-header transparent-header dark" data-sticky-class="dark">
      <?php include 'menu.php'; ?>
    </header>
    <?php /* CARRUSEL */ ?>
    <?php
    $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'home' AND pagina = 'index' ";
    $slt = $mysqli->query($sry);
    $saw = $slt->fetch_assoc();
    ?>
    <?php if ($saw['estado'] == 'A') { ?>
      <section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header" data-autoplay="6000" data-speed="650" data-loop="true">
        <div class="slider-inner">
          <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
              <?php
              $query = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'home' AND pagina = 'index' AND estado = 'A' ORDER BY posicion LIMIT 0, 5";
              $result = $mysqli->query($query);
              $numslides = $result->num_rows;
              while ($slid = $result->fetch_assoc()) {
              ?>
                <div class="swiper-slide dark">
                  <div class="container">
                    <div class="slider-caption slider-caption-<?php echo $slid['posiciontexto']; ?>">
                      <h2 data-animate="fadeIn" class="text-<?php echo $slid['posiciontexto']; ?> text-shadow"><?php echo $slid['descripcion']; ?></h2>
                    </div>
                  </div>
                  <div class="swiper-slide-bg" style="background-image: url('img/slider/<?php echo $slid['foto']; ?>');"></div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </section>
    <?php } else { ?>
      <section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header">
        <div class="slider-inner">
          <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
              <div class="swiper-slide dark">
                <div class="container">
                  <div class="slider-caption slider-caption-right">
                    <h2 data-animate="fadeIn" class="text-right text-shadow">International Dental School by Cidesid</h2>
                  </div>
                </div>
                <div class="swiper-slide-bg" style="background-image: url('img/slider/hero-principal.jpg');"></div>
              </div>

            </div>
          </div>
        </div>
      </section>
    <?php } ?>
    <?php /* CALL TO ACTION WEBINAR */ ?>
    <?php
    $wry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'webinars' AND pagina = 'index' AND estado = 'A' ORDER BY id";
    $wsl = $mysqli->query($wry);
    $webi = $wsl->fetch_assoc();
    $wry = "SELECT * FROM " . odo_DATA_WEBI . " WHERE fecha > '$hoy' AND publicado = 'S' AND estado = 'A' ";
    $wsl = $mysqli->query($wry);
    if ($wsl->num_rows > 0) {
    ?>
      <div class="bg-dark dark promo promo-full p-4 mb-0">
        <div class="container clearfix">
          <div class="row align-items-center">
            <div class="col-12 col-lg">
              <h4 class="pt-4"><?php echo $webi['descripcion']; ?></h4>
            </div>
            <div class="col-12 col-lg-auto">
              <button class="button button-border button-light button-rounded" onclick="window.location.href='webinars.php';"><i class="icon-line-clock"></i><span>VER WEBINARS</span></button>
            </div>
          </div>
        </div>
      </div>
      <?php
    } else {
      if (!isset($_SESSION['cod'])) {
        $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'calltoaction' AND pagina = 'index' ";
        $slt = $mysqli->query($sry);
        $saw = $slt->fetch_assoc();
        if ($saw['estado'] == 'A') {
          $query = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'calltoaction' AND pagina = 'index' AND estado = 'A' ORDER BY id";
          $result = $mysqli->query($query);
          $callto = $result->fetch_assoc();
      ?>
          <?php /* CALL TO ACTION ALUMNOS*/ ?>
          <div class="bg-dark dark promo promo-full p-4 mb-0">
            <div class="container clearfix">
              <div class="row align-items-center">
                <div class="col-12 col-lg">
                  <h4 class="pt-4"><?php echo $callto['descripcion']; ?></h4>
                </div>
                <div class="col-12 col-lg-auto">
                  <button class="button button-border button-rounded button-light" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>REGISTRATE GRATIS</span></button>
                </div>
              </div>
            </div>
          </div>
    <?php
        }
      }
    }
    ?>
    <?php /* CONTENIDO */ ?>
    <section id="content">
      <div class="content-wrap-none bg-light">
        <?php /* QUIENES SOMOS */ ?>
        <?php
        $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'lema' AND pagina = 'index' ";
        $slt = $mysqli->query($sry);
        $saw = $slt->fetch_assoc();
        if ($saw['estado'] == 'A') {
          $lema = $saw;
        ?>
          <div class="container clearfix mt-5">
            <div class="row">
              <div class="col-md-8">
                <div class="heading-block">
                  <h2 class="mb-4 mb-sm-0"><?php echo $lema['descripcion']; ?></h2>
                </div>
              </div>
              <div class="align-self-end col-md-4" data-animate="fadeIn">
                <div class="row align-items-center px-4 px-sm-0">
                  <div class="col-5">
                    <img class="img-thumbnail rounded-circle w-auto" src="img/<?php echo $lema['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $lema['persona']; ?>">
                  </div>
                  <div class="col-7">
                    <div class="d-flex flex-column">
                      <h4 class="my-0 text-blue"><?php echo $lema['persona']; ?></h4>
                      <p class="my-0 font-weight-bold"><?php echo $lema['cargo']; ?></p>
                      <p class="my-0 small"><?php echo $lema['especialidad']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php
        if (!isset($_SESSION['cod'])) {
        ?>
          <?php /* BENEFICIOS */ ?>
          <?php
          $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'beneficios' AND pagina = 'index' ";
          $slt = $mysqli->query($sry);
          $see_bene = [];
          while ($saw = $slt->fetch_assoc()) {
            array_push($see_bene, $saw['estado']);
          }
          $key = in_array('A', $see_bene);
          if ($key) {
          ?>
            <div class="section dark-texture">
              <h2 class="center text-light">Beneficios de <span class="text-aqua">Indesid</span></h2>
              <div class="container clearfix">
                <div class="row">
                  <?php
                  $qry = "SELECT * FROM " . odo_DATA_INTE . " WHERE (tipo = 'beneficios' AND pagina = 'index' AND estado = 'A') ORDER BY RAND()";
                  $rsl = $mysqli->query($qry);
                  while ($benef = $rsl->fetch_assoc()) {
                  ?>
                    <div class="col-10 col-lg-6 mx-auto">
                      <div class="ml-n4 d-flex align-items-center">
                        <span class="mr-1"><i class="icon-line-check-circle text-secondary"></i></span>
                        <h4 class="my-0 text-aqua"><?php echo $benef['titulo']; ?></h4>
                      </div>
                      <p class="pr-3 text-light"><?php echo $benef['texto']; ?></p>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <?php /* CURSOS */ ?>
        <?php
        $crs = "SELECT * FROM " . odo_DATA_CURS . " WHERE (estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY id ";
        $clt = $mysqli->query($crs);
        $cay = $clt->num_rows;
        $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'cursosporcate' AND pagina = 'index' ";
        $slt = $mysqli->query($sry);
        $saw = $slt->fetch_assoc();
        if ($cay > 0) { //No hay ningún curso
          if ($saw['estado'] == 'A') {
        ?>
            <div class="container clearfix bottommargin">
              <?php
              $srya = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'activafiltros' AND pagina = 'index' ";
              $slta = $mysqli->query($srya);
              $sawa = $slta->fetch_assoc();
              if ($cay > 0) { //No hay ningún curso
                //Listado de cursos con filtros
                if ($sawa['estado'] == 'A') {
              ?>
                  <div class="center">
                    <h2 class="text-blue">Cursos por categorías</h2>
                  </div>
                  <div class="tabs tabs-responsive clearfix">
                    <ul class="tab-nav clearfix d-flex justify-content-center">
                      <?php
                      $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE (estado = 'A')";
                      $csl = $mysqli->query($cry);
                      $numcate = $csl->num_rows;
                      $categat = array('');
                      $catenom = array('');
                      while ($catg = $csl->fetch_assoc()) {
                        $categat[] = $catg['id'];
                        $catenom[] = $catg['categoria'];
                      ?>
                        <li><a href="#tab-responsive-<?php echo $catg['id']; ?>"><?php echo $catg['categoria']; ?></a></li>
                      <?php
                      }
                      ?>
                    </ul>
                    <div class="tab-container">
                      <?php
                      for ($curs = 1; $curs <= $numcate; $curs++) {
                        $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (categoriaid = '" . $categat[$curs] . "' AND estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY fecha LIMIT 12";
                        $usl = $mysqli->query($ury);
                        $haycurso = $usl->num_rows;
                      ?>
                        <div class="tab-content clearfix" id="tab-responsive-<?php echo $curs; ?>">
                          <div class="row posts-md">
                            <?php
                            if ($haycurso > 0) {
                              while ($cour = $usl->fetch_assoc()) {
                            ?>
                                <article class="portfolio-item col-6 col-sm-6 col-md-6 col-lg-4">
                                  <div class="grid-inner shadow">
                                    <?php /*Video*/ ?>
                                    <div class="portfolio-image">
                                      <div class="max-photo">
                                        <img alt="<?php echo $cour['curso']; ?>" class="img-fluid" src="img/cursos/<?php echo $cour['imagen']; ?>">
                                      </div>
                                      <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                          <?php $trail = explode('/', $cour['trailer']); ?>
                                          <a href="https://player.vimeo.com/video/<?php echo $trail[3]; ?>" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                      </div>
                                    </div>
                                    <div class="entry mb-0">
                                      <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                                      <div class="bg-white min-h-curso px-4 py-3">
                                        <div class="entry-title title-xs">
                                          <h3 class="responsive"><?php echo $cour['curso']; ?></h3>
                                        </div>
                                        <?php
                                        $pry = "SELECT CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $cour['profesorid'] . "')";
                                        $psl = $mysqli->query($pry);
                                        $prf = $psl->fetch_assoc()
                                        ?>
                                        <div class="py-1">
                                          <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <?php echo mb_convert_case($prf['profe'], MB_CASE_TITLE, 'utf-8'); ?></p>
                                          <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $catenom[$cour['categoriaid']]; ?></span></p>
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
                                              <h5 class="mb-1 sales"><i class="icon-line-shopping-cart mr-1"></i><?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
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
                                          <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                                          <?php
                                        } else {
                                          $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                                          $sbl = $mysqli->query($sby);
                                          if ($sbl->num_rows == 1) {
                                          ?>
                                            <button onclick="window.location.href='clase.php?pid=<?php echo ($cour['id']); ?>&qid=1&sid=<?php echo ($cour['slug']); ?>'" class="button button-aqua button-small button-rounded mx-4 w-100"><i class="icon-line-arrow-right"></i><span>IR AL CURSO</span></button>
                                          <?php
                                          } else {
                                          ?>
                                            <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                                        <?php
                                          }
                                        }
                                      } else {
                                        ?>
                                        <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                                      <?php
                                      }
                                      ?>
                                    </div>
                                  </div>
                                </article>
                            <?php
                              }
                            }
                            ?>
                          </div>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                <?php
                  //Listado de cursos sin filtros
                } else {
                  $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE (estado = 'A')";
                  $csl = $mysqli->query($cry);
                  $numcate = $csl->num_rows;
                  $categat = array('');
                  $catenom = array('');
                  while ($catg = $csl->fetch_assoc()) {
                    $categat[] = $catg['id'];
                    $catenom[] = $catg['categoria'];
                  }
                  $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY fecha LIMIT 12";
                  $usl = $mysqli->query($ury);
                  $haycurso = $usl->num_rows;
                ?>
                  <div class="center mt-5">
                    <h2 class="text-blue">Cursos que impartimos</h2>
                  </div>
                  <div class="row posts-md">
                    <?php
                    if ($haycurso > 0) {
                      while ($cour = $usl->fetch_assoc()) {
                    ?>
                        <article class="portfolio-item col-6 col-sm-6 col-md-6 col-lg-4 my-3">
                          <div class="grid-inner shadow">
                            <?php /*Video*/ ?>
                            <div class="portfolio-image">
                              <div class="max-photo">
                                <img alt="<?php echo $cour['curso']; ?>" class="img-fluid" src="img/cursos/<?php echo $cour['imagen']; ?>">
                              </div>
                              <div class="bg-overlay">
                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                  <?php $trail = explode('/', $cour['trailer']); ?>
                                  <a href="https://player.vimeo.com/video/<?php echo $trail[3]; ?>" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                </div>
                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                              </div>
                            </div>
                            <div class="entry mb-0">
                              <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                              <div class="bg-white min-h-curso px-4 py-3">
                                <div class="entry-title title-xs">
                                  <h3 class="responsive"><?php echo $cour['curso']; ?></h3>
                                </div>
                                <?php
                                $pry = "SELECT CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $cour['profesorid'] . "')";
                                $psl = $mysqli->query($pry);
                                $prf = $psl->fetch_assoc()
                                ?>
                                <div class="py-1">
                                  <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <?php echo mb_convert_case($prf['profe'], MB_CASE_TITLE, 'utf-8'); ?></p>
                                  <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $catenom[$cour['categoriaid']]; ?></span></p>
                                  <?php if (($cour['megusta'] < 1) || (is_null($cour['megusta']))) { ?>
                                    <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                                  <?php } else { ?>
                                    <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $cour['megusta']; ?> me gusta</span></p>
                                  <?php } ?>
                                  <?php /*Precios*/ ?>
                                  <div class="d-flex">
                                    <?php if ($cour['ofertaactiva'] == 'S') { ?>
                                      <h5 class="mb-1 line-through"><i class="icon-line-shopping-cart mr-1"></i><?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                      <h5 class="mb-1 ml-2 sales"><?php echo $moneda; ?><?php echo $cour['preciooferta']; ?></h5>
                                    <?php } else { ?>
                                      <h5 class="mb-1 sales"><i class="icon-line-shopping-cart mr-1"></i><?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
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
                                  <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&qid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                                  <?php
                                } else {
                                  $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                                  $sbl = $mysqli->query($sby);
                                  if ($sbl->num_rows == 1) {
                                  ?>
                                    <button class="button button-aqua button-small button-rounded mx-4 w-100" onclick="window.location.href='clase.php?pid=<?php echo ($cour['id']); ?>&qid=1&sid=<?php echo ($cour['slug']); ?>'"><i class="icon-line-arrow-right"></i><span>IR AL CURSO</span></button>
                                  <?php
                                  } else {
                                  ?>
                                    <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                                <?php
                                  }
                                }
                              } else {
                                ?>
                                <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid<?php echo $cour['id']; ?>/<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                              <?php
                              }
                              ?>
                            </div>
                          </div>
                        </article>
                    <?php
                      }
                    }
                    ?>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          <?php
          }
        } else {
          //No hay ningún curso
          ?>
          <div class="mt-n5"></div>
        <?php
        }
        ?>
        <?php
        if (!isset($_SESSION['cod'])) {
        ?>
          <?php /* POSTULA COMO PROFESOR */ ?>
          <?php
          $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'seunprofesor' AND pagina = 'index' ";
          $slt = $mysqli->query($sry);
          $saw = $slt->fetch_assoc();
          if ($saw['estado'] == 'A') {
          ?>
            <div class="section dark dark-texture my-0">
              <div class="container">
                <div class="row d-flex align-items-center">
                  <div class="col-lg-5 w-75">
                    <h2>Se un <span class="text-aqua">profesor</span></h2>
                    <p class="lh-4 w-75"><?php echo $saw['descripcion']; ?></p>
                    <button class="button button-aqua button-rounded" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i>POSTULATE</button>
                  </div>
                  <div class="col-lg-7">
                    <img class="my-4 rounded-lg" src="img/<?php echo $saw['foto']; ?>?i=<?php echo micro(); ?>" alt="Postúlate" data-animate="fadeIn">
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
        <?php
        if (!isset($_SESSION['tip'])) {
        ?>
          <?php /* NUESTROS PROFESORES */ ?>
          <?php
          $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'nuestrosprofesores' AND pagina = 'index' ";
          $slt = $mysqli->query($sry);
          $saw = $slt->fetch_assoc();
          if ($saw['estado'] == 'A') {
            $num_profes = $saw['posicion']; //Cuantos profesores muestra
          ?>
            <div class="container clearfix">
              <div class="heading-block topmargin-sm center">
                <h3 class="mb-3 pt-4 text-aqua"><?php echo $saw['titulo']; ?></h3>
                <p class="col-9 mx-auto"><?php echo $saw['descripcion']; ?></p>
              </div>
              <div class="row">
                <?php
                $qry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS names FROM " . odo_DATA_PROF . " WHERE ((tipo = 'P' OR tipo = 'R') AND foto != 'nofoto.svg') ORDER BY RAND() LIMIT " . $num_profes;
                $rsl = $mysqli->query($qry);
                $hay = $rsl->num_rows;
                while ($profe = $rsl->fetch_assoc()) {
                ?>
                  <div class="col-6 col-sm-6 col-md-4 col-lg-3 bottommargin">
                    <a href="teacher.php?sid=<?php echo ($profe['slug']); ?>">
                      <div class="team rounded-lg shadow">
                        <div class="team-image">
                          <?php if ($profe['foto'] == null) { ?>
                            <img class="border border-info rounded-top" src="img/profesores/nofoto.svg?i=<?php echo micro(); ?>" alt="<?php echo $profe['names']; ?>">
                          <?php } else { ?>
                            <img class="border border-info rounded-top" src="img/profesores/<?php echo $profe['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $profe['names']; ?>">
                          <?php } ?>
                        </div>
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
                            <button class="button button-small button-aqua button-rounded px-2 read-more-trigger read-more-trigger-right"></button>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                }
                ?>
              </div>
              <?php
              if ($hay > 4) {
              ?>
                <div class="row mb-5 mt-1">
                  <div class="col-12 text-center">
                    <button class="button button-rounded button-aqua px-5" onclick="window.location.href='profesores.php';"><i class="icon-line-search"></i>VER MAS</button>
                  </div>
                </div>
            <?php
              }
            }
            ?>
            </div>
          <?php
        }
          ?>
          <?php
          if (!isset($_SESSION['cod'])) {
          ?>
            <?php /* CALL TO ACTION PROFESORES*/ ?>
            <?php
            $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'calltoactionprofe' AND pagina = 'index' ";
            $slt = $mysqli->query($sry);
            $saw = $slt->fetch_assoc();
            if ($saw['estado'] == 'A') {
            ?>
              <div class="section bg-dark dark promo promo-border promo-full p-4 my-0">
                <div class="container clearfix">
                  <div class="row align-items-center">
                    <div class="col-12 col-lg">
                      <h4 class="pt-4"><?php echo $saw['descripcion']; ?></h4>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <button class="button button-rounded button-aqua" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i>POSTULATE</button>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
          <?php
          if (!isset($_SESSION['cod'])) {
            $sry = "SELECT * FROM " . odo_DATA_INTE . " WHERE tipo = 'contacto' AND pagina = 'index' ";
            $slt = $mysqli->query($sry);
            $saw = $slt->fetch_assoc();
            if ($saw['estado'] == 'A') {
          ?>
              <?php /* CONTACTENOS */ ?>
              <div class="row clearfix align-items-stretch mb-0">
                <div class="d-none d-md-block col-12 col-md-6 col-padding" style="background: url('img/<?php echo $saw['foto']; ?>') center center no-repeat; background-size: cover;"></div>
                <div class="col-12 col-md-6 center col-padd light-texture">
                  <div class="heading-block border-bottom-0">
                    <h3>Contáctanos</h3>
                    <p class="my-0 small"><span class="text-danger">*</span>Todos los campos son requeridos</p>
                  </div>
                  <div class="center bottommargin">
                    <form name="contactoweb" action="contacto.php" method="post" class="max-w-lg my-4">
                      <div class="form-group col-lg-12 text-left">
                        <label for="cNombre" class="w-100">Nombres y Apellidos<span class="text-danger">*</span><span class="float-right" id="cNombreError"></span></label>
                        <input autocomplete="off" class="form-control" id="cNombre" minlength="3" name="cNombre" placeholder="Su nombre y apellido" required tabindex="1" type="text">
                      </div>
                      <div class="form-row col-lg-12">
                        <div class="form-group col-lg-6 text-left">
                          <label for="cEmail" class="w-100">Email<span class="text-danger">*</span><span class="float-right" id="cEmailError"></span></label>
                          <input autocomplete="off" class="form-control" id="cEmail" name="cEmail" placeholder="Correo electrónico" required tabindex="2" type="email">
                        </div>
                        <div class="form-group col-lg-6 text-left">
                          <label for="cFono" class="w-100">Teléfono<span class="text-danger">*</span><span class="float-right" id="cFonoError"></span></label>
                          <input autocomplete="off" class="form-control nume" id="cFono" minlength="6" name="cFono" placeholder="Número de teléfono" required tabindex="3" type="tel">
                        </div>
                      </div>
                      <div class="form-group col-lg-12 text-left">
                        <?php //Geolocalización
                        require_once 'geoplugin.class.php';
                        $geoplugin = new geoPlugin();
                        $geoplugin->locate();
                        $codpais = $geoplugin->countryCode;
                        ?>
                        <label for="cPais" class="w-100">País<span class="text-danger">*</span><span class="float-right" id="cPaisError"></span></label>
                        <select class="form-control selectpicker show-tick" data-live-search="true" data-size="3" id="cPais" name="cPais" required title="Indique país" tabindex="4">
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
                      <div class="form-group col-lg-12 text-left">
                        <label for="cMensaje" class="w-100">Mensaje<span class="text-danger">*</span><span class="float-right" id="cMensajeError"></span></label>
                        <textarea autocomplete="off" class="form-control" id="cMensaje" name="cMensaje" placeholder="Escriba aquí su mensaje" required rows="4" tabindex="5"></textarea>
                      </div>
                      <button class="button button-rounded button-small button-blue" tabindex="6" type="submit"><i class="icon-line-mail"></i><span>CONTACTANOS</span></button>
                    </form>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
      </div>
    </section>
    <?php include 'footer.php'; ?>
  </div>
  <div id="gotoTop" class="icon-line-chevron-up"></div>
  <?php require 'scripts.php'; ?>
  <script>
    <?php
    if (!isset($_SESSION['cod'])) {
    ?>
      $('.selectpicker').selectpicker('val', '<?php echo $codpais; ?>');
      var _0x31e143 = _0x21db;

      function _0x21db(_0x275bd6, _0x65b781) {
        var _0x2b9890 = _0x2b98();
        return _0x21db = function(_0x21dbd3, _0x32ff17) {
          _0x21dbd3 = _0x21dbd3 - 0x14f;
          var _0x41f480 = _0x2b9890[_0x21dbd3];
          return _0x41f480;
        }, _0x21db(_0x275bd6, _0x65b781);
      }(function(_0x2ee90f, _0x20d75e) {
        var _0x486932 = _0x21db,
          _0x15d1fe = _0x2ee90f();
        while (!![]) {
          try {
            var _0x1175ed = -parseInt(_0x486932(0x164)) / 0x1 + -parseInt(_0x486932(0x16f)) / 0x2 * (parseInt(_0x486932(0x15c)) / 0x3) + -parseInt(_0x486932(0x153)) / 0x4 + parseInt(_0x486932(0x161)) / 0x5 + parseInt(_0x486932(0x165)) / 0x6 * (-parseInt(_0x486932(0x152)) / 0x7) + parseInt(_0x486932(0x171)) / 0x8 * (-parseInt(_0x486932(0x16b)) / 0x9) + parseInt(_0x486932(0x156)) / 0xa * (parseInt(_0x486932(0x15d)) / 0xb);
            if (_0x1175ed === _0x20d75e) break;
            else _0x15d1fe['push'](_0x15d1fe['shift']());
          } catch (_0xe2972b) {
            _0x15d1fe['push'](_0x15d1fe['shift']());
          }
        }
      }(_0x2b98, 0x634ee), $(_0x31e143(0x158))[_0x31e143(0x15b)]({
        'hiddenInput': _0x31e143(0x15e),
        'initialCountry': _0x31e143(0x169),
        'allowDropdown': ![],
        'separateDialCode': !![],
        'utilsScript': _0x31e143(0x159),
        'geoIpLookup': function(_0x3fff03) {
          var _0x4a3158 = _0x31e143;
          $['get']('https://ipinfo.io', function() {}, _0x4a3158(0x167))['always'](function(_0x2a9e0c) {
            var _0x58d06d = _0x2a9e0c && _0x2a9e0c['country'] ? _0x2a9e0c['country'] : 'es';
            _0x3fff03(_0x58d06d);
          });
        }
      }), $(function() {
        var _0x3cfe2f = _0x31e143;
        $['validator'][_0x3cfe2f(0x178)](_0x3cfe2f(0x162), function(_0x503cf7, _0x18cfa3) {
          var _0x43dfd5 = _0x3cfe2f;
          return this[_0x43dfd5(0x16e)](_0x18cfa3) || /^[a-z\s áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i ['test'](_0x503cf7);
        }, _0x3cfe2f(0x179)), $(_0x3cfe2f(0x175))[_0x3cfe2f(0x166)]({
          'rules': {
            'cNombre': {
              'required': !![],
              'minlength': 0x3,
              'sololetras': !![]
            },
            'cEmail': {
              'required': !![],
              'email': !![]
            },
            'cFono': {
              'required': !![],
              'minlength': 0x6
            },
            'cPais': {
              'required': !![]
            },
            'cMensaje': {
              'required': !![]
            }
          },
          'messages': {
            'cNombre': {
              'required': _0x3cfe2f(0x155),
              'minlength': 'Mínimo\x203\x20caracteres'
            },
            'cEmail': {
              'required': _0x3cfe2f(0x154),
              'email': _0x3cfe2f(0x170)
            },
            'cFono': {
              'required': _0x3cfe2f(0x16a),
              'minlength': _0x3cfe2f(0x14f)
            },
            'cPais': {
              'required': _0x3cfe2f(0x160)
            },
            'cMensaje': {
              'required': 'Escriba\x20su\x20mensaje'
            }
          },
          'errorPlacement': function(_0x4f8e81, _0x36c3b2) {
            var _0x578155 = _0x3cfe2f;
            if (_0x36c3b2[_0x578155(0x173)](_0x578155(0x168)) == _0x578155(0x150)) _0x4f8e81[_0x578155(0x172)](_0x578155(0x16d));
            if (_0x36c3b2[_0x578155(0x173)]('name') == _0x578155(0x176)) _0x4f8e81[_0x578155(0x172)](_0x578155(0x151));
            if (_0x36c3b2[_0x578155(0x173)](_0x578155(0x168)) == _0x578155(0x15e)) _0x4f8e81['appendTo']('#cFonoError');
            if (_0x36c3b2['attr'](_0x578155(0x168)) == _0x578155(0x177)) _0x4f8e81[_0x578155(0x172)](_0x578155(0x157));
            if (_0x36c3b2[_0x578155(0x173)](_0x578155(0x168)) == _0x578155(0x15f)) _0x4f8e81[_0x578155(0x172)](_0x578155(0x16c));
          },
          'submitHandler': function(_0x55eba7) {
            var _0x414d46 = _0x3cfe2f;
            _0x55eba7[_0x414d46(0x15a)]();
          }
        }), $(_0x3cfe2f(0x163))['on']('change', function() {
          var _0x272cb4 = _0x3cfe2f;
          $(_0x272cb4(0x157))[_0x272cb4(0x174)]();
        });
      }));

      function _0x2b98() {
        var _0x38ea4d = ['name', 'auto', 'Ingrese\x20su\x20teléfono', '45450HCLcuV', '#cMensajeError', '#cNombreError', 'optional', '2gOYimy', 'Dirección\x20de\x20correo\x20no\x20válida', '488aruCVA', 'appendTo', 'attr', 'fadeOut', 'form[name=\x27contactoweb\x27]', 'cEmail', 'cPais', 'addMethod', 'Sólo\x20letras', 'Mínimo\x206\x20dígitos', 'cNombre', '#cEmailError', '3427683EGVaWj', '2243396GGtXfF', 'Ingrese\x20su\x20email', 'Ingrese\x20su\x20nombre\x20y\x20apellido', '4106290VEjoMX', '#cPaisError', '#cFono', './js/utils.min.js', 'submit', 'intlTelInput', '1473753jUEZgp', '55CNnmwA', 'cFono', 'cMensaje', 'Indique\x20su\x20país', '1923515tGejRy', 'sololetras', '#cPais', '181263vTxeii', '6XNYPdl', 'validate', 'jsonp'];
        _0x2b98 = function() {
          return _0x38ea4d;
        };
        return _0x2b98();
      }
    <?php
    }
    ?>
    <?php /*Valores númericos*/ ?>
    $('.nume').numerico();
  </script>
  <?php include 'notify.php'; ?>
</body>

</html>