<h1 class="nombre-pagina">Panel Administrativo</h1>

<?php include_once __DIR__ . "/../templates/barra.php"; ?>


<div class="busqueda">
    <h3>Buscar Citas</h3>
    <form class="formulario">
        <fieldset class="field">
            <label for="fecha" class="field-hidden"></label>
            <input type="date" value="<?php echo $fecha?>" id=fecha name="fecha" required>
            <label for="fecha">Fecha</label>
        </fieldset>
    </form>
</div>
<div class="citas-admin">
    <ul class="lista-citas">
        <?php
        $idCitas = 0;
        $totalPagar = 0;
        if ($citas == []) {
        ?>   
            <p>No hay citas.</p>
        <?php
        }
        foreach ($citas as $key => $cita) { ?>
            <?php if ($idCitas !== $cita->id) { ?>
                <li class="citas">
                    <p><span>Id: </span><?php echo $cita->id ?></p>
                    <p><span>Cliente: </span><?php echo $cita->cliente ?></p>
                    <p><span>Hora: </span><?php echo $cita->hora ?></p>
                    <p><span>email: </span><?php echo $cita->email ?></p>
                    <p><span>telefono: </span><?php echo $cita->telefono ?></p>
                    <?php
                    $idCitas = $cita->id;
                    $totalPagar = 0;
                    ?>
                    <h3>Servicios</h3>
                <?php }; ?>
                <p><?php echo $cita->servicio ?>: <?php echo $cita->precio ?></p>
                <?php
                $totalPagar += $cita->precio;
                $idSiguiente = $citas[$key + 1]->id ?? 0;
                if ($idCitas !== $idSiguiente) {
                ?>
                    <p class="total-precio-cita-admin"><span>Total: </span> <?php echo $totalPagar ?></p>
                    <form action="/delete" method="POST"  class="formulario">
                        <input type="hidden" name="id" value="<?php echo $cita->id ?>" id="id">
                        <input type="submit" value="Eliminar" class="boton-rojo">
                    </form>    
                    
                <?php } ?>
            <?php }; ?>
    </ul>
</div>
<?php 

$script = "<script src='build/js/buscador.js' ></script>";
?>
