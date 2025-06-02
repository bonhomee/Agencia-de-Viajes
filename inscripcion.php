<?php
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Inscripción</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
  <h2>Formulario de Inscripción</h2>

  <form method="post" action="procesar_inscripcion.php">

    <!-- Selector de Usuario -->
    <label for="id_usuario">Selecciona tu Usuario:</label><br>
    <select name="id_usuario" id="id_usuario" required>
      <option value="">Selecciona un usuario</option>
      <?php
      try {
          $stmt = $conn->query("SELECT id_usuario, nombre, apellidos FROM usuario");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $id = htmlspecialchars($row['id_usuario']);
              $nombre = htmlspecialchars($row['nombre']);
              $apellidos = htmlspecialchars($row['apellidos']);
              echo "<option value=\"$id\">$nombre $apellidos</option>";
          }
      } catch (PDOException $e) {
          echo "<option disabled>Error cargando usuarios</option>";
      }
      ?>
    </select><br><br>

    <!-- Selector de Destino -->
    <label for="id_destino">Selecciona un Destino:</label><br>
    <select name="id_destino" id="id_destino" required>
      <option value="">Selecciona un destino</option>
      <?php
      try {
          $stmt = $conn->query("SELECT id_destino, ciudad, pais FROM destino");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $id = htmlspecialchars($row['id_destino']);
              $ciudad = htmlspecialchars($row['ciudad']);
              $pais = htmlspecialchars($row['pais']);
              echo "<option value=\"$id\">$ciudad, $pais</option>";
          }
      } catch (PDOException $e) {
          echo "<option disabled>Error cargando destinos</option>";
      }
      ?>
    </select><br><br>

    <input type="submit" value="Inscribirse">
  </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
