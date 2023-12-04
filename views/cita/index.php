<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php include_once __DIR__ . "/../templates/barra.php"; ?>

<div id="app">
    <nav class="tab">
        <button type="button" data-paso="1" class="boton">Servicios</button>
        <button type="button" data-paso="2" class="boton">Informacion cita</button>
        <button type="button" data-paso="3" class="boton">Resumen</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h1>Servicios</h1>
        <p>Elige tus servicios</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h1>Citas</h1>
        <p>Ingresa tus datos y fehca para la cita</p>

        <form method="POST" class="formulario">
            <input type="hidden" value="<?php echo $id ?>" id="id">
            <fieldset class="field">
                <label for="name" class="field-hidden"></label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="<?php echo $nombre ?>" 
                    disabled
                >
                <label for="name">Nombre</label>
            </fieldset>
            <fieldset class="field">
                <label for="date" class="field-hidden"></label>
                <input 
                    type="date" 
                    name="date" 
                    id="date" 
                    min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>"
                    required
                >
                <label for="name">Fecha</label>
            </fieldset>
            <fieldset class="field">
                <label for="time" class="field-hidden"></label>
                <input 
                    type="time" 
                    name="time" 
                    id="time" 
                    required
                >
                <label for="time">Hora</label>
            </fieldset>
        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h1>Resumen</h1>
        <p>verifica que la relacion sea correcta</p>
    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">
        &laquo; Anterior
        </button>
        <button id="siguiente" class="boton">
        Siquiente &raquo; 
        </button>
    </div>
</div>

<?php 

$script = "
    <link href='https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js'></script>
    <script src='build/js/app.js'></script>
";

?>
