<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $id_destino = $_GET['id'];

    // Obtener información del destino
    $stmt = $conn->prepare("SELECT * FROM destino WHERE id_destino = ?");
    $stmt->execute([$id_destino]);
    $destino = $stmt->fetch();

    if (!$destino) {
        echo "Destino no encontrado.";
        exit;
    }

    // Obtener los usuarios inscritos en este destino
    $stmt_usuarios = $conn->prepare("
        SELECT u.*
        FROM usuario u
        JOIN usuario_destino ud ON u.id_usuario = ud.id_usuario
        WHERE ud.id_destino = ?
    ");
    $stmt_usuarios->execute([$id_destino]);
    $usuarios = $stmt_usuarios->fetchAll();

    // Obtener los guías para este destino
    $stmt_guias = $conn->prepare("
        SELECT * FROM guia
        WHERE id_destino = ?
    ");
    $stmt_guias->execute([$id_destino]);
    $guias = $stmt_guias->fetchAll();

} else {
    echo "Destino no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalles del Destino</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <h2>Detalles del Destino</h2
