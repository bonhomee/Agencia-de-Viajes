  <?php
  require_once 'database.php';

  // Obtener los usuarios desde la base de datos
  $stmt = $conn->query("SELECT * FROM Usuario");
  $usuarios = $stmt->fetchAll();
  ?>

  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <?php include 'header.php'; ?>

    <div class="container">
      <h2>Listado de Usuarios</h2>
      <div class="card-container">
        <?php foreach ($usuarios as $usuario): ?>
          <div class="card">
  <h3><?php echo htmlspecialchars($usuario['nombre']); ?> <?php echo htmlspecialchars($usuario['apellidos']); ?></h3>
  <p>Email: <?php echo htmlspecialchars($usuario['email']); ?></p>

  <!-- Contenedor para los botones -->
  <div class="botones-container">
    <a href="modificar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="boton-card">Modificar</a>
    <a href="eliminar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="boton-card">Eliminar</a>
  </div>
</div>

        <?php endforeach; ?>
      </div>
    </div>

    <?php include 'footer.php'; ?>

  </body>
  </html>

