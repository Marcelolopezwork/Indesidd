<?php
if (!isset($dndtoy)) header('location:index.php');
if (!isset($carro)) $carro = [];
if (isset($_SESSION['carro'])) $carro = $_SESSION['carro'];
?>
<?php /* MENÚ */ ?>
<div id="header-wrap" class="header-size-sm">
  <div class="container">
    <div class="header-row">
      <div id="logo">
        <a href="index.php"><img src="img/logo-indesid.svg" alt="Logo Indesid"></a>
      </div>
      <div id="primary-menu-trigger">
        <svg class="svg-trigger" viewBox="0 0 100 100">
          <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
          <path d="m 30,50 h 40"></path>
          <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
        </svg>
      </div>
      <?php
      if (isset($_SESSION['cod'])) {
        if ($_SESSION['xta'] == 'A') {
      ?>
          <?php /* Inicio, salir, buscar y carrito */ ?>
          <div class="header-misc">
            <?php /* Salir */ ?>
            <div id="top-logout" class="d-flex header-misc-icon">
              <span class="d-none d-lg-block small mr-2"><?php echo $_SESSION['nom']; ?></span>
              <a href="salir.php" title="Cerrar sesión"><i class="icon-line-log-out"></i></a>
            </div>
            <?php /* Carrito */ ?>
            <?php if ($_SESSION['tip'] == 'U') { ?>
              <div id="top-cart" class="d-none d-lg-block header-misc-icon">
                <a href="#" id="top-cart-trigger" title="Carrito de compras">
                  <i class="icon-line-shopping-cart"></i>
                  <?php if (count($carro) > 0) { ?>
                    <span class="top-cart-number"><?php echo count($carro); ?></span>
                  <?php } ?>
                </a>
                <div class="top-cart-content">
                  <div class="top-cart-title">
                    <h4 class="text-center">Carrito de compras</h4>
                  </div>
                  <?php
                  if (!empty($carro)) {
                    foreach ($carro as $v) {
                  ?>
                      <div class="top-cart-items">
                        <div class="top-cart-item">
                          <div class="top-cart-item-image">
                            <a href="<?php echo ($v['slug']) . '/' . ($v['newid']); ?>">
                              <img src="<?php echo 'img/cursos/' . $v['imagen']; ?>" alt="<?php echo $v['curso']; ?>">
                            </a>
                          </div>
                          <div class="top-cart-item-desc">
                            <div class="top-cart-item-desc-title">
                              <p class="small my-0"><?php echo $v['curso']; ?></p>
                              <span class="top-cart-item-price d-block"><?php echo $moneda . $v['precio']; ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                    <div class="top-cart-action">
                      <span class="top-checkout-price">
                        <span class="top-cart-item-price">Total</span><br>
                        <?php
                        $sum = 0;
                        foreach ($carro as $item) $sum += $item['precio'];
                        echo $moneda . " " . number_format($sum, 2);
                        ?>
                      </span>
                      <a href="compra.php" class="button button-small button-light m-0">Ver carrito</a>
                    </div>
                  <?php
                  } else { ?>
                    <div class="top-cart-items">
                      <h6 class="text-center">No hay items en el carrito</h6>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
            <?php } ?>
          </div>
      <?php
        }
      }
      ?>
      <nav class="primary-menu">
        <ul class="menu-container">
          <li class="d-none d-lg-block menu-item">
            <?php
            if ($dndtoy == 1) {
            ?>
              <button class="button button-light button-mini button-rounded"><i class="icon-line-paper-stack"></i><span>CURSOS</span></button>
            <?php
            } else {
            ?>
              <button class="button button-light button-mini button-rounded" onclick="window.location.href='cursos.php';"><i class="icon-line-paper-stack"></i><span>CURSOS</span></button>
            <?php
            }
            ?>
          </li>
          <?php /* Responsive */ ?>
          <li class="d-flex justify-content-start d-lg-none menu-item">
            <?php
            if ($dndtoy == 1) {
            ?>
              <div class="responsive"><i class="icon-line-paper-stack pr-2"></i><span>CURSOS</span></div>
            <?php
            } else {
            ?>
              <a class="responsive" href="cursos.php"><i class="icon-line-paper-stack pr-2"></i><span>CURSOS</span></a>
            <?php
            }
            ?>
          </li>
          <?php
          if (isset($_SESSION['cod'])) {
            if (($_SESSION['xta'] == 'A') && ($_SESSION['tip'] == 'P')) {
          ?>
              <li class="d-none d-lg-block menu-item">
                <button class="button button-border button-border-thin button-light button-mini button-rounded" onclick="window.location.href='perfil-pro.php';"><i class="icon-line-user-check"></i><span>MI PERFIL</span></button>
              </li>
              <?php /* Responsive */ ?>
              <li class="d-flex justify-content-start d-lg-none menu-item">
                <a class="responsive" href="perfil-pro.php"><i class="icon-line-user-check pr-2"></i><span>MI PERFIL</span></a>
              </li>
            <?php
            } else {
            ?>
              <li class="d-none d-lg-block menu-item">
                <?php
                if ($pro) {
                ?>
                  <button class="button button-aqua button-mini button-rounded"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
                <?php
                } else {
                ?>
                  <button class="button button-aqua button-mini button-rounded" onclick="window.location.href='profesores.php';"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
                <?php
                }
                ?>
              </li>
              <?php /* Responsive */ ?>
              <li class="d-flex justify-content-start d-lg-none menu-item">
                <?php
                if ($pro) {
                ?>
                  <div class="responsive"><i class="icon-line-shield pr-2"></i><span>PROFESORES</span></div>
                <?php
                } else {
                ?>
                  <a class="responsive" href="profesores.php"><i class="icon-line-shield pr-2"></i><span>PROFESORES</span></a>
                <?php
                }
                ?>
              </li>
            <?php
            }
          } else {
            ?>
            <li class="d-none d-lg-block menu-item">
              <button class="button button-aqua button-mini button-rounded" onclick="window.location.href='profesores.php';"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
            </li>
            <?php /* Responsive */ ?>
            <li class="d-flex justify-content-start d-lg-none menu-item">
              <a class="responsive" href="profesores.php"><i class="icon-line-shield pr-2"></i><span>PROFESORES</span></a>
            </li>
          <?php
          }
          ?>
          <?php if (!isset($_SESSION['cod'])) { ?>
            <li class="d-none d-lg-block menu-item">
              <button class="button button-border button-border-thin button-rounded button-mini button-light" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>REGISTRATE</span></button>
            </li>
            <li class="d-none d-lg-block menu-item">
              <button class="button button-border button-border-thin button-rounded button-mini button-light" onclick="window.location.href='ingreso.php';"><i class="icon-line-log-in"></i><span>INICIA SESION</span></button>
            </li>
            <?php /* Responsive */ ?>
            <li class="d-flex justify-content-start d-lg-none menu-item">
              <a class="responsive" href="registro.php"><i class="icon-line-user-plus pr-2"></i><span>REGISTRATE</span></a>
            </li>
            <li class="d-flex justify-content-start d-lg-none menu-item mb-3">
              <a class="responsive" href="ingreso.php"><i class="icon-line-log-in pr-2"></i><span>INICIA SESION</span></a>
            </li>
          <?php } ?>
          <?php
          if (isset($_SESSION['cod'])) {
            if (($_SESSION['xta'] == 'A') && ($_SESSION['tip'] == 'U')) {
          ?>
              <li class="d-none d-lg-block menu-item">
                <button class="button button-border button-border-thin button-rounded button-mini button-light button-white" onclick="window.location.href='perfil.php';"><i class="icon-line-user-check"></i><span>MI PERFIL</span></button>
              </li>
              <?php /* Responsive */ ?>
              <li class="d-flex justify-content-start d-lg-none menu-item mb-3">
                <a class="responsive" href="perfil.php"><i class="icon-line-user-check pr-2"></i><span>MI PERFIL</span></a>
              </li>
          <?php
            }
          }
          ?>
          <?php if ($buscador) { ?>
            <li class="d-none d-lg-block menu-item">
              <div class="form-search">
                <form action="search.php" name="searchfind" method="post" class="form-inline">
                  <input autocomplete="off" class="bg-light form-control form-control-sm search" type="search" placeholder="Buscar cursos" minlength="3" required id="busqueda" name="busqueda" aria-label="Buscar">
                  <button class="button button-black button-rounded button-mini button-search" type="submit"><i class="icon-line-search mr-0"></i></button>
                </form>
              </div>
            </li>
            <?php /* Responsive */ ?>
            <li class="d-flex justify-content-center d-lg-none menu-item">
              <div class="d-flex justify-content-center">
                <form action="search.php" name="searchfind" method="post" class="form-inline mb-3">
                  <div class="col-10 px-0">
                    <input autocomplete="off" class="bg-light form-control form-control-sm" type="text" placeholder="Buscar..." minlength="3" required name="busqueda" aria-label="Buscar">
                  </div>
                  <div class="col-2 px-0">
                    <button class="button button-black button-rounded button-mini" type="submit"><i class="icon-line-search mr-0"></i></button>
                  </div>
                </form>
              </div>
            </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
<div class="header-wrap-clone"></div>