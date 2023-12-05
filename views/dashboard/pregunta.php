<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<ul class="listado-items" id="listado-items">    
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php foreach($items as $item){ ?>
        <li class="estandar">
            <p>
                <?php echo $item->descripcion; ?>
            </p> 
        </li>    
    <?php } ?>      
</ul>
<form action="" method="POST" class="formulario">
    <div class="textoConsulta">
        <label for="titulo">Titulo de su consulta.</label>
        <input type="text" id="titulo" name="titulo">
        <label for="consulta">Escriba a continuacion su consulta.</label>
        <textarea name="consulta" id="consulta"  cols="100" rows="7">></textarea>
    </div>
    <input type="submit" class="boton" value="Realizar Pregunta">
</form>
<a href="/dashboard" class="enlace"> Volver</a>    

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; ?>