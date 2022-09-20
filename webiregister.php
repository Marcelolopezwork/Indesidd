<?php
//FORMULARIO DE REGISTRO A WEBINARS
require 'cfg.inc.php';
if ($_POST) {
	if (!empty($_POST['i'])) $id = $_POST['i'];
	$qry = "SELECT " . odo_DATA_WEBI . ".*, " . odo_DATA_CATE . ".categoria AS cate FROM " . odo_DATA_WEBI . ", " . odo_DATA_CATE . " WHERE " . odo_DATA_WEBI . ".id = '$id' AND " . odo_DATA_WEBI . ".publicado = 'S' AND " . odo_DATA_WEBI . ".estado = 'A' ";
	$rsl = $mysqli->query($qry);
	$wbi = $rsl->fetch_assoc();
?>
	<div class="modal-body">
		<h4 class="mb-1 text-primary"><?php echo $wbi['webinar']; ?></h4>
		<form action="register-webinar.php" method="post" name="webireg" class="px-4 py-2">
			<input type="hidden" name="wid" value="<?php echo base64_encode($wbi['id']); ?>">
			<input type="hidden" name="wca" value="<?php echo base64_encode($wbi['cate']); ?>">
			<div class="form-group">
				<label for="nombre" class="w-100">Nombre<span class="text-danger">*</span><span class="float-right" id="nombreError"></span></label>
				<input autocomplete="off" class="form-control" id="nombre" name="nombre" required tabindex="1" type="text">
			</div>
			<div class="form-group">
				<label for="email" class="w-100">Email<span class="text-danger">*</span><span class="float-right" id="emailError"></span></label>
				<input autocomplete="off" class="form-control" name="email" tabindex="2" required type="email">
			</div>
			<div class="form-group pb-2">
				<button class="button button-blue button-small button-rounded float-right" tabindex="3" type="submit">Registro</button>
			</div>
		</form>
	</div>
	<script>
		$("#nombre").focus();
		(function(_0x506eb1,_0x2424d0){var _0x47862e=_0x4f11,_0x8bddce=_0x506eb1();while(!![]){try{var _0x566925=parseInt(_0x47862e(0x1dc))/0x1*(parseInt(_0x47862e(0x1d6))/0x2)+-parseInt(_0x47862e(0x1d8))/0x3*(-parseInt(_0x47862e(0x1c9))/0x4)+parseInt(_0x47862e(0x1d4))/0x5*(-parseInt(_0x47862e(0x1de))/0x6)+parseInt(_0x47862e(0x1d5))/0x7+-parseInt(_0x47862e(0x1d1))/0x8*(parseInt(_0x47862e(0x1cd))/0x9)+-parseInt(_0x47862e(0x1d7))/0xa*(-parseInt(_0x47862e(0x1ca))/0xb)+-parseInt(_0x47862e(0x1da))/0xc*(parseInt(_0x47862e(0x1c7))/0xd);if(_0x566925===_0x2424d0)break;else _0x8bddce['push'](_0x8bddce['shift']());}catch(_0x46a604){_0x8bddce['push'](_0x8bddce['shift']());}}}(_0xa11c,0xb0430),$(function(){var _0x584fe7=_0x4f11;$[_0x584fe7(0x1db)]['addMethod'](_0x584fe7(0x1d0),function(_0x57a7d5,_0x47c896){var _0x4dfde0=_0x584fe7;return this[_0x4dfde0(0x1cc)](_0x47c896)||/^[a-z\s áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i[_0x4dfde0(0x1d2)](_0x57a7d5);},_0x584fe7(0x1e0)),$(_0x584fe7(0x1dd))[_0x584fe7(0x1ce)]({'rules':{'nombre':{'required':!![],'minlength':0x2,'sololetras':!![]},'email':{'required':!![],'email':!![]}},'messages':{'nombre':{'required':'Ingrese\x20su\x20nombre','minlength':'Mínimo\x202\x20caracteres'},'email':{'required':'Ingrese\x20su\x20email','email':_0x584fe7(0x1e1)}},'errorPlacement':function(_0x202fa5,_0x3ac7e0){var _0x56b4a4=_0x584fe7;if(_0x3ac7e0[_0x56b4a4(0x1cb)](_0x56b4a4(0x1cf))==_0x56b4a4(0x1d3))_0x202fa5[_0x56b4a4(0x1df)](_0x56b4a4(0x1d9));if(_0x3ac7e0['attr'](_0x56b4a4(0x1cf))=='email')_0x202fa5[_0x56b4a4(0x1df)](_0x56b4a4(0x1e2));},'submitHandler':function(_0x3b745e){var _0x5a5010=_0x584fe7;_0x3b745e[_0x5a5010(0x1c8)]();}});}));function _0x4f11(_0x5da799,_0x593824){var _0xa11c5e=_0xa11c();return _0x4f11=function(_0x4f119a,_0x43e391){_0x4f119a=_0x4f119a-0x1c7;var _0xefe1fb=_0xa11c5e[_0x4f119a];return _0xefe1fb;},_0x4f11(_0x5da799,_0x593824);}function _0xa11c(){var _0x3d7cf5=['360XeKuWi','254903XvkTWe','attr','optional','216qTIUqv','validate','name','sololetras','188592eaWeLu','test','nombre','15HXcFVo','4140745TeXOAr','53308MNeGLb','600kaNaXL','35304LLtvtq','#nombreError','1608xgwcvH','validator','2rSoeXI','form[name=\x27webireg\x27]','931590OHDsgX','appendTo','Sólo\x20letras','Email\x20no\x20válido','#emailError','130078xBGEMH','submit'];_0xa11c=function(){return _0x3d7cf5;};return _0xa11c();}
	</script>
<?php
}
?>