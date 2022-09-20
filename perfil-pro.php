<?php
//PROFESORES HOME
//SESSION['pod'] como id del profesor
//SESSION['cod'] como id del usuario
// Tipo de Profesor: P = profesor, R = referido, Q = Solicitó su baja, X = Despedido
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
  if ($_SESSION['tip'] == 'P') {
    if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
    if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
    if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
    $dndtoy = 11;

    $datetime = true;
    $datatable = true;
    $numeric = true;
    $select = true;
    $vertodo = false;

    $qry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS quien FROM " . odo_DATA_PROF . " WHERE id='" . $_SESSION['pod'] . "' AND estado = 'A' ";
    $rsl = $mysqli->query($qry);
    $go = $rsl->num_rows;
    if ($go == 1) {
      $vertodo = true;
      $dat = $rsl->fetch_assoc();
      $date = date_create($dat['fecha']);
      $fecha = date_format($date, 'd M Y');
    } else {
      unset($_SESSION['cod']);
      $_SESSION['verid'] = "Hola! ya recibimos tu solicitud y la estamos evaluando. Nos comunicaremos contigo a la brevedad posible. Gracias!";
      $_SESSION['vertype'] = "success";
      $_SESSION['vertitle'] = $dat['quien'];
      header('location:index.php');
    }
    include 'header.php';
?>

    <body class="stretched">
      <div id="wrapper" class="clearfix">
        <?php /* MENÚ */ ?>
        <header id="header" class="full-header dark">
          <?php include 'menu-pro.php'; ?>
        </header>
        <?php /* BIENVENIDA PROFESOR */ ?>
        <div class="container clearfix topmargin-sm">
          <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-between">
            <div class="d-flex">
              <?php /* Imagen */ ?>
              <div class="testi-image-pro">
                <div id="imgContainer">
                  <div id="imgAreaPro" class="mr-3">
                    <?php if ($dat['foto'] == null) { ?>
                      <img class="img-thumbnail rounded-circle" src="img/profesores/nofoto.svg" alt="">
                    <?php } else { ?>
                      <img class="img-thumbnail rounded-circle" src="img/profesores/<?php echo $dat['foto']; ?>?i=<?php echo micro(); ?>" alt="">
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php /* Nombres */ ?>
              <div class="title-block">
                <?php if ($dat['genero'] == 'M') $bienven = "Bienvenido";
                else $bienven = "Bienvenida"; ?>
                <h3 class="my-0"><?php echo $bienven . ' ' . $dat['nombres']; ?></h3>
                <span class="my-0"><i class="icon-line-briefcase text-info"></i> <?php echo $dat['especialidad']; ?></span>
                <?php if ($dat['estado'] == 'A') { ?>
                  <span class="my-0 small">Estamos encantados de verte de nuevo</span>
                <?php }
                if ($dat['estado'] == 'P') { ?>
                  <span class="my-0 small">Estamos evaluando tu solicitud</span>
                <?php } ?>
              </div>
            </div>
            <?php /* Estadística */ ?>
            <div class="d-flex mt-3">
              <?php if ($vertodo) { ?>
                <div class="d-flex flex-column align-items-center">
                  <?php
                  $query = "SELECT count(curso) AS cursos FROM " . odo_DATA_CURS . " WHERE profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                  $result = $mysqli->query($query);
                  $cursos = $result->fetch_assoc();
                  ?>
                  <h2 class="d-flex align-items-center lh-085 my-0"><?php echo $cursos['cursos']; ?> <span class="small"><i class="icon-line-paper-stack ml-1 small text-info"></i></span></h2>
                  <span class="small">cursos</span>
                </div>
                <div class="d-flex flex-column align-items-center mx-4">
                  <?php
                  $query = "SELECT count(usuarioid) AS alumnos FROM " . odo_DATA_ALUM . " WHERE profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                  $result = $mysqli->query($query);
                  $alumno = $result->fetch_assoc();
                  ?>
                  <h2 class="d-flex align-items-center lh-085 my-0"><?php echo $alumno['alumnos']; ?> <span class="small"><i class="icon-line-users ml-1 small text-info"></i></span></h2>
                  <span class="small">estudiantes</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                  <?php
                  $query = "SELECT sum(megusta) AS likes FROM " . odo_DATA_CURS . " WHERE profesorid = '" . $dat['id'] . "' ";
                  $result = $mysqli->query($query);
                  $megust = $result->fetch_assoc();
                  ?>
                  <h2 class="d-flex align-items-center lh-085 my-0"><?php echo (is_null($megust['likes'])) ? '0' : $megust['likes']; ?> <span class="small"><i class="icon-line-heart ml-1 small text-info"></i></span></h2>
                  <span class="small">me gusta</span>
                </div>
                <div class="d-flex flex-column align-items-center mx-4">
                  <?php
                  $query = "SELECT count(id) AS webi FROM " . odo_DATA_WEBI . " WHERE profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                  $result = $mysqli->query($query);
                  $webina = $result->fetch_assoc();
                  ?>
                  <h2 class="d-flex align-items-center lh-085 my-0"><?php echo (is_null($webina['webi'])) ? '0' : $webina['webi']; ?> <span class="small"><i class="icon-line-video ml-1 small text-info"></i></span></h2>
                  <span class="small">webinars</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                  <?php
                  $query = "SELECT count(id) AS refs FROM " . odo_DATA_REFE . " WHERE profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                  $result = $mysqli->query($query);
                  $referi = $result->fetch_assoc();
                  ?>
                  <h2 class="d-flex align-items-center lh-085 my-0"><?php echo (is_null($referi['refs'])) ? '0' : $referi['refs']; ?> <span class="small"><i class="icon-line-user-plus ml-1 popov small text-info" data-toggle="popover" data-content="Referidos aprobados"></i></span></h2>
                  <span class="small">referidos</span>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php if ($vertodo) { ?>
          <?php /* CONTENIDO */ ?>
          <section id="content">
            <div class="mt-3 bg-light pt-5">
              <div class="container clearfix">
                <div class="row">
                  <div class="col-12 col-lg-3">
                    <div class="list-group list-group-flush mb-4" id="list-tab" role="tablist">
                      <?php /* NOTIFICACIONES */ ?>
                      <?php
                      $cry = "SELECT " . odo_DATA_COME . ".*, " . odo_DATA_CURS . ".curso AS course, CONCAT(" . odo_DATA_USUA . ".nombres, ' ', " . odo_DATA_USUA . ".apellidos) AS alumno FROM " . odo_DATA_COME . ", " . odo_DATA_CURS . ", " . odo_DATA_USUA . " WHERE (" . odo_DATA_COME . ".cursoid = " . odo_DATA_CURS . ".id AND " . odo_DATA_CURS . ".estado = 'A' AND " . odo_DATA_COME . ".usuarioid = " . odo_DATA_USUA . ".id AND " . odo_DATA_COME . ".profesorid = '" . $dat['id'] . "' AND " . odo_DATA_USUA . ".tipo = 'U' AND " . odo_DATA_USUA . ".estado = 'A' AND " . odo_DATA_COME . ".estado = 'P') ";
                      $csl = $mysqli->query($cry);
                      $cuantasnoti = $csl->num_rows;
                      ?>
                      <a class="font-primary list-group-item list-group-item-action active d-flex justify-content-between align-items-center" data-toggle="list" href="#notificacion" role="tab" aria-controls="notifica">Notificaciones <?php if ($cuantasnoti > 0) { ?><span class="font-secondary badge badge-secondary badge-pill"><?php echo $cuantasnoti; ?></span><?php } ?></a>
                      <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#ajustar-perfil" role="tab" aria-controls="perfil">Mi perfil</a>
                      <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#cursos-activos" role="tab" aria-controls="activo">Cursos activos</a>
                      <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#solicitar-curso" role="tab" aria-controls="curso">Solicitar curso</a>
                      <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#solicitar-webinar" role="tab" aria-controls="webinar">Solicitar webinar</a>
                      <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#mis-pagos" role="tab" aria-controls="pago">Pagos</a>
                      <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#mis-referidos" role="tab" aria-controls="referido">Referidos</a>
                    </div>
                  </div>
                  <div class="col-12 col-lg-9">
                    <?php /* OPCIONES DEL PROFESOR */ ?>
                    <div class="tab-content" id="nav-tabContent">
                      <?php /* COMENTARIOS */ ?>
                      <div class="tab-pane min-h-pagos fade show active" id="notificacion" role="tabpanel" aria-labelledby="perfiles">
                        <div class="card px-4 pt-3 rounded shadow">
                          <h3 class="mb-0">Comentarios</h3>
                          <?php if ($cuantasnoti > 0) { ?>
                            <p class="mb-0 text-secondary">Los comentarios realizados a tus cursos no son publicados hasta que los leas y autorices o elimines.</p>
                            <p class="mb-3 small">Si quieres responder algún comentario, hazlo haciendo click en el lápiz rojo.</p>
                            <table id="comenta" class="display table-bordered w-100 mb-3">
                              <?php
                              $numplus = 1;
                              ?>
                              <thead>
                                <tr class="table-info small">
                                  <th class="px-2 py-1 text-center">#</th>
                                  <th class="p-1 small">CURSO</th>
                                  <th class="p-1 small">COMENTARIO</th>
                                  <th class="p-1 small">USUARIO</th>
                                  <th class="p-1 small">FECHA</th>
                                  <th class="p-1 small">ACCIÓN</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                while ($com = $csl->fetch_assoc()) {
                                  $fecom = date_create($com['fecha']);
                                  $comfe = date_format($fecom, 'd M Y');
                                ?>
                                  <tr class="small">
                                    <td class="px-2 small text-center"><?php echo $numplus++; ?></td>
                                    <td class="px-1 small"><?php echo $com['course']; ?></td>
                                    <td class="px-1 small"><?php echo substr($com['comentario'], 0, 50) . "..."; ?></td>
                                    <td class="px-1 small"><?php echo mb_convert_case($com['alumno'], MB_CASE_TITLE, 'utf-8'); ?></td>
                                    <td class="px-1 small"><?php echo $comfe; ?></td>
                                    <td class="px-1 text-center">
                                      <button class="btn p-0 text-danger" href="<?php echo $com['id']; ?>" data-comc="comentario" class="text-danger" data-toggle="modal" data-target="#contestar" title="Contestar"><i class="icon-line-edit-2"></i></button>
                                    </td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          <?php } else { ?>
                            <p class="mb-0">Los comentarios realizados a tus cursos no son publicados hasta que los autorices.</p>
                            <p class="mb-1 small">No tienes ningún comentario.</p>
                          <?php } ?>
                          <h3 class="mb-0 mt-3">Notificaciones</h3>
                          <?php
                          $nry = "SELECT * FROM " . odo_DATA_NOTI . " WHERE profesorid = '" . $_SESSION['pod'] . "' AND estado = 'P' ";
                          $nsl = $mysqli->query($nry);
                          ?>
                          <div class="table-responsive mb-4">
                            <table id="notificar" class="display table-bordered w-100 mb-3">
                              <thead>
                                <tr class="table-info small">
                                  <th class="px-2 py-1">#&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                  <th class="p-1 small">MENSAJE</th>
                                  <th class="p-1 small">FECHA</th>
                                  <th class="p-1 small">ACCIÓN</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $b = 1;
                                while ($not = $nsl->fetch_assoc()) {
                                  $date = date_create($not['fecha']);
                                  $days = date_format($date, 'd M Y');
                                ?>
                                  <tr class="small">
                                    <td class="px-2 text-center"><?php echo $b++; ?></td>
                                    <td class="px-1"><?php echo substr($not['notificacion'], 0, 50) . "..."; ?></td>
                                    <td class="px-1"><?php echo $days; ?></td>
                                    <td class="px-1 text-center">
                                      <button class="btn p-0 text-danger" href="<?php echo $not['id']; ?>" data-comi="indesid" class="text-danger" data-toggle="modal" data-target="#contestar" title="Contestar"><i class="icon-line-edit-2"></i></button>
                                    </td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <?php /* ACTUALIZAR DATOS */ ?>
                      <div class="tab-pane fade" id="ajustar-perfil" role="tabpanel" aria-labelledby="perfiles">
                        <?php /* ACERCA DEL PROFESOR */ ?>
                        <div class="card mb-4 px-4 pt-3 rounded shadow">
                          <h3 class="mb-1"><?php echo $dat['quien']; ?></h3>
                          <form id="actualizardata" class="container mb-0 row" role="form">
                            <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                            <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                            <div class="form-group col-12 col-md-12">
                              <label class="w-100" for="aboutmes">Acerca de mi<span class="text-danger">*</span> <span class="float-right small" id="aboutmesError"></span></label>
                              <textarea autocomplete="off" class="form-control" id="aboutmes" name="aboutmes" placeholder="Cuéntanos algo sobre ti" required rows="5" tabindex="1"><?php echo $dat['sobremi']; ?></textarea>
                            </div>
                            <div class="form-group col-12 col-md-4">
                              <label for="level">Nivel de Estudios<span class="text-danger">*</span><span id="levelError"></span></label>
                              <select id="level" name="level" class="form-control selectpicker show-tick" required title="Indique nivel de estudios" tabindex="2">
                                <?php
                                $nry = "SELECT * FROM " . odo_DATA_NIVE . " ORDER BY nivel";
                                $nsl = $mysqli->query($nry);
                                while ($nive = $nsl->fetch_assoc()) {
                                ?>
                                  <option <?php if ($dat['nivelestudio'] == $nive['nivel']) echo "selected"; ?> value="<?php echo $nive['nivel']; ?>"><?php echo $nive['nivel']; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-12 col-md-4">
                              <label class="w-100" for="phonez">Teléfono<span class="text-danger">*</span> <span class="float-right small" id="phonezError"></span></label>
                              <input autocomplete="off" class="form-control num" id="phonez" name="phonez" placeholder="Teléfono" required type="text" tabindex="3" value="<?php echo $dat['telefono']; ?>">
                            </div>
                            <div class="form-group col-12 col-md-4">
                              <label class="w-100" for="dni">Documento<span class="text-danger">*</span> <span class="float-right small" id="dniError"></span></label>
                              <input autocomplete="off" class="form-control" id="dni" name="dni" placeholder="Documento" required tabindex="4" type="text" value="<?php echo $dat['documento']; ?>">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label>Email</label>
                              <div class="form-control text-aqua"><?php echo $dat['correo']; ?></div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label>Inscripción</label>
                              <div class="form-control text-aqua"><?php echo $fecha; ?></div>
                            </div>
                            <div class="form-group col-12 text-center">
                              <button class="button button-dark button-rounded mt-1" tabindex="5" type="submit">Actualizar datos</button>
                            </div>
                          </form>
                        </div>
                        <?php /* CAMBIAR CONTRASEÑA */ ?>
                        <div class="card mb-4 px-4 pt-3 rounded shadow">
                          <h4 class="mb-0">Cambiar contraseña <i class="added icon-line-help-circle small" data-toggle="popover" data-content="La nueva contraseña debe tener por lo menos 8 caracteres, al menos un número, una letra mayúscula y por lo menos uno de estos símbolos #$%^&()={*}.,:;+-_<>!" data-trigger="click"></i></h4>
                          <p class="mx-2 my-1 small"><span class="text-danger">*</span>Todos los campos son obligatorios</p>
                          <form id="actualizarclave" class="container mb-0 row align-items-end" role="form">
                            <input type="hidden" name="cookie" value="<?php echo sha1('cambiarcontrasena'); ?>">
                            <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                              <label for="old" class="w-100">Clave actual<span class="text-danger">*</span> <span id="oldError" class="float-right small"></span></label>
                              <input autocomplete="off" class="form-control" id="old" minlength="5" name="old" placeholder="Contraseña antigua" required tabindex="1" type="password">
                              <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#old');"></i>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                              <label for="new" class="w-100">Clave nueva<span class="text-danger">*</span> <span id="newError" class="float-right small"></span></label>
                              <input autocomplete="off" class="form-control" id="new" minlength="8" name="new" placeholder="Contraseña nueva" required type="password" tabindex="2">
                              <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#new');"></i>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                              <label for="again" class="w-100">Otra vez<span class="text-danger">*</span> <span id="againError" class="float-right small"></span></label>
                              <input autocomplete="off" class="form-control" id="again" minlength="8" name="again" placeholder="Contraseña nueva otra vez" required type="password" tabindex="3" value="">
                              <i id="tagain" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#tagain', '#again');"></i>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-12 mt-n4 text-center">
                              <button class="button button-dark button-rounded cursor-not-allowed" disabled id="subbtn" role="button" tabindex="4" type="submit">Cambiar contraseña</button>
                            </div>
                          </form>
                        </div>
                        <?php /* CAMBIAR FOTO PERFIL */ ?>
                        <div class="card mb-4 px-4 pt-3 rounded shadow">
                          <h4 class="mb-1">Cambiar foto de perfil</h4>
                          <form action="upload-photo.php" class="mb-4" id="fotoperfil" enctype="multipart/form-data" method="post" name="fotoperfil" onsubmit="return valid();">
                            <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                            <input type="hidden" name="quien" value="<?php echo $dat['quien']; ?>">
                            <div class="bg-light card mb-2 py-2 mx-auto col-12 col-sm-8 col-md-8 col-lg-6">
                              <label class="font-weight-bold pb-1 pt-2">Foto <span class="float-right small text-grey">Tamaño 250 x 250 píxeles</span></label>
                              <div class="text-center">
                                <?php if ($dat['foto'] == null) { ?>
                                  <img id="profile" class="img-thumbnail" src="img/profesores/nofoto.svg" alt="">
                                <?php } else { ?>
                                  <img id="profile" class="img-thumbnail max-profile" src="img/profesores/<?php echo $dat['foto']; ?>?i=<?php echo micro(); ?>" alt="">
                                <?php } ?>
                              </div>
                              <div class="mx-auto my-2 uploader">
                                <div id="archivo" class="valor-imagen"></div>
                                <label class="form-group has-float-label">
                                  <input autocomplete="off" accept="image/png, image/jpeg" class="upload file" form="fotoperfil" id="perfilfoto" name="perfilfoto" required tabindex="1" type="file" size="4">
                                </label>
                              </div>
                              <div class="text-center pb-2 px-4">
                                <button class="button button-dark button-rounded w-75">Actualizar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <?php /* DARSE DE BAJA */ ?>
                        <div class="card mb-4 px-4 pt-3 rounded shadow">
                          <h4 class="mb-0 mt-3">Darse de baja</h4>
                          <p class="mx-2 my-1">Si por alguna razón ya no desea pertenecer a nuestra institución, llene la información del siguiente formulario para hacerlo.</p>
                          <p class="mx-2 my-1 small"><span class="text-danger">*</span>Todos los datos son obligatorios</p>
                          <form action="offline.php" class="mb-2" method="post" name="eliminarprofe" class="container row align-items-end">
                            <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                            <input type="hidden" name="activity" value="<?php echo sha1('darsedebaja'); ?>">
                            <div class="form-group col-12 col-md-6 offset-md-3">
                              <label for="darsedebaja">Escriba la palabra: <span class="font-weight-bold text-danger">INDESID</span></label>
                              <input autocomplete="off" class="form-control text-uppercase" id="darsedebaja" maxlength="7" name="darsedebaja" placeholder=" " required type="text" tabindex="1" value="">
                              <div id="bajaError" class="small"></div>
                            </div>
                            <div class="form-group col-12 col-md-6 offset-md-3">
                              <label for="darsedebaja">Escriba su contraseña actual<span class="text-danger">*</span></label>
                              <input autocomplete="off" class="form-control" id="actua" name="actua" placeholder="Contraseña actual" required type="password" tabindex="2" value="">
                              <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#actua');"></i>
                              <div id="actuaError" class="small"></div>
                            </div>
                            <div class="form-group col-12 col-md-6 offset-md-3">
                              <label for="motivo">Motivo<span class="text-danger">*</span></label>
                              <textarea autocomplete="off" class="form-control" id="motivo" name="motivo" placeholder="Por favor describa el motivo" required type="text" tabindex="3"></textarea>
                              <div id="motivoBajaError" class="small"></div>
                            </div>
                            <div class="col-12 custom-control custom-switch text-center">
                              <input class="custom-control-input" id="muestra" type="checkbox">
                              <label class="custom-control-label popov" for="muestra" data-trigger="hover" data-content="Activa o desactiva la publicación del curso">Habilitar darme de baja</label>
                            </div>
                            <div class="form-group col-12 mb-3 text-center">
                              <p class="my-1 small text-danger">*ESTA OPCION ES IRREVERSIBLE. YA NO TENDRA ACCESO A ESTA PAGINA.</p>
                              <button class="button button-dark button-rounded mt-1" disabled id="darse" tabindex="4" type="submit">DARSE DE BAJA</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <?php /* MIS CURSOS ACTIVOS */ ?>
                      <div class="tab-pane min-h-pagos fade" id="cursos-activos" role="tabpanel" aria-labelledby="activos">
                        <div class="card mb-5 px-4 pt-3 rounded shadow">
                          <h3 class="mb-1">Mis cursos a la venta</h3>
                          <?php
                          $ury = "SELECT cursos.*, categorias.categoria AS cate FROM " . odo_DATA_CURS . ", " . odo_DATA_CATE . " WHERE (cursos.profesorid = '" . $dat['id'] . "' AND cursos.categoriaid = categorias.id AND cursos.estado = 'A' AND cursos.publicado = 'S') ";
                          $usl = $mysqli->query($ury);
                          $haycurso = $usl->num_rows;
                          if ($haycurso > 0) {
                          ?>
                            <div class="row posts-md pt-2">
                              <?php
                              while ($cour = $usl->fetch_assoc()) {
                              ?>
                                <article class="portfolio-item col-6 col-sm-6 px-4">
                                  <div class="grid-inner mb-5 shadow">
                                    <?php /*Video*/ ?>
                                    <div class="entry mb-0">
                                      <div class="entry-image center">
                                        <img src="img/cursos/<?php echo $cour['imagen']; ?>" alt="Video">
                                      </div>
                                      <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                                      <div class="bg-white min-h-curso-pro px-4 py-3">
                                        <div class="entry-title title-xs nott">
                                          <h3 class="responsive"><?php echo $cour['curso']; ?></h3>
                                        </div>
                                        <div class="py-1">
                                          <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $cour['cate']; ?></span></p>
                                          <?php if (($cour['megusta'] < 1) || (is_null($cour['megusta']))) { ?>
                                            <p class="d-flex align-items-center my-0"><i class="icon-line-sun mr-1"></i> <span class="small">Curso nuevo</span></p>
                                          <?php } else { ?>
                                            <p class="d-flex align-items-center my-0"><i class="icon-line-heart mr-1"></i> <span class="small"><?php echo $cour['megusta']; ?> me gusta</span></p>
                                          <?php } ?>
                                          <?php /*Precios*/ ?>
                                          <div class="d-flex">
                                            <?php if ($cour['ofertaactiva'] == 'S') { ?>
                                              <h5 class="mb-0 line-through"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                              <h5 class="mb-0 ml-2 sales"><?php echo $moneda; ?><?php echo $cour['preciooferta']; ?></h5>
                                            <?php } else { ?>
                                              <h5 class="mb-0 sales"><i class="icon-line-shopping-cart mr-1"></i> <?php echo $moneda; ?><?php echo $cour['precioventa']; ?></h5>
                                            <?php } ?>
                                          </div>
                                          <p class="mb-1 mt-0 small">
                                            <?php
                                            $tra = "SELECT COUNT(id) AS cuanto FROM " . odo_DATA_TRAN . " WHERE (profesorid = '" . $dat['id'] . "' AND cursoid = '" . $cour['id'] . "' AND estado = 'A') ";
                                            $tsl = $mysqli->query($tra);
                                            $ccv = $tsl->fetch_assoc();
                                            if ($ccv['cuanto'] == 0) echo 'No se ha vendido ningún curso';
                                            if ($ccv['cuanto'] == 1) echo $ccv['cuanto'] . ' curso vendido';
                                            if ($ccv['cuanto'] > 1) echo $ccv['cuanto'] . ' cursos vendidos';
                                            ?>
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                    <?php /*Botones*/ ?>
                                    <div class="bg-white justify-content-center px-3 pb-2 rounded-bottom">
                                      <div class="bg-white d-flex justify-content-center py-2 rounded-bottom">
                                        <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='class.php?pid=<?php echo base64_encode($cour['id']); ?>&qid=<?php echo base64_encode('1'); ?>'"><i class="icon-line-search"></i><span><?php echo $txtBtnProf; ?></span></button>
                                      </div>
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
                            <p>No tienes cursos activos aún. Haz clic en el menú <span class="font-primary text-blue">Solicitar curso</span>, llena la información requerida y envíanosla para poder evaluarla y que empieces tu participación en la plataforma.</p>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                      <?php /* SOLICITAR CURSO NUEVO */ ?>
                      <div class="tab-pane fade" id="solicitar-curso" role="tabpanel" aria-labelledby="cursos">
                        <div class="card mb-4 px-4 pt-3 rounded shadow">
                          <h3 class="mb-0">Cursos solicitados</h3>
                          <p class="d-none d-md-block font-secondary px-2 small">
                            <span class="small text-success mr-1">Activo<i class="icon-line-help-circle" data-toggle="popover" data-content="Su propuesta ha sido aprobada y ya está a disposición de los alumnos." data-trigger="hover"></i></span>
                            <span class="small text-info mr-1">Aprobado<i class="icon-line-help-circle" data-toggle="popover" data-content="Su propuesta ha sido aprobada pero aún no está a disposición de los alumnos." data-trigger="hover"></i></span>
                            <span class="small text-warning mr-1">En revisión<i class="icon-line-help-circle" data-toggle="popover" data-content="Estamos revisando la información enviada." data-trigger="hover"></i></span>
                            <span class="small text-danger">Rechazado<i class="icon-line-help-circle" data-toggle="popover" data-content="Su propuesta ha sido rechazada." data-trigger="hover"></i></span>
                          </p>
                          <?php
                          $pury = "SELECT * FROM " . odo_DATA_CURS . " WHERE (profesorid = '" . $dat['id'] . "') ";
                          $pusl = $mysqli->query($pury);
                          $presente = $pusl->num_rows;
                          if ($presente > 0) {
                          ?>
                            <table id="curso" class="display table-bordered w-100 mb-1">
                              <thead>
                                <tr class="table-info small">
                                  <th class="p-1 small">#</th>
                                  <th class="p-1 small">CURSO</th>
                                  <th class="p-1 small">PRESENTADO</th>
                                  <th class="p-1 small">ESPECIALIDAD</th>
                                  <th class="p-1 small">ESTADO DEL PROYECTO</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $scry = "SELECT *, " . odo_DATA_CURS . ".fecha AS presentado, " . odo_DATA_CURS . ".estado AS status, " . odo_DATA_CURS . ".publicado AS publish, " . odo_DATA_CATE . ".categoria AS especialidad FROM " . odo_DATA_CURS . ",  " . odo_DATA_CATE . " WHERE " . odo_DATA_CURS . ".categoriaid = " . odo_DATA_CATE . ".id AND profesorid = '" . $dat['id'] . "' ";
                                $rssl = $mysqli->query($scry);
                                $a = 1;
                                while ($resl = $rssl->fetch_assoc()) {
                                  $pre = date_create($resl['presentado']);
                                  $pres = date_format($pre, 'd M Y');
                                ?>
                                  <tr class="small">
                                    <td class="px-1"><?php echo $a++; ?></td>
                                    <td class="px-1"><?php echo $resl['curso']; ?></td>
                                    <td class="px-1"><?php echo $pres; ?></td>
                                    <td class="px-1"><?php echo $resl['especialidad']; ?></td>
                                    <td class="px-1">
                                      <?php if ($resl['status'] == 'A' and $resl['publish'] == 'S') echo '<span class="text-success">Activo'; ?>
                                      <?php if ($resl['status'] == 'A' and $resl['publish'] == 'N') echo '<span class="text-info">Aprobado'; ?>
                                      <?php if ($resl['status'] == 'P' and $resl['publish'] == 'N') echo '<span class="text-warning">En revisión'; ?>
                                      <?php if ($resl['status'] == 'X') echo '<span class="text-danger">Rechazado'; ?>
                                    </td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          <?php
                          } else {
                          ?>
                            <p class="mb-0">No has presentado ninguna solicitud aún</p>
                          <?php
                          }
                          ?>
                          <h3 class="mb-1 mt-3">Nuevo curso</h3>
                          <p class="my-1 text-secondary">Si desea presentar un nuevo curso a los alumnos de la plataforma, llene la siguiente solicitud y envíela para revisarla. Nos pondremos en contacto con usted a la brevedad posible.</p>
                          <div class="card my-3 px-4 py-3 small">
                            <p class="my-0">En INDESID los cursos tienen la siguiente estructura:</p>
                            <pre class="my-2 text-center">Especialidad -> Módulos -> Clases</pre>
                            <p class="my-0">Es decir que primero debes seleccionar a que <span class="text-secondary">Especialidad</span> pertenece el curso que deseas dictar. Luego indicarás la cantidad de <span class="text-secondary">Módulos</span> en las que has dividido el curso. Finalmente debes indicar el número de <span class="text-secondary">Clases</span> que tiene cada Módulo.</p>
                          </div>
                          <form name="nuevocurso" id="nuevocurso" action="new-course.php" method="post" class="container row bottommargin">
                            <input type="hidden" name="whoask" value="<?php echo $_SESSION['pod']; ?>">
                            <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                            <input type="hidden" name="cookies" value="<?php echo micro(); ?>">
                            <input type="hidden" name="cem" value="<?php echo base64_encode($dat['correo']); ?>">
                            <div class="form-group col-12 col-md-6">
                              <label for="course">Curso<span class="text-danger">*</span><span id="courseError"></span></label>
                              <input autocomplete="off" class="form-control" id="course" name="course" placeholder="Nombre del curso" required type="text" tabindex="1">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="category">Especialidad<span class="text-danger">*</span><span id="categoryError"></span></label>
                              <select id="category" name="category" class="form-control selectpicker" required title="Escoja una especialidad" tabindex="2">
                                <?php
                                $pry = "SELECT * FROM " . odo_DATA_CATE . " WHERE estado = 'A' ORDER BY categoria";
                                $psl = $mysqli->query($pry);
                                while ($cate = $psl->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $cate['id']; ?>"><?php echo $cate['categoria']; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="module">Módulos<span class="text-danger">*</span><i class="added icon-line-help-circle" data-toggle="popover" data-content="Divide tu curso en módulos. Máximo 10 módulos." data-trigger="hover"></i><span id="moduleError"></span></label>
                              <div class="d-flex align-items-center">
                                <input autocomplete="off" class="form-control text-left num" id="module" name="module" placeholder="Cantidad de módulos del curso" maxlength="2" required type="text" tabindex="3">
                                <a href="javascript:;" class="button button-small button-aqua button-rounded" id="pasaModulo">Aceptar</a>
                              </div>
                            </div>
                            <fieldset id="fwrapper" class="mx-auto w-100"></fieldset>
                            <div id="modappears">
                              <div class="row col-12">
                                <div class="form-group col-12 col-md-4">
                                  <label for="levelc">Nivel de dificultad<span class="text-danger">*</span><span id="levelcError"></span></label>
                                  <select id="levelc" name="levelc" class="form-control selectpicker" required title="Nivel del curso" tabindex="4">
                                    <option value="B">Básico</option>
                                    <option value="I">Intermedio</option>
                                    <option value="A">Avanzado</option>
                                  </select>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label for="language">Idioma base<span class="text-danger">*</span><span id="languageError"></span></label>
                                  <select id="language" name="language" class="form-control selectpicker" required title="Escoja idioma" tabindex="6">
                                    <option value="ES">Español</option>
                                    <option value="EN">Inglés</option>
                                  </select>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label for="subtitle">Subtítulos<span class="text-danger">*</span><span id="subtitleError"></span></label>
                                  <select id="subtitle" name="subtitle" class="form-control selectpicker" required title="Escoja subtítulos" tabindex="7">
                                    <option value="NO">No tiene</option>
                                    <option value="ES">Español</option>
                                    <option value="EN">Inglés</option>
                                  </select>
                                </div>
                                <div class="form-group col-12">
                                  <label for="description">Descripción del curso<span class="text-danger">*</span><span id="descriptionError"></span></label>
                                  <textarea autocomplete="off" class="form-control" name="description" id="description" rows="4" placeholder="Breve resumen del curso" required tabindex="8"></textarea>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label for="price">Precio de venta<span class="text-danger">*</span><i class="icon-line-help-circle" data-toggle="popover" data-content="Indica el valor de venta que te gustaría para el curso que propones." data-trigger="hover"></i><span id="priceError"></span></label>
                                  <select id="price" name="price" class="form-control selectpicker" required title="Tu precio sugerido" tabindex="9">
                                    <?php
                                    $zry = "SELECT * FROM " . odo_DATA_PREC . " ORDER BY precio DESC";
                                    $zsl = $mysqli->query($zry);
                                    while ($prec = $zsl->fetch_assoc()) {
                                    ?>
                                      <option value="<?php echo $prec['precio']; ?>"><?php echo $moneda . " " . $prec['precio'] . ".00"; ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label for="sale">Precio de oferta<span class="text-danger">*</span><i class="icon-line-help-circle" data-toggle="popover" data-content="Indica el precio de oferta que aceptarías para el curso." data-trigger="hover"></i><span id="saleError"></span></label>
                                  <select id="sale" name="sale" class="form-control selectpicker" required title="Tu precio de oferta" tabindex="10">
                                    <?php
                                    $zry = "SELECT * FROM " . odo_DATA_PREC . " ORDER BY oferta DESC";
                                    $zsl = $mysqli->query($zry);
                                    while ($prec = $zsl->fetch_assoc()) {
                                    ?>
                                      <option value="<?php echo $prec['oferta']; ?>"><?php echo $moneda . " " . $prec['oferta'] . ".00"; ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-12 col-md-4">&nbsp;</div>
                                <div class="mx-auto">
                                  <button type="submit" class="button button-dark button-rounded mt-1" tabindex="12">Enviar solicitud de curso nuevo</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <?php /* SOLICITAR WEBINAR NUEVO */ ?>
                      <div class="tab-pane fade" id="solicitar-webinar" role="tabpanel" aria-labelledby="webinars">
                        <div class="card mb-5 px-4 pt-3 rounded shadow">
                          <h3 class="mb-1">Webinars presentados</h3>
                          <?php
                          $wury = "SELECT * FROM " . odo_DATA_WEBI . " WHERE (profesorid = '" . $dat['id'] . "') ";
                          $wusl = $mysqli->query($wury);
                          $webpres = $wusl->num_rows;
                          if ($webpres > 0) {
                          ?>
                            <table id="webi" class="display table-bordered w-100 mb-1">
                              <thead>
                                <tr class="table-info small">
                                  <th class="p-1 small">#</th>
                                  <th class="p-1 small">PRESENTADO</th>
                                  <th class="p-1 small">EVENTO</th>
                                  <th class="p-1 small">PONENTE</th>
                                  <th class="p-1 small">PLATAFORMA</th>
                                  <th class="p-1 small">FECHA EVENTO</th>
                                  <th class="p-1 small">ESTADO</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $a = 1;
                                while ($webi = $wusl->fetch_assoc()) {
                                  $webday = date_create($webi['solicitud']);
                                  $wday = date_format($webday, 'd M Y');
                                  $event = date_create($webi['fecha']);
                                  $eventday = date_format($event, 'd M Y');
                                ?>
                                  <tr class="small">
                                    <td class="px-1"><?php echo $a++; ?></td>
                                    <td class="px-1"><?php echo $wday; ?></td>
                                    <td class="px-1"><?php echo $webi['webinar']; ?></td>
                                    <td class="px-1"><?php echo $webi['ponente']; ?></td>
                                    <td class="px-1"><?php echo $webi['plataforma']; ?></td>
                                    <td class="px-1"><?php echo $eventday; ?></td>
                                    <td class="px-1">
                                      <?php if ($webi['estado'] == 'A') echo '<span class="text-success">Publicado'; ?>
                                      <?php if ($webi['estado'] == 'P') echo '<span class="text-info">En revisión'; ?>
                                      <?php if ($webi['estado'] == 'D') echo '<span class="text-danger">Rechazado'; ?>
                                      <?php if ($webi['estado'] == 'X') echo '<span class="text-danger">Culminado'; ?>
                                    </td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          <?php
                          } else {
                          ?>
                            <p class="mb-0">No has presentado ninguna solicitud aún</p>
                          <?php
                          }
                          ?>
                          <h3 class="mb-1 mt-3">Webinar nuevo</h3>
                          <p class="mb-3 text-secondary">Si está interesado en brindar un webinar a los alumnos de la plataforma, llene la siguiente solicitud y envíenosla para revisarla. Nos pondremos en contacto con usted a la brevedad posible.</p>
                          <form name="nuevowebinar" action="new-webinar.php" method="post" class="container row">
                            <input type="hidden" name="quienlopide" value="<?php echo sha1($dat['id']); ?>">
                            <input type="hidden" name="activity" value="<?php echo sha1('profesor'); ?>">
                            <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                            <input type="hidden" name="wem" value="<?php echo base64_encode($dat['correo']); ?>">
                            <div class="form-group col-12">
                              <label class="w-100" for="event">Evento<span class="text-danger">*</span><span class="float-right" id="eventError"></span></label>
                              <input autocomplete="off" class="form-control" id="event" name="event" placeholder="Nombre del evento" required type="text" tabindex="1">
                            </div>
                            <div class="form-group col-12">
                              <label class="w-100" for="wdescription">De que trata el webinar<span class="text-danger">*</span><span class="float-right" id="wdescriptionError"></span></label>
                              <textarea autocomplete="off" class="form-control" name="wdescription" id="wdescription" rows="3" placeholder="Breve resumen del webinar" required tabindex="2"></textarea>
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label class="w-100" for="special">Especialidad<span class="text-danger">*</span><span class="float-right" id="specialError"></span></label>
                              <select id="special" name="special" class="form-control selectpicker" required title="Escoja especialidad" tabindex="3">
                                <?php
                                $pry = "SELECT * FROM " . odo_DATA_CATE . " WHERE estado = 'A' ORDER BY categoria";
                                $psl = $mysqli->query($pry);
                                while ($cate = $psl->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $cate['id']; ?>"><?php echo $cate['categoria']; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label class="w-100" for="wplatform">Plataforma<span class="text-danger">*</span><span class="float-right" id="platformError"></span></label>
                              <select id="wplatform" name="wplatform" class="form-control selectpicker" required title="Escoja plataforma" tabindex="4">
                                <?php
                                foreach ($redes as $social) {
                                  echo '<option value="' . $social . '">' . $social . '</option>';
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-12">
                              <label class="w-100" for="expo">Expositor<span class="text-danger">*</span><span class="float-right" id="expoError"></span></label>
                              <input autocomplete="off" class="form-control" id="expo" name="expo" placeholder="Expositor del webinar" required type="text" tabindex="5" value="<?php echo $dat['quien']; ?>">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label class="w-100" for="datew">Fecha del evento<span class="text-danger">*</span><span class="float-right" id="datewError"></span></label>
                              <input autocomplete="off" class="form-control" id="datew" name="datew" placeholder="dd/mm/yyyy" required type="text" tabindex="6">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label class="w-100" for="time">Hora del evento<span class="text-danger">*</span><span class="float-right" id="timeError"></span></label>
                              <input autocomplete="off" class="form-control" id="time" maxlength="5" name="time" placeholder="hh:mm (24 horas)" required type="text" tabindex="7">
                            </div>
                            <div class="d-flex flex-column mx-auto">
                              <button type="submit" class="button button-dark button-rounded mt-1" tabindex="8">Enviar solicitud de nuevo webinar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <?php /* MIS PAGOS */ ?>
                      <div class="tab-pane min-h-pagos fade" id="mis-pagos" role="tabpanel" aria-labelledby="pagos">
                        <div class="card mb-5 px-4 pt-3 rounded shadow">
                          <h3 class="mb-1">Pagos mensuales
                            <span class="form-group float-right ml-1 small">
                              <select class="font-secondary form-control form-control-sm selectpicker" id="cambiaanio">
                                <?php
                                if ($anioini < $year) $varios = true;
                                else $varios = false;
                                if ($varios) {
                                  for ($anios = $year; $anios >= $anioini; $anios--) {
                                ?>
                                    <option value="<?php echo $anios; ?>"><?php echo $anios; ?></option>
                                  <?php
                                  }
                                } else {
                                  ?>
                                  <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </span>
                          </h3>
                          <div id="payment" class="pb-2">
                            <table id="tpagos" class="table table-bordered table-sm w-100">
                              <thead>
                                <tr class="table-info small">
                                  <th class="p-1 small">MES</th>
                                  <th class="p-1 small">INSCRITOS</th>
                                  <th class="p-1 small">PAGO x CURSOS</th>
                                  <th class="p-1 small">PAGO x REFERIDOS</th>
                                  <th class="p-1 small">PAGO TOTAL</th>
                                  <th class="p-1 small">ESTADO</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                for ($mes = 1; $mes <= 12; $mes++) {
                                  $try = "SELECT SUM(monto*comision/100) AS billete FROM " . odo_DATA_TRAN . " WHERE (YEAR(fecha) = $year) AND (MONTH(fecha) = $mes) AND profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                                  $tsl = $mysqli->query($try);
                                  $pay = $tsl->fetch_assoc();
                                  $sry = "SELECT count(profesorid) AS cuantos FROM " . odo_DATA_TRAN . " WHERE (YEAR(fecha) = $year) AND (MONTH(fecha) = $mes) AND profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                                  $ssl = $mysqli->query($sry);
                                  $pag = $ssl->fetch_assoc();
                                ?>
                                  <tr class="small">
                                    <td class="px-1"><?php echo $meses[$mes]; ?></td>
                                    <td class="px-1">
                                      <?php
                                      if ($pag['cuantos'] > 0) {
                                        if ($pag['cuantos'] == 1) echo $pag['cuantos'] . " alumno";
                                        else echo $pag['cuantos'] . " alumnos";
                                      }
                                      ?>
                                    </td>
                                    <td class="px-1"><?php if (!is_null($pay['billete'])) echo $moneda . number_format($pay['billete'], 2); ?></td>
                                    <td class="px-1 text-grey">
                                      <?php
                                      $fry = "SELECT referidoid FROM " . odo_DATA_REFE . " WHERE profesorid = '" . $dat['id'] . "' AND estado = 'A' ";
                                      $fsl = $mysqli->query($fry);
                                      $hayref = $fsl->num_rows;
                                      if ($hayref > 0) {
                                        $por_referido = [];
                                        while ($fef = $fsl->fetch_assoc()) {
                                          $rry = "SELECT SUM(monto*0.1) AS referidos FROM " . odo_DATA_TRAN . " WHERE (YEAR(fecha) = $year) AND (MONTH(fecha) = $mes) AND profesorid = '" . $fef['referidoid'] . "' AND estado = 'A' ";
                                          $rrl = $mysqli->query($rry);
                                          $ref = $rrl->fetch_assoc();
                                          if (is_null($ref['referidos'])) array_push($por_referido, '0');
                                          else array_push($por_referido, $ref['referidos']);
                                          $totref = array_sum($por_referido);
                                        }
                                        if ($totref > 0) echo $moneda . number_format($totref, 2);
                                      } else {
                                        $totref = 0;
                                      }
                                      ?>
                                    </td>
                                    <td class="px-1 font-weight-bold">
                                      <?php
                                      if ($pay['billete'] != 0) {
                                        $tot = $pay['billete'] + $totref;
                                        echo $moneda . number_format($tot, 2);
                                      }
                                      ?>
                                    </td>
                                    <td class="px-1">
                                      <?php
                                      if ($pag['cuantos'] > 0) {
                                      ?>
                                        <?php
                                        ?>
                                        <a class="small text-info" href="https://www.paypal.com/myaccount/transfer/homepage/external/profile" target="_blank">Conéctate con PayPal</a>
                                      <?php
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <?php /* MIS REFERIDOS */ ?>
                      <div class="tab-pane min-h-pagos fade" id="mis-referidos" role="tabpanel" aria-labelledby="referidos">
                        <div class="card mb-5 px-4 pt-3 rounded shadow">
                          <h3 class="mb-1">Referidos propuestos</h3>
                          <?php
                          $rury = "SELECT * FROM " . odo_DATA_REFE . " WHERE (profesorid = '" . $dat['id'] . "') ";
                          $rusl = $mysqli->query($rury);
                          $refer = $rusl->num_rows;
                          if ($refer > 0) {
                          ?>
                            <table id="refe" class="display table-bordered w-100 mb-1">
                              <thead>
                                <tr class="table-info small">
                                  <th class="p-1 small">#</th>
                                  <th class="p-1 small">REFERIDO</th>
                                  <th class="p-1 small">EMAIL</th>
                                  <th class="p-1 small">FECHA</th>
                                  <th class="p-1 small">ESTADO</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $a = 1;
                                while ($rfrd = $rusl->fetch_assoc()) {
                                  $rfr = date_create($rfrd['fecha']);
                                  $rfrday = date_format($rfr, 'd M Y');
                                ?>
                                  <tr class="small">
                                    <td class="px-1"><?php echo $a++; ?></td>
                                    <td class="px-1"><?php echo $rfrd['referido']; ?></td>
                                    <td class="px-1"><?php echo $rfrd['correoreferido']; ?></td>
                                    <td class="px-1"><?php echo $rfrday; ?></td>
                                    <td class="px-1">
                                      <?php if ($rfrd['estado'] == 'A') echo '<span class="text-success">Aprobado'; ?>
                                      <?php if ($rfrd['estado'] == 'R') echo '<span class="text-info">En revisión'; ?>
                                      <?php if ($rfrd['estado'] == 'X') echo '<span class="text-danger">Rechazado'; ?>
                                    </td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          <?php
                          } else {
                          ?>
                            <p class="mb-0">No has presentado ninguna solicitud aún</p>
                          <?php
                          }
                          ?>
                          <h3 class="mb-1 mt-3">Referir</h3>
                          <p class="mb-3 text-secondary">Si conoces alguien que puedas recomendar para pertenecer al staff de profesores puedes referirlo. Si califica podrás obtener un porcentaje de sus cursos vendidos todos los meses. Todos los datos con un <span class="text-danger">*</span> son obligatorios.</p>
                          <form name="referer" action="new-referer.php" method="post" class="container row">
                            <input type="hidden" name="qask" value="<?php echo base64_encode($dat['quien']); ?>">
                            <input type="hidden" name="whenask" value="<?php echo sha1($hoy); ?>">
                            <input type="hidden" name="activity" value="<?php echo sha1('referido'); ?>">
                            <input type="hidden" name="cookies" value="<?php echo sha1(micro()); ?>">
                            <input type="hidden" name="rem" value="<?php echo base64_encode($dat['correo']); ?>">
                            <div class="form-group col-12 col-md-6">
                              <label for="firstname">Nombres<span class="text-danger">*</span><span id="firstnameError"></span></label>
                              <input autocomplete="off" class="form-control" id="firstname" name="firstname" placeholder="Nombres" required type="text" tabindex="1">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="lastname">Apellidos<span class="text-danger">*</span><span id="lastnameError"></span></label>
                              <input autocomplete="off" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required type="text" tabindex="2">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="email">Email<span class="text-danger">*</span><span id="emailError"></span></label>
                              <input autocomplete="off" class="form-control" id="email" name="email" placeholder="Email" required type="email" tabindex="3">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="telephone">Teléfono<span class="text-danger">*</span><span id="telephoneError"></span></label>
                              <input autocomplete="off" class="form-control numerico" minlength="5" id="telephone" name="telephone" placeholder="Teléfono" required type="text" tabindex="4">
                            </div>
                            <div class="form-group col-12 col-md-3">
                              <label for="gender">Género<span class="text-danger">*</span><span id="genderError"></span></label>
                              <select id="gender" name="gender" class="form-control selectpicker" required title="Indique género" tabindex="5">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                              </select>
                            </div>
                            <div class="form-group col-12 col-md-3">
                              <label for="age">Edad<span class="text-danger">*</span><span id="ageError"></span></label>
                              <input autocomplete="off" class="form-control" id="age" maxlength="2" name="age" placeholder="Edad" required type="text" tabindex="6">
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="specialty">Especialidad<span class="text-danger">*</span><span id="specialtyError"></span></label>
                              <select id="specialty" name="specialty" class="form-control selectpicker" required title="Indique especialidad" tabindex="7">
                                <?php
                                $pry = "SELECT * FROM " . odo_DATA_CATE . " ORDER BY categoria";
                                $psl = $mysqli->query($pry);
                                while ($cate = $psl->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $cate['categoria']; ?>"><?php echo $cate['categoria']; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="studies">Nivel de Estudios<span class="text-danger">*</span><span id="studiesError"></span></label>
                              <select id="studies" name="studies" class="form-control selectpicker show-tick" required title="Indique nivel de estudios" tabindex="8">
                                <?php
                                $lry = "SELECT * FROM " . odo_DATA_NIVE . " ORDER BY nivel";
                                $lsl = $mysqli->query($lry);
                                while ($live = $lsl->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $live['nivel']; ?>"><?php echo $live['nivel']; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                              <label for="country">País<span class="text-danger">*</span><span id="countryError"></span></label>
                              <select id="country" name="country" class="form-control selectpicker" data-live-search="true" data-size="3" required title="Escoja país" tabindex="9">
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
                            <div class="form-group col-12">
                              <label for="aboutit">Acerca del referido<span class="text-danger">*</span><span id="aboutitError"></span></label>
                              <textarea autocomplete="off" class="form-control" id="aboutit" name="aboutit" placeholder="Cuéntanos tu opinión sobre el referido" required tabindex="10" rows="3"></textarea>
                            </div>
                            <div class="mx-auto">
                              <button type="submit" class="button button-dark button-rounded mt-1" tabindex="11">Enviar datos del referido</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php echo vmodalsm('contestar', 'Notificación', 'modal-lg', 'noti') ?>
        <?php } ?>
        <?php include 'footer.php'; ?>
      </div>
      <div id="gotoTop" class="icon-line-chevron-up"></div>
      <?php require 'scripts.php'; ?>
      <script>
        $('table.display').DataTable({
          order: [0, 'asc'],
          paging: true,
          responsive: true,
          language: {
            emptyTable: 'No hay datos',
            loadingRecords: 'Cargando...',
            search: 'Buscar:',
            paginate: {
              previous: '<',
              next: '>',
            },
          },
          dom: 'ftp',
        });
      </script>
      <?php if ($vertodo) { ?>
        <script>
          var _0x3cdd90 = _0x2dd0;
          (function(_0x290e50, _0x5e5646) {
            var _0x3f0d2b = _0x2dd0,
              _0xfab1d0 = _0x290e50();
            while (!![]) {
              try {
                var _0xca5ed7 = parseInt(_0x3f0d2b(0xf1)) / 0x1 * (-parseInt(_0x3f0d2b(0x18a)) / 0x2) + -parseInt(_0x3f0d2b(0x14d)) / 0x3 + -parseInt(_0x3f0d2b(0x13f)) / 0x4 + -parseInt(_0x3f0d2b(0x18d)) / 0x5 + parseInt(_0x3f0d2b(0x180)) / 0x6 + -parseInt(_0x3f0d2b(0xc1)) / 0x7 * (parseInt(_0x3f0d2b(0x142)) / 0x8) + parseInt(_0x3f0d2b(0x16c)) / 0x9;
                if (_0xca5ed7 === _0x5e5646) break;
                else _0xfab1d0['push'](_0xfab1d0['shift']());
              } catch (_0x356aa0) {
                _0xfab1d0['push'](_0xfab1d0['shift']());
              }
            }
          }(_0xcc7b, 0xafdba), $(_0x3cdd90(0x165))[_0x3cdd90(0xd4)](![]), $(_0x3cdd90(0x153))[_0x3cdd90(0xd4)](), $(_0x3cdd90(0x14b))['numerico'](), $(_0x3cdd90(0x160))[_0x3cdd90(0xd4)](), $(_0x3cdd90(0x140))[_0x3cdd90(0xd0)]({
            'autoclose': !![],
            'format': _0x3cdd90(0x13d),
            'startDate': '+1w\x20-1d'
          }), $(_0x3cdd90(0x18c))['datepicker']({
            'autoclose': !![],
            'format': _0x3cdd90(0x13d),
            'startDate': _0x3cdd90(0xed)
          }), $(_0x3cdd90(0x107))['numerico']({
            'decimal': ':'
          }), $[_0x3cdd90(0x118)] = function(_0x560ca6) {
            var _0x52e399 = _0x3cdd90;
            isValid = !![];
            var _0x4c0917 = $(_0x560ca6)[_0x52e399(0xe1)]();
            if (_0x4c0917 === '') isValid = ![];
            var _0x359f1b = /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/,
              _0x28f95a = _0x4c0917[_0x52e399(0xd7)](_0x359f1b);
            if (_0x28f95a === null) isValid = ![];
            return isValid;
          }, $(_0x3cdd90(0x107))['on']('change', function() {
            var _0x324996 = _0x3cdd90;
            !$[_0x324996(0x118)]($(this)) ? $(_0x324996(0x100))['html']('<span\x20class=\x22form-label-error\x22>Formato\x20de\x2024\x20horas</span>') : $(_0x324996(0x100))[_0x324996(0xdb)]('\x20');
          }), $('#pasaModulo')[_0x3cdd90(0x151)](), $('#modappears')[_0x3cdd90(0x151)](), $(_0x3cdd90(0x11d))['prop']('disabled', !![]), $('#darse')[_0x3cdd90(0xea)](_0x3cdd90(0x169)), $('#darse')[_0x3cdd90(0x151)](), $(_0x3cdd90(0x168))['on'](_0x3cdd90(0x195), function() {
            var _0x2e02ea = _0x3cdd90;
            readURL(this), $('#archivo')['text']($(this)['get'](0x0)[_0x2e02ea(0xd1)][_0x2e02ea(0xc2)](0x0)[_0x2e02ea(0x166)]);
          }), $(_0x3cdd90(0x10a))['on'](_0x3cdd90(0x195), function postinput() {
            var _0x47d62b = _0x3cdd90,
              _0x519b24 = $(this)[_0x47d62b(0xe1)]();
            $[_0x47d62b(0x161)]({
              'url': _0x47d62b(0x110),
              'type': _0x47d62b(0xe8),
              'data': {
                'p': _0x519b24
              }
            })[_0x47d62b(0xf0)](function(_0x16397b) {
              var _0x4fd472 = _0x47d62b;
              $(_0x4fd472(0xcb))[_0x4fd472(0xdb)](_0x16397b);
            })[_0x47d62b(0x185)](function(_0x5b9301, _0xfce3da) {
              var _0x31cfbc = _0x47d62b;
              $(_0x31cfbc(0xcb))['html']('Error!!!');
            });
          }), ajaxData(_0x3cdd90(0x10e), _0x3cdd90(0x157), _0x3cdd90(0x108), 'noti'), ajaxData(_0x3cdd90(0xfb), 'answer.php', _0x3cdd90(0x159), 'noti'), $(_0x3cdd90(0x104))['on'](_0x3cdd90(0x18b), function(_0x25b505) {
            var _0x4c99ab = _0x3cdd90,
              _0x41d45b = 0xa;
            minField = $(this)[_0x4c99ab(0xe1)]();
            if (minField == 0x0) return $('#pasaModulo')[_0x4c99ab(0x151)](), Toast[_0x4c99ab(0xc4)]({
              'icon': _0x4c99ab(0x125),
              'title': _0x4c99ab(0x106)
            }), ![];
            if (minField <= _0x41d45b) $(_0x4c99ab(0x11b))[_0x4c99ab(0x135)](), $('#pasaModulo')['on'](_0x4c99ab(0x197), function() {
              var _0x31c7dd = _0x4c99ab;
              $('#pasaModulo')['hide'](), $(_0x31c7dd(0x104))[_0x31c7dd(0x151)](), $(_0x31c7dd(0x167))[_0x31c7dd(0x135)]();
              var _0x158538 = $('#fwrapper'),
                _0x2dea1a = '<div\x20class=\x22form-group\x20col-12\x20mb-0\x22><label\x20for=\x22nmodule\x22>Nombre\x20de\x20cada\x20módulo<span\x20class=\x22text-danger\x22>*</span><span\x20id=\x22moduleError\x22></span></label></div>';
              if (minField > 0x0) {
                if (minField == 0x1) var _0x38cee4 = _0x31c7dd(0x13a);
                else var _0x38cee4 = _0x31c7dd(0x14e);
                $('#moduleError')[_0x31c7dd(0xdb)](_0x31c7dd(0x111) + minField + _0x38cee4 + _0x31c7dd(0xbf)), $(_0x158538)[_0x31c7dd(0xdb)](_0x2dea1a);
                for (x = 0x1; x <= minField; x++) {
                  $(_0x158538)[_0x31c7dd(0x177)]('<div\x20class=\x22form-group\x20col-12\x22><div\x20class=\x22d-flex\x20align-items-center\x22><input\x20autocomplete=\x22off\x22\x20class=\x22form-control\x22\x20id=\x22nmodule' + x + _0x31c7dd(0xc5) + x + _0x31c7dd(0x117) + x + _0x31c7dd(0xcf) + x + _0x31c7dd(0x163)), $(_0x31c7dd(0x103) + x)[_0x31c7dd(0xd4)](![]);
                }
                return;
              } else return ![];
            });
            else return $('#pasaModulo')[_0x4c99ab(0x151)](), Toast['fire']({
              'icon': 'error',
              'title': _0x41d45b + '\x20es\x20el\x20máximo\x20número\x20de\x20módulos'
            }), ![];
            _0x25b505['preventDefault']();
          }), $(function() {
            var _0x3eaeed = _0x3cdd90;
            $['validator'][_0x3eaeed(0xe9)](_0x3eaeed(0x105), function(_0x4c9df6, _0x483258) {
              var _0x592a20 = _0x3eaeed;
              return this[_0x592a20(0x171)](_0x483258) || /^[a-zA-Z0-9!@#$%^&()={*};:\_\|,.<>+-]*$/i [_0x592a20(0x182)](_0x4c9df6) && /[A-Z]/ [_0x592a20(0x182)](_0x4c9df6) && /[a-z]/ [_0x592a20(0x182)](_0x4c9df6) && /\d/i [_0x592a20(0x182)](_0x4c9df6) && /[!@#$%^&()={*};:\_\|,.<>+-]/i ['test'](_0x4c9df6);
            }, _0x3eaeed(0x12f)), $(_0x3eaeed(0x12d))['validate']({
              'rules': {
                'level': {
                  'required': !![]
                },
                'aboutmes': {
                  'required': !![]
                },
                'phonez': {
                  'required': !![],
                  'minlength': 0x6
                },
                'dni': {
                  'required': !![]
                }
              },
              'messages': {
                'level': {
                  'required': _0x3eaeed(0x13b)
                },
                'aboutmes': {
                  'required': 'Cuentános\x20acerca\x20de\x20tí'
                },
                'phonez': {
                  'required': 'Indique\x20teléfono',
                  'minlength': _0x3eaeed(0xd2)
                },
                'dni': {
                  'required': _0x3eaeed(0x113)
                }
              },
              'errorPlacement': function(_0x2b9191, _0x2d7499) {
                var _0x49c839 = _0x3eaeed;
                if (_0x2d7499[_0x49c839(0x150)](_0x49c839(0x166)) == _0x49c839(0xc6)) _0x2b9191[_0x49c839(0xf8)](_0x49c839(0x152));
                if (_0x2d7499[_0x49c839(0x150)](_0x49c839(0x166)) == _0x49c839(0x172)) _0x2b9191[_0x49c839(0xf8)](_0x49c839(0xf9));
                if (_0x2d7499['attr']('name') == _0x49c839(0x120)) _0x2b9191[_0x49c839(0xf8)]('#dniError');
              },
              'submitHandler': function(_0xa64529) {
                var _0x56dcc6 = _0x3eaeed;
                $[_0x56dcc6(0x161)]({
                  'type': 'post',
                  'url': _0x56dcc6(0xe2),
                  'data': $(_0xa64529)[_0x56dcc6(0xbe)](),
                  'success': function(_0x4b4633) {
                    var _0x116f97 = _0x56dcc6;
                    const _0x28830f = JSON[_0x116f97(0x13c)](_0x4b4633);
                    if (_0x28830f[0x0] == !![]) Toast[_0x116f97(0xc4)]({
                      'icon': _0x116f97(0x196),
                      'title': _0x116f97(0x192)
                    });
                    else Toast[_0x116f97(0xc4)]({
                      'icon': _0x116f97(0x125),
                      'title': _0x28830f[0x1]
                    });
                  },
                  'error': function() {
                    var _0x5d78b3 = _0x56dcc6;
                    Toast[_0x5d78b3(0xc4)]({
                      'icon': _0x5d78b3(0x125),
                      'title': _0x5d78b3(0x17e)
                    });
                  }
                });
              }
            }), $(_0x3eaeed(0xc7))[_0x3eaeed(0x131)]({
              'rules': {
                'old': {
                  'required': !![],
                  'minlength': 0x5
                },
                'new': {
                  'required': !![],
                  'minlength': 0x8,
                  'passeguro': !![]
                },
                'again': {
                  'required': !![],
                  'minlength': 0x8,
                  'passeguro': !![],
                  'equalTo': '#new'
                }
              },
              'messages': {
                'old': {
                  'required': _0x3eaeed(0xf6),
                  'minlength': _0x3eaeed(0x156)
                },
                'new': {
                  'required': 'Ingresa\x20clave\x20nueva',
                  'minlength': _0x3eaeed(0x15f)
                },
                'again': {
                  'required': _0x3eaeed(0x11c),
                  'minlength': _0x3eaeed(0x15f),
                  'equalTo': _0x3eaeed(0xfa)
                }
              },
              'errorPlacement': function(_0x542937, _0x4a4b18) {
                var _0x1e697f = _0x3eaeed;
                if (_0x4a4b18[_0x1e697f(0x150)]('name') == 'old') _0x542937['appendTo']('#oldError');
                if (_0x4a4b18[_0x1e697f(0x150)]('name') == 'new') _0x542937[_0x1e697f(0xf8)](_0x1e697f(0x115));
                if (_0x4a4b18[_0x1e697f(0x150)](_0x1e697f(0x166)) == _0x1e697f(0x148)) _0x542937[_0x1e697f(0xf8)](_0x1e697f(0x188));
              },
              'submitHandler': function(_0x14d957) {
                var _0x5b609b = _0x3eaeed;
                $[_0x5b609b(0x161)]({
                  'type': _0x5b609b(0x16f),
                  'url': _0x5b609b(0x15b),
                  'data': $(_0x14d957)[_0x5b609b(0xbe)](),
                  'success': function(_0x3eb06b) {
                    var _0x22e67b = _0x5b609b;
                    const _0x2bdda3 = JSON[_0x22e67b(0x13c)](_0x3eb06b);
                    console[_0x22e67b(0x124)](_0x3eb06b), document[_0x22e67b(0x11a)](_0x22e67b(0x128))[_0x22e67b(0x181)](), $(_0x22e67b(0x112))[_0x22e67b(0x143)](_0x22e67b(0x149), !![]), $(_0x22e67b(0x14f))[_0x22e67b(0x150)](_0x22e67b(0x10f), _0x22e67b(0x199)), $(_0x22e67b(0xce))[_0x22e67b(0x150)](_0x22e67b(0x10f), _0x22e67b(0x199)), $(_0x22e67b(0xe4))[_0x22e67b(0x150)](_0x22e67b(0x10f), _0x22e67b(0x199));
                    if (_0x2bdda3[0x0] == !![]) Toast[_0x22e67b(0xc4)]({
                      'icon': 'success',
                      'title': _0x22e67b(0x15d)
                    });
                    else Toast[_0x22e67b(0xc4)]({
                      'icon': _0x22e67b(0x125),
                      'title': _0x2bdda3[0x1]
                    });
                  },
                  'error': function() {
                    var _0x1fe960 = _0x5b609b;
                    Toast[_0x1fe960(0xc4)]({
                      'icon': _0x1fe960(0x125),
                      'title': _0x1fe960(0x194)
                    });
                  }
                });
              }
            }), $(_0x3eaeed(0x184))[_0x3eaeed(0x131)]({
              'rules': {
                'darsedebaja': {
                  'required': !![],
                  'maxlength': 0x7
                },
                'actua': {
                  'required': !![]
                },
                'motivo': {
                  'required': !![]
                }
              },
              'messages': {
                'darsedebaja': {
                  'required': _0x3eaeed(0x18f)
                },
                'actua': {
                  'required': _0x3eaeed(0x127)
                },
                'motivo': {
                  'required': _0x3eaeed(0x146)
                }
              },
              'errorPlacement': function(_0x996670, _0x5c8ce3) {
                var _0x4f3d5d = _0x3eaeed;
                if (_0x5c8ce3[_0x4f3d5d(0x150)](_0x4f3d5d(0x166)) == _0x4f3d5d(0xff)) _0x996670[_0x4f3d5d(0xf8)](_0x4f3d5d(0x16d));
                if (_0x5c8ce3['attr'](_0x4f3d5d(0x166)) == _0x4f3d5d(0x198)) _0x996670[_0x4f3d5d(0xf8)]('#actuaError');
                if (_0x5c8ce3[_0x4f3d5d(0x150)]('name') == _0x4f3d5d(0xde)) _0x996670[_0x4f3d5d(0xf8)](_0x4f3d5d(0xd6));
              },
              'submitHandler': function(_0x2e2981) {
                _0x2e2981['submit']();
              }
            }), $(_0x3eaeed(0xfc))[_0x3eaeed(0x131)]({
              'rules': {
                'course': {
                  'required': !![]
                },
                'category': {
                  'required': !![]
                },
                'levelc': {
                  'required': !![]
                },
                'language': {
                  'required': !![]
                },
                'subtitle': {
                  'required': !![]
                },
                'module': {
                  'required': !![]
                },
                'description': {
                  'required': !![]
                },
                'trailer': {
                  'url': !![]
                },
                'price': {
                  'required': !![]
                },
                'sale': {
                  'required': !![]
                }
              },
              'messages': {
                'course': {
                  'required': _0x3eaeed(0x16b)
                },
                'category': {
                  'required': 'Escoja\x20especialidad'
                },
                'levelc': {
                  'required': _0x3eaeed(0xc8)
                },
                'language': {
                  'required': 'Escoja\x20idioma\x20base'
                },
                'subtitle': {
                  'required': 'Escoja\x20opción'
                },
                'module': {
                  'required': _0x3eaeed(0x154)
                },
                'description': {
                  'required': _0x3eaeed(0x164)
                },
                'trailer': {
                  'url': _0x3eaeed(0xdd)
                },
                'price': {
                  'required': 'Indique\x20precio\x20de\x20venta'
                },
                'sale': {
                  'required': _0x3eaeed(0x16e)
                }
              },
              'errorPlacement': function(_0x349d2e, _0x4b3b26) {
                var _0x400c70 = _0x3eaeed;
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == _0x400c70(0x109)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0xf5));
                if (_0x4b3b26[_0x400c70(0x150)]('name') == _0x400c70(0x162)) _0x349d2e[_0x400c70(0xf8)]('#aboutmeError');
                if (_0x4b3b26[_0x400c70(0x150)]('name') == _0x400c70(0x191)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0x14c));
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == _0x400c70(0xf4)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0x183));
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == _0x400c70(0x10d)) _0x349d2e['appendTo'](_0x400c70(0x136));
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == 'levelc') _0x349d2e['appendTo'](_0x400c70(0xcd));
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == 'language') _0x349d2e[_0x400c70(0xf8)]('#languageError');
                if (_0x4b3b26['attr'](_0x400c70(0x166)) == _0x400c70(0xef)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0x137));
                if (_0x4b3b26['attr'](_0x400c70(0x166)) == _0x400c70(0x155)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0xee));
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == _0x400c70(0x141)) _0x349d2e[_0x400c70(0xf8)]('#descriptionError');
                if (_0x4b3b26['attr'](_0x400c70(0x166)) == _0x400c70(0x147)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0x15c));
                if (_0x4b3b26[_0x400c70(0x150)](_0x400c70(0x166)) == _0x400c70(0x17b)) _0x349d2e[_0x400c70(0xf8)](_0x400c70(0xc3));
                if (_0x4b3b26['attr']('name') == _0x400c70(0x132)) _0x349d2e['appendTo'](_0x400c70(0xeb));
              },
              'submitHandler': function(_0x485dee) {
                _0x485dee['submit']();
              }
            }), $('form[name=\x27nuevowebinar\x27]')[_0x3eaeed(0x131)]({
              'rules': {
                'event': {
                  'required': !![]
                },
                'wdescription': {
                  'required': !![]
                },
                'special': {
                  'required': !![]
                },
                'platform': {
                  'required': !![]
                },
                'expo': {
                  'required': !![]
                },
                'datew': {
                  'required': !![]
                },
                'time': {
                  'required': !![],
                  'maxlength': 0x5
                }
              },
              'messages': {
                'event': {
                  'required': _0x3eaeed(0x176)
                },
                'wdescription': {
                  'required': _0x3eaeed(0x190)
                },
                'special': {
                  'required': _0x3eaeed(0xe5)
                },
                'platform': {
                  'required': _0x3eaeed(0x134)
                },
                'expo': {
                  'required': _0x3eaeed(0xc9)
                },
                'datew': {
                  'required': 'Indique\x20la\x20fecha\x20del\x20webinar'
                },
                'time': {
                  'required': _0x3eaeed(0x129),
                  'maxlength': _0x3eaeed(0x144)
                }
              },
              'errorPlacement': function(_0x4879bd, _0x29a3b1) {
                var _0x405d75 = _0x3eaeed;
                if (_0x29a3b1[_0x405d75(0x150)](_0x405d75(0x166)) == _0x405d75(0x116)) _0x4879bd[_0x405d75(0xf8)](_0x405d75(0x145));
                if (_0x29a3b1[_0x405d75(0x150)](_0x405d75(0x166)) == _0x405d75(0x11e)) _0x4879bd['appendTo'](_0x405d75(0x114));
                if (_0x29a3b1[_0x405d75(0x150)](_0x405d75(0x166)) == _0x405d75(0xd5)) _0x4879bd['appendTo'](_0x405d75(0x17f));
                if (_0x29a3b1[_0x405d75(0x150)](_0x405d75(0x166)) == _0x405d75(0x12a)) _0x4879bd[_0x405d75(0xf8)](_0x405d75(0x126));
                if (_0x29a3b1[_0x405d75(0x150)](_0x405d75(0x166)) == _0x405d75(0xf7)) _0x4879bd[_0x405d75(0xf8)](_0x405d75(0xf2));
                if (_0x29a3b1[_0x405d75(0x150)](_0x405d75(0x166)) == _0x405d75(0xda)) _0x4879bd['appendTo'](_0x405d75(0xe6));
                if (_0x29a3b1['attr'](_0x405d75(0x166)) == _0x405d75(0x13e)) _0x4879bd['appendTo'](_0x405d75(0x100));
              },
              'submitHandler': function(_0x87fd13) {
                var _0x3587e2 = _0x3eaeed;
                _0x87fd13[_0x3587e2(0x10c)]();
              }
            }), $(_0x3eaeed(0xdf))['validate']({
              'rules': {
                'firstname': {
                  'required': !![]
                },
                'lastname': {
                  'required': !![]
                },
                'email': {
                  'required': !![],
                  'email': !![]
                },
                'telephone': {
                  'required': !![],
                  'minlength': 0x5
                },
                'gender': {
                  'required': !![]
                },
                'age': {
                  'required': !![],
                  'maxlength': 0x2
                },
                'specialty': {
                  'required': !![]
                },
                'studies': {
                  'required': !![]
                },
                'country': {
                  'required': !![]
                },
                'aboutit': {
                  'required': !![]
                }
              },
              'messages': {
                'firstname': {
                  'required': _0x3eaeed(0x17a)
                },
                'lastname': {
                  'required': 'Ingrese\x20apellidos\x20del\x20referido'
                },
                'email': {
                  'required': _0x3eaeed(0x123),
                  'email': _0x3eaeed(0x14a)
                },
                'telephone': {
                  'required': _0x3eaeed(0x11f),
                  'minlength': _0x3eaeed(0x178)
                },
                'gender': {
                  'required': _0x3eaeed(0xfe)
                },
                'age': {
                  'required': _0x3eaeed(0x17c),
                  'maxlength': _0x3eaeed(0x178)
                },
                'speciality': {
                  'required': _0x3eaeed(0x133)
                },
                'studies': {
                  'required': _0x3eaeed(0xfd)
                },
                'country': {
                  'required': _0x3eaeed(0xd3)
                },
                'aboutit': {
                  'required': 'Escriba\x20un\x20breve\x20resumen'
                }
              },
              'errorPlacement': function(_0x52b06a, _0x1eece9) {
                var _0x2d7cc1 = _0x3eaeed;
                if (_0x1eece9[_0x2d7cc1(0x150)]('name') == _0x2d7cc1(0x139)) _0x52b06a['appendTo'](_0x2d7cc1(0x130));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0x138)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0xec));
                if (_0x1eece9[_0x2d7cc1(0x150)]('name') == _0x2d7cc1(0x102)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0xe3));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == 'pass') _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0xca));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0xcc)) _0x52b06a[_0x2d7cc1(0xf8)]('#telephoneError');
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0x122)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0xe7));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0xd8)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0x17d));
                if (_0x1eece9['attr'](_0x2d7cc1(0x166)) == _0x2d7cc1(0x179)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0xdc));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0x186)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0x193));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0x12e)) _0x52b06a[_0x2d7cc1(0xf8)](_0x2d7cc1(0x189));
                if (_0x1eece9[_0x2d7cc1(0x150)](_0x2d7cc1(0x166)) == _0x2d7cc1(0xd9)) _0x52b06a['appendTo'](_0x2d7cc1(0x15a));
              },
              'submitHandler': function(_0xf7b095) {
                var _0x3a3936 = _0x3eaeed;
                _0xf7b095[_0x3a3936(0x10c)]();
              }
            });
          }), $('#muestra')['on'](_0x3cdd90(0x197), function() {
            var _0x2b3a22 = _0x3cdd90;
            if (this[_0x2b3a22(0x158)]) $('#darse')[_0x2b3a22(0x135)]();
            else $('#darse')[_0x2b3a22(0x151)]();
          }), $('#darsedebaja')['on'](_0x3cdd90(0x18b), function() {
            var _0x41bf6d = _0x3cdd90;
            $(this)[_0x41bf6d(0xe1)]()['length'] <= 0x7 && $(this)[_0x41bf6d(0xe1)]()['toUpperCase']() !== _0x41bf6d(0x187) ? ($('#darse')[_0x41bf6d(0xea)]('prohibited'), $('#darse')[_0x41bf6d(0x143)](_0x41bf6d(0x149), !![])) : ($(_0x41bf6d(0x11d))[_0x41bf6d(0xc0)]('prohibited'), $(_0x41bf6d(0x11d))[_0x41bf6d(0x143)](_0x41bf6d(0x149), ![]));
          }));

          function _0xcc7b() {
            var _0x28d91e = ['#datew', '5566535fdRYAC', 'cursor-not-allowed', 'Ingrese\x20la\x20palabra\x20INDESID', 'Escriba\x20un\x20breve\x20resumen', 'phone', 'Datos\x20actualizados', '#studiesError', 'No\x20se\x20pudo\x20cambiar\x20la\x20contraseña', 'change', 'info', 'click', 'actua', 'password', 'serialize', '</span>', 'removeClass', '35nPHMTa', 'item', '#priceError', 'fire', '\x22\x20name=\x22nmodule[]\x22\x20placeholder=\x22Nombre\x20del\x20módulo\x20', 'aboutmes', '#actualizarclave', 'Escoja\x20nivel', 'Indique\x20el\x20nombre\x20del\x20expositor', '#passError', '#payment', 'telephone', '#levelcError', '#new', '\x22\x20name=\x22nclass[]\x22\x20placeholder=\x22Cantidad\x20de\x20clases\x20para\x20módulo\x20', 'datepicker', 'files', 'Mínimo\x206\x20caracteres', 'Elija\x20país', 'numerico', 'special', '#motivoBajaError', 'match', 'age', 'aboutit', 'datew', 'html', '#specialtyError', 'La\x20URL\x20debe\x20empezar\x20con\x20https', 'motivo', 'form[name=\x27referer\x27]', 'Imagen\x20muy\x20grande.\x20Utilice\x20una\x20imagen\x20de\x204MB\x20como\x20máximo.', 'val', 'update.php', '#emailError', '#again', 'Elige\x20especialidad', '#datewError', '#genderError', 'POST', 'addMethod', 'addClass', '#saleError', '#lastnameError', '+1w\x20-1d', '#moduleError', 'subtitle', 'done', '33362WbGJZj', '#expoError', 'result', 'course', '#levelError', 'Ingrese\x20clave\x20actual', 'expo', 'appendTo', '#phonezError', 'Claves\x20no\x20son\x20iguales', '[data-comi]', 'form[name=\x27nuevocurso\x27]', 'Indique\x20nivel', 'Elija\x20género', 'darsedebaja', '#timeError', 'target', 'email', '#nclass', '#module', 'passeguro', 'Tiene\x20que\x20ser\x20mayor\x20que\x20cero', '#time', 'data-comc', 'level', '#cambiaanio', 'toggleClass', 'submit', 'category', '[data-comc]', 'type', 'sueldos.php', '&nbsp;<span\x20class=\x22font-secondary\x20like\x20text-lowercase\x22>&nbsp;', '#subbtn', 'Documento\x20de\x20identidad', '#wdescriptionError', '#newError', 'event', '\x22\x20required\x20type=\x22text\x22><input\x20autocomplete=\x22off\x22\x20class=\x22form-control\x20ml-2\x22\x20maxlength=\x222\x22\x20id=\x22nclass', 'isTime', 'src', 'getElementById', '#pasaModulo', 'Clave\x20nueva\x20otra\x20vez', '#darse', 'wdescription', 'Ingrese\x20número\x20de\x20teléfono', 'dni', 'size', 'gender', 'Ingrese\x20email\x20del\x20referido', 'log', 'error', '#platformError', 'Ingrese\x20su\x20contraseña\x20actual', 'actualizarclave', 'Indique\x20la\x20hora\x20del\x20webinar', 'platform', 'blur\x20keyup\x20change', 'readAsDataURL', '#actualizardata', 'country', 'No\x20es\x20segura', '#firstnameError', 'validate', 'sale', 'Elija\x20especialidad', 'Elige\x20plataforma\x20para\x20el\x20webinar', 'show', '#categoryError', '#subtitleError', 'lastname', 'firstname', '\x20módulo', 'Ingrese\x20nivel\x20de\x20estudios', 'parse', 'dd/mm/yyyy', 'time', '1183884XeIJKa', '#date', 'description', '1077864luliQI', 'prop', 'El\x20formato\x20de\x20hora\x20es\x20HH:mm', '#eventError', 'Indícanos\x20el\x20porque\x20de\x20ésta\x20decisión', 'trailer', 'again', 'disabled', 'Ingrese\x20un\x20email\x20válido', '#phone', '#phoneError', '412452aytSUe', '\x20módulos', '#old', 'attr', 'hide', '#aboutmesError', '#age', 'Indique\x20número\x20de\x20módulos', 'module', 'Mínimo\x205\x20caracteres', 'answer.php', 'checked', 'data-comi', '#aboutitError', 'security.php', '#trailerError', 'Contraseña\x20cambiada', 'Aviso', 'Mínimo\x208\x20caracteres', '#telephone', 'ajax', 'aboutme', '\x22\x20required\x20type=\x22text\x22></div></div>', 'Breve\x20descripción\x20del\x20curso', '.num', 'name', '#modappears', '#perfilfoto', 'prohibited', 'icon-line-eye-off', 'Ingrese\x20nombre\x20del\x20curso', '14637249SqOwDZ', '#bajaError', 'Indique\x20precio\x20de\x20oferta', 'post', 'valid', 'optional', 'phonez', 'onload', 'text', 'cursor-pointer', 'Ingrese\x20nombre\x20del\x20webinar', 'append', 'Escriba\x20un\x20número\x20válido', 'specialty', 'Ingrese\x20nombres\x20del\x20referido', 'price', 'Indique\x20la\x20edad', '#ageError', 'No\x20se\x20pudo\x20actualizar\x20la\x20información', '#specialError', '8286624qccCVh', 'reset', 'test', '#courseError', 'form[name=\x27eliminarprofe\x27]', 'fail', 'studies', 'INDESID', '#againError', '#countryError', '4qLEALy', 'keyup'];
            _0xcc7b = function() {
              return _0x28d91e;
            };
            return _0xcc7b();
          }

          function hab(_0x4df254, _0x49d0ba, _0x248c7e) {
            var _0x5b7b34 = _0x3cdd90;
            $(_0x4df254)['on'](_0x5b7b34(0x12b), _0x49d0ba, function() {
              var _0xdf725 = _0x5b7b34;
              $(_0x4df254)[_0xdf725(0x170)]() ? ($(_0x248c7e)['addClass']('cursor-not-allowed'), $(_0x248c7e)[_0xdf725(0xc0)](_0xdf725(0x175)), $(_0x248c7e)['prop'](_0xdf725(0x149), ![])) : ($(_0x248c7e)['addClass'](_0xdf725(0x175)), $(_0x248c7e)[_0xdf725(0xc0)](_0xdf725(0x18e)), $(_0x248c7e)[_0xdf725(0x143)]('disabled', !![]));
            });
          }
          hab(_0x3cdd90(0xc7), _0x3cdd90(0xe4), _0x3cdd90(0x112));

          function _0x2dd0(_0x4f1407, _0x4ba3a4) {
            var _0xcc7b4f = _0xcc7b();
            return _0x2dd0 = function(_0x2dd016, _0x48dd5f) {
              _0x2dd016 = _0x2dd016 - 0xbe;
              var _0x4623eb = _0xcc7b4f[_0x2dd016];
              return _0x4623eb;
            }, _0x2dd0(_0x4f1407, _0x4ba3a4);
          }

          function valid() {
            var _0xbb8221 = _0x3cdd90,
              _0x206870 = $(_0xbb8221(0x168))[0x0][_0xbb8221(0xd1)][0x0][_0xbb8221(0x121)],
              _0x25493b = parseInt(_0x206870 / 0xc92c0);
            if (_0x25493b > $(_0xbb8221(0x168))[_0xbb8221(0x150)](_0xbb8221(0x121))) return Swal[_0xbb8221(0xc4)](_0xbb8221(0x15e), _0xbb8221(0xe0), _0xbb8221(0x125)), ![];
          }

          function readURL(_0xfcf0f9) {
            var _0x13bb43 = _0x3cdd90;
            if (_0xfcf0f9[_0x13bb43(0xd1)] && _0xfcf0f9[_0x13bb43(0xd1)][0x0]) {
              var _0x453d9e = new FileReader();
              _0x453d9e[_0x13bb43(0x173)] = function(_0x41bf51) {
                var _0x38b47c = _0x13bb43;
                $('#profile')['attr'](_0x38b47c(0x119), _0x41bf51[_0x38b47c(0x101)][_0x38b47c(0xf3)]);
              }, _0x453d9e[_0x13bb43(0x12c)](_0xfcf0f9[_0x13bb43(0xd1)][0x0]);
            }
          }
        </script>
      <?php } ?>
      <?php include 'notify.php'; ?>
    </body>

    </html>
<?php
  } else {
    header('location:profesores.php');
  }
} else {
  header('location:index.php');
}
