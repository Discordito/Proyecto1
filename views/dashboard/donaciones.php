<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="donaciones">
    <p>La plataforma, sus sistemas y funcionalidades fueron creadas y diseñadas unicamente por su administrador. Cada donación realizada sera destinada al mantenimiento y mejora del sitio web para el uso y disfrute de toda la comunidad. Muchas gracias!</p>
    <div class="boton-donacion">
        <div id="donate-button-container">
            <div id="donate-button"></div>
            <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
            <script>
                PayPal.Donation.Button({
                env:'sandbox',
                hosted_button_id:'D2B7U8BU882QC',
                image: {
                src:'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
                alt:'Donate with PayPal button',
                title:'PayPal - The safer, easier way to pay online!',
                }
                }).render('#donate-button');
            </script>
        </div>
    </div>
</div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>