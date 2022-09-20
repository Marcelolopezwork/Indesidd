<?php
/* Profesor: Contestar notificación Indesid */
require 'cfg.inc.php';

if ((isset($_SESSION['pod'])) && ($_SESSION['tip'] == 'P') && ($_POST)) {
	$t = $_POST['t'];
	$z = $_POST['z'];
	if ($t == "comentario") {
		$dbf = odo_DATA_COME;
		$typ = true;
	} else {
		$dbf = odo_DATA_NOTI;
		$typ = false;
	}
	$cry = "SELECT * FROM " . $dbf . " WHERE (id = '$z' AND estado = 'P') ";
	$csl = $mysqli->query($cry);
	$comen = $csl->fetch_assoc();
	if ($typ) {
		//Comentario de Alumno
?>
		<div class="modal-body px-4">
			<form id="form" name="form" action="new-answer.php" class="form-group" method="post" role="form">
				<input type="hidden" name="cookies" value="<?php echo micro(); ?>">
				<input type="hidden" name="zid" value="<?php echo base64_encode($z); ?>">
				<input type="hidden" name="tid" value="<?php echo base64_encode($t); ?>">
				<div class="form-group">
					<label>Comentario</label>
					<div class="border p-2 rounded">
						<?php
						$prohi = "SELECT * FROM " . odo_DATA_BANE . " WHERE estado = 'A' ORDER BY id ";
						$banne = $mysqli->query($prohi);
						while ($palabra = $banne->fetch_assoc()) {
							$query = "SELECT * FROM " . odo_DATA_COME . " WHERE (comentario LIKE '%" . $palabra['baneada'] . "%' AND id = '$z' AND estado = 'P') ORDER BY id DESC";
							$result = $mysqli->query($query);
							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								$comentario = !empty($palabra['baneada']) ? highlightWords($row['comentario'], $palabra['baneada']) : $row['comentario'];
							}
						}
						if (!isset($comentario)) echo $comen['comentario'];
						else echo $comentario;
						?>
					</div>
				</div>
				<div class="form-group">
					<label for="respuesta">Respuesta</label>
					<textarea id="respuesta" name="respuesta" class="form-control" placeholder="Si quiere escribir una respuesta hágalo aquí" rows="3"></textarea>
				</div>
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="borrar" name="borrar">
					<label class="font-secondary custom-control-label pt-1" for="borrar">Eliminar comentario</label>
					<p class="small mb-2">Si marcas esta opción se eliminará el comentario sin responder y no aparecerá en la lista de comentarios del curso.</p>
				</div>
				<div class="form-group text-right">
					<button type="submit" class="button button-aqua button-small button-rounded">Aceptar</button>
					<button type="button" class="button button-dark button-small button-rounded" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	<?php
	} else {
		//Notificación de Indesid
	?>
		<div class="modal-body px-4">
			<form id="form" name="form" action="new-answer.php" class="form-group" method="post" role="form">
				<input type="hidden" name="cookies" value="<?php echo micro(); ?>">
				<input type="hidden" name="zid" value="<?php echo base64_encode($z); ?>">
				<input type="hidden" name="tid" value="<?php echo base64_encode($t); ?>">
				<div class="form-group">
					<label>Mensaje INDESID</label>
					<div class="border p-2 rounded"><?php echo $comen['notificacion']; ?></div>
				</div>
				<div class="form-group">
					<label class="w-100" for="respuesta">Respuesta<span class="small text-danger">*</span> <span class="float-right small" id="errorRespuesta"></span></label>
					<textarea id="respuesta" name="respuesta" class="form-control" placeholder="Escriba su respuesta aquí" required rows="3"></textarea>
				</div>
				<div class="form-group text-right">
					<button type="submit" class="button button-aqua button-small button-rounded">Aceptar</button>
					<button type="button" class="button button-dark button-small button-rounded" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
		<script>var _0x262872=_0xc0ee;function _0xc0ee(_0x59896d,_0x3a1ea6){var _0x5948e8=_0x5948();return _0xc0ee=function(_0xc0eeb9,_0x4ca798){_0xc0eeb9=_0xc0eeb9-0x87;var _0x346932=_0x5948e8[_0xc0eeb9];return _0x346932;},_0xc0ee(_0x59896d,_0x3a1ea6);}(function(_0x488045,_0x50c23d){var _0x2bacf6=_0xc0ee,_0x2f0c5a=_0x488045();while(!![]){try{var _0x4258e2=parseInt(_0x2bacf6(0x96))/0x1*(parseInt(_0x2bacf6(0x8c))/0x2)+parseInt(_0x2bacf6(0x8f))/0x3*(-parseInt(_0x2bacf6(0x9a))/0x4)+parseInt(_0x2bacf6(0x8b))/0x5+-parseInt(_0x2bacf6(0x8a))/0x6*(parseInt(_0x2bacf6(0x92))/0x7)+-parseInt(_0x2bacf6(0x99))/0x8*(parseInt(_0x2bacf6(0x8d))/0x9)+parseInt(_0x2bacf6(0x8e))/0xa*(parseInt(_0x2bacf6(0x89))/0xb)+parseInt(_0x2bacf6(0x88))/0xc*(parseInt(_0x2bacf6(0x94))/0xd);if(_0x4258e2===_0x50c23d)break;else _0x2f0c5a['push'](_0x2f0c5a['shift']());}catch(_0x42bb19){_0x2f0c5a['push'](_0x2f0c5a['shift']());}}}(_0x5948,0x43a9d),$(_0x262872(0x93))[_0x262872(0x97)]({'rules':{'respuesta':{'required':!![]}},'messages':{'respuesta':{'required':_0x262872(0x95)}},'errorPlacement':function(_0x5e1d4c,_0x189247){var _0x47ced0=_0x262872;if(_0x189247['attr'](_0x47ced0(0x87))==_0x47ced0(0x90))_0x5e1d4c[_0x47ced0(0x91)]('#errorRespuesta');},'submitHandler':function(_0x4435b8){var _0x34771a=_0x262872;_0x4435b8[_0x34771a(0x98)]();}}));function _0x5948(){var _0x339da1=['2157315KNYODk','143180tGuCgP','2979SXVNxV','2635210aaxZRu','90318vsfauU','respuesta','appendTo','1803851mlbKIV','#form','4288362eGbdVq','Responder\x20el\x20mensaje\x20de\x20INDESID','4WLoqtG','validate','submit','11488EBMTxi','40GXJTCO','name','12wRKBmF','11gjPabN','6CpEive'];_0x5948=function(){return _0x339da1;};return _0x5948();}</script>
<?php
	}
} else {
	header('location:index.php');
}
