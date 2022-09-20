<?php
//VERIFICAR
require 'cfg.inc.php';
$dndtoy = 22;
if ($_SESSION['verifica']) {
  $buscador = false;
  include 'header.php';
?>

  <body class="stretched">
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header dark">
        <?php include 'menu.php'; ?>
      </header>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap bg-light pb-4">
          <div class="container clearfix">
            <?php
            if (isset($_SESSION['top'])) {
            ?>
              <h2>Hola <?php echo $_SESSION['nom']; ?></h2>
              <p>Gracias por tu interés en pertenecer a <strong>INDESID</strong>.<br>Revisa la bandeja de entrada del correo electrónico consignado en tu registro. Sigue las instrucciones ahí indicadas para que podamos verificar tus datos.</p>
              <p>Si no puedes ver el email, revisa en tu carpeta de SPAM.</p>
              <button class="d-none d-lg-block button button-border button-reveal button-rounded button-small mx-auto text-right" onclick="window.location.href='index.php';"><i class="icon-line-log-in"></i><span>Ir a la página inicial</span></button>
            <?php
              unset($_SESSION['top']);
              unset($_SESSION['nom']);
              $_SESSION['verifica'] = false;
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
} else {
  header('location:index.php');
}
?>