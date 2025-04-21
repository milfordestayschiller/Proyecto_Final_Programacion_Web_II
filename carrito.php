<?php
session_start();
include 'conexion.php';
$userId = $_SESSION['usuario_id'];

$libros = mysqli_query($conn, "SELECT * FROM LIBROS");

echo '<form method="POST" action="agregar_carrito.php">';
echo '<select name="libro_id">';
while ($libro = mysqli_fetch_assoc($libros)) {
  echo "<option value='{$libro['ID']}'>{$libro['titulo']} - $ {$libro['precio']}</option>";
}
echo '</select>';
echo '<input type="number" name="cantidad" min="1">';
echo '<button type="submit">Agregar al Carrito</button>';
echo '</form>';
?>
