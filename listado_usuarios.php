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
    <h2 style="display:inline-block;">Listado de Usuarios</h2>
    <a href="home.php" class="btn-volver">Volver</a>

    <table class="tabla-usuarios">
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Edad</th>
        <th>Email</th>
        <th>Modificar</th>
        <th>Eliminar</th>
      </tr>
      <?php foreach ($usuarios as $usuario): ?>
        <tr>
          <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
          <td><?php echo htmlspecialchars($usuario['apellidos']); ?></td>
          <td><?php echo htmlspecialchars($usuario['edad']); ?></td>
          <td><?php echo htmlspecialchars($usuario['email']); ?></td>
          <td>
            <a href="modificar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="boton-modificar">Modificar</a>
          </td>
          <td>
            <a href="eliminar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="boton-eliminar">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
