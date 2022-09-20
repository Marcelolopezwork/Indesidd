<?php
//LANDING OLVIDO
require 'cfg.inc.php';
$dndtoy = 18;

if (isset($_SESSION['top'])) {
  $_SESSION['cod'] = 0;
  include 'header.php';
?>

  <body class="stretched">
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header dark">
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
              <nav class="primary-menu menu-spacing-margin">
                <ul class="menu-container">
                  <?php if ($_SESSION['tip'] == 'U') { ?>
                    <li class="menu-item">
                      <button class="button button-border button-rounded button-small" onclick="window.location.href='registro.php';"><i class="icon-line-user-plus"></i><span>Registrate</span></button>
                    </li>
                    <li class="menu-item">
                      <button class="button button-border button-rounded button-small" onclick="window.location.href='ingreso.php';"><i class="icon-line-log-in"></i><span>Inicia sesión</span></button>
                    </li>
                  <?php } else { ?>
                    <li class="menu-item">
                      <button class="button button-aqua button-border button-rounded button-small" onclick="window.location.href='registro-pro.php';"><i class="icon-line-user-plus"></i><span>Postúlate</span></button>
                    </li>
                    <li class="menu-item">
                      <button class="button button-border button-rounded button-small" onclick="window.location.href='ingreso-pro.php';"><i class="icon-line-log-in"></i><span>Inicia sesión</span></button>
                    </li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="header-wrap-clone"></div>
      </header>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap bg-light pb-4">
          <div class="container clearfix">
            <?php
            if (isset($_SESSION['top'])) {
            ?>
              <h2>Hola <?php echo $_SESSION['nom']; ?></h2>
              <p class="mb-1">Revisa la bandeja de entrada del correo electrónico con el que te registraste. Y sigue las instrucciones indicadas para que podamos restablecer tu contraseña de acceso.</p>
              <p>Si no puedes ver el email, revisa en tu carpeta de SPAM.</p>
              <div class="row justify-content-center mb-5 mx-auto">
                <button class="button button-dark button-rounded" onclick="window.location.href='index.php';"><i class="icon-line-home"></i><span>Volver al inicio</span></button>
              </div>
            <?php
              unset($_SESSION['tip']);
              unset($_SESSION['top']);
              unset($_SESSION['nom']);
            } else {
              header('location:index.php');
            }
            ?>
          </div>
        </div>
      </section>
      <?php include 'footer.php'; ?>
    </div>
    <div id="gotoTop" class="icon-line-chevron-up"></div>
    <?php require 'scripts.php'; ?>
  </body>

  </html>

<?php
  unset($_SESSION['cod']);
} else {
  header('location:index.php');
}
