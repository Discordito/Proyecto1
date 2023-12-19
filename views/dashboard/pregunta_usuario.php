<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<p><?php echo $descripcion ?></p>

<h3>Respuesta:</h3> 
<?php if($respuesta === ''){?>
    <p>Espere la respuesta del administrador.</p>
<?php } ?>
<p><?php echo $respuesta; ?></p>
<a href="/preguntas" class="enlace"> Volver</a>   


<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; ?>