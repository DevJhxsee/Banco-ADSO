<h2>Retirar dinero</h2>

<?php if ($mensaje): ?>
  <p class="exito"><?= e($mensaje) ?></p>
<?php endif; ?>

<?php if ($error): ?>
  <p class="error"><?= e($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?ruta=retiros/realizar">
  <label>Valor a retirar (sin puntos)
    <input type="text" name="valor" placeholder="Ej: 50000">
  </label>

  <label>Contraseña
    <input type="password" name="clave">
  </label>

  <button type="submit">Retirar</button>
</form>