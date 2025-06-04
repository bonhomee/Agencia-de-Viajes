<?php
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar destino</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<div class="container">
    <?php include 'header.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id_destino = $_GET['id'];

    // Verificar si el destino existe
    $stmt = $conn->prepare("SELECT * FROM destino WHERE id_destino = ?");
    $stmt->execute([$id_destino]);
    $destino = $stmt->fetch();

    if (!$destino) {
        echo "<h2 class='error'>❌ El destino no existe.</h2>";
    } else {
        // Eliminar relaciones de claves foráneas primero (si existen)
        $conn->prepare("DELETE FROM usuario_destino WHERE id_destino = ?")->execute([$id_destino]);
        $conn->prepare("DELETE FROM guia WHERE id_destino = ?")->execute([$id_destino]);

        // Eliminar destino
        $delete = $conn->prepare("DELETE FROM destino WHERE id_destino = ?");
        if ($delete->execute([$id_destino])) {
            echo "<h2 class='exito'>✅ Destino eliminado correctamente.</h2>";
        } else {
            echo "<h2 class='error'>❌ Error al eliminar el destino.</h2>";
        }
    }
} else {
    echo "<h2 class='error'>❌ No se ha especificado ningún destino.</h2>";
}
?>

<a href="listado_destinos.php" class="btn-volver">Volver al listado</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
