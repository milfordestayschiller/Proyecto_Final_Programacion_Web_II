<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Inicio de Sesión</h2>
  <form id="loginForm" method="POST" action="procesar_login.php">
    <div class="mb-3">
      <label>Email:</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Contraseña:</label>
      <input type="password" name="password" class="form-control" required id="password">
    </div>
    <button type="submit" class="btn btn-success">Entrar</button>
  </form>

  <script src="js/login-validation.js"></script>
</body>
</html>
