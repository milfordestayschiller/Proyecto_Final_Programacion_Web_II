<?php
include 'conexion.php';
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO LIBROS (titulo, autor, precio, cantidad) VALUES ('$titulo', '$autor', '$precio', '$cantidad')";
mysqli_query($conn, $sql);
header("Location: catalogo.php");
?>
