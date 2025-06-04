<?php
require_once 'database.php';

$stmt = $conn->query("SELECT * FROM destino LIMIT 3 ");
$destinos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agencia de Viajes</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Encode+Sans+Expanded:wght@400;600&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <header class="header">
        <img src="img/logo.png" alt="Logo DAW" class="logo" />
        <nav class="nav">
          <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="inscripcion.php">Formulario</a></li>
            <li><a href="crear_destino.php">Crear Destino</a></li>
            <li><a href="crear_guia.php">Crear Guía</a></li>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropbtn">Listados</a>
              <ul class="dropdown-content">
                <li><a href="listado_destinos.php">Listado de destinos</a></li>
                <li><a href="listado_usuarios.php">Listado de usuarios</a></li>
                <li><a href="listado_guias.php">Listado de guías</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        <a href="crear_usuario.php" class="boton-menu">Crear Usuario</a>
      </header>

      <section class="hero">
        <div class="hero-text">
          <h1>Discover the Best Lovely Places</h1>
          <p>Plan and book your perfect trip with expert advice, travel tips, destination information and inspiration from us.</p>
        </div>
        <div class="hero-image">
          <img src="img/section1.png" alt="Person with passport" class="main-image"/>
          <img src="img/mapa.png" alt="Map icon" class="map-icon" />
          <img src="img/globo.png" alt="Globo icon" class="globo-icon" />
        </div>
      </section>

      <section class="destinations">
        <h2>Find Popular Destination</h2>

        <div class="cards-container">
          <?php if (count($destinos) > 0): ?>
            <?php foreach ($destinos as $destino): ?>
              <div class="card">
                <img src="img/default.jpg" alt="Destino" class="card-img" />
                <h3><?= htmlspecialchars($destino['ciudad']) ?>, <?= htmlspecialchars($destino['pais']) ?></h3>
                <p><?= $destino['requiere_pasaporte'] ? 'Requiere Pasaporte' : 'No requiere pasaporte' ?></p>
                <a href="destino_detalles.php?id=<?= $destino['id_destino'] ?>" class="boton-card">Ver Detalles</a>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No hay destinos disponibles por el momento.</p>
          <?php endif; ?>
        </div>
      </section>

      <section class="newsletter">
        <h2>Sign up to our newsletter</h2>
        <p>Recibe noticias, novedades y más cosas cada semana.</p>
        <input type="email" placeholder="Introduce tu correo electrónico" />
      </section>
    </div>
   
    <footer class="footer">
      <img src="img/logo.png" alt="Footer Logo" class="logo-footer" />
      <p>Enjoy the touring</p>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank">
          <img src="img/facebook.png" alt="Facebook" />
        </a>
        <a href="https://instagram.com" target="_blank">
          <img src="img/instagram.png" alt="Instagram" />
        </a>
        <a href="https://twitter.com" target="_blank">
          <img src="img/twitter.png" alt="Twitter" />
        </a>
      </div>
    </footer>
  </body>
</html>
