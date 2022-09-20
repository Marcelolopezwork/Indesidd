<?php
//CLASE VISTA POR EL PROFESOR
require 'cfg.inc.php';
if (!isset($_SESSION['pod'])) {
  header('location:index.php');
} else {
  if ($_SESSION['tip'] == 'U') header('location:cursos.php');
  if (!isset($_GET['pid'])) header('location:cursos.php');
  if (!isset($_GET['qid'])) header('location:cursos.php');
  if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
  if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
  if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
  $dndtoy = 24;
  $fileinput = true;
  //Vimeo
  /*
    require '../vendor/vimeo/vimeo-api/autoload.php';
    use Vimeo\Vimeo;
    $client = new Vimeo(odo_VIDE_IDES, odo_VIDE_CLNT, odo_VIDE_ACTK);
    $response = $client->request('/tutorial', array(), 'GET');
    if ($response['status'] == '200') $correcto = true;
    else $correcto = false;
    */
  //EndVimeo
  //Revisa si el usuario ha comprado el curso
  //Datos del curso
  $cid = base64_decode($_GET['pid']);
  $did = base64_decode($_GET['qid']);
  $qry = "SELECT " . odo_DATA_CURS . ".*, " . odo_DATA_CURS . ".id AS vid, " . odo_DATA_CATE . ".categoria AS cate FROM " . odo_DATA_CURS . ", " . odo_DATA_CATE . " WHERE " . odo_DATA_CURS . ".categoriaid = " . odo_DATA_CATE . ".id AND " . odo_DATA_CURS . ".id='" . $cid . "' AND " . odo_DATA_CURS . ".estado = 'A' ";
  $rsl = $mysqli->query($qry);
  $revok = $rsl->num_rows;
  if ($revok == 1) {
    $cour = $rsl->fetch_assoc();
    $qour = $cour['id'];
    $date = date_create($cour['fechaactualizacion']);
    $fecha = date_format($date, 'd M, Y');
    //Datos del profesor
    $pry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $cour['profesorid'] . "')";
    $psl = $mysqli->query($pry);
    $prf = $psl->fetch_assoc();
    include 'header.php';
?>

    <body class="stretched">
      <div id="wrapper" class="clearfix">
        <?php /* MENÚ */ ?>
        <header id="header" class="full-header dark">
          <?php include 'menu.php'; ?>
        </header>
        <?php /* BREADCRUMB */ ?>
        <section id="page-title">
          <div class="container clearfix">
            <h2 class="mb-0"><?php echo $cour['curso']; ?></h2>
          </div>
        </section>
        <?php /* CONTENIDO */ ?>
        <section id="content">
          <div class="my-5">
            <div class="container clearfix">
              <div class="row">
                <?php /* MUESTRA VIDEO DEL CURSO */ ?>
                <div class="col-lg-7 mx-auto">
                  <div class="mb-3">
                    <?php
                    $vry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE cursoid='$cid' AND orden = '$did' AND estado = 'A' ";
                    $vsl = $mysqli->query($vry);
                    $vdo = $vsl->fetch_assoc();
                    $video = explode('/', $vdo['video']);
                    ?>
                    <iframe src="https://player.vimeo.com/video/<?php echo $video[3]; ?>" frameborder="0" allow="fullscreen" allowfullscreen mozallowfullscreen webkitallowfullscreen title="Video: Indesid" width="600" height="320"></iframe>
                  </div>
                </div>
                <?php /*DETALLES DEL CURSO*/ ?>
                <div class="col-lg-5">
                  <div class="entry">
                    <div class="entry-title title-xs nott">
                      <h3><?php echo $cour['curso']; ?></h3>
                      <h4 class="text-blue"><?php echo $cour['cate']; ?></h4>
                      <?php /*LIKES*/ ?>
                      <div id="megusta">
                        <div class="likes">
                        </div>
                      </div>
                    </div>
                    <?php /*CLASES*/ ?>
                    <ul class="lista-sin-estilo mt-n3">
                      <li>
                        <?php
                        $mry = "SELECT * FROM " . odo_DATA_MODU . " WHERE cursoid='$cid' AND estado = 'A' ";
                        $msl = $mysqli->query($mry);
                        while ($modu = $msl->fetch_assoc()) {
                          $mid = $modu['id'];
                        ?>
                          <h5 class="mb-2 mt-4"><?php echo $modu['modulo']; ?></h5>
                          <ul class="llevando">
                            <?php
                            $sry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE moduloid='$mid' AND estado = 'A' ";
                            $ssl = $mysqli->query($sry);
                            while ($clas = $ssl->fetch_assoc()) {
                              if ($did == $clas['orden']) $addclass = "actual text-info";
                              else $addclass = "cursado text-secondary";
                            ?>
                              <li id="<?php echo $clas['id']; ?>" class="small <?php echo $addclass; ?>">
                                <button class="check <?php echo $addclass; ?>" onclick="window.location.href='class.php?pid=<?php echo base64_encode($clas['cursoid']); ?>&qid=<?php echo base64_encode($clas['orden']); ?>'"><?php echo $clas['clase']; ?></button>
                              </li>
                            <?php
                            }
                            ?>
                          </ul>
                        <?php
                        }
                        ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <?php /* SOBRE EL CURSO y EL PROFESOR */ ?>
            <div class="container mx-auto mt-3">
              <div class="row">
                <?php /* Descripción */ ?>
                <div class="col-12 mb-5">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="my-1 text-blue">Descripción del curso</h4>
                    <p><?php echo $cour['descripcion']; ?></p>
                  </div>
                </div>
                <?php /* Sobre este curso */ ?>
                <div class="col-md-6 col-lg-4">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="my-1 text-blue">Sobre este curso</h4>
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
                        $duy = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(duracion))) AS horas FROM " . odo_DATA_CLAS . " WHERE cursoid = '$qour' ";
                        $dlt = $mysqli->query($duy);
                        $duracion = $dlt->fetch_assoc();
                        if (!is_null($duracion['horas'])) $dur = $duracion['horas'];
                        else $dur = "00:00:00";
                        ?>
                        <?php echo $dur; ?> hrs.
                      </p>
                    </div>
                    <div class="nott">
                      <h5 class="my-0"><i class="icon-line-users"></i> Estudiantes inscritos</h5>
                      <p class="ml-3 my-0">
                        <?php
                        if ($cour['estudiantes'] == 0) echo "Curso nuevo";
                        else echo $cour['estudiantes'];
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
                    <h4 class="my-1 text-blue">Acerca del profesor</h4>
                    <div class="row">
                      <div class="col-md-4">
                        <?php if ($prf['foto'] == null) { ?>
                          <img class="img-thumbnail" src="img/profesores/nofoto.svg" alt="Aún sin foto">
                        <?php } else { ?>
                          <img class="img-thumbnail" src="img/profesores/<?php echo $prf['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $prf['profe']; ?>">
                        <?php } ?>
                      </div>
                      <div class="col-md-8">
                        <div class="nott">
                          <h5 class="my-0"><i class="icon-line-shield"></i> <?php echo $prf['profe']; ?></h5>
                          <p class="ml-3 my-0 small text-blue"><?php echo $prf['especialidad']; ?></p>
                          <hr>
                          <p class="ml-3 my-0 small"><?php echo nl2br($prf['sobremi']); ?></p>
                        </div>
                        </hr>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php /* DESCARGA DE MATERIAL DEL CURSO Y COMENTARIOS */ ?>
            <div class="container mx-auto my-5">
              <div class="row">
                <?php /* Material del curso: Descarga de archivos */ ?>
                <div class="col-md-6 col-lg-6">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="mb-2 text-info">Material adjunto de ésta clase</h4>
                    <?php
                    if (!is_null($vdo['archivos'])) {
                    ?>
                      <ul class="ml-3 mb-0">
                        <li class="list-disc my-1">
                          <a href="img/material/<?php echo $vdo['archivos']; ?>" class="text-blue"><?php echo $vdo['clase']; ?></a>
                        </li>
                      </ul>
                    <?php
                    } else {
                    ?>
                      <p class="mb-1 small">No hay documentos para descargar.</p>
                    <?php
                    }
                    ?>
                    <p class="mb-4 small">Si deseas adjuntar material complementario para ésta clase, coloca los documentos dentro de un archivo ZIP y súbelo desde el enlace de abajo. Si ya existe un archivo con material, será reemplazado.</p>
                    <form name="material" id="material" action="new-material.php" method="post" class="container row" enctype="multipart/form-data">
                      <input type="hidden" name="linu" value="<?php echo base64_encode($vdo['id']); ?>">
                      <input type="hidden" name="prfs" value="<?php echo base64_encode($prf['id']); ?>">
                      <input type="hidden" name="cors" value="<?php echo base64_encode($cour['curso']); ?>">
                      <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                      <div class="form-group col-12">
                        <div class="custom-file">
                          <input autocomplete="off" accept=".zip, application/zip, application/x-zip, application/octet-stream, application/x-zip-compressed" class="custom-file-input mate" form="material" id="archivo" name="archivo" placeholder="Archivo ZIP" required tabindex="1" type="file">
                          <label class="font-secondary custom-file-label text-capitalize" for="archivo" style="font-size:.9rem;font-weight:400;letter-spacing:0;">Archivo ZIP</label>
                        </div>
                      </div>
                      <div class="form-group col-12 text-right">
                        <button class="button button-small button-rounded button-dark" tabindex="2">Subir achivo</button>
                      </div>
                    </form>
                  </div>
                </div>
                <?php /* Comentarios */ ?>
                <div class="col-md-6 col-lg-6">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="mb-2 text-blue">Comentarios anteriores</h4>
                    <?php
                    $bry = "SELECT " . odo_DATA_COME . ".*, CONCAT(" . odo_DATA_USUA . ".nombres, ' ', " . odo_DATA_USUA . ".apellidos) AS alumno FROM " . odo_DATA_COME . ", " . odo_DATA_USUA . " WHERE " . odo_DATA_COME . ".usuarioid = " . odo_DATA_USUA . ".id AND " . odo_DATA_COME . ".cursoid = '$qour' AND " . odo_DATA_COME . ".estado = 'A' ORDER BY " . odo_DATA_COME . ".fecha ";
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
      <script>
        $(document).ready(function() {
          bsCustomFileInput.init();
        });

        function _0xf982() {
          var _0x3b9d85 = ['7dqgRJx', '6XHjujA', '3574728wnAySw', 'application/octet-stream', 'files', 'application/x-zip-compressed', 'substring', '565886ncGiSo', 'application/zip', 'Archivo\x20ZIP', '674778cTijnE', 'type', '607760mkIgEs', 'application/x-zip', '.custom-file-label', '</span>', '15uyzvdd', '1774456oTDwTn', 'next', 'html', 'Sólo\x20se\x20permiten\x20archivos\x20ZIP', '612620CMMosH', 'change', '5376740CeGmjB', 'val'];
          _0xf982 = function() {
            return _0x3b9d85;
          };
          return _0xf982();
        }
        var _0x5c5940 = _0x37e3;

        function _0x37e3(_0x5648fa, _0x58249f) {
          var _0xf982dd = _0xf982();
          return _0x37e3 = function(_0x37e310, _0xed94fe) {
            _0x37e310 = _0x37e310 - 0x9d;
            var _0x59ff73 = _0xf982dd[_0x37e310];
            return _0x59ff73;
          }, _0x37e3(_0x5648fa, _0x58249f);
        }(function(_0x1c3391, _0xa0abb1) {
          var _0x56f557 = _0x37e3,
            _0x4ae424 = _0x1c3391();
          while (!![]) {
            try {
              var _0x84a882 = -parseInt(_0x56f557(0xa4)) / 0x1 + -parseInt(_0x56f557(0xa9)) / 0x2 + parseInt(_0x56f557(0x9e)) / 0x3 * (-parseInt(_0x56f557(0xb2)) / 0x4) + -parseInt(_0x56f557(0xad)) / 0x5 * (-parseInt(_0x56f557(0xa7)) / 0x6) + parseInt(_0x56f557(0x9d)) / 0x7 * (parseInt(_0x56f557(0xae)) / 0x8) + parseInt(_0x56f557(0x9f)) / 0x9 + parseInt(_0x56f557(0xb4)) / 0xa;
              if (_0x84a882 === _0xa0abb1) break;
              else _0x4ae424['push'](_0x4ae424['shift']());
            } catch (_0x4eecee) {
              _0x4ae424['push'](_0x4ae424['shift']());
            }
          }
        }(_0xf982, 0x4da22), $('.mate')['on'](_0x5c5940(0xb3), function() {
          var _0x2835f5 = _0x5c5940,
            _0x32aca2 = $(this)[_0x2835f5(0xb5)]()[_0x2835f5(0xa3)](0xc);
          $(this)[_0x2835f5(0xaf)](_0x2835f5(0xab))['html']('<span\x20class=\x22small\x20text-info\x22>' + _0x32aca2 + _0x2835f5(0xac));
          var _0x5464c0 = this[_0x2835f5(0xa1)][0x0],
            _0x2e2ad1 = _0x5464c0[_0x2835f5(0xa8)],
            _0x17ea1f = ['.zip', _0x2835f5(0xa5), _0x2835f5(0xaa), _0x2835f5(0xa0), _0x2835f5(0xa2)];
          if (!(_0x2e2ad1 == _0x17ea1f[0x0] || _0x2e2ad1 == _0x17ea1f[0x1] || _0x2e2ad1 == _0x17ea1f[0x2] || _0x2e2ad1 == _0x17ea1f[0x3] || _0x2e2ad1 == _0x17ea1f[0x4])) return Toast['fire']({
            'icon': 'error',
            'title': _0x2835f5(0xb1)
          }), $(this)[_0x2835f5(0xaf)]('.custom-file-label')[_0x2835f5(0xb0)](_0x2835f5(0xa6)), ![];
        }));
      </script>
      <?php include 'notify.php'; ?>
    </body>

    </html>
<?php
  } else {
    header('location:cursos.php');
  }
}
?>
?>