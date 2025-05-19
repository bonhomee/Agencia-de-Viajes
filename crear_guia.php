<?php
// Incluir archivo de conexión
include('db.php');

// Incluir header
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $especialidad = $_POST['especialidad'];
    $id_destino = $_POST['id_destino'];

    // Validación básica
    if (empty($nombre) || empty($apellidos) || empty($especialidad) || empty($id_destino)) {
        echo "Por favor, completa todos los campos.";
    } else {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO guia (nombre, apellidos, especialidad, id_destino) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $apellidos, $especialidad, $id_destino]);

        echo "Guía creado exitosamente.";
    }
}

// Obtener los destinos disponibles para el select
$destinos_stmt = $conn->query("SELECT id_destino, ciudad, pais FROM destino");
$destinos = $destinos_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Guía</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <main>
            <h2>Crear Guía</h2>
            <form action="crear_guia.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>

                <label for="especialidad">Especialidad:</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="Geografía">Geografía</option>
                    <option value="Historia">Historia</option>
                    <option value="Arquitectura">Arquitectura</option>
                    <option value="Comida">Comida</option>
                </select>

                <label for="id_destino">Destino:</label>
                <select id="id_destino" name="id_destino" required>
                    <option value="">Selecciona un destino</option>
                    <?php foreach ($destinos as $destino): ?>
                        <option value="<?= $destino['id_destino']; ?>">
                            <?= $destino['ciudad']; ?>, <?= $destino['pais']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Crear Guía</button>
            </form>
        </main>
    </div>

    <!-- Incluir footer -->
    <?php include('footer.php'); ?>
</body>
</html>
