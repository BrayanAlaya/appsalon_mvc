<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Crear Servicio</p>

<?php include_once __DIR__ . "/../templates/barra.php" ?>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>
<form class="formulario" method="POST" action="/servicio/crear">
    <?php include_once __DIR__ . "/formulario.php" ?>
</form>