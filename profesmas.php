<?php
//Carga más profesores
require 'cfg.inc.php';
sleep(1);

if ($_POST) {
  $ids = $_POST['z'];
  $lim = $_POST['l'];
  $ury = "SELECT *, CONCAT(nombres, ' ', apellidos) AS names FROM " . odo_DATA_PROF . " WHERE (id > '$ids' AND estado = 'A') ORDER BY id LIMIT " . $lim;
  $usl = $mysqli->query($ury);
  $hayprofe = $usl->num_rows;
  if ($hayprofe > 0) {
    while ($prof = $usl->fetch_assoc()) {
?>
      <div class="col-lg-3 col-md-6 bottommargin">
        <div class="team rounded-lg shadow">
          <a href="profesor/<?php echo ($prof['slug']); ?>">
            <div class="team-image">
              <?php if ($prof['foto'] == null) { ?>
                <img class="border rounded-top" src="img/profesores/nofoto.svg" alt="<?php echo $prof['names']; ?>">
              <?php } else { ?>
                <img class="border grayscale rounded-top" src="img/profesores/<?php echo $prof['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $prof['names']; ?>">
              <?php } ?>
            </div>
          </a>
          <div class="team-desc team-desc-bg rounded-bottom">
            <?php
            $lry = "SELECT SUM(megusta) AS likes FROM " . odo_DATA_CURS . " WHERE (profesorid = '" . $prof['id'] . "' AND estado = 'A')";
            $lsl = $mysqli->query($lry);
            $likes = $lsl->fetch_assoc();
            ?>
            <h5 class="mb-0"><?php echo mb_convert_case($prof['names'], MB_CASE_TITLE, 'utf-8'); ?></h5>
            <p class="font-weight-bold my-0 small text-grey"><?php echo mb_convert_case($prof['especialidad'], MB_CASE_TITLE, 'utf-8'); ?></p>
            <?php if (($likes['likes'] < 1) || (is_null($likes['likes']))) { ?>
              <p class="small my-0"><i class="icon-line-sun"></i> Profesor debutante</p>
            <?php } else { ?>
              <p class="small my-0"><i class="icon-line-heart"></i> <?php echo $likes['likes']; ?> me gusta</p>
            <?php } ?>
            <div class="small" data-readmore="true" data-readmore-trigger-open="<i class='icon-line-maximize'></i>" data-readmore-trigger-close="<i class='icon-line-minimize'></i>">
              <p class="mt-4 px-4 small text-left"><?php echo $prof['sobremi']; ?></p>
              <a href="#" class="button button-small button-aqua button-rounded px-2 read-more-trigger read-more-trigger-right"></a>
            </div>
          </div>
        </div>
      </div>
    <?php
      $next = $prof['id'];
    }
    $mry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS names FROM " . odo_DATA_PROF . " WHERE (id > '$next' AND estado = 'A') ORDER BY id LIMIT " . $lim;
    $msl = $mysqli->query($mry);
    $quedan = $msl->num_rows;
    $cuantos = $quedan - $lim;
    if ($cuantos >= 0) {
    ?>
      <div class="text-center w-100">
        <button type="button" class="button button-dark button-large button-rounded vermas" data-lim="<?php echo $lim; ?>" id="<?php echo $next; ?>">Ver más profesores</button>
      </div>
    <?php
    }
    ?>
    <script src="js/fnc.min.js"></script>
<?php
  }
}
