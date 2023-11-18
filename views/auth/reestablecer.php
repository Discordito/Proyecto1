<div class="contenedor reestablecer">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu Nueva Contraseña </p>
        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>
        <?php if($mostrar) { ?>
        <form method="POST" class="formulario">
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Tu Contraseña">
            </div>
            <input type="submit" class="boton" value="Guardar Contraseña">
        </form>
        <?php } ?>
        <div class="acciones">
            <a href="/crear">Crea tu Cuenta</a>
            <a href="/olvide">Olvide mi Contraseña</a>
        </div>
    </div>
</div>