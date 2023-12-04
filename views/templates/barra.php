<div class="barra">
    <p>Hola, <?php echo $nombre ?></p>
    <a href="/logout" class="boton-rojo">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION["admin"])){?>
    <div class="enlaces">
        <a class="boton" href="/admin">Ver citas</a>
        <a class="boton" href="/servicio">Ver Servicios</a>
        <a class="boton" href="/servicio/crear">Crear Servicio</a>
    </div>
<?php }?>
