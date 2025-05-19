<?php
require_once 'db.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Insertar el nuevo destino
    try {
        $stmt = $conn->prepare("INSERT INTO destino (ciudad, pais, requiere_pasaporte) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['ciudad'], $_POST['pais'], isset($_POST['requiere_pasaporte']) ? 1 : 0]);
        $mensaje = "Destino creado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al crear el destino: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Destino</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <h2>Crear Nuevo Destino</h2>

    <?php if ($mensaje): ?>
      <p style="color: <?php echo $mensaje === "Destino creado correctamente." ? 'green' : 'red'; ?>;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form method="POST" action="">

      <label for="ciudad">Ciudad:</label><br>
      <input type="text" name="ciudad" required><br><br>

      <label for="pais">País:</label><br>
      <input type="text" name="pais" required><br><br>

      <label for="requiere_pasaporte">¿Requiere Pasaporte?</label>
      <input type="checkbox" name="requiere_pasaporte"><br><br>

      <input type="submit" class="boton-card boton-izquierda" value="Crear Destino">

    </form>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
