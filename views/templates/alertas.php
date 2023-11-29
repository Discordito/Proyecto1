<?php
    foreach($alertas as $key => $alerta):
        foreach($alerta as $mensaje):
?>

    <div class="alerta <?php echo $key; ?>" id="alerta"><?php echo $mensaje; ?></div>

<?php
        endforeach;
    endforeach;    
?>