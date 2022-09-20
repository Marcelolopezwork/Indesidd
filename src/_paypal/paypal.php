//CÓDIGO ANTIGUO
<div id="smart-button-container">
  <div style="text-align: center;">
    <?php
    $buy = "SELECT * FROM " . odo_DATA_USUA . " WHERE id = '" . $_SESSION['cod'] . "' AND estado = 'A' ";
    $bsl = $mysqli->query($buy);
    $compra = $bsl->fetch_assoc();
    ?>
    <div id="paypal-button-container"></div>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo odo_PYPL_CLIE; ?>"></script>
    <script>
      paypal.Buttons({
        env: "<?php echo odo_PayPalENV; ?>",
        style: {
          shape: "rect",
          color: "blue",
          layout: "vertical",
          label: "paypal"
        },
        createOrder: function(data, actions) {
          return actions.order.create({
            application_context: {
              shipping_preference: "NO_SHIPPING"
            },
            payer: {
              email_address: "<?php echo $compra['correo']; ?>",
              name: {
                given_name: "<?php echo $compra['nombres']; ?>",
                surname: "<?php echo $compra['apellidos']; ?>"
              },
              address: {
                address_line_1: "",
                address_line_2: "",
                admin_area_1: "",
                admin_area_2: "",
                postal_code: "",
                country_code: "<?php echo $compra['pais']; ?>"
              },
            },
            purchase_units: [{
              amount: {
                value: "<?php echo $multi; ?>",
                currency_code: "<?php echo $currency; ?>"
              }
            }]
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
          window.location.href = "cancel.php";
        }
      }).render('#paypal-button-container');
    </script>
  </div>
</div>

/*
Ingreso
paypal@indesid.com
PayIndesidapal2025!

SANDBOX
Cuenta Tienda: Business
sb-lzglk6144615@business.example.com
n9&o55M^

Cuenta Usuario: Personal
sb-474b9z6142783@personal.example.com
VlLV"y^5

Tarjeta Personal
4020026581678664
VISA
05/2026

Client ID
ASq5GFTzy-sjwD9VdKtCqWe009s_pEX2BlaciB3uEfyHg8-eK0kIWiRnhsd9_iaALSpJ4hIu58zQ5tjX
Secret
EM8ABTuLcSPvX2bNm4fms0RyrcN4rCF8g0hKaI7avPX33xsZPABHussy4OrbsubeX6ADcKKo68-xHWBh
*/
//CÓDIGO SANDBOX
<div id="smart-button-container">
  <div style="text-align: center;">
    <div id="paypal-button-container"></div>
  </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
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
            "description": "Indesid",
            "amount": {
              "currency_code": "USD",
              "value": 1
            }
          }]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {

          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');

        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>

/*
LIVE
Client ID
AeYudycGB8WyJ1QfUW0F0KLg9Hqdoa4fMBlgBfdsS5Z_L6HEXgb9Y5thL5liK6JAy73qQ2VgQu7KtEL_
Secret
EALTYux_VdZScB6Bc8oeH4c6edPY7N-AUxGeIqzkO4aX-rzcLUToK6AzWRs4WNAfzLHl50rrVz3S1m_D
*/
//CÓDIGO LIVE
<div id="smart-button-container">
  <div style="text-align: center;">
    <div id="paypal-button-container"></div>
  </div>
</div>
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
            "description": "Curso de Indesid",
            "amount": {
              "currency_code": "USD",
              "value": 1
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          //Todos los detalles de la transacción
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          //Muestra mensaje de transacción exitosa
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Gracias por tu compra!</h3>';
          // Or go to another URL:  actions.redirect('success.php');
        });
      },
      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>