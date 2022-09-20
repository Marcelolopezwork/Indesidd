<?php
//COMPRA RECHAZADA
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
  if ((isset($_SESSION['carro'])) && (!empty($_SESSION['carro']))) {
    $carro = $_SESSION['carro'];
    $nombrecurso = "";

    foreach ($carro as $h) {
      $nombrecurso .= $h['curso'] . ", ";
    };
    $cursos = substr($nombrecurso, 0, -2);
    $ccursos = count($carro);

    $dndtoy = 16;
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
          <div class="content-wrap mb-5">
            <div class="container clearfix">
              <h3 class="mb-1">Aviso</h3>
              <?php
              if ($ccursos > 1) {
              ?>
                <p class="mb-2">Ha ocurrido un error en la compra de los cursos: <span class="font-primary"><?php echo $cursos; ?></span></p>
              <?php
              } else {
              ?>
                <p class="mb-2">Ha ocurrido un error en la compra del curso: <span class="font-primary"><?php echo $cursos; ?></span></p>
              <?php
              }
              ?>
              <p class="my-0">No se ha realizado ningún cargo a su tarjeta de crédito.</p>
              <p class="mb-4">Revise los datos consignados y vuelva a intentar su compra.</p>
              <button onclick="window.location.href='compra.php';" class="button button-rounded button-small button-red ml-1"><i class="icon-line-alert-circle"></i> <span>Volver a intentar</span></button>
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
    header("location:perfil.php");
  }
} else {
  header("location:index.php");
}
