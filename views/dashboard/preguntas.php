<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<ul class="listado-items" id="listado-items">    
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php foreach($preguntas as $p){ ?>
        <li class="listado-pregunta">
            <p><?php echo $p->titulo; ?></p> 
            <a href="/pregunta_usuario?id=<?php echo $p->url ;?>">Acceder</a>
        </li>    
    <?php } ?>      
</ul>
<a href="/dashboard" class="enlace"> Volver</a>    

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; ?>