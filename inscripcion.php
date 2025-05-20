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

    <label for="id_usuario">Selecciona tu Usuario:</label><br>
    <select name="id_usuario" required>
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

    <!-- Aquí podrías añadir más campos según lo que vaya a inscribirse el usuario -->

    <input type="submit" value="Inscribirse">
  </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
