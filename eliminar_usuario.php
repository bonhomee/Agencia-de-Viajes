<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Desactivar modo autocommit para controlar la transacción
        $conn->beginTransaction();

        // 1. Eliminar relaciones en usuario_destino
        $stmt1 = $conn->prepare("DELETE FROM usuario_destino WHERE id_usuario = ?");
        $stmt1->execute([$id]);

        // 2. Eliminar pasaporte del usuario
        $stmt2 = $conn->prepare("DELETE FROM pasaporte WHERE id_usuario = ?");
        $stmt2->execute([$id]);

        // 3. Eliminar usuario
        $stmt3 = $conn->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        $stmt3->execute([$id]);

        $conn->commit();

        header("Location: listado_usuarios.php?mensaje=eliminado");
        exit;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "<h2 class='error'>❌ No se pudo eliminar el usuario: " . htmlspecialchars($e->getMessage()) . "</h2>";
        echo "<a href='listado_usuarios.php' class='boton-accion'>Volver al listado</a>";
    }
} else {
    echo "<h2 class='error'>❌ ID de usuario no proporcionado.</h2>";
    echo "<a href='listado_usuarios.php' class='boton-accion'>Volver al listado</a>";
}
?>
