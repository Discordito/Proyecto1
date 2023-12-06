<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<div class="contenedor-sm">
<div class="contenedor-preguntas">
    <p>Preguntas de los Usuarios</p>
</div>
<div id="filtros" class="filtros">
    <div class="filtros-input">
        <h2>Filtros:</h2>
        <div class="campo">
            <label for="todas">Todas</label>
            <input type="radio" name="filtro" id="todas" value="" checked>
        </div>
        <div class="campo">
            <label for="completadas">Completadas</label>
            <input type="radio" name="filtro" id="completadas" value="1">
        </div>
        <div class="campo">
            <label for="pendientes">Pendientes</label>
            <input type="radio" name="filtro" id="pendientes" value="0">
        </div>
    </div>
</div>
<ul id="listado-preguntas" class="listado-preguntas"></ul>
</div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php $script .= '
    <script src="/build/js/preguntas.js"></script>'; ?>