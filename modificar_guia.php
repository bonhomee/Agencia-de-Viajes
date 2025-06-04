<?php
require_once 'database.php';

// Obtener el ID del guía
$id_guia = $_GET['id'] ?? null;

// Si no hay ID, redirigir
if (!$id_guia) {
    header("Location: listado_guias.php");
    exit;
}

// Obtener datos actuales del guía
$stmt = $conn->prepare("SELECT * FROM guia WHERE id_guia = :id_guia");
$stmt->bindParam(':id_guia', $id_guia, PDO::PARAM_INT);
$stmt->execute();
$guia = $stmt->fetch();

if (!$guia) {
    echo "Guía no encontrado.";
    exit;
}

// Obtener especialidades y destinos para los <select>
$especialidades = $conn->query("SELECT * FROM especialidad")->fetchAll();
$destinos = $conn->query("SELECT * FROM destino")->fetchAll();

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $id_especialidad = $_POST['id_especialidad'];
    $id_destino = $_POST['id_destino'];

    $update = $conn->prepare("UPDATE guia SET nombre = ?, apellidos = ?, id_especialidad = ?, id_destino = ? WHERE id_guia = ?");
    $success = $update->execute([$nombre, $apellidos, $id_especialidad, $id_destino, $id_guia]);

    if ($success) {
        header("Location: listado_guias.php");
        exit;
    } else {
        echo "❌ Error al actualizar la guía.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Guía</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container">
      <?php include 'header.php'; ?>

    <h2>Modificar Guía</h2>
    <form method="post">
      <label>Nombre:</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($guia['nombre']) ?>" required>

      <label>Apellidos:</label>
      <input type="text" name="apellidos" value="<?= htmlspecialchars($guia['apellidos']) ?>" required>

      <label>Especialidad:</label>
      <select name="id_especialidad" required>
        <?php foreach ($especialidades as $esp): ?>
          <option value="<?= $esp['id_especialidad'] ?>" <?= $esp['id_especialidad'] == $guia['id_especialidad'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($esp['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label>Destino:</label>
      <select name="id_destino" required>
        <?php foreach ($destinos as $dest): ?>
          <option value="<?= $dest['id_destino'] ?>" <?= $dest['id_destino'] == $guia['id_destino'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($dest['ciudad']) ?>, <?= htmlspecialchars($dest['pais']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <input type="submit" value="Guardar Cambios" class="boton-card boton-izquierda">
    </form>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
