<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administracion de servicios</p>

<?php include_once __DIR__ . "/../templates/barra.php" ?>

<ul class="servicios-lista">
    <?php foreach($servicios as $servicio){?>
        <li class="servicios">
            <p><span>Nombre: </span><?php echo $servicio->nombre ?></p>
            <p><span>Precio: </span>$<?php echo $servicio->precio ?></p>
            <div class="enlaces" >
                <a href="/servicio/actualizar" class="boton">Actualizar</a>
                <form action="/servicio/eliminar" method="post">
                    <input type="hidden" name="id" value="<?php echo $servicio->id ?>">
                    <input type="submit" class="boton-rojo" value="Eliminar">
                </form>
            </div>
        </li>    
    <?php } ?>
</ul>

