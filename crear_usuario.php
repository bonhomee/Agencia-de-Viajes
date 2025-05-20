<?php
require_once 'database.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Insertar usuario
        $stmt = $conn->prepare("INSERT INTO usuario (nombre, apellidos, dni, edad, email) VALUES (?, ?, ?, ?, ?) RETURNING id_usuario");
        $stmt->execute([
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['dni'],
            $_POST['edad'],
            $_POST['email']
        ]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $usuario['id_usuario'];

        // Si se marca que quiere crear pasaporte
        if (isset($_POST['crear_pasaporte'])) {
            $stmt = $conn->prepare("INSERT INTO pasaporte (numero, pais_exp, fecha_validez, id_usuario) VALUES (?, ?, ?,)");
            $stmt->execute([
                $_POST['numero'],
                $_POST['pais_exp'],
                $_POST['fecha_validez'],
                $id_usuario
]);

        }

        $mensaje = "Usuario creado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Usuario</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<?php include 'header.php'; ?>
  <h2>Crear Usuario</h2>
  <?php if ($mensaje): ?>
    <p style="color: green;"><?php echo $mensaje; ?></p>
  <?php endif; ?>
  <form method="post" action="">

 
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Apellidos:</label><br>
    <input type="text" name="apellidos" required><br><br>

    <label>DNI:</label><br>
    <input type="text" name="dni" required><br><br>

    <label>Edad:</label><br>
    <input type="number" name="edad" min="18" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>
      <input type="checkbox" name="crear_pasaporte" id="checkPasaporte" onchange="mostrarPasaporte()"> ¿Crear también pasaporte?
    </label><br><br>

    <div id="datosPasaporte" style="display:none;">
      <label>Número de Pasaporte:</label><br>
      <input type="text" name="numero"><br><br>

      <label>País de Expedición:</label><br>
      <input type="text" name="pais_expedicion"><br><br>
    </div>

    <input type="submit" class="boton-card boton-izquierda" value="Aceptar">

  </form>
  <?php include 'footer.php'; ?>
</div>

<script>
  function mostrarPasaporte() {
    const check = document.getElementById("checkPasaporte");
    const div = document.getElementById("datosPasaporte");
    div.style.display = check.checked ? "block" : "none";
  }
</script>
</body>
</html>
