<?php
//CURSOS AGRUPADOS POR CATEGORÍAS
require 'cfg.inc.php';

$dndtoy = 26;
$buscador = false;

include 'header.php';

$pid = ($_GET['sid']);
$qry = "SELECT * FROM " . odo_DATA_CATE . " WHERE slug = '$pid' AND estado = 'A' ORDER BY id ";
$rsl = $mysqli->query($qry);
$cat = $rsl->fetch_assoc();
?>

<body class="stretched">
  <div id="wrapper" class="clearfix">
    <?php /* MENÚ */ ?>
    <header id="header" class="full-header dark">
      <?php include 'menu.php'; ?>
    </header>
    <?php /* CONTENIDO */ ?>
    <section id="content">
      <div class="content-wrap bg-light pb-3">
        <div class="container clearfix">
          <h3>Categoría <span class="text-secondary"><?php echo $cat['categoria']; ?></span></h3>
          <?php
          $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE categoriaid = '" . $cat['id'] . "' AND estado = 'A' AND publicado = 'S' ";
          $usl = $mysqli->query($ury);
          $haycurso = $usl->num_rows;
          if ($haycurso > 0) {
          ?>
            <div id="portfolio" class="portfolio row grid-container" data-layout="fitRows">
              <?php
              while ($cour = $usl->fetch_assoc()) {
              ?>
                <article class="portfolio-item col-md-4 col-sm-6 col-12">
                  <div class="grid-inner mb-5 shadow">
                    <?php /*Video*/ ?>
                    <div class="portfolio-image">
                      <div class="max-photo">
                        <img src="<?php echo "img/cursos/" . $cour['imagen']; ?>" alt="Video">
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
                          <h3><?php echo $cour['curso']; ?></h3>
                        </div>
                        <?php
                        $pry = "SELECT CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $cour['profesorid'] . "')";
                        $psl = $mysqli->query($pry);
                        $prf = $psl->fetch_assoc()
                        ?>
                        <div class="py-1">
                          <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <?php echo $prf['profe']; ?></p>
                          <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $cat['categoria']; ?></span></p>
                          <?php if (($cour['megusta'] < 1) || (is_null($cour['megusta']))) { ?>
                            <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                          <?php } else { ?>
                            <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $cour['megusta']; ?> me gusta</span></p>
                          <?php } ?>
                        </div>
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
                    <?php /*Botones*/ ?>
                    <div class="bg-white d-flex justify-content-center pb-3 pt-1 rounded-bottom">
                      <?php
                      if (isset($_SESSION['cod'])) {
                        if ($_SESSION['tip'] == 'P') {
                      ?>
                          <button class="button button-light button-rounded mx-4 w-100" onclick="window.location.href='detalle?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                          <?php
                        } else {
                          $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                          $sbl = $mysqli->query($sby);
                          if ($sbl->num_rows == 1) {
                          ?>
                            <button class="button button-aqua button-rounded mx-4 w-100" onclick="window.location.href='clase.php?pid<?php echo ($cour['id']); ?>&qid=1&sid=<?php echo $cour['slug']; ?>'"><i class="icon-line-arrow-right"></i><span>Ir al curso</span></button>
                          <?php
                          } else {
                          ?>
                            <button class="button button-light button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                        <?php
                          }
                        }
                      } else {
                        ?>
                        <button class="button button-light button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
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
          <?php
          } else {
          ?>
            <p class="text-center">Aún no hay cursos en esta categoría</p>
          <?php
          }
          ?>
        </div>
      </div>
    </section>
    <?php include 'footer.php'; ?>
  </div>
  <div id="gotoTop" class="icon-line-chevron-up"></div>
  <?php require 'scripts.php'; ?>
</body>

</html>