<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<ul class="listado-items" id="listado-items">    
    <?php foreach($registros as $registro){ ?>
        <li class="registro">            
            <div class="registros">
                <p>Fecha: <?php echo $registro->date;?></p>
                <p>Estandar: <?php echo $registro->estandar_id; ?></p>
                <p>Puntaje: <?php echo $registro->puntaje;?></p>
            </div>
        </li>        
    <?php } ?>
</ul>
<a href="/dashboard" class="enlace"> Volver</a>    

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; ?>