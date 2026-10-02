<div class="ingreso">
  <h2>Iniciar sesión</h2>

  <?php if ($error): ?>
    <p class="error"><?= e($error) ?></p>
  <?php endif; ?>

  <form method="post" action="index.php?ruta=sesion/entrar">
    <label>Número de cuenta
      <input type="text" name="numero_cuenta">
    </label>

    <label>Contraseña
      <input type="password" name="clave">
    </label>

    <button type="submit">Entrar</button>
  </form>
</div>