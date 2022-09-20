<?php
//Cursos de cada profesor
require 'cfg.inc.php';
$dndtoy = 25;
if (!isset($_GET['sid'])) header('location:profesores.php');
else $pro = $_GET['sid'];
$query = "SELECT *, CONCAT(nombres, ' ', apellidos) AS profesor FROM " . odo_DATA_PROF . " WHERE slug = '" . $pro . "' AND estado = 'A' ";
$result = $mysqli->query($query);
if ($result->num_rows == 0) {
  header('location:index.php');
} else {
  $data = $result->fetch_assoc();
  include 'header.php';
?>

  <body class="stretched">
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header dark">
        <?php include 'menu.php'; ?>
      </header>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap">
          <div class="container clearfix">
            <h3><?php echo $data['profesor']; ?></h3>
            <div class="media">
              <blockquote class="blockquote-reverse">
                <?php if ($data['foto'] == null) { ?>
                  <img class="img-thumbnail align-self-start teacher" src="img/profesores/nofoto.svg" alt="">
                <?php } else { ?>
                  <img class="img-thumbnail align-self-start teacher" src="img/profesores/<?php echo $data['foto']; ?>?i=<?php echo micro(); ?>" alt="">
                <?php } ?>
              </blockquote>
              <div class="media-body">
                <p class="text-teacher"><?php echo $data['sobremi']; ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="container clearfix my-4">
          <div class="row posts-md">
            <?php
            $cry = "SELECT * FROM " . odo_DATA_CURS . " WHERE (profesorid = '" . $data['id'] . "' AND estado = 'A' AND publicado = 'S') ";
            $csl = $mysqli->query($cry);
            if ($csl->num_rows > 0) {
              while ($cour = $csl->fetch_assoc()) {
            ?>
                <article class="portfolio-item col-lg-4 col-md-4 col-sm-6 col-12">
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
                        $cay = "SELECT categoria FROM " . odo_DATA_CATE . " WHERE (id = '" . $cour['categoriaid'] . "' AND estado = 'A')";
                        $cal = $mysqli->query($cay);
                        $cat = $cal->fetch_assoc()
                        ?>
                        <div class="py-1">
                          <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $cat['categoria']; ?></span></p>
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
                          <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
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
                            <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                        <?php
                          }
                        }
                      } else {
                        //No login en el sistema
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
            } else {
              ?>
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
<?php
}
?>