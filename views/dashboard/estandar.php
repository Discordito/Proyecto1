<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<ul class="listado-items" id="listado-items">    
    <?php include_once __DIR__ . '/../templates/alertas.php.php'; ?>
    <form class="formulario" action="">
        <?php foreach($items as $item){ ?>
            <li class="estandar">
                <p>
                    <?php echo $item->descripcion; ?>
                </p>            
                    <div class="preguntas">
                        <div class="pregunta">
                            <label for="respuesta1">Muy Poco</label>
                            <input type="radio" id="respuesta1" name="<?php echo $item->id; ?>" value="1" checked/>
                        </div>
                        <div class="pregunta">
                            <label for="respuesta2">Poco</label>
                            <input type="radio" id="respuesta2" name="<?php echo $item->id; ?>" value="2"/>
                        </div>
                        <div class="pregunta">
                            <label for="respuesta3">Normal</label>
                            <input type="radio" id="respuesta3" name="<?php echo $item->id; ?>"value="3"/>
                        </div>
                        <div class="pregunta">
                            <label for="respuesta4">Mucho</label>
                            <input type="radio" id="respuesta4" name="<?php echo $item->id; ?>" value="4"/>
                        </div>
                        <div class="pregunta">
                            <label for="respuesta5">Demasiado</label>
                            <input type="radio" id="respuesta5" name="<?php echo $item->id; ?>" value="5"/>
                        </div>                  
                    </div>
                </li>        
        <?php } ?>
        <input type="button" id="respondido"  value="Guardar">        
    </form>
    <div id="puntaje" class="puntaje">
            <p>Tu puntaje es: </p>
    </div>
</ul>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/estandar.js"></script>'; ?>