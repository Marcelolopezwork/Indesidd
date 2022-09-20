<?php
if (!isset($dndtoy)) header('location:index.php');
?>
<?php /* MENÚ PROFESORES */ ?>
<div id="header-wrap">
  <div class="container">
    <div class="header-row">
      <div id="logo">
        <a href="index.php" class="py-2"><img src="img/logo-indesid.svg" alt="Logo Indesid"></a>
      </div>
      <div id="primary-menu-trigger">
        <svg class="svg-trigger" viewBox="0 0 100 100">
          <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
          <path d="m 30,50 h 40"></path>
          <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
        </svg>
      </div>
      <?php if (isset($_SESSION['cod'])) { ?>
        <div class="header-misc">
          <?php /* Salir */ ?>
          <div id="top-logout" class="d-flex header-misc-icon">
            <span class="d-none d-md-block small mr-2"><?php echo $_SESSION['nom']; ?></span>
            <a href="salir.php"><i class="icon-line-log-out"></i></a>
          </div>
        </div>
      <?php } ?>
      <nav class="primary-menu">
        <ul class="menu-container">
          <li class="d-none d-lg-block menu-item">
            <button class="button button-rounded button-mini button-light button-white" onclick="window.location.href='cursos.php';"><i class="icon-line-paper-stack"></i><span>CURSOS</span></button>
          </li>
          <?php /* Responsive */ ?>
          <li class="d-flex justify-content-start d-lg-none menu-item">
            <a class="responsive" href="cursos.php"><i class="icon-line-paper-stack pr-2"></i><span>CURSOS</span></a>
          </li>
          <?php
          if (!isset($_SESSION['cod'])) {
            if ($pro) {
          ?>
              <li class="d-none d-lg-block menu-item">
                <button class="button button-rounded button-mini button-aqua"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
              </li>
              <?php /* Responsive */ ?>
              <li class="d-flex justify-content-start d-lg-none menu-item">
                <div class="responsive"><i class="icon-line-shield pr-2"></i><span>PROFESORES</span></div>
              </li>
            <?php
            } else {
            ?>
              <li class="d-none d-lg-block menu-item">
                <button class="button button-rounded button-mini button-aqua" onclick="window.location.href='profesores.php'"><i class="icon-line-shield"></i><span>PROFESORES</span></button>
              </li>
              <?php /* Responsive */ ?>
              <li class="d-flex justify-content-start d-lg-none menu-item">
                <a class="responsive" href="profesores.php"><i class="icon-line-shield pr-2"></i><span>PROFESORES</span></a>
              </li>
          <?php
            }
          }
          ?>
          <?php if (!isset($_SESSION['cod'])) { ?>
            <li class="d-none d-lg-block menu-item">
              <button class="button button-border button-rounded button-mini button-aqua" onclick="window.location.href='registro-pro.php'"><i class="icon-line-user-plus"></i><span>POSTULATE</span></a>
            </li>
            <li class="d-none d-lg-block menu-item">
              <button class="button button-border button-rounded button-mini button-aqua" onclick="window.location.href='ingreso-pro.php'"><i class="icon-line-log-in"></i><span>INICIA SESION</span></button>
            </li>
            <?php /* Responsive */ ?>
            <li class="d-flex justify-content-start d-lg-none menu-item">
              <a class="responsive" href="registro-pro.php"><i class="icon-line-user-plus pr-2"></i><span>POSTULATE</span></a>
            </li>
            <li class="d-flex justify-content-start d-lg-none menu-item mb-3">
              <a class="responsive" href="ingreso-pro.php"><i class="icon-line-log-in pr-2"></i><span>INICIA SESION</span></a>
            </li>
          <?php } ?>
          <?php if (isset($_SESSION['cod'])) { ?>
            <li class="d-none d-lg-block menu-item">
              <button class="button button-border button-rounded button-mini button-light" onclick="window.location.href='perfil-pro.php'"><i class="icon-line-user-check"></i><span>MI PERFIL</span></button>
            </li>
            <?php /* Responsive */ ?>
            <li class="d-flex justify-content-start d-lg-none menu-item">
              <a class="responsive" href="perfil-pro.php"><i class="icon-line-user-check pr-2"></i><span>MI PERFIL</span></a>
            </li>
          <?php } ?>
      </nav>
    </div>
  </div>
</div>
<div class="header-wrap-clone"></div>