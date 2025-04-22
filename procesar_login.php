<?php
session_start();
include 'conexion.php';

$correo = $_POST['email'];
$password = $_POST['password'];

// Usamos sentencia preparada para mayor seguridad
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['contraseña'])) {
    $_SESSION['usuario_id'] = $user['id'];
    header("Location: catalogo.php");
    exit();
} else {
    echo "Error de inicio de sesión: correo o contraseña incorrectos.";
}

$stmt->close();
$conn->close();
?>
