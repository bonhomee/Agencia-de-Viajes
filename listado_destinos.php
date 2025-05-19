<?php
require_once 'db.php';

// Obtener los destinos desde la base de datos
$stmt = $conn->query("SELECT * FROM Destino");
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

  <?php include 'header.php'; ?>

  <div class="container">
    <h2>Listado de Destinos</h2>
    <div class="card-container">
      <?php foreach ($destinos as $destino): ?>
        <div class="card">
          <h3><?php echo htmlspecialchars($destino['ciudad']); ?>, <?php echo htmlspecialchars($destino['pais']); ?></h3>
          <p>¿Requiere pasaporte? <?php echo $destino['requiere_pasaporte'] ? 'Sí' : 'No'; ?></p>
          <a href="destino_detalles.php?id=<?php echo $destino['id']; ?>" class="boton-card">Ver Detalles</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
