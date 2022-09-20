<?php
//DETALLE DE UN CURSO
require 'cfg.inc.php';
if (!isset($_GET['pid'])) $_GET['pid'] = 1;
$dndtoy = 3;

$select = true;
if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
$did = ($_GET['pid']);

$qry = "SELECT *, id AS vid FROM " . odo_DATA_CURS . " WHERE id = '$did' AND publicado = 'S' AND venta = 'S' AND estado = 'A' ";
$rsl = $mysqli->query($qry);
$revok = $rsl->num_rows;

if ($revok == 0) {
  header('location:cursos.php');
} else {
  include 'header.php';
?>

  <body class="stretched">
    <?php
    $cour = $rsl->fetch_assoc();
    $date = date_create($cour['fechaactualizacion']);
    $fecha = date_format($date, 'd M, Y');

    $cry = "SELECT categoria AS cate FROM " . odo_DATA_CATE . " WHERE id = '" . $cour['categoriaid'] . "' AND estado = 'A' ";
    $csl = $mysqli->query($cry);
    $cat = $csl->fetch_assoc();

    $pry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE id = '" . $cour['profesorid'] . "' ";
    $psl = $mysqli->query($pry);
    $prf = $psl->fetch_assoc();
    ?>
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header dark">
        <?php include 'menu.php'; ?>
      </header>
      <?php /* BREADCRUMB */ ?>
      <section id="page-title">
        <div class="container clearfix">
          <h2 class="breadcrumb-max-width-title mb-0"><?php echo $cour['curso']; ?></h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="cursos.php">Cursos</a></li>
          </ol>
        </div>
      </section>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap">
          <?php /* CURSO */ ?>
          <div class="container clearfix">
            <div class="row">
              <?php /* MUESTRA VIDEO DEL CURSO */ ?>
              <div class="col-12 col-lg-7">
                <div class="center mb-4 w-100">
                  <?php $trail = explode('/', $cour['trailer']); ?>
                  <iframe class="bg-white border" src="https://player.vimeo.com/video/<?php echo $trail[3]; ?>" frameborder="0" allow="autoplay; fullscreen;" allowfullscreen width="600" height="300" title="Trailer: Indesid"></iframe>
                </div>
              </div>
              <?php /* MUESTRA DATOS DEL CURSO */ ?>
              <div class="col-12 col-lg-5">
                <div class="entry">
                  <div class="entry-title title-xs">
                    <h3><?php echo $cour['curso']; ?></h3>
                    <h4 class="text-blue"><?php echo $cat['cate']; ?></h4>
                  </div>
                  <div class="nott">
                    <p class="font-weight-bold my-0"><i class="icon-line-shield"></i> <?php echo $prf['profe']; ?></p>
                    <?php
                    if (($cour['megusta'] < 1) || (is_null($cour['megusta']))) {
                    ?>
                      <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                    <?php
                    } else {
                    ?>
                      <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $cour['megusta']; ?> me gusta</span></p>
                    <?php
                    }
                    ?>
                    <div class="d-flex mb-1">
                      <?php
                      if ($cour['ofertaactiva'] == 'S') {
                      ?>
                        <h5 class="mb-1 line-through"><i class="icon-line-shopping-cart mr-1"></i><?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                        <h5 id="tot" class="mb-1 ml-2 sales"><?php echo $moneda; ?><?php echo $cour['preciooferta']; ?> <span><i class="added icon-line-help-circle small" data-toggle="popover" data-content="<?php echo $txtdcto; ?>" data-trigger="hover"></i></span></h5>
                      <?php
                      } else {
                      ?>
                        <h5 id="tot" class="mb-1 sales"><i class="icon-line-shopping-cart mr-1"></i><?php echo $moneda; ?><?php echo $cour['precioventa']; ?> <span><i class="added icon-line-help-circle small" data-toggle="popover" data-content="<?php echo $txtdcto; ?>" data-trigger="hover"></i></span></h5>
                      <?php
                      }
                      ?>
                    </div>
                    <?php
                    if (!isset($_SESSION['cod'])) {
                    ?>
                      <div class="d-block ml-n1">
                        <button class="button button-blue button-rounded w-75" onclick="window.location.href='add.php?pid=<?php echo base64_encode($cour['id']); ?>'"><i class="icon-line-shopping-cart"></i><span><?php echo $txtBtnBuy; ?></span></button>
                      </div>
                      <?php
                    }
                    if ((isset($_SESSION['cod'])) && ($_SESSION['tip'] == 'U')) {
                      $sby = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A' ";
                      $sbl = $mysqli->query($sby);
                      if ($sbl->num_rows > 0) {
                      ?>
                        <div class="d-block ml-n1">
                          <button class="button button-aqua button-rounded" onclick="window.location.href='clase.php?pid=<?php echo ($cour['id']); ?>&qid=1&sid=<?php echo ($cour['slug']); ?>'"><i class="icon-line-arrow-right"></i><span>Ir al curso</span></button>
                        </div>
                        <?php
                      } else {
                        //Si hay algún descuento disponible
                        $dry = "SELECT * FROM " . odo_DATA_DESC . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND utilizado IS NULL AND fechauso IS NULL AND estado = 'A' ORDER BY id ";
                        $dsl = $mysqli->query($dry);
                        $haydescuento = $dsl->num_rows;
                        if ($haydescuento > 0) {
                        ?>
                          <div id="mostrardscto">
                            <form id="aplicadscto" class="mb-0 mt-1 w-75">
                              <input type="hidden" id="cid" name="cid" value="<?php echo base64_encode('Aplicar'); ?>">
                              <input type="hidden" id="did" name="did" value="<?php echo base64_encode(rand(11, 20)); ?>">
                              <input type="hidden" id="mid" name="mid" value="<?php echo base64_encode(rand(1, 10)); ?>">
                              <input type="hidden" id="pid" name="pid" value="<?php echo base64_encode($cour['id']); ?>">
                              <h5 class="mb-0 mt-2 text-secondary text-uppercase">Códigos de descuento<span><i class="icon-line-help-circle small" data-toggle="popover" data-content="Si lo aplica, el código de descuento quedará vinculado a éste curso" data-trigger="hover"></i></h5>
                              <div class="align-items-center d-flex form-group">
                                <div id="cuanto" class="w-100">
                                  <select class="form-control form-control-sm selectpicker" id="descuento" name="descuento">
                                    <option value="0" selected>Sin utilizar</option>
                                    <?php
                                    while ($dct = $dsl->fetch_assoc()) {
                                    ?>
                                      <option value="<?php echo $dct['id']; ?>"><?php echo $dct['codigo'] . " (" . $dct['descuento'] . "%)"; ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div id="codes"></div>
                                <button id="aplicar" class="aplicacode" disabled>APLICAR</button>
                              </div>
                            </form>
                          </div>
                          <div class="d-block mt-1" id="resdscto"></div>
                        <?php
                        }
                        ?>
                        <div class="d-block ml-n1 mt-1">
                          <button class="button button-blue button-rounded w-75" onclick="window.location.href='add.php?pid=<?php echo base64_encode($cour['id']); ?>'"><i class="icon-line-shopping-cart"></i><span><?php echo $txtBtnBuy; ?></span></button>
                        </div>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php /* SOBRE EL CURSO y EL PROFESOR */ ?>
          <div class="container mx-auto topmargin">
            <div class="row">
              <?php /* DESCRIPCIÓN */ ?>
              <div class="col-12 mb-5">
                <div class="bg-white border p-4 rounded shadow">
                  <h4 class="mb-1">Descripción del curso</h4>
                  <p><?php echo $cour['descripcion']; ?></p>
                </div>
              </div>
              <?php /* DATOS SOBRE EL CURSO */ ?>
              <div class="col-md-6 col-lg-4">
                <div class="bg-white border p-4 rounded shadow">
                  <h4 class="mb-2 mt-0 text-blue">Sobre este curso</h4>
                  <div class="nott">
                    <h5 class="my-0"><i class="icon-line-award"></i> Nivel</h5>
                    <p class="ml-3 my-0">
                      <?php if ($cour['nivel'] == 'B') echo 'Básico'; ?>
                      <?php if ($cour['nivel'] == 'I') echo 'Intermedio'; ?>
                      <?php if ($cour['nivel'] == 'A') echo 'Avanzado'; ?>
                    </p>
                  </div>
                  <div class="nott">
                    <h5 class="my-0"><i class="icon-line-clock"></i> Duración total</h5>
                    <p class="ml-3 my-0">
                      <?php
                      $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(duracion))) AS horas FROM " . odo_DATA_CLAS . " WHERE cursoid = '" . $cour['id'] . "' ";
                      $result = $mysqli->query($query);
                      $duracion = $result->fetch_assoc();
                      if (!is_null($duracion['horas'])) echo $duracion['horas'];
                      else echo "00:00:30";
                      ?> hrs.
                    </p>
                  </div>
                  <div class="nott">
                    <h5 class="my-0"><i class="icon-line-users"></i> Estudiantes inscritos</h5>
                    <p class="ml-3 my-0">
                      <?php
                      $ary = "SELECT COUNT(cursoid) AS estudiantes FROM " . odo_DATA_ALUM . " WHERE cursoid='" . $cour['id'] . "' AND estado = 'A' ";
                      $asl = $mysqli->query($ary);
                      $alum = $asl->fetch_assoc();
                      if ($alum['estudiantes'] == 0) echo "Curso nuevo";
                      else echo $alum['estudiantes'];
                      ?>
                    </p>
                  </div>
                  <div class="nott">
                    <h5 class="my-0"><i class="icon-line-volume-1"></i> Audio</h5>
                    <p class="ml-3 my-0"><?php echo $cour['audio']; ?></p>
                  </div>
                  <div class="nott">
                    <h5 class="my-0"><i class="icon-line-speech-bubble"></i> Subtítulos</h5>
                    <p class="ml-3 my-0"><?php echo mb_convert_case($cour['subtitulos'], MB_CASE_TITLE, 'utf-8'); ?></p>
                  </div>
                  <div class="nott">
                    <h5 class="my-0"><i class="icon-line-calendar"></i> Última actualización</h5>
                    <p class="ml-3 my-0"><?php echo $fecha; ?></p>
                  </div>
                </div>
              </div>
              <?php /* ACERCA DEL PROFESOR */ ?>
              <div class="col-md-6 col-lg-8">
                <div class="bg-white border p-4 rounded shadow">
                  <h4 class="mb-2 mt-0 text-blue">Acerca del profesor</h4>
                  <div class="row">
                    <div class="text-center col-12 col-md-12 col-lg-4">
                      <?php if ($prf['foto'] == null) { ?>
                        <img class="img-thumbnail" src="img/profesores/nofoto.svg" alt="">
                      <?php } else { ?>
                        <img src="img/profesores/<?php echo $prf['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $prf['profe']; ?>">
                      <?php } ?>
                      <?php if (!isset($_SESSION['pod'])) { ?>
                        <button class="button button-aqua button-small button-rounded mx-0 w-100" onclick="window.location.href='teacher.php?sid=<?php echo ($prf['slug']); ?>';"><i class="icon-line-search"></i><span>Ver perfil</span></button>
                      <?php } ?>
                    </div>
                    <div class="col-12 col-md-12 col-lg-8">
                      <div class="nott">
                        <h5 class="my-0"><i class="icon-line-shield"></i> <?php echo $prf['profe']; ?></h5>
                        <p class="ml-3 my-0 small text-blue"><?php echo $prf['especialidad']; ?></p>
                        <hr>
                        <p class="ml-3 my-0 small"><?php echo nl2br($prf['sobremi']); ?></p>
                        </hr>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php /* MÓDULOS DEL CURSO */ ?>
            <div class="container mx-auto topmargin">
              <div class="row">
                <div class="bg-white border col p-4 rounded shadow">
                  <h4 class="mb-0 text-blue">Módulos y clases de éste curso</h4>
                  <p>Éste es el contenido que verás en el curso</p>
                  <div class="accordion accordion-bg" data-collapsible="true">
                    <?php
                    $mry = "SELECT * FROM " . odo_DATA_MODU . " WHERE cursoid='" . $cour['id'] . "' AND estado = 'A' ";
                    $msl = $mysqli->query($mry);
                    while ($modu = $msl->fetch_assoc()) {
                    ?>
                      <div class="accordion-header">
                        <div class="accordion-icon">
                          <i class="accordion-closed icon-line-chevron-up"></i>
                          <i class="accordion-open icon-line-chevron-down"></i>
                        </div>
                        <div class="accordion-title"><?php echo $modu['modulo']; ?></div>
                      </div>
                      <div class="accordion-content">
                        <h5 class="mt-2 mb-0">Clases:</h5>
                        <ul class="ml-5">
                          <?php
                          $sry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE moduloid='" . $modu['id'] . "' AND estado = 'A' ";
                          $ssl = $mysqli->query($sry);
                          while ($clas = $ssl->fetch_assoc()) {
                          ?>
                            <li><?php echo $clas['clase']; ?></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <?php /* COMENTARIOS */ ?>
            <div class="mx-auto my-5">
              <div class="row">
                <?php /* Lista de Comentarios */ ?>
                <div class="col-12">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="mb-2 text-blue">Comentarios anteriores</h4>
                    <?php
                    $bry = "SELECT " . odo_DATA_COME . ".*, CONCAT(" . odo_DATA_USUA . ".nombres, ' ', " . odo_DATA_USUA . ".apellidos) AS alumno FROM " . odo_DATA_COME . ", " . odo_DATA_USUA . " WHERE " . odo_DATA_COME . ".usuarioid = " . odo_DATA_USUA . ".id AND " . odo_DATA_COME . ".cursoid = '" . $cour['id'] . "' AND " . odo_DATA_COME . ".estado = 'A' ORDER BY " . odo_DATA_COME . ".fecha DESC LIMIT 8";
                    $bsl = $mysqli->query($bry);
                    if ($bsl->num_rows > 0) {
                    ?>
                      <ul class="ml-3 mr-2">
                        <?php
                        while ($comm = $bsl->fetch_assoc()) {
                        ?>
                          <li class="lista-sin-estilo small text-justify">
                            <?php echo $comm['comentario']; ?>
                            <h5 class="my-0 text-right"><?php echo $comm['alumno']; ?></h5>
                            <?php if (!empty($comm['respuesta'])) { ?>
                              <blockquote><?php echo $comm['respuesta']; ?></blockquote>
                              <h5 class="my-0 text-info text-right"><?php echo $prf['profe']; ?></h5>
                            <?php } ?>
                            <hr>
                          </li>
                        <?php
                        }
                        ?>
                      </ul>
                    <?php
                    } else {
                    ?>
                      <p>No hay comentarios.</p>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </section>
      <?php include 'footer.php'; ?>
    </div>
    <div id="gotoTop" class="icon-line-chevron-up"></div>
    <?php require 'scripts.php'; ?>
    <?php include 'notify.php'; ?>
    <?php //Visitantes
    require_once('geoplugin.class.php');
    $geoplugin = new geoPlugin();
    $geoplugin->locate();
    $ip = $geoplugin->ip;
    $ciudad = $geoplugin->city;
    $vpais = $geoplugin->countryName;
    $codpais = $geoplugin->countryCode;
    $conticode = $geoplugin->continentCode;
    if ($ip != '127.0.0.1') {
      $ipid = $cour['vid'];
      $vst = "SELECT * FROM " . odo_DATA_VISI . " WHERE cursoid = '$ipid' AND ip = '$ip' AND ciudad = '$ciudad' AND codpais = '$codpais' AND estado = 'A' ";
      $vsr = $mysqli->query($vst);
      $habia = $vsr->num_rows;
      if ($habia > 0) {
        $vsk = $vsr->fetch_assoc();
        $date = $vsk['fecha'];
        $ahorita = strtotime(date("d-m-Y H:i:s", time()));
        $fechareg = strtotime($date . "+ 1 days");
        $diff = $ahorita - $fechareg;
        if ($diff > 0) {
          $vst = "INSERT INTO " . odo_DATA_VISI . " (cursoid, ip, fecha, ciudad, pais, codpais, continentcode, estado) VALUES ('$ipid', '$ip', '$ult', '$ciudad', '$vpais', '$codpais', '$conticode', 'A')";
          $vsk = $mysqli->query($vst);
        }
      } else {
        $vst = "INSERT INTO " . odo_DATA_VISI . " (cursoid, ip, fecha, ciudad, pais, codpais, continentcode, estado) VALUES ('$ipid', '$ip', '$ult', '$ciudad', '$vpais', '$codpais', '$conticode', 'A')";
        $vsk = $mysqli->query($vst);
      }
    }
    ?>
    <?php
    if ($haydescuento > 0) {
    ?>
      <script>
        const a = '#aplicar';
        const c = '#codes';
        const q = '#cuanto';
        $('#descuento').on('change', function() {
          var valor = $('#descuento').val();
          var valop = '<?php echo base64_encode($cour['id']); ?>';
          if (valor !== '0') $(a).prop('disabled', false);
          else $(a).prop('disabled', true);
        });
        $(a).on('click', function(e) {
          let i = '#cid';
          $.ajax({
            url: 'dda.php',
            type: 'POST',
            data: $('#aplicadscto').serialize(),
          }).done(function(response) {
            const listo = JSON.parse(response);
            if (listo[0] == true) {
              if (listo[1] == 'aplica') {
                $(a).remove();
                $(q).remove();
                $(c).append(listo[3]);
                $(i).val(listo[4]);
              } else {
                $(i).val(listo[4]);
              }
              Toast.fire({
                icon: 'success',
                title: listo[2],
              });
            }
          }).fail(function() {
            Toast.fire({
              icon: 'warning',
              title: 'Ha ocurrido un error!!!',
            });
          });
          e.preventDefault();
        });
      </script>
    <?php
    }
    ?>
  </body>

  </html>
<?php
}
?>