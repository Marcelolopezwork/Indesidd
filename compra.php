<?php
//CARRITO DE COMPRAS
require 'cfg.inc.php';

if (isset($_SESSION['cod'])) {
  if ((isset($_SESSION['carro'])) && (!empty($_SESSION['carro']))) $carro = $_SESSION['carro'];
  $dndtoy = 14;
  $buscador = false;
  include 'header.php';
  if (!empty($_SESSION['carro'])) {
    foreach ($carro as $g) {
      $rev = "SELECT * FROM " . odo_DATA_ALUM . " WHERE cursoid = '" . $g['newid'] . "' AND usuarioid = '" . $_SESSION['cod'] . "' AND estado = 'A' ";
      $rsl = $mysqli->query($rev);
      $nopasa = $rsl->num_rows;
      if ($nopasa == 1) {
        unset($carro[$g['newid']]);
        $mensaje = "Ya has comprado este curso anteriormente";
        $_SESSION['carro'] = $carro;
      }
    }
  }
?>

  <body class="stretched">
    <div id="wrapper" class="clearfix">
      <?php /* MENÚ */ ?>
      <header id="header" class="full-header dark">
        <?php include 'menu.php'; ?>
      </header>
      <?php /* CONTENIDO */ ?>
      <section id="content">
        <div class="content-wrap">
          <div class="container clearfix mb-4">
            <h3 class="mb-1 text-blue">Carrito de compras <span class="d-none d-md-inline small"><i class="added icon-line-help-circle small" data-toggle="popover" data-content="<?php echo $txtdcto; ?>" data-trigger="hover"></i></span></h3>
            <?php
            if (!empty($carro)) {
            ?>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-8">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="bg-secondary font-primary dark small">
                        <th>Curso</th>
                        <th>Profesor</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($carro as $v) {
                        $cry = "SELECT * FROM " . odo_DATA_CATE . " WHERE id = '" . $v['categoria'] . "' AND estado = 'A' ";
                        $csl = $mysqli->query($cry);
                        $cat = $csl->fetch_assoc();
                        $pry = "SELECT CONCAT(nombres, ' ', apellidos) AS profe FROM " . odo_DATA_PROF . " WHERE id = '" . $v['profe'] . "' ";
                        $psl = $mysqli->query($pry);
                        $pro = $psl->fetch_assoc();
                      ?>
                        <tr class="small">
                          <td class="font-primary"><?php echo $v['curso']; ?></td>
                          <td>
                            <div class="d-flex flex-column">
                              <div><?php echo $pro['profe']; ?></div>
                              <div class="small text-secondary text-nowrap"><?php echo $cat['categoria']; ?></div>
                            </div>
                          </td>
                          <td class="text-nowrap">
                            <?php
                            $sum = 0;
                            $sum += $v['precio'];
                            $precio_activo = number_format($sum, 2);
                            ?>
                            <div class="d-flex">
                              <div><?php echo $moneda; ?></div>
                              <div id="pre" class="total"><?php echo $precio_activo; ?></div>
                            </div>
                          </td>
                          <td class="px-1 text-center text-secondary">
                            <?php
                            if ($v['descuento'] > 0) echo 'Dscto: ' . $v['descuento'] . '%';
                            else echo 'N/A';
                            ?>
                          </td>
                          <td class="text-center"><button class="btn text-danger" onclick="window.location.href='del.php?pid=<?php echo base64_encode($v['newid']); ?>&did=<?php echo base64_encode($v['iddescto']); ?>'"><i class="icon-line-circle-cross text-danger" data-toggle="popover" data-content="Eliminar curso del carrito" data-trigger="hover"></i></button></td>
                        </tr>
                      <?php
                      }
                      ?>
                      <tr class="bg-light font-primary small">
                        <td colspan="4" class="text-right">TOTAL</td>
                        <td class="text-center">
                          <?php
                          $sum = 0;
                          foreach ($carro as $item) $sum += $item['precio'];
                          $multi = $sum * 1;
                          $total = number_format($multi, 2);
                          ?>
                          <div class="d-flex justify-content-center">
                            <div class="mr-1"><?php echo $moneda; ?></div>
                            <div id="tot" class="total"><?php echo $total; ?></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="col-12 mb-3">
                    <div class="d-flex justify-content-center">
                      <button class="button button-rounded button-light" onclick="window.location.href='cursos.php'"><i class="icon-line-shopping-cart"></i> Continuar comprando</button>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                  <div id="smart-button-container">
                    <div style="text-align: center;">
                      <div id="paypal-button-container"></div>
                    </div>
                  </div>
                  <?php
                  $buy = "SELECT * FROM " . odo_DATA_USUA . " WHERE id = '" . $_SESSION['cod'] . "' AND estado = 'A' ";
                  $bsl = $mysqli->query($buy);
                  $compra = $bsl->fetch_assoc();
                  ?>
                  <script src="https://www.paypal.com/sdk/js?client-id=AeYudycGB8WyJ1QfUW0F0KLg9Hqdoa4fMBlgBfdsS5Z_L6HEXgb9Y5thL5liK6JAy73qQ2VgQu7KtEL_&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
                  <script>
                    function initPayPalButton() {
                      paypal.Buttons({
                        style: {
                          shape: 'rect',
                          color: 'blue',
                          layout: 'vertical',
                          label: 'paypal',
                        },
                        createOrder: function(data, actions) {
                          return actions.order.create({
                            purchase_units: [{
                              "description": "Curso Indesid",
                              "amount": {
                                "currency_code": "USD",
                                "value": <?php echo $multi; ?>
                              }
                            }],
                            payer: {
                              email_address: "<?php echo $compra['correo']; ?>",
                              name: {
                                given_name: "<?php echo $compra['nombres']; ?>",
                                surname: "<?php echo $compra['apellidos']; ?>"
                              },
                            }
                          });
                        },
                        onApprove: function(data, actions) {
                          return actions.order.capture().then(function(orderData) {
                            console.log('Resultado:', orderData, JSON.stringify(orderData, null, 2));
                            var numbertrans = orderData.id;
                            var transaction = orderData.purchase_units[0].payments.captures[0].id;
                            var purchaseids = orderData.payer.payer_id;
                            window.location.href = "success.php?tid=" + transaction + "&pye=" + purchaseids + "&tkn=" + numbertrans;
                          });
                        },
                        onError: function(err) {
                          console.log(err);
                          //window.location.href = "cancel.php";
                        }
                      }).render('#paypal-button-container');
                    }
                    initPayPalButton();
                  </script>
                </div>
              </div>
            <?php
            } else {
              $mensaje = "No has escogido ningún curso";
            ?>
              <h4 class="my-3 text-center"><?php echo $mensaje; ?></h4>
              <p class="center"><button onclick="window.location.href='cursos.php';" class="button button-dark button-rounded mb-4"><i class="icon-line-search"></i><span>Ver cursos</span></button></p>
            <?php
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
  header("location:ingreso.php");
}
