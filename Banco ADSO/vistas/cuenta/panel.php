<h2>Hola, <?= e($nombre) ?></h2>

<div class="tarjeta">
  <p class="gris">Cuenta N.° <?= e($numeroCuenta) ?></p>
  <p class="gris">Saldo actual</p>
  <p class="saldo"><?= e(dinero($saldo)) ?></p>
</div>

<a class="boton" href="index.php?ruta=retiros/formulario">Retirar</a>
<a class="boton" href="index.php?ruta=transferencias/formulario">Transferir</a>