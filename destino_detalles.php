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
        SELECT g.*, e.nombre AS especialidad
        FROM guia g
        JOIN especialidad e ON g.id_especialidad = e.id_especialidad
        WHERE g.id_destino = ?
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


<div class="container">
  <?php include 'header.php'; ?>

  <h2>Detalles del Destino</h2>

  <h3>Ciudad: <?= htmlspecialchars($destino['ciudad']) ?></h3>
  <p><strong>País:</strong> <?= htmlspecialchars($destino['pais']) ?></p>
  <p><strong>Requiere Pasaporte:</strong> <?= $destino['requiere_pasaporte'] ? 'Sí' : 'No' ?></p>

  <hr>

  <h3>Usuarios Inscritos</h3>
  <?php if (count($usuarios) > 0): ?>
    <ul>
      <?php foreach ($usuarios as $u): ?>
        <li><?= htmlspecialchars($u['nombre']) ?> <?= htmlspecialchars($u['apellidos']) ?> (<?= htmlspecialchars($u['email']) ?>)</li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No hay usuarios inscritos.</p>
  <?php endif; ?>

  <hr>

  <h3>Guías Asignados</h3>
  <?php if (count($guias) > 0): ?>
    <ul>
      <?php foreach ($guias as $g): ?>
        <li><?= htmlspecialchars($g['nombre']) ?> <?= htmlspecialchars($g['apellidos']) ?> - Especialidad: <?= htmlspecialchars($g['especialidad']) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No hay guías asignados.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
