<h2>Mis retiros</h2>

<div class="resumen">
  <div class="tarjeta">
    <p class="gris">Cantidad de retiros</p>
    <p class="numero"><?= e($cantidad) ?></p>
  </div>
  <div class="tarjeta">
    <p class="gris">Total retirado</p>
    <p class="numero"><?= e(dinero($total)) ?></p>
  </div>
</div>

<?php if (empty($retiros)): ?>
  <p class="tarjeta">No ha realizado retiros.</p>
<?php else: ?>
  <table>
    <tr><th>Fecha</th><th>Valor</th></tr>
    <?php foreach ($retiros as $retiro): ?>
    <tr>
      <td><?= e($retiro->fecha) ?></td>
      <td><?= e(dinero($retiro->valor)) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>