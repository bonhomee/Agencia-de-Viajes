<?php
require_once 'database.php';

// Verificar que el ID esté presente en la URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Obtener los detalles del usuario
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }

    // Obtener los detalles del pasaporte (si existe)
    $stmt_pasaporte = $conn->prepare("SELECT * FROM pasaporte WHERE id_usuario = ?");
    $stmt_pasaporte->execute([$id_usuario]);
    $pasaporte = $stmt_pasaporte->fetch(PDO::FETCH_ASSOC);
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

<div class="container">
  <?php include 'header.php'; ?>

  <h2>Modificar Usuario</h2>
  
  <form method="post" action="guardar_modificaciones.php">
    <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

    <?php if ($pasaporte): ?>
      <h3>Pasaporte</h3>

      <label for="numero_pasaporte">Número de Pasaporte:</label>
      <input type="text" name="numero_pasaporte" value="<?php echo htmlspecialchars($pasaporte['numero']); ?>" required>

      <label for="pais_exp">País de Expedición:</label>
      <input type="text" name="pais_exp" value="<?php echo htmlspecialchars($pasaporte['pais_exp']); ?>" required>

      <label for="fecha_validez">Fecha de Validez:</label>
      <input type="date" name="fecha_validez" value="<?php echo htmlspecialchars($pasaporte['fecha_validez']); ?>" required>

    <?php else: ?>
      <h3>Agregar Pasaporte</h3>

      <label for="numero_pasaporte">Número de Pasaporte:</label>
      <input type="text" name="numero_pasaporte" required>

      <label for="pais_exp">País de Expedición:</label>
      <input type="text" name="pais_exp" required>

      <label for="fecha_validez">Fecha de Validez:</label>
      <input type="date" name="fecha_validez" required>

    <?php endif; ?>

    <button type="submit" class="boton-card">Guardar Cambios</button>
  </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
