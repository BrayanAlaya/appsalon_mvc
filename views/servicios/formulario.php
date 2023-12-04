
    <fieldset class="field">
        <label class="field-hidden" for="nombre"></label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            value="<?php echo $servicio->nombre ?>" 
            
        >
        <label for="nombre">Nombre: </label>
    </fieldset>
    <fieldset class="field">
        <label class="field-hidden" for="precio"></label>
        <input 
            type="text" 
            name="precio" 
            id="precio" 
            value="<?php echo $servicio->precio ?>"
            
        >
        <label for="precio">Precio: </label>
    </fieldset>
    <input type="submit" class="boton" value="Crear">
