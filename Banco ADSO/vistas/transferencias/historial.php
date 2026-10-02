<h2>Mis transferencias</h2>

<div class="resumen">
  <div class="tarjeta">
    <p class="gris">Cantidad de transferencias</p>
    <p class="numero"><?= e($cantidad) ?></p>
  </div>
  <div class="tarjeta">
    <p class="gris">Total transferido</p>
    <p class="numero"><?= e(dinero($total)) ?></p>
  </div>
</div>

<?php if (empty($transferencias)): ?>
  <p class="tarjeta">No ha realizado transferencias.</p>
<?php else: ?>
  <table>
    <tr><th>Fecha</th><th>Valor</th></tr>
    <?php foreach ($transferencias as $transferencia): ?>
    <tr>
      <td><?= e($transferencia->fecha) ?></td>
      <td><?= e(dinero($transferencia->valor)) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>