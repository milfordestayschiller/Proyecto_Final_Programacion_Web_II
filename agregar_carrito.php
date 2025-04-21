<?php
session_start();
include 'conexion.php';

$userId = $_SESSION['usuario_id'];
$libroId = $_POST['libro_id'];
$cantidad = $_POST['cantidad'];

$precio_query = mysqli_query($conn, "SELECT precio FROM LIBROS WHERE ID=$libroId");
$precio = mysqli_fetch_assoc($precio_query)['precio'];
$total = $cantidad * $precio;

mysqli_query($conn, "INSERT INTO CARRITO (usuario_id, libro_id, cantidad, monto_total) VALUES ($userId, $libroId, $cantidad, $total)");
header("Location: carrito.php");
?>
