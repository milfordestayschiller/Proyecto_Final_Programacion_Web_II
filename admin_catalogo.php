<?php
session_start();
include 'conexion.php';

// Solo usuarios logueados pueden acceder
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

// Manejar inserción o edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $precio = $_POST['precio'];
  $cantidad = $_POST['cantidad'];

  if (isset($_POST['id']) && $_POST['id'] !== '') {
    // Actualizar libro existente
    $id = (int)$_POST['id'];
    $stmt = $conn->prepare("UPDATE libros SET titulo=?, autor=?, precio=?, cantidad=? WHERE id=?");
    $stmt->bind_param("ssdii", $titulo, $autor, $precio, $cantidad, $id);
  } else {
    // Insertar nuevo libro
    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, precio, cantidad) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $titulo, $autor, $precio, $cantidad);
  }

  $stmt->execute();
  $stmt->close();
  header("Location: admin_catalogo.php");
  exit();
}

// Manejar eliminación
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $conn->query("DELETE FROM libros WHERE id = $id");
  header("Location: admin_catalogo.php");
  exit();
}

// Si viene con edit
$editar = null;
if (isset($_GET['edit'])) {
  $id = (int)$_GET['edit'];
  $res = $conn->query("SELECT * FROM libros WHERE id = $id");
  $editar = $res->fetch_assoc();
}

// Obtener todos los libros
$resultado = $conn->query("SELECT * FROM libros");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Catálogo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Gestión del Catálogo</h2>

  <!-- Formulario -->
  <form action="admin_catalogo.php" method="POST" class="row g-3 mt-4">
    <input type="hidden" name="id" value="<?= $editar ? $editar['id'] : '' ?>">
    <div class="col-md-3">
      <input type="text" name="titulo" class="form-control" placeholder="Título" required value="<?= $editar ? $editar['titulo'] : '' ?>">
    </div>
    <div class="col-md-3">
      <input type="text" name="autor" class="form-control" placeholder="Autor" required value="<?= $editar ? $editar['autor'] : '' ?>">
    </div>
    <div class="col-md-2">
      <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required value="<?= $editar ? $editar['precio'] : '' ?>">
    </div>
    <div class="col-md-2">
      <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required value="<?= $editar ? $editar['cantidad'] : '' ?>">
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100"><?= $editar ? "Actualizar" : "Agregar" ?></button>
    </div>
  </form>

  <!-- Tabla -->
  <table class="table table-bordered table-striped mt-4">
    <thead class="table-dark">
      <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Precio</th>
        <th>Disponibles</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($libro = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($libro['titulo']) ?></td>
          <td><?= htmlspecialchars($libro['autor']) ?></td>
          <td>$<?= number_format($libro['precio'], 2) ?></td>
          <td><?= (int)$libro['cantidad'] ?></td>
          <td class="d-flex gap-2">
            <a href="admin_catalogo.php?edit=<?= $libro['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
            <a href="admin_catalogo.php?delete=<?= $libro['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a>
            <form action="agregar_carrito.php" method="POST" class="d-inline-flex">
              <input type="hidden" name="libro_id" value="<?= $libro['id'] ?>">
              <input type="hidden" name="cantidad" value="1">
              <button class="btn btn-primary btn-sm">+ Carrito</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="mt-3">
    <a href="carrito.php" class="btn btn-outline-success">Ver Carrito</a>
    <a href="logout.php" class="btn btn-outline-danger float-end">Cerrar Sesión</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
