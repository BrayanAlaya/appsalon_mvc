<h1 class="nombre-pagina">Crea una cuenta</h1>
<p class="descripcion-pagina">Ingresa tus datos para crear una cuenta</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/crear-cuenta" class="formulario" method="POST">
    <fieldset class="field-both">
        <fieldset class="field">
            <label class="field-hidden" for="nombre"></label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>" required>
            <label for="nombre">Nombre</label>
        </fieldset>
        <fieldset class="field">
            <label class="field-hidden" for="apellido"></label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $usuario->apellido ?>" required>
            <label for="apellido">Apellido</label>
        </fieldset>
    </fieldset>
    <fieldset class="field">
        <label class="field-hidden" for="telefono"></label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $usuario->telefono ?>" required>
        <label for="telefono">Teléfono</label>
    </fieldset>
    <fieldset class="field">
        <label class="field-hidden" for="email"></label>
        <input type="text" id="email" name="email" value="<?php echo $usuario->email?>" required>
        <label for="email">E-mail</label>
    </fieldset>
    <fieldset class="field">
        <label class="field-hidden" for="password"></label>
        <input type="password" id="password" name="password" required>
        <label for="password">Contraseña</label>
    </fieldset>

    <div class="enlaces">
        <a href="/">Ya tienes una cuenta?</a>
        <input type="submit" class="boton" value="Crear">
    </div>

</form>