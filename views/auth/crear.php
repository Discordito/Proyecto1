<div class="contenedor crear">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu Cuenta </p>
        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>
        <form action="/crear" method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php $usuario->nombre; ?>" maxlength="30">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email" value="<?php $usuario->email; ?>" maxlength="40">
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Tu Contraseña">
                <i class="fa fa-eye" id="togglePassword"></i>
            </div>
            <div class="campo">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" name="password2" id="password2" placeholder="Repite tu Contraseña">
                <i class="fa fa-eye" id="togglePassword2"></i>
            </div>
            <p class="disclaimer">Al crear una cuenta acepta que almacenemos sus datos para uso interno del sistema.</p>
            <input type="submit" class="boton" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            <a href="/olvide">Olvide mi Contraseña</a>
        </div>
    </div>
</div>
<?php $script .= '
    <script src="build/js/app.js"></script>'; ?>