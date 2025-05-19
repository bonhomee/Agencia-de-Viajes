<?php
require_once 'db.php';

// Obtener el destino desde la base de datos
if (isset($_GET['id'])) {
    $id_destino = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM destino WHERE id = ?");
    $stmt->execute([$id_destino]);
    $destino = $stmt->fetch();

    // Obtener los usuarios inscritos en este destino
    $stmt_usuarios = $conn->prepare("SELECT * FROM usuario WHERE destino_id = ?");
    $stmt_usuarios->execute([$id_destino]);
    $usuarios = $stmt_usuarios->fetchAll();

    // Obtener las guías para este destino
    $stmt_guias = $conn->prepare("SELECT * FROM guia WHERE destino_id = ?");
    $stmt_guias->execute([$id_destino]);
    $guias = $stmt_guias->fetchAll();
} else {
    echo "Destino no encontrado.";
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
    <h2>Detalles del Destino</h2>
    <h3><?php echo htmlspecialchars($destino['ciudad']); ?>, <?php echo htmlspecialchars($destino['pais']); ?></h3>
    <p>¿Requiere pasaporte? <?php echo $destino['requiere_pasaporte'] ? 'Sí' : 'No'; ?></p>

    <h4>Usuarios Inscritos</h4>
    <div class="card-container">
      <?php foreach ($usuarios as $usuario): ?>
        <div class="card">
          <h5><?php echo htmlspecialchars($usuario['nombre']); ?> <?php echo htmlspecialchars($usuario['apellido']); ?></h5>
          <p>Email: <?php echo htmlspecialchars($usuario['email']); ?></p>
          <a href="modificar_usuario.php?id=<?php echo $usuario['id']; ?>" class="boton-card">Modificar</a>
        </div>
      <?php endforeach; ?>
    </div>

    <h4>Guías</h4>
    <div class="card-container">
      <?php foreach ($guias as $guia): ?>
        <div class="card">
          <h5><?php echo htmlspecialchars($guia['nombre']); ?></h5>
          <p>Descripción: <?php echo htmlspecialchars($guia['descripcion']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
