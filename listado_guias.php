<?php
require_once 'database.php';

// Consulta para obtener guías con su especialidad y destino
$sql = "SELECT 
            g.id_guia,
            g.nombre,
            g.apellidos,
            e.nombre AS especialidad,
            d.ciudad AS ciudad_destino,
            d.pais AS pais_destino
        FROM guia g
        JOIN especialidad e ON g.id_especialidad = e.id_especialidad
        JOIN destino d ON g.id_destino = d.id_destino";

$stmt = $conn->prepare($sql);
$stmt->execute();
$guias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Guías</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
  <h2 style="display:inline-block;">Listado de Guías</h2>
  <a href="home.php" class="btn-volver">Volver</a>

  <table class="tabla-usuarios">
    <tr>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Especialidad</th>
      <th>Destino</th>
      <th>Acciones</th>
    </tr>
    <?php foreach ($guias as $guia): ?>
      <tr>
        <td><?php echo htmlspecialchars($guia['nombre']); ?></td>
        <td><?php echo htmlspecialchars($guia['apellidos']); ?></td>
        <td><?php echo htmlspecialchars($guia['especialidad']); ?></td>
        <td><?php echo htmlspecialchars($guia['ciudad_destino']) . ", " . htmlspecialchars($guia['pais_destino']); ?></td>
        <td>
          <!-- Puedes añadir acciones como editar o eliminar si las necesitas -->
          <a href="modificar_guia.php?id=<?php echo $guia['id_guia']; ?>" class="boton-modificar">Modificar</a>
          <a href="eliminar_guia.php?id=<?php echo $guia['id_guia']; ?>" class="boton-eliminar">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
