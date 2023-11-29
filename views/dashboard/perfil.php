<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>    
    <form action="/perfil" class="formulario" method="POST">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" value="<?php echo $usuario->nombre; ?>" name="nombre" placeholder="Tu Nombre">
        </div>
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" value="<?php echo $usuario->email; ?>" name="email" placeholder="Tu email">
        </div>
        <div class="btnes-perfil">
            <a href="/cambiar-password" class="enlace">Cambiar Contraseña</a>
            <input type="submit" value="Guardar Cambios">
        </div>
        
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>