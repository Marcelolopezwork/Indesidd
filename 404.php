<?php
//Error 404
require 'cfg.inc.php';

$dndtoy = 404;
include 'header.php';
?>

<body class="stretched">
	<div id="wrapper" class="clearfix">
		<?php /* MENÚ */ ?>
		<header id="header" class="full-header sticky">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">
						<div id="logo">
							<a href="index.php" class="py-2"><img src="img/logo-indesid-dark.svg" alt="Logo Indesid"></a>
						</div>
						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100">
								<path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
								<path d="m 30,50 h 40"></path>
								<path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</header>
		<section id="page-title">
			<div class="container clearfix">
				<h1>Página no encontrada</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
					<li class="breadcrumb-item active" aria-current="page">404</li>
				</ol>
			</div>
		</section>
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<div class="row align-items-center bottommargin-lg">
						<div class="col-lg-6">
							<div class="error404 center">404</div>
						</div>
						<div class="col-lg-6">
							<div class="heading-block text-center text-lg-left border-bottom-0">
								<h4>Lo sentimos!!!</h4>
								<h5>La página que estás buscando no se encuentra</h5>
							</div>
							<div class="input-group-append">
								<a href="index.php" class="button button-rounded button-red" type="button">Volver al inicio</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include 'footer.php'; ?>
	</div>
	<div id="gotoTop" class="icon-line-chevron-up"></div>
	<?php require 'scripts.php'; ?>
</body>

</html>