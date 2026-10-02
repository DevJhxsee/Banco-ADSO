<h2>Transferir dinero</h2>

<?php if ($mensaje): ?>
  <p class="exito"><?= e($mensaje) ?></p>
<?php endif; ?>

<?php if ($error): ?>
  <p class="error"><?= e($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?ruta=transferencias/realizar">
  <label>Cuenta destino
    <input type="text" name="numero_destino">
  </label>

  <label>Valor a transferir (sin puntos)
    <input type="text" name="valor" placeholder="Ej: 50000">
  </label>

  <label>Contraseña
    <input type="password" name="clave">
  </label>

  <button type="submit">Transferir</button>
</form>