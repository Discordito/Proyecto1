<div class="barra-mobile">
    <h1>'S.C.'</h1>
    <div class="menu">
        <img src="build/img/menu.svg" alt="imagen menu" id="mobile-menu">
    </div>
</div>

<div class="barra">
    <?php if(empty($_SESSION['id'])){?>        
        <p>Bienvenido.</p>
        <a href="/" class="cerrar-sesion">Iniciar Sesión</a>
    <?php }?>
    <?php if(!empty($_SESSION['id'])){?>
        <p>Hola: <span> <?php echo $_SESSION['nombre'];?> </span></p>
        <a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>
    <?php }?>
    
</div>