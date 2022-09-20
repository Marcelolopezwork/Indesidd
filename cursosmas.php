<?php
//Carga más cursos
require 'cfg.inc.php';
sleep(1);

if ($_POST) {
  $ids = $_POST['z'];
  $lim = $_POST['l'];
  $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (id > '$ids' AND estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY id LIMIT " . $lim;
  $usl = $mysqli->query($ury);
  $haycurso = $usl->num_rows;
  if ($haycurso > 0) {
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
              <img class="img-fluid" src="img/cursos/<?php echo $cour['imagen']; ?>" alt="Video" width="410" height="270">
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
                <button class="button button-light button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                <?php
              } else {
                //Login como alumno
                $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                $sbl = $mysqli->query($sby);
                if ($sbl->num_rows == 1) {
                  //Como alumno que compró el curso
                ?>
                  <button class="button button-aqua button-small button-rounded mx-4 w-100" onclick="window.location.href='clase.php?pid=<?php echo ($cour['id']); ?>$qid=1&sid=<?php echo ($cour['slug']); ?>'"><i class="icon-line-arrow-right"></i><span>IR AL CURSO</span></button>
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
      $next = $cour['id'];
    }
    $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (id > '$ids' AND estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY id";
    $usl = $mysqli->query($ury);
    $quedan = $usl->num_rows;
    $cuantos = $quedan - $lim;
    if ($cuantos >= 0) {
    ?>
      <div class="text-center w-100">
        <button type="button" class="button button-dark button-large button-rounded vermas" data-lim="<?php echo $lim; ?>" id="<?php echo $next; ?>">Ver más cursos</button>
      </div>
    <?php
    }
    ?>
    <script src="js/fnc.min.js"></script>
<?php
  }
}
