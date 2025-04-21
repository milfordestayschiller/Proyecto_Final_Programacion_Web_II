<?php
session_start();
include 'conexion.php';
$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM USUARIOS WHERE email='$email'");
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['contraseña'])) {
  $_SESSION['usuario_id'] = $user['ID'];
  header("Location: catalogo.php");
} else {
  echo "Error de inicio de sesión";
}
?>
