<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['email']; // ahora usamos la columna 'correo'
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO usuarios (nombre, correo, contraseña, direccion, telefono)
        VALUES ('$nombre', '$correo', '$password', '$direccion', '$telefono')";

mysqli_query($conn, $sql);
header("Location: login.php");
?>
