<?php
/* Webinars */
require 'cfg.inc.php';
$wry = "SELECT * FROM " . odo_DATA_WEBI . " WHERE fecha > '" . $hoy . "' AND publicado = 'S' AND estado = 'A' ";
$wsl = $mysqli->query($wry);
if ($wsl->num_rows > 0) {
	if (!isset($_SESSION['verid'])) $_SESSION['verid'] = "";
	if (!isset($_SESSION['vertype'])) $_SESSION['vertype'] = "";
	if (!isset($_SESSION['vertitle'])) $_SESSION['vertitle'] = "";
	$dndtoy = 13;
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
				<div class="content-wrap bg-dark">
					<div class="container clearfix">
						<h3 class="text-light">Webinars</h3>
						<div class="row grid-container" data-layout="fitRows">
							<?php
							while ($webi = $wsl->fetch_assoc()) {
								$cry = "SELECT categoria FROM " . odo_DATA_CATE . " WHERE id >= '" . $webi['categoriaid'] . "' AND estado = 'A' ";
								$csl = $mysqli->query($cry);
								$cate = $csl->fetch_assoc();
							?>
								<div class="entry event col-12">
									<div class="grid-inner row align-items-center no-gutters p-4">
										<div class="entry-image col-md-4 mb-md-0">
											<img src="img/webinars/<?php echo $webi['imagen']; ?>" alt="">
											<div class="entry-date">
												<?php
												$fechaevento = new DateTime($webi['fecha']);
												$wdia = $fechaevento->format('j');
												$wmes = $fechaevento->format('n');
												?>
												<span><?php echo substr($meses[$wmes], 0, 3); ?></span>
												<?php echo $wdia; ?>
												<span><?php echo $webi['horaini']; ?></span>
											</div>
										</div>
										<div class="col-md-8 pl-md-4">
											<div class="entry-title title-sm">
												<h2><?php echo $webi['webinar']; ?></h2>
											</div>
											<div class="entry-meta">
												<ul>
													<li class="text-success"><i class="icon-line-head"></i><?php echo $webi['ponente']; ?></li>
													<li><i class="icon-line-video"></i><?php echo $redes[$webi['plataforma']]; ?></li>
													<li><i class="icon-line-copy"></i><?php echo $cate['categoria']; ?></li>
												</ul>
											</div>
											<div class="entry-content">
												<p><?php echo $webi['descripcion']; ?></p>
												<button data-web="<?php echo $webi['id']; ?>" class="button button-dark button-small button-rounded float-right" data-toggle="modal" data-target="#registrar">Registrarse</button>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</section>
			<?php echo vmodalsm('registrar', 'Registrarse al Webinar', '', 'webi') ?>
			<?php include 'footer.php'; ?>
		</div>
		<div id="gotoTop" class="icon-line-chevron-up"></div>
		<?php require 'scripts.php'; ?>
		<script>
			var _0xdee4f8=_0x5426;function _0x4f04(){var _0x3e4198=['1119408dEtDua','preventDefault','done','fail','28ZVmyqt','5WROBsh','ajax','13177120rIVmCL','html','921834WBLkaM','186195vHgGVW','3718172iTnPiZ','click','46HkaNel','POST','#webi','9CVSOrP','attr','<p\x20class=\x22p-2\x20text-center\x22>Ha\x20ocurrido\x20un\x20error</p>','[data-web]','2224782wNMmPD','1961729GmTJvn'];_0x4f04=function(){return _0x3e4198;};return _0x4f04();}function _0x5426(_0x3c2774,_0x1fb554){var _0x4f0439=_0x4f04();return _0x5426=function(_0x542697,_0x34827c){_0x542697=_0x542697-0xa3;var _0x487e36=_0x4f0439[_0x542697];return _0x487e36;},_0x5426(_0x3c2774,_0x1fb554);}(function(_0x5c1564,_0x2e49af){var _0xeb2a02=_0x5426,_0x18a2d2=_0x5c1564();while(!![]){try{var _0x2fbeb1=-parseInt(_0xeb2a02(0xae))/0x1+-parseInt(_0xeb2a02(0xb2))/0x2*(-parseInt(_0xeb2a02(0xaf))/0x3)+parseInt(_0xeb2a02(0xb0))/0x4+parseInt(_0xeb2a02(0xaa))/0x5*(parseInt(_0xeb2a02(0xa3))/0x6)+parseInt(_0xeb2a02(0xa9))/0x7*(parseInt(_0xeb2a02(0xa5))/0x8)+parseInt(_0xeb2a02(0xb5))/0x9*(-parseInt(_0xeb2a02(0xac))/0xa)+-parseInt(_0xeb2a02(0xa4))/0xb;if(_0x2fbeb1===_0x2e49af)break;else _0x18a2d2['push'](_0x18a2d2['shift']());}catch(_0x2bed51){_0x18a2d2['push'](_0x18a2d2['shift']());}}}(_0x4f04,0xd4516),$(_0xdee4f8(0xb8))['on'](_0xdee4f8(0xb1),function(_0xdb54df){var _0x3faae0=_0xdee4f8;_0xdb54df[_0x3faae0(0xa6)](_0xdb54df);var _0x3c55c3=$(this)[_0x3faae0(0xb6)]('data-web');$[_0x3faae0(0xab)]({'url':'webiregister.php','type':_0x3faae0(0xb3),'data':{'i':_0x3c55c3}})[_0x3faae0(0xa7)](function(_0x4c54b5){var _0x4c402f=_0x3faae0;$('#webi')[_0x4c402f(0xad)](_0x4c54b5);})[_0x3faae0(0xa8)](function(_0x4d05be,_0x266eb2){var _0x5c866d=_0x3faae0;$(_0x5c866d(0xb4))[_0x5c866d(0xad)](_0x5c866d(0xb7));});}));
		</script>
		<?php include 'notify.php'; ?>
	</body>

	</html>
<?php
} else {
	header('location:index.php');
}
?>