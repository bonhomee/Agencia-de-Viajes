<?php
require_once 'database.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $id_especialidad = $_POST['id_especialidad'] ?? '';
    $id_destino = $_POST['id_destino'] ?? '';

    if (empty($nombre) || empty($apellidos) || empty($dni) || empty($id_especialidad) || empty($id_destino)) {
        $mensaje = "<p class='error'>❌ Por favor, completa todos los campos.</p>";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO guia (nombre, apellidos, dni, id_especialidad, id_destino) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellidos, $dni, $id_especialidad, $id_destino]);
            $mensaje = "<p class='exito'>✅ Guía creado exitosamente.</p>";
        } catch (PDOException $e) {
            $mensaje = "<p class='error'>❌ Error: " . $e->getMessage() . "</p>";
        }
    }
}

// Obtener destinos y especialidades para los select
$destinos_stmt = $conn->query("SELECT id_destino, ciudad, pais FROM destino");
$destinos = $destinos_stmt->fetchAll(PDO::FETCH_ASSOC);

$especialidades_stmt = $conn->query("SELECT id_especialidad, nombre FROM especialidad");
$especialidades = $especialidades_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Guía</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <?php include 'header.php'; ?>

  <h2>Crear Guía</h2>

  <?= $mensaje ?>

  <form action="crear_guia.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required>

    <label for="dni">DNI:</label>
    <input type="text" id="dni" name="dni" required>

    <label for="id_especialidad">Especialidad:</label>
    <select id="id_especialidad" name="id_especialidad" required>
      <option value="">Selecciona una especialidad</option>
      <?php foreach ($especialidades as $esp): ?>
        <option value="<?= $esp['id_especialidad']; ?>"><?= htmlspecialchars($esp['nombre']); ?></option>
      <?php endforeach; ?>
    </select>

    <label for="id_destino">Destino:</label>
    <select id="id_destino" name="id_destino" required>
      <option value="">Selecciona un destino</option>
      <?php foreach ($destinos as $destino): ?>
        <option value="<?= $destino['id_destino']; ?>">
          <?= htmlspecialchars($destino['ciudad']) . ', ' . htmlspecialchars($destino['pais']); ?>
        </option>
      <?php endforeach; ?>
    </select>

    <input type="submit" class="boton-card boton-izquierda" value="Crear Guía">
  </form>

</div>

<?php include('footer.php'); ?>
</body>
</html>
