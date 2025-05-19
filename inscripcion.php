<?php
require_once 'db.php';

$mensaje = "";
$destinos = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recuperar el ID del destino y usuario del formulario
    $id_usuario = $_POST['id_usuario'];
    $id_destino = $_POST['id_destino'];

    // Comprobar si el usuario tiene pasaporte
    $stmt = $conn->prepare("SELECT id_usuario FROM pasaporte WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    $pasaporte = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pasaporte) {
        // Si tiene pasaporte, permitir inscripción al destino
        $stmt2 = $conn->prepare("INSERT INTO Usuarios_Destinos (id_usuario, id_destino) VALUES (?, ?)");
        $stmt2->execute([$id_usuario, $id_destino]);
        $mensaje = "Te has inscrito al destino con éxito.";
    } else {
        $mensaje = "No puedes inscribirte en este destino porque no tienes pasaporte.";
    }
}

// Recuperar todos los destinos disponibles
$stmt3 = $conn->query("SELECT * FROM destino");
$destinos = $stmt3->fetchAll(PDO::FETCH_ASSOC);

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
    
    <?php if ($mensaje): ?>
      <p style="color: <?php echo $mensaje === "Te has inscrito al destino con éxito." ? 'green' : 'red'; ?>;"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="">
      <label for="id_usuario">Selecciona tu Usuario:</label><br>
      <select name="id_usuario" id="id_usuario" required>
        <?php
        // Mostrar los usuarios disponibles
        $stmt4 = $conn->query("SELECT id_usuario, nombre, apellidos FROM Usuarios");
        while ($usuario = $stmt4->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$usuario['id_usuario']}'>{$usuario['nombre']} {$usuario['apellidos']}</option>";
        }
        ?>
      </select><br><br>

      <label for="id_destino">Selecciona tu Destino:</label><br>
      <select name="id_destino" id="id_destino" required>
        <?php
        // Mostrar los destinos disponibles
        foreach ($destinos as $destino) {
            echo "<option value='{$destino['id_destino']}'>{$destino['ciudad']}, {$destino['pais']}</option>";
        }
        ?>
      </select><br><br>

      <input type="submit" value="Inscribirse" class="boton-card">
    </form>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
