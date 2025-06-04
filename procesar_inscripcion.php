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

<div class="container">
    <?php require_once 'header.php'; ?>

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
            // Verificar si ya existe esa inscripción
            $check = $conn->prepare("SELECT * FROM usuario_destino WHERE id_usuario = :id_usuario AND id_destino = :id_destino");
            $check->bindParam(':id_usuario', $id_usuario);
            $check->bindParam(':id_destino', $id_destino);
            $check->execute();

            if ($check->rowCount() > 0) {
                echo "<h2 class='error'>⚠️ Ya estás inscrito en este destino.</h2>";
            } else {
                // Insertar la inscripción
                $insert = $conn->prepare("INSERT INTO usuario_destino (id_usuario, id_destino) VALUES (:id_usuario, :id_destino)");
                $insert->bindParam(':id_usuario', $id_usuario);
                $insert->bindParam(':id_destino', $id_destino);

                if ($insert->execute()) {
                    echo "<h2 class='exito'>✅ ¡Inscripción realizada con éxito!</h2>";
                } else {
                    echo "<h2 class='error'>❌ Error inesperado al inscribirte.</h2>";
                }
            }

        }
    }
}
?>
</div>

<?php require_once 'footer.php'; ?>
</body>
</html>
