
<h1 class="nombre-pagina">Restablecer Contraseña</h1>
<p class="descripcion-pagina">Ingresa tu nueva contraseña y luego repitela</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<?php if ($error) {
    return;
} ?>

<form method="POST" class="formulario">

    <fieldset class="field">
        <label for="password" class="field-hidden"></label>
        <input type="password" name="password" id="password" >
        <label for="password">Contraseña:</label>
    </fieldset>
    <fieldset class="field">
        <label for="passwordRepeat" class="field-hidden"></label>
        <input type="password" name="passwordRepeat" id="passwordRepeat" >
        <label for="passwordRepeat">Repetir Contraseña:</label>
    </fieldset>

    <input type="submit" class="boton" value="Restablecer">

</form>

<div class="enlaces">
    <a href="/">¿Ya tienes cuenta?, Inicia Sesion</a>
    <a href="/crear-cuenta">Aun no tienes cuenta?, Crea una</a>
</div>

