<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<ul class="listado-proyectos">
    <?php foreach($estandares as $estandar){ ?>
        <li class="proyecto">
            <a href="/estandar?id=<?php echo $estandar->id;?>">
                <?php echo $estandar->nombre; ?>
            </a>
        </li>
    <?php } ?>
</ul>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>