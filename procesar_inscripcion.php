<?php
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado de inscripción</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php require_once 'header.php'; ?>

<div class="container">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'] ?? null;
    $id_destino = $_POST['id_destino'] ?? null;

    if (!$id_usuario || !$id_destino) {
        echo "<h2 class='error'>❌ Error: faltan datos del formulario.</h2>";
        echo "<a href='inscripcion.php' class='btn-volver'>Volver al formulario</a>";
    } else {
        // Verificar si el usuario tiene pasaporte
        $stmt = $conn->prepare("SELECT * FROM pasaporte WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo "<h2 class='error'>❌ No puedes inscribirte: necesitas tener un pasaporte.</h2>";
            echo "<a href='inscripcion.php' class='btn-volver'>Volver al formulario</a>";
        } else {
            $insert = $conn->prepare("INSERT INTO usuario_destino (id_usuario, id_destino) VALUES (:id_usuario, :id_destino)");
            $insert->bindParam(':id_usuario', $id_usuario);
            $insert->bindParam(':id_destino', $id_destino);

            if ($insert->execute()) {
                echo "<h2 class='exito'>✅ ¡Inscripción realizada con éxito!</h2>";
            } else {
                echo "<h2 class='error'>❌ Error: puede que ya estés inscrito en este destino.</h2>";
            }
            echo "<a href='home.php' class='btn-volver'>Volver al inicio</a>";
        }
    }
}
?>
</div>

<?php require_once 'footer.php'; ?>
</body>
</html>
