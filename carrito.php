<?php
session_start();
include 'conexion.php';

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$userId = $_SESSION['usuario_id'];

// Obtener datos del carrito
$query = $conn->prepare("
  SELECT c.id, l.titulo, l.precio, c.cantidad, c.monto_total 
  FROM carrito c 
  JOIN libros l ON c.libro_id = l.id 
  WHERE c.usuario_id = ?
");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();

$carrito = [];
$total_general = 0;
while ($fila = $result->fetch_assoc()) {
  $carrito[] = $fila;
  $total_general += $fila['monto_total'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Compras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>🛒 Carrito de Compras</h2>

    <?php if (count($carrito) === 0): ?>
      <div class="alert alert-info mt-4">No hay productos en tu carrito.</div>
    <?php else: ?>
      <table class="table table-bordered mt-4">
        <thead class="table-dark">
          <tr>
            <th>Título</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($carrito as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['titulo']) ?></td>
              <td>$<?= number_format($item['precio'], 2) ?></td>
              <td><?= $item['cantidad'] ?></td>
              <td>
                $<?= number_format($item['monto_total'], 2) ?>
                <form action="eliminar_item.php" method="POST" class="d-inline">
                  <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-outline-danger ms-2">Cancelar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="d-flex justify-content-between align-items-center mt-4">
        <h4>Total: $<?= number_format($total_general, 2) ?></h4>

        <div>
          <form action="comprar.php" method="POST" class="d-inline">
            <button type="submit" class="btn btn-success">✅ Comprar</button>
          </form>
          <form action="cancelar_compra.php" method="POST" class="d-inline ms-2">
            <button type="submit" class="btn btn-danger">🗑️ Cancelar todas las compras</button>
          </form>
        </div>
      </div>
    <?php endif; ?>

    <a href="catalogo.php" class="btn btn-primary mt-4">← Volver al Catálogo</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
