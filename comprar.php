<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Seleccionar Método de Pago</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5 text-center">
    <h2>✅ ¡Compra Iniciada!</h2>
    <p class="mt-4 fs-4">¿Qué método de pago desea usar?</p>

    <div class="d-flex justify-content-center gap-4 mt-4">
      <a href="pago_tarjeta.php" class="btn btn-outline-primary btn-lg">💳 Tarjeta</a>
      <a href="pago_efectivo.php" class="btn btn-outline-success btn-lg">💵 Efectivo</a>
      <a href="pago_paypal.php" class="btn btn-outline-dark btn-lg">🪙 PayPal</a>
    </div>

    <a href="carrito.php" class="btn btn-secondary mt-5">← Volver al Carrito</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
