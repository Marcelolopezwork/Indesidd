<?php
if (!isset($dndtoy)) header('location:index.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="<?php echo odo_TITL; ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bundle.min.css?i=<?php echo micro(); ?>" type="text/css">
  <link rel="stylesheet" href="css/styles.min.css?i=<?php echo micro(); ?>" type="text/css">
  <?php /*SWIPER*/ ?>
  <?php if ($swiper) { ?>
    <link rel="stylesheet" href="css/swiper.min.css" type="text/css">
  <?php } ?>
  <?php /*SELECT*/ ?>
  <?php if ($select) { ?>
    <link rel="stylesheet" href="css/select.min.css" type="text/css">
  <?php } ?>
  <?php /*DATATABLE*/ ?>
  <?php if ($datatable) { ?>
    <link rel="stylesheet" href="css/datatable.min.css">
  <?php } ?>
  <?php /*CALENDAR*/ ?>
  <?php if ($datetime) { ?>
    <link rel="stylesheet" href="css/datepicker.min.css" type="text/css" />
  <?php } ?>
  <?php /*NUMERO DE TELEFONO*/ ?>
  <?php if ($telephone) { ?>
    <link rel="stylesheet" href="css/telefono.min.css">
  <?php } ?>
  <link rel="stylesheet" href="css/custom.min.css?i=<?php echo micro(); ?>" type="text/css">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo odo_TITL; ?></title>
  <style>
    @font-face {
      font-family: "FuturaBold";
      src: url("css/fonts/FuturaBT-Bold.eot");
      src: url("css/fonts/FuturaBT-Bold.eot?#iefix") format("embedded-opentype"),
        url("css/fonts/FuturaBT-Bold.woff") format("woff"),
        url("css/fonts/FuturaBT-Bold.woff2") format("woff2"),
        url("css/fonts/FuturaBT-Bold.ttf") format("truetype");
      font-weight: normal;
      font-style: normal;
      font-display: swap;
    }

    @font-face {
      font-family: "lined-icons";
      src: url("css/fonts/lined-icons.eot");
      src: url("css/fonts/lined-icons.eot?#iefix") format("embedded-opentype"),
        url("css/fonts/lined-icons.woff") format("woff"),
        url("css/fonts/lined-icons.ttf") format("truetype"),
        url("css/fonts/lined-icons.svg") format("svg");
      font-weight: normal;
      font-style: normal;
    }
  </style>
</head>