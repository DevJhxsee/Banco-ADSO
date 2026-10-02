<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($titulo ?? 'Banco ADSO') ?></title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header>
    <h1>Banco ADSO</h1>

    <?php if (isset($_SESSION['cuenta_id'])): ?>
    <nav>
      <a href="index.php?ruta=cuenta/panel">Panel</a>
      <a href="index.php?ruta=retiros/formulario">Retirar</a>
      <a href="index.php?ruta=retiros/historial">Mis retiros</a>
      <a href="index.php?ruta=transferencias/formulario">Transferir</a>
      <a href="index.php?ruta=transferencias/historial">Mis transferencias</a>
      <a href="index.php?ruta=sesion/salir">Salir</a>
    </nav>
    <?php endif; ?>
  </header>

  <main>
    <?= $contenido ?>
  </main>
</body>
</html>