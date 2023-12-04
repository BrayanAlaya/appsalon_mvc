<h1 class="nombre-pagina">Log-In</h1>
<p class="descripcion-pagina">Incicia sesion con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/" method="POST" class="formulario">
    <fieldset class="field">
        <label class="field-hidden" for="email"></label>
        <input type="text" id="email" name="email" required>
        <label for="email">E-mail</label>
    </fieldset>
    <fieldset class="field">
        <label class="field-hidden" for="password"></label>
        <input type="password" id="password" name="password" required>
        <label for="password">Password</label>
    </fieldset>
    <input type="submit" class="boton" value="Ingresar">
</form>

<div class="enlaces">
    <a href="/forget">¿Olvidaste tu contraseña?</a>
    <a href="/crear-cuenta">Aun no tienes una cuenta? crea una</a>
</div>