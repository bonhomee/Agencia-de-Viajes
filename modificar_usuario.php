<?php
require_once 'db.php';

// Verificar que el ID esté presente en la URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Obtener los detalles del usuario
    $stmt = $conn->prepare("SELECT * FROM Usuario WHERE id = ?");
    $stmt->execute([$id_usuario]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }

    // Obtener los detalles del pasaporte (si existe)
    $stmt_pasaporte = $conn->prepare("SELECT * FROM Pasaporte WHERE usuario_id = ?");
    $stmt_pasaporte->execute([$id_usuario]);
    $pasaporte = $stmt_pasaporte->fetch();
} else {
    echo "ID de usuario no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Usuario</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <h2>Modificar Usuario</h2>
    
    <form method="post" action="guardar_modificaciones.php">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

      <label for="apellido">Apellido:</label>
      <input type="text" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>

      <label for="email">Email:</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

      <?php if ($pasaporte): ?>
        <h3>Pasaporte</h3>
        <label for="numero_pasaporte">Número de Pasaporte:</label>
        <input type="text" name="numero_pasaporte" value="<?php echo htmlspecialchars($pasaporte['numero']); ?>" required>

        <label for="fecha_emision">Fecha de Emisión:</label>
        <input type="date" name="fecha_emision" value="<?php echo htmlspecialchars($pasaporte['fecha_emision']); ?>" required>

        <label for="fecha_expiracion">Fecha de Expiración:</label>
        <input type="date" name="fecha_expiracion" value="<?php echo htmlspecialchars($pasaporte['fecha_expiracion']); ?>" required>
      <?php else: ?>
        <h3>Agregar Pasaporte</h3>
        <label for="numero_pasaporte">Número de Pasaporte:</label>
        <input type="text" name="numero_pasaporte" required>

        <label for="fecha_emision">Fecha de Emisión:</label>
        <input type="date" name="fecha_emision" required>

        <label for="fecha_expiracion">Fecha de Expiración:</label>
        <input type="date" name="fecha_expiracion" required>
      <?php endif; ?>

      <button type="submit" class="boton-card">Guardar Cambios</button>
    </form>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
