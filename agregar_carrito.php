<?php
session_start();
include 'conexion.php';

// Validar que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

// Validar campos recibidos
if (!isset($_POST['libro_id']) || !isset($_POST['cantidad'])) {
  die("Error: Datos incompletos.");
}

$userId = $_SESSION['usuario_id'];
$libroId = intval($_POST['libro_id']);
$cantidad = intval($_POST['cantidad']);

// Buscar el libro en la base de datos
$stmt = $conn->prepare("SELECT precio FROM libros WHERE id = ?");
$stmt->bind_param("i", $libroId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Error: Libro no encontrado.");
}

$libro = $result->fetch_assoc();
$precio = $libro['precio'];
$total = $precio * $cantidad;

// Insertar en el carrito
$insert = $conn->prepare("INSERT INTO carrito (usuario_id, libro_id, cantidad, monto_total) VALUES (?, ?, ?, ?)");
$insert->bind_param("iiid", $userId, $libroId, $cantidad, $total);
$insert->execute();

header("Location: carrito.php");
exit();
?>
