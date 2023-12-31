<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<div class="listado-recomendaciones"></div>
<ul class="listado-items" id="listado-items">    
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario" action="" method="POST">
    <input type="hidden" id="mydata" name="a"> 
        <?php foreach($items as $item){ ?>
            <li class="estandar"  >
                <p>
                    <?php echo $item->descripcion; ?>
                </p>                            
                <div class="preguntas" id="preguntas">                        
                    <div class="pregunta">
                        <label for="respuesta1">No existe</label>
                        <input type="radio" id="respuesta1" name="<?php echo $item->id; ?>" value="20" checked/>
                    </div>
                    <div class="pregunta">
                        <label for="respuesta2">Sin implementar</label>
                        <input type="radio" id="respuesta2" name="<?php echo $item->id; ?>" value="40"/> 
                    </div>
                    <div class="pregunta">
                        <label for="respuesta3">Desactualizado</label>
                        <input type="radio" id="respuesta3" name="<?php echo $item->id; ?>"value="60" />
                    </div>
                    <div class="pregunta">
                        <label for="respuesta4">Parciales</label>
                        <input type="radio" id="respuesta4" name="<?php echo $item->id; ?>" value="80"/>  
                    </div>
                    <div class="pregunta">
                        <label for="respuesta5">Completos</label>
                        <input type="radio" id="respuesta5" name="<?php echo $item->id; ?>" value="100"/>
                    </div>                  
                </div>
            </li>        
        <?php } ?>
        <div class="botones">
            <input type="button" id="respondido" class="comprobar" value="Comprobar">   
            <a href="/dashboard" class="enlace"> Volver</a>  
            <?php if(!empty($_SESSION['id'])){?>
                <input type="submit" id="registrar" class="comprobar" value="Guardar">  
            <?php }?>
        </div>          
    </form>    
</ul>
<div id="puntaje" class="puntaje">
    <p>Tu puntaje es: </p>    
</div>
<?php if($estado === '1'){?>
        <a href="/pregunta?id=<?php echo $idEstandar;?>">Hacer una pregunta</a>
    <?php } ?>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/build/js/bundle-estandar.js"></script>'; ?>