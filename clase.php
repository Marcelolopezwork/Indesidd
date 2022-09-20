<?php
//CLASE
//Los queries que están comentados filtraban que el curso este disponible y a la venta
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
  $dndtoy = 10;
  $uid = $_SESSION['cod'];

  if ($_SESSION['tip'] == 'P') header('location:profesores.php');

  //$oki['id'] . "-" . $oki['usuarioid'] . "-" . $oki['cursoid'] . "-" . $oki['claseid'] . "-" . $oki['marca']
  if ((isset($_GET['pid'])) && (isset($_GET['qid'])) && (isset($_GET['sid']))) {
    $cid = $_GET['pid']; //Curso ID
    $did = $_GET['qid']; //Número de orden de la Clase
    $sid = $_GET['sid']; //
  } else {
    header('location:cursos.php');
  }

  if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
  if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
  if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";

  //Revisa si el usuario ha comprado el curso
  $try = "SELECT * FROM " . odo_DATA_ALUM . " WHERE cursoid = '$cid' AND usuarioid = '$uid' AND estado = 'A' ";
  $tsl = $mysqli->query($try);
  if ($tsl->num_rows == 1) {
    $oki = $tsl->fetch_assoc();
    $transaccion = $oki['transaccionid'];

    //Revisa en transacciones
    $try = "SELECT * FROM " . odo_DATA_TRAN . " WHERE id = '$transaccion' AND estado = 'A' ";
    $tsl = $mysqli->query($try);
    $pay = $tsl->fetch_assoc();
    $curso_comprado = $pay['cursoid'];

    //Averigua cuál curso es
    $qry = "SELECT * FROM " . odo_DATA_CURS . " WHERE id = '$curso_comprado' ";
    $rsl = $mysqli->query($qry);
    $cour = $rsl->fetch_assoc();
    $que_categoria = $cour['categoriaid'];
    $date = date_create($cour['fechaactualizacion']);
    $fecha = date_format($date, 'd M, Y');

    //Averigua cuál categoría es
    $kry = "SELECT * FROM " . odo_DATA_CATE . " WHERE id = '$que_categoria' AND estado = 'A' ";
    $ksl = $mysqli->query($kry);
    $catg = $ksl->fetch_assoc();
    $cate = $catg['categoria'];

    //Averigua quién es el profesor
    $pry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE id = '" . $cour['profesorid'] . "' ";
    $psl = $mysqli->query($pry);
    $prf = $psl->fetch_assoc();

    //Video
    $vry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE cursoid = '$cid' AND orden = '$did'  ";
    $vsl = $mysqli->query($vry);
    $vdo = $vsl->fetch_assoc();

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
            <ol class="breadcrumb tope">
              <li class="breadcrumb-item active" aria-current="page"><?php echo $vdo['clase']; ?></li>
            </ol>
          </div>
        </section>
        <?php /* CONTENIDO */ ?>
        <section id="content">
          <div class="my-5">
            <div class="container clearfix">
              <div id="vc" class="row">
                <?php /* MUESTRA VIDEO DEL CURSO */ ?>
                <div class="col-lg-7 mx-auto">
                  <div class="mb-5">
                    <?php $video = explode('/', $vdo['video']); ?>
                    <iframe src="https://player.vimeo.com/video/<?php echo $video[3]; ?>" frameborder="0" allow="fullscreen" allowfullscreen mozallowfullscreen webkitallowfullscreen title="Video: Indesid" width="600" height="320"></iframe>
                  </div>
                </div>
                <?php /*DETALLES DEL CURSO*/ ?>
                <div class="col-lg-5">
                  <div class="entry">
                    <div class="entry-title title-xs nott">
                      <h3><?php echo $cour['curso']; ?></h3>
                      <h4 class="text-blue"><?php echo $cate; ?></h4>
                    </div>
                    <?php /*LIKES*/ ?>
                    <?php
                    if ($oki['megusta'] == '1') {
                    ?>
                      <span class="cursor-pointer likes small text-info" data-lke="<?php echo $oki['id']; ?>"><i class="icon-line-heart"></i> Sí, me gusta</span>
                    <?php
                    } else {
                    ?>
                      <span class="cursor-pointer likes small text-secondary" data-lke="<?php echo $oki['id']; ?>"><i class="icon-line-heart"></i> ¿Te gusta el curso?</span>
                    <?php
                    }
                    ?>
                    <?php /*CLASES*/ ?>
                    <div class="i-frame rounded">
                      <ul class="lista-sin-estilo mt-n3">
                        <li>
                          <?php
                          $mry = "SELECT * FROM " . odo_DATA_MODU . " WHERE cursoid = '$cid' ";
                          $msl = $mysqli->query($mry);
                          while ($modu = $msl->fetch_assoc()) {
                          ?>
                            <h5 class="mb-2 mt-4"><?php echo $modu['modulo']; ?></h5>
                            <ul class="llevando">
                              <?php
                              $sry = "SELECT * FROM " . odo_DATA_CLAS . " WHERE cursoid = '$cid' AND moduloid = '" . $modu['id'] . "' ";
                              $ssl = $mysqli->query($sry);
                              $next = ($oki['marca'] + 1);
                              while ($clas = $ssl->fetch_assoc()) {
                                if ($oki['marca'] == $clas['orden']) $addclass = "actual";
                                if ($oki['marca'] > $clas['orden']) $addclass = "cursado";
                                if ($oki['marca'] < $clas['orden']) $addclass = "";

                                if ($next == $clas['orden']) $addclass = "siguiente";

                                if ($oki['completado'] == 'N') {
                                  if ($addclass == 'actual') {
                              ?>
                                    <li id="<?php echo $clas['id']; ?>" class="small <?php echo $addclass; ?> text-info"><?php echo $clas['clase']; ?>&nbsp;<i class="icon-line-check action"></i></li>
                                  <?php
                                  } elseif ($addclass == 'siguiente') {
                                  ?>
                                    <li id="<?php echo $clas['id']; ?>" class="small <?php echo $addclass; ?> text-info">
                                      <form action="upmark.php" method="post" class="mb-2">
                                        <input type="hidden" name="dark" value="<?php echo base64_encode(micro()); ?>">
                                        <input type="hidden" name="park" value="<?php echo base64_encode('alumno'); ?>">
                                        <input type="hidden" name="mark" value="<?php echo base64_encode($oki['id'] . "-" . $oki['usuarioid'] . "-" . $oki['cursoid'] . "-" . $oki['claseid'] . "-" . $oki['marca']); ?>">
                                        <button class="check p-0"><?php echo $clas['clase']; ?></button>
                                        <div class="badge small">Clase siguiente</div>
                                      </form>
                                    </li>
                                  <?php
                                  } elseif ($addclass == 'cursado') {
                                  ?>
                                    <li id="<?php echo $clas['id']; ?>" class="small <?php echo $addclass; ?>"><a class="text-secondary" onclick="window.location.href='clase.php?pid=<?php echo $clas['cursoid']; ?>&qid=<?php echo $clas['orden']; ?>&sid=<?php echo $clas['slug']; ?>'"><?php echo $clas['clase']; ?></a></li>
                                  <?php
                                  } else {
                                  ?>
                                    <li id="<?php echo $clas['id']; ?>" class="small text-dark"><?php echo $clas['clase']; ?></li>
                                  <?php
                                  }
                                } else {
                                  ?>
                                  <li id="<?php echo $clas['id']; ?>" class="small cursado"><a class="<?php echo $resalta; ?>" onclick="window.location.href='clase.php?pid=<?php echo $clas['cursoid']; ?>&qid=<?php echo $clas['orden']; ?>&sid=<?php echo $clas['slug']; ?>'"><?php echo $clas['clase']; ?></a></li>
                              <?php
                                }
                              }
                              ?>
                            </ul>
                          <?php
                          }
                          ?>
                        </li>
                      </ul>
                    </div>
                    <?php /*CERTIFICADO*/ ?>
                    <?php if ($oki['completado'] == 'S') { ?>
                      <div class="text-center my-1">
                        <a href="certified.php?rid=<?php echo base64_encode($oki['id']); ?>&rus=<?php echo base64_encode($cour['curso']); ?>" class="button button-small button-aqua button-rounded">Descargar certificado del curso</a>
                      </div>
                    <?php } ?>
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
                        $duy = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(duracion))) AS horas FROM " . odo_DATA_CLAS . " WHERE cursoid = '" . $cour['id'] . "' ";
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
                    <div class="nott">
                      <h5 class="my-0">
                        <?php
                        $pague = date_create($pay['fecha']);
                        $fecha_compra = date_format($pague, 'd M, Y');
                        //Calcula si puede solicitar devolución del dinero
                        $fecha_actual = strtotime(date("d-m-Y", time()));
                        $fecha_compro = strtotime($pay['fecha']);
                        $devolucion = date("d-m-Y", strtotime($pay['fecha']));
                        $fecha_devolu = strtotime($devolucion . $dias_devolucion);
                        $verifica  = "SELECT * FROM " . odo_DATA_DEVO . " WHERE transaccionid = '" . $pay['id'] . "' AND usuarioid = '" . $_SESSION['cod'] . "' AND estado = 'P' ";
                        $resverif  = $mysqli->query($verifica);
                        $solicito = $resverif->num_rows;
                        if ($fecha_actual <= $fecha_devolu) {
                          if ($solicito == 1) {
                        ?>
                            <i class="icon-line-calendar"></i>
                          <?php
                          } else {
                          ?>
                            <i class="icon-line-info text-danger" data-toggle="popover" data-content="Desde la fecha de compra tienes <?php echo substr($dias_devolucion, 2, 1); ?> días para solicitar la devolución del importe de éste curso" data-trigger="hover"></i>
                          <?php
                          }
                        } else {
                          ?>
                          <i class="icon-line-calendar"></i>
                        <?php
                        }
                        ?>
                        Fecha de compra
                        <?php
                        if ($fecha_actual <= $fecha_devolu) {
                          if ($solicito == 1) {
                        ?>
                            <i class="icon-line-reload text-info" data-toggle="popover" data-content="Solicitaste la devolución de éste curso" data-trigger="hover"></i>
                          <?php
                          } else {
                          ?>
                            <button class="bg-white border-0 p-0" data-devo="<?php echo $pay['id']; ?>" data-toggle="modal" data-target="#devolver" href="<?php echo $pay['id']; ?>"><i class="icon-line-reload text-danger"></i></button>
                        <?php
                          }
                        }
                        ?>
                      </h5>
                      <p class="ml-3 my-0"><?php echo $fecha_compra; ?></p>
                    </div>
                  </div>
                </div>
                <?php /* ACERCA DEL PROFESOR */ ?>
                <div class="col-md-6 col-lg-8">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="my-1 text-blue">Acerca del profesor</h4>
                    <div class="row">
                      <div class="text-center col-12 col-md-12 col-lg-4">
                        <?php if ($prf['foto'] == null) { ?>
                          <img class="img-thumbnail" src="img/profesores/nofoto.svg" alt="Aún sin foto">
                        <?php } else { ?>
                          <img class="img-thumbnail" src="img/profesores/<?php echo $prf['foto']; ?>?i=<?php echo micro(); ?>" alt="<?php echo $prf['profe']; ?>">
                        <?php } ?>
                        <button class="button button-aqua button-small button-rounded mx-0 w-100" onclick="window.location.href='teacher.php?sid=<?php echo ($prf['slug']); ?>';"><i class="icon-line-search"></i><span>Ver perfil</span></button>
                      </div>
                      <div class="col-12 col-md-12 col-lg-8">
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
                    <h4 class="mb-2 text-blue">Descarga los archivos adjuntos del curso</h4>
                    <ul class="ml-3">
                      <?php
                      if (is_null($vdo['archivos'])) {
                      ?>
                        <li class="ml-3">No hay material para descargar de ésta clase.</li>
                      <?php
                      } else {
                      ?>
                        <li class="list-disc my-1">
                          <a href="<?php echo "img/material/" . $vdo['archivos']; ?>" class="text-blue"><?php echo $vdo['clase']; ?></a>
                        </li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                </div>
                <?php /* Comentarios */ ?>
                <div class="col-md-6 col-lg-6">
                  <div class="bg-white border p-4 rounded shadow">
                    <h4 class="mb-2 text-blue">Comentarios anteriores</h4>
                    <?php
                    $bry = "SELECT " . odo_DATA_COME . ".*, CONCAT(" . odo_DATA_USUA . ".nombres, ' ', " . odo_DATA_USUA . ".apellidos) AS alumno FROM " . odo_DATA_COME . ", " . odo_DATA_USUA . " WHERE " . odo_DATA_COME . ".usuarioid = " . odo_DATA_USUA . ".id AND " . odo_DATA_COME . ".cursoid = '" . $cour['id'] . "' AND " . odo_DATA_COME . ".estado = 'A' ORDER BY " . odo_DATA_COME . ".fecha ";
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
                      <p>No hay comentarios. Se tú el primero en hacer uno.</p>
                    <?php
                    }
                    ?>
                    <h4 class="mb-2 text-blue">Has tus comentarios del curso</h4>
                    <?php
                    if (isset($_SESSION['cod'])) {
                      if ($_SESSION['tip'] == "U") {
                    ?>
                        <form action="new-comment.php" method="post" class="form-group">
                          <input type="hidden" name="cookie" value="<?php echo md5(micro()); ?>">
                          <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
                          <input type="hidden" name="stkes" value="<?php echo base64_encode($_SESSION['cod']); ?>">
                          <input type="hidden" name="cuote" value="<?php echo base64_encode($cour['id']); ?>">
                          <input type="hidden" name="couti" value="<?php echo base64_encode($cour['curso']); ?>">
                          <input type="hidden" name="eachr" value="<?php echo base64_encode($cour['profesorid']); ?>">
                          <textarea class="border form-control" name="comentario" placeholder="Escribe un comentario." rows="3"></textarea>
                          <div class="my-2 text-right">
                            <button type="submit" class="button button-rounded button-small button-blue button-border"><i class="icon-line-mail"></i><span>Enviar</span></button>
                          </div>
                        </form>
                      <?php
                      }
                    } else {
                      ?>
                      <div class="form-group">
                        <textarea class="border form-control" readonly placeholder="Para escribir un comentario, inicia sesión" rows="5"></textarea>
                        <div class="my-2 text-right">
                          <button class="button button-rounded button-reveal button-small button-blue button-border text-right" onclick="window.location.href='ingreso.php'"><i class="icon-line-log-in"></i> <span>Inicia sesión</span></button>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php echo vmodalsm('devolver', 'Solicitar devolución', 'modal-lg', 'solicita') ?>
        <?php include 'footer.php'; ?>
      </div>
      <div id="gotoTop" class="icon-line-chevron-up"></div>
      <?php require 'scripts.php'; ?>
      <script type="text/javascript">
        ajaxData('[data-devo]', 'devolucion.php', '<?php echo $pay['id']; ?>', 'solicita');
        <?php /* Like curso */ ?>
        $("[data-lke]").click(function(e) {
          var href = $(this).attr("data-lke");
          $.ajax({
            url: 'like.php',
            type: 'POST',
            data: {
              z: href
            },
            success: function(data) {
              if (data == "1") {
                $('.likes').removeClass('text-secondary');
                $('.likes').addClass('text-info');
                $('.likes').html('<span><i class="icon-line-heart"></i> Sí, me gusta</span>');
              } else {
                $('.likes').removeClass('text-info');
                $('.likes').addClass('text-secondary');
                $('.likes').html('<span><i class="icon-line-heart"></i> ¿Te gusta el curso?</span>');
              }
            },
            error: function(xhr, status, error) {
              console.error(xhr);
            }
          });
          e.preventDefault();
        });
      </script>
      <?php include 'notify.php'; ?>
    </body>

    </html>
<?php
  } else {
    unset($carro);
    unset($_SESSION['cod']);
    unset($_SESSION['carro']);
    session_unset();
    session_destroy();
    header('location:index.php');
  }
} else {
  header('location:index.php');
}
