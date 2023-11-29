<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    
    <form action="/cambiar-password" class="formulario" method="POST">
        <div class="campo">
            <label for="password_actual">Contraseña Actual:</label>
            <input type="password" name="password_actual" placeholder="Tu Contraseña Actual">
        </div>
        <div class="campo">
            <label for="password_nuevo">Contraseña Nueva:</label>
            <input type="password" name="password_nuevo" placeholder="Tu Contraseña Nueva">
        </div>
        <div class="btnes-perfil">
            <a href="/perfil" class="enlace"> Volver a Perfil</a>
            <input type="submit" value="Guardar Cambios"> 
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>