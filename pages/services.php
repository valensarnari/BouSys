<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../styles.css" rel="stylesheet">
    <script src="../script.js"></script>
    <title>Services</title>

    <style>
        .observer {
            padding: 2rem 0;
        }
        
        .card-services {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .card-services:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .card-services .col-md-4 {
            overflow: hidden;
        }

        .card-services img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card-services:hover img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 2rem;
        }

        .resto-description {
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
        }
        .description {
            font-family: "Merriweather", serif;
            font-size: 1.1rem;
            color: #2c3e50;
        }
    </style>

</head>

<body class="container-fluid">
    <script>
        document.title = "\uD83E\uDDF3 Services";
    </script>
    <!-------------------------------------------------------Titulo top------------------------------>
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <!---------------------------------------------MENÚ------------------------------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
            aria-controls="navbarContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a
                      class="nav-link text-dark"
                      href="../index.php"
                      data-section="nav"
                      data-value="home"
                      >Inicio</a
                    >
                </li>
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href="services.php"
                  data-section="nav"
                  data-value="services"
                  >Servicios</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href="rooms.php"
                  data-section="nav"
                  data-value="rooms"
                  >Habitaciones</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href="recommendations.php"
                  data-section="nav"
                  data-value="recommendations"
                  >Recomendaciones</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href="contacto.php"
                  data-section="nav"
                  data-value="signup"
                  >Contacto</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href="receptions.php"
                >
                  <img src="../icons/calendar-check.svg" alt="Reservas" /> <span data-section="nav" data-value="receptions">Reservas</span>
                </a>
              </li>
            </ul>
  
            <ul class="navbar-nav ms-auto">
              <?php
              if(isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2) {
              ?>
                <li class="nav-item dropdown">
                  <a class="nav-link text-dark dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #212529 !important;">
                    <i class="fas fa-user"></i> Perfil
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                    <li><a class="dropdown-item" href="../codigo/cliente/perfil.php" data-section="nav" data-value="perfil">Mi Perfil</a></li>
                    <li><a class="dropdown-item" href="../codigo/cliente/mis_reservas.php" data-section="nav" data-value="reservas">Mis Reservas</a></li>
                    <li><a class="dropdown-item" href="../codigo/registro_login/cerrar_sesion.php" data-section="nav" data-value="cerrar-sesion">Cerrar sesión</a></li>
                  </ul>
                </li>
              <?php
              } else {
              ?>
                <li class="nav-item">
                  <a class="nav-link text-dark active" aria-current="page" href="../codigo/registro_login/panel_registro_login.php" style="color: #212529 !important;">
                    <i class="fas fa-user"></i> <span data-section="nav" data-value="perfilnav">Ingreso</span>
                  </a>
                </li>
              <?php
              }
              ?>
              <li class="nav-item dropdown">
                <a
                  class="nav-link text-dark dropdown-toggle"
                  href="#"
                  id="languageDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="fas fa-globe"></i> <span data-section="nav" data-value="language">Idioma</span>
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="languageDropdown"
                >
                  <li>
                    <div
                      id="flags"
                      class="flags_item dropdown-item"
                      data-language="en"
                    >
                      <img
                        src="../icons/gb.svg"
                        alt="English"
                        class="me-2"
                        style="width: 20px"
                      />
                      English
                    </div>
                  </li>
                  <li>
                    <div
                      id="flag-es"
                      class="flags_item_es dropdown-item"
                      data-language="es"
                    >
                      <img
                        src="../icons/es.svg"
                        alt="Español"
                        class="me-2"
                        style="width: 20px"
                      />
                      Español
                    </div>
                  </li>
                    <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                        src="../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;"> Português
                    </div>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-------------------------------------------Center title-------------------------------------------------------------------->
    <div class="row align-items-center room-title">
        <span class="subrayado" id="room-3" data-section="services" data-value="title-1">Nuestros servicios</span>
    </div>
    <!--------------------------------------  CARDS  ------------------------------------------->
    <div class="container services-container">
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <div class="col">
                <div class="card h-100">
                    <img src="../images/garage/cars.jpg" class="card-img-top" alt="Garage">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Garage</h5>
                        <a href="#garage" class="btn btn-primary mt-auto">Saber más...</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="../images/services/baby-cot-1.jpg" class="card-img-top" alt="Baby">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Baby</h5>
                        <a href="#baby" class="btn btn-primary mt-auto">Saber más...</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="../images/services/laundry-1.jpg" class="card-img-top" alt="Laundry">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Laundry</h5>
                        <a href="#laundry" class="btn btn-primary mt-auto">Saber más...</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="../images/spa/spa_1.jpg" class="card-img-top" alt="Spa">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Spa</h5>
                        <a href="#spa" class="btn btn-primary mt-auto">Saber más...</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="../images/bar_resto/bar_1.jpg" class="card-img-top" alt="Restaurant">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Restaurant</h5>
                        <a href="#resto" class="btn btn-primary mt-auto">Saber más...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------------V I D E O-------------------------------------------->
    <div class="row ratio ratio-16x9 video-first">
        <video src="../video/video-resto.mp4" autoplay muted loop></video>
    </div>
    <!----------------------------------- Intersection Observer ------------------------------------------------------------>
    <div class="container-fluid observer">
        <!-------------------------------------------Resto title-------------------------------------------------------------------->
        <div class="row align-items-center room-title">
            <span class="subrayado" id="resto" id="resto">RESTORANT</span>
        </div>
        <br>
        <div class="card-services mb-3" style="width: 100%">
            <div class="row g-0">
                <div class="col-md-4 hidden">
                    <img src="../images/bar_resto/restaurant-service.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text resto-description description">
                            El Continental Hotel se enorgullece de albergar un restaurante y bar de renombre, conocido
                            por ser el escenario de eventos importantes y celebraciones exclusivas. <br> 
                            Su gastronomía excepcional ha sido reconocida con estrellas Michelin, destacándose 
                            por su creatividad y calidad. Los huéspedes y visitantes pueden disfrutar de una experiencia 
                            culinaria inigualable, donde cada plato es una obra de arte que refleja la pasión y el talento de nuestros chefs.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------Garage title-------------------------------------------------------------------->
        <div class="row align-items-center room-title">
            <span class="subrayado" id="garage">GARAGE</span>
        </div>
        <br>
        <!-----------------------------garage horizontal card-------------------------------------------->
        <div class="card-services mb-3" style="width: 100%">
            <div class="row g-0">
                <div class="col-md-4 hidden">
                    <img src="../images/garage/garage-services.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text resto-description description">
                            El Continental Hotel ofrece un servicio de garaje y guardería de coches de primera clase,
                            garantizando la máxima seguridad y trasnquilidad para sus huéspedes, gracias a nuestra 
                            seguridad privada las 24 horas, nuestros clientes pueden estar tranquilos sabiendo 
                            que sus vehículos están protegidos en todo momento. Además, nuestro equipo de valet parking 
                            se encarga de estacionar y cuidar cada coche con la mayor atención y profesionalismo, asegurando 
                            una experiencia sin preocupaciones desde el momento de la llegada hasta la salida.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-------------------------------------------Spa title-------------------------------------------------------------------->
        <div class="row align-items-center room-title">
            <span class="subrayado" id="spa">SPA</span>
        </div>
        <br>
        <div class="card-services mb-3" style="width: 100%">
            <div class="row g-0">
                <div class="col-md-4 hidden">
                    <img src="../images/spa/spa-service.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text resto-description description">
                            Sumérgete en un oasis de tranquilidad en el spa del Continental Hotel. 
                            Disfruta de tratamientos rejuvenecedores, masajes terapéuticos y una 
                            variedad de servicios diseñados para revitalizar tu cuerpo y mente. 
                            Nuestro SPA ofrece un ambiente sereno y lujoso, perfecto para relajarte 
                            y escapar del estrés diario. Buscamos que pases un momento de relax y relajación, 
                            para que puedas disfrutar de una estancia cómoda y sin preocupaciones. <br>
                            Tu salud y bienestar son nuestra prioridad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <!-----------------------------baby horizontal card-------------------------------------------->
        <div class="row align-items-center room-title">
            <span class="subrayado" id="cuna">CUNA</span>
        </div>
        <br>
        <div class="card-services mb-3" style="width: 100%" id="baby">
            <div class="row g-0">
                <div class="col-md-4 hidden">
                    <img src="../images/services/baby-cot.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text resto-description description">
                            En el Continental Hotel, nos preocupamos por el bienestar de toda tu familia. <br>
                            Por eso, ofrecemos un servicio gratuito de cuna para nuestros huéspedes con bebés. 
                            Disfruta de una estancia en donde no tendrás que dormir con tu bebé en la misma cama, 
                            sino que tu pequeño descansará plácidamente en una cuna segura y confortable, proporcionada sin costo adicional
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-----------------------------laundry horizontal card-------------------------------------------->
        <div class="row align-items-center room-title">
            <span class="subrayado" id="laundry">LAUNDRY</span>
        </div>
        <br>
        <div class="card-services mb-3" style="width: 100%" id="laundry">
            <div class="row g-0">
                <div class="col-md-4 hidden">
                    <img src="../images/services/laundry-service.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text resto-description description">
                            Mantén tu ropa impecable con nuestro servicio de lavandería del Continental Hotel. <br> 
                            Ofrecemos un servicio eficiente y de alta calidad para todos nuestros huéspedes.
                            Aunque este servicio tiene un costo adicional, es completamente gratuito para nuestros clientes
                            top, asegurando que disfruten de la máxima comodidad y atención durante su estancia. <br>
                            Ya no tendrás que preocuparte por lavar tu ropa y sacar las manchas difíciles, ya que nosotros nos encargamos de ello.
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
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
