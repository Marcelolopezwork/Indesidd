<?php
//PIE DE PÁGINA
if (!isset($dndtoy)) header('location:index.php');
?>
<?php /* PIE DE PÁGINA */ ?>
<footer id="footer" class="dark">
  <div class="container">
    <div class="footer-widgets-wrap">
      <div class="row col-mb-30">
        <?php /* COLUMNA IZQUIERDA */ ?>
        <div class="col-12 col-lg-8">
          <div class="row">
            <?php /* LOGOTIPO INDESID */ ?>
            <div class="col-md-4 mb-2">
              <div class="widget clearfix">
                <a href="index.php"><img src="img/logo-indesid-footer.svg" alt="Indesid" class="footer-logo"></a>
              </div>
            </div>
            <?php /* CATEGORÍAS */ ?>
            <div class="col-md-4 d-flex justify-content-center mb-2">
              <div class="widget clearfix">
                <h4 class="mb-1 ml-n3 text-secondary">Especialidades</h4>
                <ul>
                  <?php
                  $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE estado = 'A' ORDER BY id ";
                  $csl = $mysqli->query($cry);
                  while ($cate = $csl->fetch_assoc()) {
                    $ase = "SELECT * FROM " . odo_DATA_CURS . " WHERE (categoriaid = '" . $cate['id'] . "' AND publicado = 'S' AND venta = 'S' AND estado = 'A') ORDER BY id ";
                    $asr = $mysqli->query($ase);
                    $ner = $asr->num_rows;
                    if ((!is_null($ner)) && ($ner > 0)) {
                  ?>
                      <li><button class="bg-transparent border-0 ml-n1 text-left" onclick="window.location.href='categories.php?sid=<?php echo $cate['slug']; ?>';"><span class="link-footer"><?php echo $cate['categoria']; ?></span></button></li>
                    <?php
                    } else {
                    ?>
                      <li><span class="link-footer"><?php echo $cate['categoria']; ?></span></li>
                  <?php
                    }
                  }
                  ?>
                </ul>
              </div>
            </div>
            <?php /* NUEVOS CURSOS */ ?>
            <div class="col-md-4 d-flex justify-content-center mb-2">
              <div class="widget clearfix">
                <?php
                $kry = "SELECT * FROM " . odo_DATA_CURS . " WHERE (estado = 'A' AND publicado = 'S' AND venta = 'S') ORDER BY fecha DESC LIMIT 3";
                $ksl = $mysqli->query($kry);
                $kne = $ksl->num_rows;
                if ((!is_null($kne)) && ($kne > 0)) {
                ?>
                  <h4 class="mb-1 ml-n3 text-secondary">Nuevos cursos</h4>
                  <ul>
                    <?php
                    while ($kurs = $ksl->fetch_assoc()) {
                      $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE (id = '" . $kurs['categoriaid'] . "' AND estado = 'A') ORDER BY id ";
                      $csl = $mysqli->query($cry);
                      $cate = $csl->fetch_assoc();
                    ?>
                      <li>
                        <div class="cate"><?php echo $cate['categoria']; ?></div>
                        <div class="ml-1 mb-3 small"><button class="bg-transparent border-0 ml-n2 text-left text-white" onclick="window.location.href='detalle.php?pid=<?php echo $kurs['id']; ?>&sid=<?php echo $kurs['slug']; ?>';"><span class="link-footer"><?php echo $kurs['curso']; ?></span></button></div>
                      </li>
                    <?php
                    }
                    ?>
                  </ul>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <?php /* COLUMNA DERECHA */ ?>
        <div class="col-12 col-lg-4">
          <?php /* BOTONES ACCESO DIRECTO */ ?>
          <div class="col-12">
            <?php
            if (!isset($_SESSION['cod'])) {
            ?>
              <div class="widget clearfix mb-4">
                <div class="row">
                  <?php if ($pro) { ?>
                    <div class="col-12 text-center">
                      <h5 class="mb-0 text-uppercase">Si quieres ser profesor</h5>
                      <button class="button button-aqua button-rounded button-small" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i>POSTULATE</button>
                    </div>
                  <?php } elseif ($both) { ?>
                    <div class="col-6 text-center">
                      <button class="button button-aqua button-rounded button-small" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i>POSTULATE</button>
                    </div>
                    <div class="col-6 text-center">
                      <button class="button button-blue button-rounded button-small" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>REGISTRATE</span></button>
                    </div>
                  <?php } else { ?>
                    <div class="col-12 text-center">
                      <h5 class="mb-0 text-uppercase">Inscríbete como alumno</h5>
                      <button class="button button-blue button-rounded button-small" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>REGISTRATE</span></button>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
          <?php /* MÉTODOS DE PAGO */ ?>
          <div class="col-12">
            <div class="font-primary text-center text-uppercase text-white small">Métodos de pago</div>
            <div class="clearfix">
              <div class="d-flex justify-content-center row my-2">
                <div class="text-center">
                  <img src="img/visa.svg?i=<?php echo micro(); ?>" alt="Visa">
                </div>
                <div class="text-center">
                  <img src="img/mastercard.svg?i=<?php echo micro(); ?>" alt="Mastercard">
                </div>
              </div>
              <div class="d-flex justify-content-center mb-2 row">
                <img src="img/paypal.svg?i=<?php echo micro(); ?>" alt="PayPal">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="copyrights">
    <div class="container">
      <div class="d-flex row col-mb-30">
        <div class="col-md-4 text-center text-md-left">
          <div>&copy;<?php echo $year; ?> Todos los derechos reservados por INDESID</div>
          <div class="copyright-links"><a href="terms.php">Términos y Condiciones</a></div>
          <div class="copyright-links"><a href="privacy.php">Política de Privacidad</a></div>
          <div class="copyright-links"><a href="devolutions.php">Política de Devoluciones</a></div>
        </div>
        <div class="align-items-end col-md-4 d-flex text-center">
          <h6 class="mb-1 mx-auto">POWERED BY <a class="text-info" href="https://thepublisherlab.com/" target="blank">the publisher lab</a></h6>
        </div>
        <div class="col-md-4 text-center text-md-right">
          <div class="d-flex justify-content-center justify-content-md-end">
            <a href="#" class="facebook mx-1">
              <svg width="32" height="32" class="fb" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="16" />
                <path d="M20.624 6.004L18.225 6c-2.695 0-4.436 1.933-4.436 4.922v2.27h-2.412c-.208 0-.377.182-.377.408v3.288c0 .225.169.407.377.407h2.412v8.297c0 .226.168.408.377.408h3.146c.21 0 .377-.183.377-.407v-8.298h2.82c.209 0 .378-.182.378-.407V13.6a.427.427 0 00-.11-.29.364.364 0 00-.267-.119h-2.82v-1.923c0-.925.203-1.394 1.317-1.394h1.616c.208 0 .377-.184.377-.409V6.412c0-.224-.168-.407-.376-.408z" fill="#ccc" />
              </svg>
            </a>
            <a href="#" class="instagram mx-1">
              <svg width="32" height="32" class="ig" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="16" />
                <path d="M15.996 7.16c-1.327 0-2.656-.006-3.984.004a5.294 5.294 0 00-1.033.096c-2.276.477-3.806 2.382-3.813 4.744-.007 2.666-.005 5.332.003 7.997 0 .338.026.682.094 1.012.472 2.282 2.38 3.82 4.756 3.828 2.648.008 5.296.003 7.945.001.663 0 1.312-.096 1.918-.372 1.984-.903 2.927-2.491 2.947-4.633.026-2.597.008-5.195.004-7.793 0-.27-.011-.545-.055-.812-.4-2.43-2.335-4.07-4.798-4.072h-3.984zm0 18.834c-1.39 0-2.778.015-4.166-.002a5.876 5.876 0 01-5.816-5.847 611.732 611.732 0 010-8.291 5.878 5.878 0 015.884-5.849c2.724-.007 5.448-.006 8.172 0 3.241.01 5.875 2.59 5.91 5.834.03 2.823.025 5.648-.003 8.472-.026 2.693-2.155 5.146-4.805 5.582a8.118 8.118 0 01-1.238.099c-1.313.012-2.626.005-3.939.005v-.003z" fill="#ccc" />
                <path d="M19.706 16.006c.005-2.056-1.65-3.736-3.688-3.743a3.739 3.739 0 00-3.753 3.73 3.74 3.74 0 003.718 3.742c2.05.007 3.718-1.663 3.723-3.73zm-3.697 4.889c-2.673.014-4.875-2.175-4.9-4.872-.024-2.684 2.172-4.899 4.875-4.918 2.652-.02 4.871 2.19 4.882 4.862.011 2.714-2.157 4.914-4.857 4.928zM21.418 11.586c.823.01 1.43-.55 1.448-1.335.018-.772-.62-1.428-1.413-1.453-.763-.024-1.45.645-1.452 1.411-.001.771.612 1.367 1.417 1.377z" fill="#ccc" />
              </svg>
            </a>
            <a href="#" class="twitter mx-1">
              <svg width="32" height="32" class="tw" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="16" />
                <path d="M26 9.895a8.63 8.63 0 01-2.362.636 4.027 4.027 0 001.803-2.23 8.296 8.296 0 01-2.6.977A4.137 4.137 0 0019.846 8c-2.27 0-4.097 1.815-4.097 4.039 0 .32.027.627.095.92a11.668 11.668 0 01-8.452-4.223 4.018 4.018 0 00-.56 2.041c0 1.398.73 2.638 1.82 3.355a4.102 4.102 0 01-1.852-.498v.045c0 1.961 1.422 3.591 3.285 3.967a4.15 4.15 0 01-1.075.133c-.262 0-.527-.015-.776-.069a4.131 4.131 0 003.831 2.812 8.322 8.322 0 01-5.083 1.722A7.82 7.82 0 016 22.189 11.673 11.673 0 0012.29 24c7.545 0 11.67-6.154 11.67-11.488 0-.178-.007-.35-.015-.522A8.101 8.101 0 0026 9.895z" fill="#ccc" />
              </svg>
            </a>
          </div>
          <div class="mt-2">
            <?php
            $row = [];
            $kry = "SELECT descripcion FROM " . odo_DATA_INTE . " WHERE (tipo = 'footer' AND pagina = 'all' AND estado = 'A') ORDER BY posicion";
            $ksl = $mysqli->query($kry);
            while ($foot = $ksl->fetch_assoc()) {
              array_push($row, $foot['descripcion']);
            }
            ?>
            <i class="icon-line-mail"></i> <?php echo $row[0]; ?>
            <i class="icon-line-phone"></i> <?php echo $row[1]; ?><br>
            <i class="icon-line-map-pin"></i> <?php echo $row[2]; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>