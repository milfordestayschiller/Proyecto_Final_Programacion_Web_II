<?php
include 'conexion.php';
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO USUARIOS (nombre, email, contraseña, direccion, telefono)
        VALUES ('$nombre', '$email', '$password', '$direccion', '$telefono')";
mysqli_query($conn, $sql);
header("Location: login.php");
?>
