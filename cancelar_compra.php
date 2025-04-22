<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$userId = $_SESSION['usuario_id'];

// Eliminar todos los productos del carrito de este usuario
$query = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ?");
$query->bind_param("i", $userId);
$query->execute();

header("Location: carrito.php");
exit();
?>
