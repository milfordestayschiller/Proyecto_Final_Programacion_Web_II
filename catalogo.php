<?php
session_start();
include 'conexion.php';

// Validar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

// Obtener todos los libros del catálogo
$resultado = mysqli_query($conn, "SELECT * FROM libros");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Catálogo de Libros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Catálogo de Libros</h2>
    <table class="table table-bordered table-striped mt-3">
      <thead class="table-dark">
        <tr>
          <th>Título</th>
          <th>Autor</th>
          <th>Precio</th>
          <th>Disponibles</th>
          <th>Agregar al Carrito</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($libro = mysqli_fetch_assoc($resultado)): ?>
          <tr>
            <td><?= htmlspecialchars($libro['titulo']) ?></td>
            <td><?= htmlspecialchars($libro['autor']) ?></td>
            <td>$<?= number_format($libro['precio'], 2) ?></td>
            <td><?= (int)$libro['cantidad'] ?></td>
            <td>
              <?php if ((int)$libro['cantidad'] > 0): ?>
                <form method="POST" action="agregar_carrito.php" class="d-flex">
                  <input type="hidden" name="libro_id" value="<?= (int)$libro['id'] ?>">
                  <input type="number" name="cantidad" min="1" max="<?= (int)$libro['cantidad'] ?>" value="1" class="form-control me-2" style="width: 80px;" required>
                  <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                </form>
              <?php else: ?>
                <span class="text-danger">Agotado</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-between">
      <a href="carrito.php" class="btn btn-success">Ver Carrito</a>
      <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
