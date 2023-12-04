<?php foreach ($errores as $key => $values) {
    foreach ($values as $value) {
?>
        <div class="alerta <?php echo $key ?>">
            <?php echo $value ?>
        </div>
<?php
    }
} ?>