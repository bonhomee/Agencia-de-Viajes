<?php
require_once 'database.php';

// Obtener los destinos desde la base de datos
$stmt = $conn->query("SELECT * FROM destino");
$destinos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Destinos</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container">
    <?php include 'header.php'; ?>

    <h2 style="display:inline-block;">Listado de Destinos</h2>
    <table class="tabla-usuarios">
      <thead>
        <tr>
          <th>Ciudad</th>
          <th>País</th>
          <th>Requiere Pasaporte</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($destinos as $destino): ?>
          <tr>
            <td><?php echo htmlspecialchars($destino['ciudad']); ?></td>
            <td><?php echo htmlspecialchars($destino['pais']); ?></td>
            <td>
              <?php
                // Mostrar 'Sí' si es true ('t' en PostgreSQL), 'No' en cualquier otro caso
                echo (isset($destino['requiere_pasaporte']) && ($destino['requiere_pasaporte'] === true || $destino['requiere_pasaporte'] === 't' || $destino['requiere_pasaporte'] === 1)) ? 'Sí' : 'No';
              ?>
            </td>
            <td>
              <a href="destino_detalles.php?id=<?php echo $destino['id_destino']; ?>" class="boton-modificar">Ver Detalles</a>
              <a href="eliminar_destino.php?id=<?= $destino['id_destino'] ?>" class="boton-eliminar" onclick="return confirm('¿Estás seguro de eliminar este destino?')">Eliminar</a>

            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
