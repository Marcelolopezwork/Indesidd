<?php
//Cerrar sesión
require 'cfg.inc.php';
unset($carro);
unset($_SESSION['cod']);
unset($_SESSION['carro']);
session_unset();
session_destroy();
header('location:index.php');
