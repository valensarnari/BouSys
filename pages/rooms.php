<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!---iconos --->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="../styles.css" rel="stylesheet" />
  <script src="../script.js"></script>
  <link rel="icon" type="image/svg+xml" href="../icons/bed.png" />
  <title>Suites</title>
  <style>
    .room-description {
      max-width: 800px;
      margin: 0 auto 3rem;
      text-align: center;
      font-family: "Merriweather", serif;
      font-size: 1.1rem;
      line-height: 1.6;
      color: #2c3e50;
    }


    .observer img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    /* Estilos específicos para la galería de la habitación simple */
    .gallery {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 15px;
      margin-bottom: 3rem;
    }

    .gallery .grid-item {
      position: relative;
      overflow: hidden;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery .grid-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .gallery .grid-item:first-child {
      grid-column: span 2;
      grid-row: span 2;
    }

    .gallery .grid-item:first-child img {
      height: 415px;
    }

    /* Estilos para las imágenes de la habitación completa y suite top */
    .row.gx-3,
    .row.g-2 {
      margin-bottom: 1rem;
    }

    .row.gx-3 .col,
    .row.g-2 .col {
      padding: 0.5rem;
    }
  </style>
</head>

<body class="container-fluid">
  <!-------------------------------------------------------Titulo top------------------------------>
  <header class="row top-title">
    <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
  </header>
  <!---------------------------------------------MENÚ------------------------------------------------------------->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-dark" href="../index.php" data-section="nav" data-value="services">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="services.php" data-section="nav" data-value="services">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="rooms.php" data-section="nav" data-value="rooms">Habitaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="recommendations.php" data-section="nav"
              data-value="recommendations">Recomendaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="contacto.php" data-section="nav" data-value="signup">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="receptions.php" data-section="nav" data-value="receptions">
              <img src="../icons/calendar-check.svg" alt="Reservas" /> Reservas
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
          <?php
          if (isset($_SESSION['usuario_id'])) {
            ?>
          <li class="nav-item dropdown">
            <a class="nav-link text-dark dropdown-toggle" href="#" id="perfilDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false" style="color: #212529 !important;">
              <i class="fas fa-user"></i> Perfil
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
              <li><a class="dropdown-item" href="../codigo/cliente/perfil.php" data-section="nav" data-value="perfil">Mi
                  Perfil</a></li>
              <li><a class="dropdown-item" href="../codigo/cliente/mis_reservas.php" data-section="nav"
                  data-value="reservas">Mis Reservas</a></li>
              <li><a class="dropdown-item" href="../codigo/registro_login/cerrar_sesion.php" data-section="nav"
                  data-value="cerrar-sesion">Cerrar sesión</a></li>
            </ul>
          </li>
          <?php
          } else {
            ?>
          <li class="nav-item">
            <a class="nav-link text-dark active" aria-current="page"
              href="../codigo/registro_login/panel_registro_login.php" data-section="nav" data-value="login"
              style="color: #212529 !important;">
              <i class="fas fa-user"></i> Ingreso
            </a>
          </li>
          <?php
          }
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false" data-section="nav" data-value="language">
              <i class="fas fa-globe"></i> Idioma
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
              <li>
                <div id="flags" class="flags_item dropdown-item" data-language="en">
                  <img src="../icons/gb.svg" alt="English" class="me-2" style="width: 20px" />
                  English
                </div>
              </li>
              <li>
                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es">
                  <img src="../icons/es.svg" alt="Español" class="me-2" style="width: 20px" />
                  Español
                </div>
              </li>
              <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img src="../icons/pt.svg"
                  alt="Português" class="me-2" style="width: 20px;"> Português
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-----------------------------V I D E O-------------------------------------------->
  <div class="row ratio ratio-16x9 video-first">
    <video src="../video/video-room-view.mp4" autoplay muted loop></video>
  </div>
  <!----------------------------- text above video -------------------------------------------------------->
  <div class="row txt-room-1">
    <p data-section="rooms" data-value="video-txt">
      El Hotel Continental te ofrece diferentes tipos de habitaciones
      adecuadas a tus necesidades. Desde suites de lujo con vistas panorámicas
      hasta habitaciones estándar cómodas y funcionales, encontrarás la opción
      perfecta para tu estancia. Cada habitación está equipada con todas las
      comodidades modernas para garantizar una experiencia confortable y
      placentera. ¡Esperamos que disfrutes de tu estancia!
    </p>
  </div>
  <!--------------------------------------  CARDS  ------------------------------------------->
  <div class="row align-items-end room-cards">
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="../images/room/room-simple.jpg" class="card-img-top" alt="Habitación Simple" />
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Simple</h5>
          <a href="#room-1" class="btn btn-primary mt-auto" data-section="rooms" data-value="more">Saber más...</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="../images/room/room-completa.jpeg" class="card-img-top" alt="Habitación Completa" />
        <div class="card-body d-flex flex-column">
          <h5 class="card-title" data-section="rooms" data-value="complete">
            Completa
          </h5>
          <a href="#room-2" class="btn btn-primary mt-auto" data-section="rooms" data-value="more">Saber más...</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="../images/room/room-lujosa.jpg" class="card-img-top" alt="Habitación Lujosa" />
        <div class="card-body d-flex flex-column">
          <h5 class="card-title" data-section="rooms" data-value="luxurious">
            Suite Top
          </h5>
          <a href="#room-3" class="btn btn-primary mt-auto" data-section="rooms" data-value="more">Saber más...</a>
        </div>
      </div>
    </div>
  </div>
  <!-----------------------------V I D E O-------------------------------------------->
  <div class="col-12 video-container-service-room">
    <div class="row ratio ratio-16x9 video-first">
      <video src="../video/video-service-room.mp4" autoplay muted loop></video>
    </div>
  </div>
  <!----------------------------------- Intersection Observer ------------------------------------------------------------>
  <div class="container-fluid observer">
    <!--------------------------------- ROOM TITLE SIMPLE  ------------------------------------------->
    <div class="row align-items-center room-title">
      <span class="subrayado" id="room-1">HABITACIÓN SIMPLE</span> <br><br>
    </div>
    <div class="row room-description">
      <p>
        Nuestra habitación estándar es la opción más simple y económica, ideal
        para aquellos que buscan comodidad y funcionalidad. Esta habitación
        cuenta con una cama matrimonial, una caja fuerte con capacidad para
        notebook, wifi gratuito y desayuno incluido. Perfecta para una
        estancia práctica y confortable.
      </p>
    </div>

    <div class="row">
      <div class="gallery">
        <div class="grid-item">
          <img class="img-fluid" src="../images/room/room-simple-1.jpg" />
        </div>
        <div class="grid-item">
          <img class="img-fluid" src="../images/room/room-simple-2.jpg" />
        </div>
        <div class="grid-item">
          <img class="img-fluid" src="../images/room/room-5.jpg" />
        </div>
        <div class="grid-item">
          <img class="img-fluid" src="../images/room/room-4.jpg" />
        </div>
        <div class="grid-item">
          <img class="img-fluid" src="../images/room/room-8.jpg" />
        </div>
        <div class="grid-item">
          <img class="img-fluid" src="../images/room/room_girl_luggage.jpg" />
        </div>
      </div>
    </div>
    <!--------------------------------- ROOM TITLE COMPLETA  ------------------------------------------->
    <div class="row align-items-center room-title">
      <span class="subrayado" id="room-2">HABITACIÓN COMPLETA</span> <br><br>
    </div>
    <div class="row room-description">
      <p>
        Nuestra habitación completa ofrece el máximo confort y espacio para tu
        estancia. Esta habitación cuenta con TV LED, wifi gratuito, y un
        frigobar. Además, dispone de dos ambientes: uno con una cama
        matrimonial y otro con dos camas simples, ideal para familias o grupos
        que buscan comodidad y privacidad
      </p>
    </div>

    <div class="row gx-3">
      <div class="col">
        <div class="p-3">
          <img src="../images/room/room-10.jpg" alt="" class="img-fluid" />
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <img src="../images/room/room-17.jpg" alt="" class="img-fluid" />
        </div>
      </div>
    </div>
    <div class="row gx-3">
      <div class="col">
        <div class="p-3">
          <img src="../images/room/bathroom.jpg" alt="" class="img-fluid" />
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <img src="../images/room/room-14.jpg" alt="" class="img-fluid" />
        </div>
      </div>
    </div>

    <div class="row gx-3">
      <div class="col">
        <div class="p-3">
          <img src="../images/room/room-11.jpg" alt="" class="img-fluid" />
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <img src="../images/room/room-2.jpg" alt="" class="img-fluid" />
        </div>
      </div>
    </div>
    <br /><br />
    <!--------------------------------- ROOM TITLE TOP  ------------------------------------------->
    <div class="row align-items-center room-title">
      <span class="subrayado" id="room-3">SUITE TOP</span> <br><br>
    </div>
    <div class="row room-description">
      <p>
        Nuestra habitación lujosa ofrece una experiencia de máxima comodidad y
        elegancia. Además de contar con TV LED, wifi gratuito, y un frigobar,
        esta habitación dispone de dos ambientes: uno con una cama matrimonial
        y otro con tres camas simples. También incluye un jacuzzi para
        relajarte, lavandería sin cargo, y una impresionante vista a la
        costanera. Perfecta para quienes buscan un toque extra de lujo y
        confort durante su estancia
      </p>
    </div>
    <div class="row g-2">
      <div class="col">
        <div class="p-3">
          <img class="img-fluid" src="../images/room/room-13.jpg" alt="" />
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <img class="img-fluid" src="../images/room/room-9.jpg" alt="" />
        </div>
      </div>
    </div>
    <div class="row g-2">
      <div class="col">
        <div class="p-3">
          <img class="img-fluid" src="../images/room/room-16.jpg" alt="" />
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <img class="img-fluid" src="../images/room/room-15.jpg" alt="" />
        </div>
      </div>
    </div>
  </div>
  <!-------------------------------------footer----------------------------------------------------->
  <footer class="bg-dark text-white pt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Sobre Nosotros</h5>
          <p>Información sobre la empresa.</p>
        </div>
        <div class="col-md-4">
          <h5>Enlaces</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Inicio</a></li>
            <li><a href="#" class="text-white">Servicios</a></li>
            <li><a href="#" class="text-white">Contacto</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Contacto</h5>
          <p>Email: info@ejemplo.com</p>
          <p>Teléfono: +123 456 7890</p>
        </div>
      </div>
      <div class="text-center py-3">
        © 2024 Tu Empresa. Todos los derechos reservados.
      </div>
    </div>
  </footer>

  <!---bootstrap js --->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>