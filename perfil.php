<?php
//PERFIL DEL ALUMNO
require 'cfg.inc.php';
if (isset($_SESSION['cod'])) {
  if ($_SESSION['tip'] == 'U') {
    if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
    if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
    if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
    $dndtoy = 12;

    $numeric = true;
    $select = true;

    include 'header.php';
    $qry = "SELECT *, CONCAT(nombres, ' ', apellidos) AS quien FROM " . odo_DATA_USUA . " WHERE id='" . $_SESSION['cod'] . "' AND tipo = 'U' AND estado = 'A' ";
    $rsl = $mysqli->query($qry);
    $existe = $rsl->num_rows;
    if ($existe == 1) {
      $dat = $rsl->fetch_assoc();
      $date = date_create($dat['fecha']);
      $fecha = date_format($date, 'd M Y');
?>
      <style>
        .list-group-item.active {
          background-color: #2e1180 !important;
          border-color: #2e1180 !important;
        }
      </style>

      <body class="stretched">
        <div id="wrapper" class="clearfix">
          <?php /* MENÚ */ ?>
          <header id="header" class="full-header dark">
            <?php include 'menu.php'; ?>
          </header>
          <?php /* BIENVENIDA ALUMNO */ ?>
          <div class="container clearfix topmargin-sm">
            <div class="d-flex">
              <div class="testi-image">
                <div id="imgContainer">
                  <div id="imgArea">
                    <?php if ($dat['foto'] == null) { ?>
                      <img class="img-thumbnail" src="img/usuarios/nofoto.svg" alt="">
                    <?php } else { ?>
                      <img class="img-thumbnail" src="img/usuarios/<?php echo $dat['foto']; ?>?i=<?php echo micro(); ?>" alt="">
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="title-block">
                <?php if ($dat['genero'] == 'M') $bienven = "Bienvenido";
                else $bienven = "Bienvenida"; ?>
                <h3><?php echo $bienven . ' ' . $dat['nombres']; ?></h3>
                <?php if ($dat['estado'] == 'A') { ?>
                  <span class="small">Gracias por ser parte de la comunidad</span>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php /* CONTENIDO */ ?>
          <section id="content" class="bg-light py-4">
            <div class="container clearfix">
              <div class="row">
                <div class="col-12 col-md-3">
                  <div class="list-group list-group-flush mb-4" id="list-tab" role="tablist">
                    <a class="font-primary list-group-item list-group-item-action active" data-toggle="list" href="#mis-cursos" role="tab" aria-controls="activo">Mis cursos</a>
                    <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#ajustar-perfil" role="tab" aria-controls="perfil">Mi perfil</a>
                    <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#fotografias" role="tab" aria-controls="fotografia">Fotografía</a>
                    <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#certificados" role="tab" aria-controls="pago">Certificados</a>
                    <a class="font-primary list-group-item list-group-item-action" data-toggle="list" href="#cupones" role="tab" aria-controls="cupon">Cupones</a>
                  </div>
                </div>
                <div class="col-12 col-md-9">
                  <div class="tab-content" id="nav-tabContent">
                    <?php /* MIS CURSOS */ ?>
                    <div class="tab-pane min-h-pagos fade show active" id="mis-cursos" role="tabpanel" aria-labelledby="cursos">
                      <?php /* CURSOS COMPRADOS */ ?>
                      <h3 class="mb-2">Mis cursos</h3>
                      <?php
                      $aly = "SELECT * FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND estado = 'A' ORDER BY fecha DESC";
                      $asl = $mysqli->query($aly);
                      $cua = $asl->num_rows;
                      if ($cua > 0) {
                        $alumcurso = [];
                        $alummarca = [];
                        while ($alm = $asl->fetch_assoc()) {
                          array_push($alumcurso, $alm['cursoid']);
                          array_push($alummarca, $alm['marca']);
                        }
                        for ($a = 0; $a < count($alumcurso); $a++) {
                          //$amy = "SELECT * FROM " . odo_DATA_CURS . " WHERE id = '" . $alumcurso[$a] . "' AND estado = 'A' ORDER BY id";
                          $amy = "SELECT * FROM " . odo_DATA_CURS . " WHERE id = '" . $alumcurso[$a] . "' ORDER BY id";
                          $azl = $mysqli->query($amy);
                          while ($kour = $azl->fetch_assoc()) {
                            $cate = "SELECT categoria AS categat, slug FROM " . odo_DATA_CATE . " WHERE id = '" . $kour['categoriaid'] . "' AND estado = 'A' ORDER BY id";
                            $czl = $mysqli->query($cate);
                            $cat = $czl->fetch_assoc();
                      ?>
                            <div class="entry event mb-4 shadow">
                              <div class="align-items-start bg-white grid-inner no-gutters pb-3 px-4 pt-4 row">
                                <div class="entry-image col-md-5 mb-md-0">
                                  <img class="border" src="img/cursos/<?php echo $kour['imagen']; ?>" alt="<?php echo $kour['curso']; ?>">
                                </div>
                                <div class="col-md-7 pl-md-4">
                                  <div class="bg-white d-flex flex-column justify-content-center entry-title min-h-curso title-xs">
                                    <div class="mt-1">
                                      <h3 class="mb-0"><a href="#"><?php echo $kour['curso']; ?></a></h3>
                                      <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><a href="#!" class="categorias"><span class="small"><?php echo $cat['categat']; ?></span></a></p>
                                      <?php /*Nombre del curso, Profesor y cantidad de likes*/ ?>
                                      <?php
                                      $pry = "SELECT CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE (id = '" . $kour['profesorid'] . "')";
                                      $psl = $mysqli->query($pry);
                                      $prf = $psl->fetch_assoc()
                                      ?>
                                      <div class="py-1">
                                        <p class="font-weight-bold my-0 teacher"><i class="icon-line-shield"></i> <?php echo mb_convert_case($prf['profe'], MB_CASE_TITLE, 'utf-8'); ?></p>
                                        <?php if (($kour['megusta'] < 1) || (is_null($kour['megusta']))) { ?>
                                          <p class="d-flex align-items-center my-0 small"><i class="icon-line-sun mr-1"></i> Curso nuevo</p>
                                        <?php } else { ?>
                                          <p class="d-flex align-items-center my-0 small"><i class="icon-line-heart mr-1"></i> <?php echo $kour['megusta']; ?> me gusta</p>
                                        <?php } ?>
                                        <?php /*Precios*/ ?>
                                        <div class="d-flex">
                                          <?php
                                          $try = "SELECT * FROM " . odo_DATA_TRAN . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND cursoid = '" . $alumcurso[$a] . "' AND estado = 'A' ";
                                          $tsl = $mysqli->query($try);
                                          $price = $tsl->fetch_assoc()
                                          ?>
                                          <p class="mb-1 small"><i class="icon-line-shopping-cart mr-1"></i><?php echo $moneda; ?><?php echo $price['monto']; ?></p>
                                        </div>
                                      </div>
                                    </div>
                                    <?php /*Ver curso*/ ?>
                                    <div class="d-flex justify-content-center pt-1">
                                      <button class="button button-aqua button-small button-rounded w-50" onclick="window.location.href='clase.php?pid=<?php echo $alumcurso[$a]; ?>&qid=<?php echo $alummarca[$a]; ?>&sid=<?php echo uri($kour['curso']); ?>';"><i class="icon-line-arrow-right"></i><span>Ir al curso</span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php
                          }
                        }
                        ?>
                      <?php
                      } else {
                      ?>
                        <p>Aún no te has inscrito en ningún curso.</p>
                      <?php
                      }
                      ?>
                    </div>
                    <?php /* PERFIL DEL ALUMNO */ ?>
                    <div class="tab-pane min-h-pagos fade show" id="ajustar-perfil" role="tabpanel" aria-labelledby="perfiles">
                      <?php /* ACTUALIZAR DATOS */ ?>
                      <div class="bg-white border-0 card rounded mb-4 px-4 pt-4 shadow">
                        <h3 class="mb-2">Actualizar datos</h3>
                        <form id="actualizardata" name="actualizardata" class="container row">
                          <input type="hidden" name="cookie" value="<?php echo micro(); ?>">
                          <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
                          <div class="form-group col-12 col-md-6">
                            <label for="level">Nivel de Estudios<span class="text-danger">*</span><span id="levelError"></span></label>
                            <select id="level" name="level" class="form-control selectpicker show-tick" required title="Indique nivel de estudios" tabindex="1">
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
                          <div class="form-group col-12 col-md-6">
                            <label for="phone">Teléfono<span class="text-danger">*</span><span id="phoneError"></span></label>
                            <input autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Teléfono" required type="text" tabindex="3" value="<?php echo $dat['telefono']; ?>">
                          </div>
                          <div class="form-group col-12 col-md-6">
                            <label>Email</label>
                            <div class="form-control text-blue"><?php echo $dat['correo']; ?></div>
                          </div>
                          <div class="form-group col-12 col-md-6">
                            <label>Fecha de inscripción</label>
                            <div class="form-control text-blue"><?php echo $fecha; ?></div>
                          </div>
                          <div class="col-12 text-center">
                            <button type="submit" class="button button-dark button-rounded mt-1" tabindex="4">Actualizar datos</button>
                          </div>
                        </form>
                      </div>
                      <?php /* CAMBIAR CONTRASEÑA */ ?>
                      <div class="bg-white border-0 card rounded mt-4 px-4 pt-4 shadow">
                        <h3 class="mb-0">Cambiar contraseña <i class="added icon-line-help-circle small" data-toggle="popover" data-content="La nueva contraseña debe tener por lo menos 8 caracteres, al menos un número, una letra mayúscula y por lo menos uno de estos símbolos #$%^&()={*}.,:;+-_<>!" data-trigger="click"></i></h3>
                        <p class="mb-4 mx-2 mt-0 small"><span class="text-danger">*</span>Todos los campos son obligatorios</p>
                        <form id="actualizarclave" class="container row align-items-end" role="form">
                          <input type="hidden" name="cookie" value="<?php echo sha1('cambiarcontrasena'); ?>">
                          <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
                          <div class="col-12 col-md-6 col-lg-4">
                            <label for="old" class="w-100">Clave actual <span id="oldError" class="small"></span></label>
                            <input autocomplete="off" class="form-control" id="old" minlength="5" name="old" placeholder="Contraseña antigua" required tabindex="1" type="password">
                            <i id="togg" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#togg', '#old');"></i>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4">
                            <label for="new" class="w-100">Clave nueva <span id="newError" class="small"></span></label>
                            <input autocomplete="off" class="form-control" id="new" minlength="8" name="new" placeholder="Contraseña nueva" required type="password" tabindex="2">
                            <i id="tnew" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#tnew', '#new');"></i>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4">
                            <label for="again" class="w-100">Otra vez<span id="againError" class="small"></span></label>
                            <input autocomplete="off" class="form-control" id="again" minlength="8" name="again" placeholder="Contraseña nueva otra vez" required type="password" tabindex="3" value="">
                            <i id="tagain" class="float-right icon-line-eye mx-1 position-relative show-hide-eye" onclick="muestraClave('#tagain', '#again');"></i>
                          </div>
                          <div class="col-12 col-md-6 col-lg-12 mt-n2 text-center">
                            <button class="button button-dark button-rounded cursor-not-allowed" disabled id="subbtn" role="button" tabindex="4" type="submit">Cambiar contraseña</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php /* FOTOGRAFIA */ ?>
                    <div class="tab-pane min-h-pagos fade show" id="fotografias" role="tabpanel" aria-labelledby="fotografias">
                      <?php /* Cambiar foto */ ?>
                      <h3 class="mb-2">Cambiar foto de perfil</h3>
                      <form action="upload-photo.php" id="fotoperfil" enctype="multipart/form-data" method="post" name="fotoperfil" onsubmit="return valid();">
                        <input type="hidden" name="activity" value="<?php echo sha1('alumno'); ?>">
                        <input type="hidden" name="quien" value="<?php echo $dat['quien']; ?>">
                        <div class="card py-2 mx-auto col-8 col-sm-8 col-md-5 shadow">
                          <label class="font-weight-bold pb-1 pt-2">Foto <span class="float-right small text-grey">Tamaño 250 x 250 píxeles</span></label>
                          <div class="text-center">
                            <?php if ($dat['foto'] == null) { ?>
                              <img id="profile" class="img-thumbnail" src="img/usuarios/nofoto.svg" alt="">
                            <?php } else { ?>
                              <img id="profile" class="img-thumbnail max-profile" src="img/usuarios/<?php echo $dat['foto']; ?>?i=<?php echo micro(); ?>" alt="">
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
                    <?php /* CERTIFICADOS */ ?>
                    <div class="tab-pane min-h-pagos fade show" id="certificados" role="tabpanel" aria-labelledby="certificados">
                      <?php /* Descargas */ ?>
                      <h3 class="mb-1">Descargar certificados</h3>
                      <p>Aquí podrás descargar los certificados que entrega INDESID al finalizar un curso.</p>
                      <div id="certified" class="table-responsive">
                        <table class="display table-bordered table-sm w-100 mb-3">
                          <thead>
                            <tr class="table-info small">
                              <th class="px-2 py-1 text-center">#</th>
                              <th class="p-1 small">CURSO</th>
                              <th class="p-1 small">PROFESOR</th>
                              <th class="p-1 small">FECHA</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $dry = "SELECT " . odo_DATA_ALUM . ".*, CONCAT(" . odo_DATA_PROF . ".nombres, ' ', " . odo_DATA_PROF . ".apellidos) AS maestro, " . odo_DATA_CURS . ".curso AS curso FROM " . odo_DATA_ALUM . ", " . odo_DATA_PROF . ", " . odo_DATA_CURS . " WHERE " . odo_DATA_ALUM . ".usuarioid = '" . $_SESSION['cod'] . "' AND " . odo_DATA_ALUM . ".cursoid = " . odo_DATA_CURS . ".id AND " . odo_DATA_ALUM . ".profesorid = " . odo_DATA_PROF . ".id AND " . odo_DATA_ALUM . ".certificado IS NOT NULL AND " . odo_DATA_ALUM . ".estado = 'A' ";
                            $dsl = $mysqli->query($dry);
                            $crtnull = $dsl->num_rows;
                            if ($crtnull > 0) {
                              $a = 1;
                              while ($crt = $dsl->fetch_assoc()) {
                                $fecom = date_create($crt['certificado']);
                                $fecrt = date_format($fecom, 'd-M-Y');
                            ?>
                                <tr class="small">
                                  <td class="text-center"><?php echo $a++; ?></td>
                                  <td><button class="btn p-0" onclick="window.location.href='certified.php?rid=<?php echo base64_encode($crt['id']); ?>&rus=<?php echo base64_encode($crt['curso']); ?>'"><?php echo $crt['curso']; ?> <i class="icon-line-download text-info"></i></button></td>
                                  <td><?php echo $crt['maestro']; ?></td>
                                  <td><?php echo $fecrt; ?></td>
                                </tr>
                              <?php
                              }
                            } else {
                              ?>
                              <tr class="small">
                                <td class="text-center" colspan="4">No hay certificados</td>
                              </tr>
                            <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php /* CUPONES */ ?>
                    <div class="tab-pane min-h-pagos fade show" id="cupones" role="tabpanel" aria-labelledby="cupones">
                      <?php /* Cupones de descuento */ ?>
                      <h3 class="mb-1">Cupones de descuento</h3>
                      <p><?php echo $txtdcto; ?></p>
                      <div id="coupon" class="table-responsive">
                        <table class="display table-bordered table-sm w-100 mb-3">
                          <thead>
                            <tr class="table-info small">
                              <th class="px-2 py-1 text-center">#</th>
                              <th class="p-1 small">CUPON</th>
                              <th class="p-1 small">DESCUENTO</th>
                              <th class="p-1 small">FECHA</th>
                              <th class="p-1 small">UTILIZADO</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $ery = "SELECT * FROM " . odo_DATA_DESC . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND estado = 'A' ";
                            $esl = $mysqli->query($ery);
                            $cupon = $esl->num_rows;
                            if ($cupon > 0) {
                              $a = 1;
                              while ($ert = $esl->fetch_assoc()) {
                                if (is_null($ert['fechauso'])) {
                                  $mesa = '<span class="text-success">Disponible</span>';
                                } else {
                                  $ecom = date_create($ert['fechauso']);
                                  $ecrt = date_format($ecom, 'd-M-Y');
                                  $mesa = $ecrt;
                                }
                            ?>
                                <tr class="small">
                                  <td class="text-center"><?php echo $a++; ?></td>
                                  <td class="px-1"><?php echo substr($ert['codigo'], '0', '6') . "..."; ?></td>
                                  <td class="px-1"><?php echo $ert['descuento']; ?>%</td>
                                  <td class="px-1"><?php echo $mesa; ?></td>
                                  <td class="px-1 small">
                                    <?php
                                    if (is_null($ert['utilizado'])) echo "No";
                                    if ($ert['utilizado'] == 'S') echo "Si";
                                    if ($ert['utilizado'] == 'T') echo "Se está aplicando a un curso, pero aún no se usa. Si quieres recuperarlo, quítalo del carrito de compras o cierra y renueva tu sesión de login.";
                                    ?>
                                  </td>
                                </tr>
                              <?php
                              }
                            } else {
                              ?>
                              <tr class="small">
                                <td class="text-center" colspan="5">No hay cupones</td>
                              </tr>
                            <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php /* CURSOS QUE TE PUEDEN INTERESAR */ ?>
          <?php
          $ury = "SELECT cursoid, usuarioid FROM " . odo_DATA_ALUM . " WHERE usuarioid = '" . $_SESSION['cod'] . "' AND estado = 'A' ";
          $usl = $mysqli->query($ury);
          $comprado = [];
          while ($cmp = $usl->fetch_assoc()) array_push($comprado, $cmp['cursoid']);
          asort($comprado);
          $compro = count($comprado);
          $val = '';
          foreach ($comprado as $key) $val .= $key . ', ';
          $estosno = substr_replace($val, '', -2);
          if (($estosno > 0) && (!is_null($estosno))) {
            $ury = "SELECT * FROM " . odo_DATA_CURS . " WHERE estado = 'A' AND publicado = 'S' AND venta = 'S' AND id NOT IN (" . $estosno . ") ORDER BY RAND() LIMIT 3 ";
            $usl = $mysqli->query($ury);
            $rey = $usl->num_rows;
            if (($rey > 0) && (!is_null($rey))) {
          ?>
              <section id="cursos" class="bg-dark pb-5 pt-1">
                <div class="container clearfix">
                  <div class="container clearfix topmargin">
                    <div class="heading-block center">
                      <h2 class="text-white">Cursos que te pueden interesar</h2>
                    </div>
                    <div id="portfolio" class="portfolio row grid-container" data-layout="fitRows">
                      <?php
                      while ($qour = $usl->fetch_assoc()) {
                        $wry = "SELECT " . odo_DATA_CURS . ".*, " . odo_DATA_CATE . ".categoria AS cate FROM " . odo_DATA_CURS . ", " . odo_DATA_CATE . " WHERE " . odo_DATA_CURS . ".categoriaid = " . odo_DATA_CATE . ".id AND " . odo_DATA_CURS . ".id = '" . $qour['id'] . "' ";
                        $wsl = $mysqli->query($wry);
                        $cour = $wsl->fetch_assoc();
                      ?>
                        <article class="portfolio-item col-lg-4 col-md-6 col-12">
                          <div class="grid-inner mb-5 shadow">
                            <?php /*Video*/ ?>
                            <div class="portfolio-image">
                              <div class="max-photo">
                                <img src="img/cursos/<?php echo $cour['imagen']; ?>" alt="Video">
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
                                  <p class="my-0 text-aqua"><i class="icon-line-copy mr-1"></i><span class="small"><?php echo $cour['cate']; ?></span></p>
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
                              ?>
                                  <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span>VER MAS</span></button>
                                <?php
                                } else {
                                ?>
                                  <button class="button button-dark button-small button-rounded mx-4 w-100" onclick="window.location.href='detalle.php?pid=<?php echo $cour['id']; ?>&sid=<?php echo $cour['slug']; ?>';"><i class="icon-line-search"></i><span><?php echo $txtBtn; ?></span></button>
                              <?php
                                }
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
                </div>
              </section>
          <?php
            }
          }
          ?>
          <?php include 'footer.php'; ?>
        </div>
        <div id="gotoTop" class="icon-line-chevron-up"></div>
        <?php require 'scripts.php'; ?>
        <script>
          var _0x162251 = _0x4d66;
          (function(_0x48ac9a, _0x3ae8ba) {
            var _0xdd9ac5 = _0x4d66,
              _0x25c35d = _0x48ac9a();
            while (!![]) {
              try {
                var _0x4a4c7c = parseInt(_0xdd9ac5(0x9b)) / 0x1 * (parseInt(_0xdd9ac5(0x96)) / 0x2) + parseInt(_0xdd9ac5(0x9d)) / 0x3 + -parseInt(_0xdd9ac5(0x7f)) / 0x4 + -parseInt(_0xdd9ac5(0x8b)) / 0x5 * (-parseInt(_0xdd9ac5(0x97)) / 0x6) + -parseInt(_0xdd9ac5(0xb5)) / 0x7 + parseInt(_0xdd9ac5(0x81)) / 0x8 * (parseInt(_0xdd9ac5(0x90)) / 0x9) + -parseInt(_0xdd9ac5(0xa9)) / 0xa;
                if (_0x4a4c7c === _0x3ae8ba) break;
                else _0x25c35d['push'](_0x25c35d['shift']());
              } catch (_0x25c6a1) {
                _0x25c35d['push'](_0x25c35d['shift']());
              }
            }
          }(_0x41c9, 0x765aa), $(_0x162251(0xac))[_0x162251(0x99)](), $('#perfilfoto')['on'](_0x162251(0x9c), function() {
            var _0x443f71 = _0x162251;
            readURL(this), $(_0x443f71(0x94))['text']($(this)['get'](0x0)['files'][_0x443f71(0x73)](0x0)[_0x443f71(0x76)]);
          }), $(function() {
            var _0x41d51b = _0x162251;
            $(_0x41d51b(0x72))[_0x41d51b(0x82)]({
              'rules': {
                'level': {
                  'required': !![]
                },
                'phone': {
                  'required': !![],
                  'minlength': 0x6
                }
              },
              'messages': {
                'level': {
                  'required': _0x41d51b(0x85)
                },
                'phone': {
                  'required': _0x41d51b(0xb8),
                  'minlength': _0x41d51b(0x7e)
                }
              },
              'errorPlacement': function(_0x5f4ca8, _0x5b12c8) {
                var _0x4445d5 = _0x41d51b;
                if (_0x5b12c8[_0x4445d5(0x93)](_0x4445d5(0x76)) == 'level') _0x5f4ca8[_0x4445d5(0x71)]('#levelError');
                if (_0x5b12c8[_0x4445d5(0x93)](_0x4445d5(0x76)) == 'phone') _0x5f4ca8[_0x4445d5(0x71)]('#phoneError');
              },
              'submitHandler': function(_0x15d13f) {
                var _0x3ddd7c = _0x41d51b;
                $[_0x3ddd7c(0x77)]({
                  'type': _0x3ddd7c(0x7b),
                  'url': _0x3ddd7c(0xba),
                  'data': $(_0x15d13f)[_0x3ddd7c(0xa8)](),
                  'success': function(_0x5ad72c) {
                    var _0x4f8855 = _0x3ddd7c;
                    const _0x2ae208 = JSON[_0x4f8855(0xb9)](_0x5ad72c);
                    if (_0x2ae208[0x0] == !![]) Toast[_0x4f8855(0x84)]({
                      'icon': _0x4f8855(0xa0),
                      'title': 'Datos\x20actualizados'
                    });
                    else Toast[_0x4f8855(0x84)]({
                      'icon': _0x4f8855(0x7d),
                      'title': _0x2ae208[0x1]
                    });
                  },
                  'error': function() {
                    var _0x111bc6 = _0x3ddd7c;
                    Toast[_0x111bc6(0x84)]({
                      'icon': 'error',
                      'title': _0x111bc6(0xa5)
                    });
                  }
                });
              }
            }), $[_0x41d51b(0xb1)]['addMethod']('passeguro', function(_0x1bb26f, _0x21fec1) {
              var _0x2ce7f8 = _0x41d51b;
              return this[_0x2ce7f8(0x9f)](_0x21fec1) || /^[a-zA-Z0-9!@#$%^&()={*};:\_\|,.<>+-]*$/i [_0x2ce7f8(0xa4)](_0x1bb26f) && /[A-Z]/ [_0x2ce7f8(0xa4)](_0x1bb26f) && /[a-z]/ ['test'](_0x1bb26f) && /\d/i [_0x2ce7f8(0xa4)](_0x1bb26f) && /[!@#$%^&()={*};:\_\|,.<>+-]/i ['test'](_0x1bb26f);
            }, _0x41d51b(0x83)), $('#actualizarclave')['on']('blur\x20keyup\x20change', _0x41d51b(0xa7), function() {
              var _0x38c8ce = _0x41d51b;
              $(_0x38c8ce(0xab))[_0x38c8ce(0x7c)]() ? ($(_0x38c8ce(0x75))[_0x38c8ce(0xbb)](_0x38c8ce(0xb0)), $(_0x38c8ce(0x75))[_0x38c8ce(0x8d)](_0x38c8ce(0x70)), $(_0x38c8ce(0x75))['prop']('disabled', ![])) : ($(_0x38c8ce(0x75))[_0x38c8ce(0xbb)]('curor-pointer'), $(_0x38c8ce(0x75))[_0x38c8ce(0x8d)]('curor-not-allowed'), $('#subbtn')[_0x38c8ce(0x74)](_0x38c8ce(0x6f), !![]));
            }), $(_0x41d51b(0xab))[_0x41d51b(0x82)]({
              'rules': {
                'old': {
                  'required': !![],
                  'minlength': 0x5,
                  'maxlength': 0xc
                },
                'new': {
                  'required': !![],
                  'minlength': 0x8,
                  'maxlength': 0xc,
                  'passeguro': !![]
                },
                'again': {
                  'required': !![],
                  'minlength': 0x8,
                  'maxlength': 0xc,
                  'passeguro': !![],
                  'equalTo': '#new'
                }
              },
              'messages': {
                'old': {
                  'required': _0x41d51b(0x86),
                  'minlength': _0x41d51b(0x80),
                  'maxlength': 'Mínimo\x2012\x20caracteres'
                },
                'new': {
                  'required': _0x41d51b(0x8a),
                  'minlength': _0x41d51b(0xa6),
                  'maxlength': 'Mínimo\x2012\x20caracteres'
                },
                'again': {
                  'required': _0x41d51b(0x8c),
                  'minlength': _0x41d51b(0xa6),
                  'maxlength': _0x41d51b(0x95),
                  'equalTo': 'Claves\x20no\x20son\x20iguales'
                }
              },
              'errorPlacement': function(_0x2e7ccd, _0x4431f6) {
                var _0x34f772 = _0x41d51b;
                if (_0x4431f6[_0x34f772(0x93)](_0x34f772(0x76)) == 'old') _0x2e7ccd[_0x34f772(0x71)](_0x34f772(0xa2));
                if (_0x4431f6[_0x34f772(0x93)](_0x34f772(0x76)) == _0x34f772(0x91)) _0x2e7ccd[_0x34f772(0x71)]('#newError');
                if (_0x4431f6[_0x34f772(0x93)](_0x34f772(0x76)) == _0x34f772(0xb2)) _0x2e7ccd[_0x34f772(0x71)](_0x34f772(0x78));
              },
              'submitHandler': function(_0xfa1f16) {
                var _0x4b600c = _0x41d51b;
                $[_0x4b600c(0x77)]({
                  'type': _0x4b600c(0x7b),
                  'url': _0x4b600c(0x98),
                  'data': $(_0xfa1f16)[_0x4b600c(0xa8)](),
                  'success': function(_0x5a3a98) {
                    var _0x4a2c18 = _0x4b600c;
                    const _0x40f4b2 = JSON['parse'](_0x5a3a98);
                    document[_0x4a2c18(0x9e)]('actualizarclave')[_0x4a2c18(0x89)](), $('#subbtn')['prop']('disabled', !![]), $(_0x4a2c18(0x8e))[_0x4a2c18(0x93)](_0x4a2c18(0xa3), 'password'), $(_0x4a2c18(0xb7))['attr'](_0x4a2c18(0xa3), _0x4a2c18(0xb4)), $(_0x4a2c18(0xa7))[_0x4a2c18(0x93)](_0x4a2c18(0xa3), _0x4a2c18(0xb4));
                    if (_0x40f4b2[0x0] == !![]) Toast['fire']({
                      'icon': _0x4a2c18(0xa1),
                      'title': 'Contraseña\x20cambiada'
                    });
                    else Toast[_0x4a2c18(0x84)]({
                      'icon': _0x4a2c18(0x7d),
                      'title': _0x40f4b2[0x1]
                    });
                  },
                  'error': function() {
                    var _0x53a812 = _0x4b600c;
                    Toast['fire']({
                      'icon': _0x53a812(0x7d),
                      'title': _0x53a812(0x88)
                    });
                  }
                });
              }
            });
          }));

          function valid() {
            var _0x325ddd = _0x162251,
              _0x4b1375 = $(_0x325ddd(0x7a))[0x0][_0x325ddd(0xaf)][0x0]['size'],
              _0x535926 = parseInt(_0x4b1375 / 0xc92c0);
            if (_0x535926 > $(_0x325ddd(0x7a))[_0x325ddd(0x93)](_0x325ddd(0xad))) return Swal[_0x325ddd(0x84)]('Aviso', _0x325ddd(0xae), 'error'), ![];
          }

          function _0x4d66(_0x52da88, _0xe40050) {
            var _0x41c9eb = _0x41c9();
            return _0x4d66 = function(_0x4d66b9, _0x24f685) {
              _0x4d66b9 = _0x4d66b9 - 0x6f;
              var _0x5b0629 = _0x41c9eb[_0x4d66b9];
              return _0x5b0629;
            }, _0x4d66(_0x52da88, _0xe40050);
          }

          function _0x41c9() {
            var _0x163786 = ['addClass', 'disabled', 'curor-pointer', 'appendTo', 'form[name=\x27actualizardata\x27]', 'item', 'prop', '#subbtn', 'name', 'ajax', '#againError', '#profile', '#perfilfoto', 'post', 'valid', 'error', 'Mínimo\x206\x20caracteres', '2042212bUngwz', 'Mínimo\x205\x20caracteres', '65360RiZhUt', 'validate', 'No\x20es\x20segura', 'fire', 'Ingrese\x20nivel\x20de\x20estudios', 'Ingrese\x20clave\x20actual', 'readAsDataURL', 'No\x20se\x20pudo\x20cambiar\x20la\x20contraseña', 'reset', 'Ingresa\x20clave\x20nueva', '24815AvnnbE', 'Clave\x20nueva\x20otra\x20vez', 'removeClass', '#old', 'target', '810lrSINn', 'new', 'result', 'attr', '#archivo', 'Máximo\x2012\x20caracteres', '4JPPDxM', '24HesIqf', 'security.php', 'numerico', 'onload', '281450ZfwIYd', 'change', '1026942bumwls', 'getElementById', 'optional', 'info', 'success', '#oldError', 'type', 'test', 'No\x20se\x20pudo\x20actualizar\x20la\x20información', 'Mínimo\x208\x20caracteres', '#again', 'serialize', '1233910moyKpr', 'icon-line-eye-off', '#actualizarclave', '#phone', 'size', 'Imagen\x20muy\x20grande.\x20Utilice\x20una\x20imagen\x20de\x204MB\x20de\x20peso\x20como\x20máximo.', 'files', 'curor-not-allowed', 'validator', 'again', 'src', 'password', '3791508IokGkS', 'toggleClass', '#new', 'Ingresa\x20tu\x20número\x20de\x20teléfono', 'parse', 'update.php'];
            _0x41c9 = function() {
              return _0x163786;
            };
            return _0x41c9();
          }

          function readURL(_0xd45575) {
            var _0x967ff5 = _0x162251;
            if (_0xd45575[_0x967ff5(0xaf)] && _0xd45575[_0x967ff5(0xaf)][0x0]) {
              var _0x39c8ec = new FileReader();
              _0x39c8ec[_0x967ff5(0x9a)] = function(_0x197e8e) {
                var _0x467477 = _0x967ff5;
                $(_0x467477(0x79))[_0x467477(0x93)](_0x467477(0xb3), _0x197e8e[_0x467477(0x8f)][_0x467477(0x92)]);
              }, _0x39c8ec[_0x967ff5(0x87)](_0xd45575[_0x967ff5(0xaf)][0x0]);
            }
          }
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
} else {
  header('location:index.php');
}
