<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$userId = $_SESSION['usuario_id'];
$itemId = $_POST['item_id'];

$query = $conn->prepare("DELETE FROM carrito WHERE id = ? AND usuario_id = ?");
$query->bind_param("ii", $itemId, $userId);
$query->execute();

header("Location: carrito.php");
exit();
?>
