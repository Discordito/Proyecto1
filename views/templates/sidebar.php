<aside class="sidebar">
    <div class="contenedor-sidebar">
    <h2>'P.D.'</h2>
    <div class="cerrar-menu">
        <img src="build/img/cerrar.svg" alt="imagen cerrar menu" id="cerrar-menu">
    </div>
    </div>
    
    <nav class="sidebar-nav">
        <a class="<?php echo ($titulo === 'Estandares') ? 'activo' : ''; ?>" href="/dashboard">Estandares</a>
        <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
        <a class="<?php echo ($titulo === 'Registro') ? 'activo' : ''; ?>" href="/registro">Registro</a>
        <a class="<?php echo ($titulo === 'Membresia') ? 'activo' : ''; ?>" href="/membresia">Membresia</a>
    </nav>
    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>
    </div>
</aside>