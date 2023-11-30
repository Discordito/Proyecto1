<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<h4>Membresia Actual: <?php echo $membresia; ?></h4>
<div id="smart-button-container">
    <div style="text-align: center;">
        <div id="paypal-button-container"></div>
        <input type="hidden" id="miTiempo" name="tiempo"> 
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=Ab_k3Lz0Nw60L2mL58rXgScXWSiL-ZuO6nurXdogA5bctWAMpyl1LVUUf3IXIdY_LfJmXByuZBN82k7H&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
     
     <script>
         function initPayPalButton() {
           paypal.Buttons({
             style: {
               shape: 'rect',
               color: 'blue',
               layout: 'vertical',
               label: 'pay',
             },     
             createOrder: function(data, actions) {
               return actions.order.create({
                 purchase_units: [{"description":"membresia1","amount":{"currency_code":"USD","value":3}}]
               });
             },  
             onClick(){                
                var tiempo = new Date();
                document.getElementById("miTiempo").setAttribute('value', tiempo);
                const $variable = document.querySelector('#miTiempo');
             },    
             onApprove: function(data, actions) {
               return actions.order.capture().then(function(orderData) {
                $dates = document.getElementById("miTiempo").value;
                const datos = new FormData();
                datos.append('transaccion', orderData.purchase_units[0].payments.captures[0].id);
                datos.append('descripcion', orderData.purchase_units[0].description);
                datos.append('date', $dates);                

                fetch('/membresia', {
                    method: 'POST',
                    body: datos
                })
      
                 // Full available details
                //  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
      
                 // Show a success message within this page, e.g.
                //  const element = document.getElementById('paypal-button-container');
                //  element.innerHTML = '';
                //  element.innerHTML = '<h3>Thank you for your payment!</h3>';
      
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
 
 
 
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $_SESSION['tiempo'] = '$miTiempo' ?>
<?php $script .= '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/build/js/bundle-tiempo.js"></script>'; ?>