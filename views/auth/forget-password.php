<h1 class="nombre-pagina">Restablecer contraseña</h1>
<p class="descripcion-pagina">Ingresa el email para enviar poder restablecer tu contraseña</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/forget" class="formulario" method="POST">
    <fieldset class="field">
        <label for="email" class="field-hidden"></label>
        <input type="text" name="email" id="email" >
        <label for="email">E-mail</label>
    </fieldset>
    <input type="submit" class="boton" value="Enviar">
</form>

<div class="enlaces">
    <a href="/">Ya tienes una cuenta?</a>
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crea una</a>
</div>
