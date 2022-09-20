<?php
/* Alumno: Motivo por el que solicita devolución de dinero de un curso */
require 'cfg.inc.php';
if (!isset($_SESSION['cod'])) {
  header('location:index.php');
} else {
  if (($_SESSION['tip'] == 'U') && ($_POST)) {
    $z = $_POST['z'];
    $cry = "SELECT * FROM " . odo_DATA_TRAN . " WHERE (id = '$z' AND estado = 'A') ";
    $csl = $mysqli->query($cry);
    $dev = $csl->fetch_assoc();
    $deb = $dev['monto'] - (($dev['monto'] * $monto_devolucion) / 100);
    $devolu = number_format($deb, 2);
    //Devoluciones
?>
    <div class="modal-body px-4">
      <form id="form" name="form" action="new-devolution.php" class="form-group" method="post" role="form">
        <input type="hidden" name="cookies" value="<?php echo micro(); ?>">
        <input type="hidden" name="zid" value="<?php echo base64_encode($z); ?>">
        <input type="hidden" name="xid" value="<?php echo base64_encode($dev['cursoid']); ?>">
        <input type="hidden" name="did" value="<?php echo base64_encode($deb); ?>">
        <div class="form-group">
          <h4 class="mb-0 text-info"><?php echo $dev['curso']; ?></h4>
          <?php if ($monto_devolucion > 0) { ?>
            <h5 class="mb-0 text-secondary">Monto venta curso: <?php echo "US$ " . $dev['monto']; ?></h5>
          <?php } ?>
          <h5 class="mb-0 text-secondary">Monto devolución: <?php echo "US$ " . $devolu; ?></h5>
          <label class="w-100" for="motivo">Motivo de la devolución<span class="small text-danger">*</span> <span class="float-right small" id="errorMotivo"></span></label>
          <textarea id="motivo" name="motivo" class="form-control" placeholder="Describa el motivo aquí" required rows="3"></textarea>
          <?php if ($monto_devolucion > 0) { ?>
            <p class="mt-0 small text-center text-secondary"><span class="small">*Si la solicitud procede, el monto de la devolución es <?php echo $monto_devolucion; ?>% menos del valor de venta del curso por concepto de gastos administrativos<span class="small"></p>
          <?php } ?>
        </div>
        <div class="form-group text-right">
          <button type="submit" class="button button-aqua button-small button-rounded">Enviar</button>
          <button type="button" class="button button-dark button-small button-rounded" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
    <script>
      function _0xf882() {
        var _0x2f237a = ['2205AEhRRu', 'attr', '2201322PtBAUE', '344fxYvnp', '854498MmqrcT', 'motivo', '#errorMotivo', 'appendTo', '8496PTCalY', 'validate', '5214888ddBIGO', '#form', 'submit', '267736REGsTL', '31559550ZElUAv', '3KRYQTw', '1709048ETFzFC'];
        _0xf882 = function() {
          return _0x2f237a;
        };
        return _0xf882();
      }

      function _0x5759(_0x1fd972, _0x16b438) {
        var _0xf88256 = _0xf882();
        return _0x5759 = function(_0x575936, _0x475cb2) {
          _0x575936 = _0x575936 - 0x11e;
          var _0x11e3d7 = _0xf88256[_0x575936];
          return _0x11e3d7;
        }, _0x5759(_0x1fd972, _0x16b438);
      }
      var _0x517bce = _0x5759;
      (function(_0xf02a0d, _0x22f709) {
        var _0x4446df = _0x5759,
          _0x4647a6 = _0xf02a0d();
        while (!![]) {
          try {
            var _0x10cadc = parseInt(_0x4446df(0x125)) / 0x1 + -parseInt(_0x4446df(0x12a)) / 0x2 * (parseInt(_0x4446df(0x124)) / 0x3) + -parseInt(_0x4446df(0x12e)) / 0x4 * (-parseInt(_0x4446df(0x126)) / 0x5) + -parseInt(_0x4446df(0x128)) / 0x6 + -parseInt(_0x4446df(0x122)) / 0x7 * (-parseInt(_0x4446df(0x129)) / 0x8) + parseInt(_0x4446df(0x11f)) / 0x9 + -parseInt(_0x4446df(0x123)) / 0xa;
            if (_0x10cadc === _0x22f709) break;
            else _0x4647a6['push'](_0x4647a6['shift']());
          } catch (_0x1849d6) {
            _0x4647a6['push'](_0x4647a6['shift']());
          }
        }
      }(_0xf882, 0xe08b9), $(_0x517bce(0x120))[_0x517bce(0x11e)]({
        'rules': {
          'motivo': {
            'required': !![]
          }
        },
        'messages': {
          'motivo': {
            'required': 'Indicar\x20el\x20motivo\x20de\x20la\x20solicitud'
          }
        },
        'errorPlacement': function(_0xd2f1b0, _0x406180) {
          var _0x2b24b2 = _0x517bce;
          if (_0x406180[_0x2b24b2(0x127)]('name') == _0x2b24b2(0x12b)) _0xd2f1b0[_0x2b24b2(0x12d)](_0x2b24b2(0x12c));
        },
        'submitHandler': function(_0xf7e1f6) {
          var _0x483cfc = _0x517bce;
          _0xf7e1f6[_0x483cfc(0x121)]();
        }
      }));
    </script>
<?php
  }
}
?>