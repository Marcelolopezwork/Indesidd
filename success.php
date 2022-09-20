<?php
//COMPRA EXITOSA
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
  if ((isset($_SESSION['carro'])) && (!empty($_SESSION['carro']))) $carro = $_SESSION['carro'];
  else header("location:perfil.php");
  if (!empty($_GET['tid']) && !empty($_GET['pye']) && !empty($_GET['tkn'])) {
    $transaction = $_GET['tid'];
    $payer = $_GET['pye'];
    $token = $_GET['tkn'];
    $cuantos = count($carro);
    $nombrecurso = "";
    $er = "";

    foreach ($carro as $h) {
      $qry = new PDO('mysql:' . odo_HOST . '=localhost;dbname=' . odo_BASE, odo_USER, odo_PASS);
      $tmt = $qry->prepare("INSERT INTO " . odo_DATA_TRAN . " (transaccion, pagador, token, monto, curso, cursoid, usuarioid, profesorid, comision, fecha, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      try {
        $qry->beginTransaction();
        $tmt->execute(array($transaction, $payer, $token, $h['precio'], $h['curso'], $h['newid'], $_SESSION['cod'], $h['profe'], $h['comica'], $hoy, 'A'));
        $operation = $qry->lastInsertId();
        $qry->commit();
      } catch (PDOException $e) {
        $qry->rollback();
        $er .= $e->getMessage();
      }

      $tmt = $qry->prepare("INSERT INTO " . odo_DATA_ALUM . " (transaccionid, usuarioid, categoriaid, profesorid, cursoid, claseid, megusta, fecha, marca, material, completado, nota, certificado, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      try {
        $qry->beginTransaction();
        $tmt->execute(array($operation, $_SESSION['cod'], $h['categoria'], $h['profe'], $h['newid'], '1', '0', $hoy, '1', null, 'N', null, null, 'A'));
        $qry->commit();
      } catch (PDOException $e) {
        $qry->rollback();
        $er .= $e->getMessage();
      }

      $qry = "UPDATE " . odo_DATA_CURS . " SET estudiantes = (estudiantes + 1) WHERE id = '" . $h['newid'] . "' AND estado = 'A' ";
      $rsl = $mysqli->query($qry);
      $nombrecurso .= $h['curso'] . ", ";

      $qrys = "UPDATE " . odo_DATA_DESC . " SET utilizado = 'T', fechauso = '$hoy', cursoid = '" . $h['newid'] . "' WHERE id = '" . $h['iddescto'] . "' ";
      $rsul = $mysqli->query($qrys);
    };
    $cursos = substr($nombrecurso, 0, -2);

    $dndtoy = 15;
    $buscador = false;
    include 'header.php';
?>

    <body class="stretched">
      <div id="wrapper" class="clearfix">
        <?php /* MENÚ */ ?>
        <header id="header" class="full-header dark">
          <?php
          $carro = "";
          $_SESSION['carro'] = "";
          unset($carro);
          unset($_SESSION['carro']);
          include 'menu.php';
          ?>
        </header>
        <?php /* CONTENIDO */ ?>
        <section id="content">
          <div class="content-wrap mb-4">
            <div class="container clearfix">
              <h3 class="mb-1">Felicitaciones <?php echo $_SESSION['nom']; ?></h3>
              <p>Has comprado: <span class="font-primary text-blue"><?php echo $cursos; ?></span></p>
              <?php if ($cuantos == 1) { ?>
                <button class="button button-dark button-sm mx-auto" onclick="window.location.href='clase.php?pid=<?php echo $h['newid']; ?>&qid=1&sid<?php echo $h['slug']; ?>';">Ir al curso</button>
              <?php } else { ?>
                <button class="button button-dark button-sm mx-auto" onclick="window.location.href='perfil.php';">Ir a tus cursos</button>
              <?php } ?>
            </div>
          </div>
        </section>
        <?php include 'footer.php'; ?>
      </div>
      <div id="gotoTop" class="icon-line-chevron-up"></div>
      <?php require 'scripts.php'; ?>
    </body>

    </html>
    <?php if (!empty($er)) { ?>
      <script>
        Swal.fire('Error', '<?php echo $er; ?>', 'danger');
      </script>
    <?php } ?>
<?php
  }
} else {
  header("location:ingreso.php");
}
