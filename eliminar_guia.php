<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $id_guia = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM guia WHERE id_guia = :id_guia");
        $stmt->bindParam(':id_guia', $id_guia, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error al eliminar guía: " . $e->getMessage();
        exit;
    }
}

// Redirigir de nuevo al listado
header("Location: listado_guias.php");
exit;
