<?php
/*
El 0 simboliza entorno de Prueba
El 1 simboliza entorno de producción
*/
define('__ProPayPal', 1);

define('__currency', 'USD');
define('__PYPL_CLIE', '');
define('__PYPL_SECR', '');

if (__ProPayPal) :
  define('_PayPalBaseUrl', 'https://api.paypal.com/v1/');
  define('__PayPalENV', 'production');
else :
  define('_PayPalBaseUrl', 'https://api-m.sandbox.paypal.com/');
  define('__PayPalENV', 'sandbox');
endif;
