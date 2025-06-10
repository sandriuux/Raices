<!doctype html>
<html lang="en">
<head>
    <title>RAÍCES</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" href="../img/restaurante.png">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/nav.css">

    <script rel="script" src="../js/login.js"></script>

</head>
<body>

<section id="inicio" class="container mt-4" style="scroll-margin-top: 10em">
          <nav class="navbar navbar-expand-lg bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand text-white font-family_nav" style="font-size: 25px;" href="index.php #inicio">Raíces ||</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link text-white font-family_nav" href="index.php #historia">Historia |</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white font-family_nav" href="index.php #menu">Menú |</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white font-family_nav" href="index.php #chefs">Chefs | </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white font-family_nav" href="contacto.php">Contacto |</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
</section>

<section id="banner" class="container-fluid p-0">
    <div class="banner-img" style="opacity:5; background-image: url('../img/imagen.jpg'); background-position: center; background-size: cover; height: 400px;">
        <div class="banner-text" style="position: relative; top: 55%; transform: translateY(-50%); text-align: center; color: white;">
        <h1 id="tituloRaices" class="font-family" ondblclick="redirigirAlLogin()">Raíces</h1>
            <p class="eslogan">"Optimizando cada sabor, gestionando cada detalle"</p>
            <a href="reserva.php" class="btn btn-primary" style="background-color: #073D65; border-color: #071D2E; color: white; padding: 5px 30px; font-size: 20px; border-radius: 10px;">¡Reserva ya!</a>
        </div>            
    </div>
</section>


<br>

<section id="#" class="container mt-4" style="scroll-margin-top: 10em">
<div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 d-flex align-items-center">
            <h1 class="restaurant-title" style="font-size: 40px;">Restaurante Raíces</h1>
            
          </div>
          <div class="col-12 col-lg-6">
              <p >Desde 1967, Raíces invita a saborear la esencia española a través de platos gastronómicos
                que rinden homenaje a la rica tradicion culinaria del país. A pocos pasos del vibrante corazón
                cultural de la ciudad, cada plato celebra la frescura y la calidad, inspirados en la cosecha de cada temporada.
              </p> 
        </div>
        <div class="col-12">
          <hr class="quote-divider">
        </div>
      </div>
    </div>
</section>


<section id="menu" class="container mt-4" style="scroll-margin-top: 10em">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 d-flex align-items-center">
                <h1 class="restaurant-title" style="font-size: 40px;">Nuestros platos</h1>
            </div>
            
        </div>
        <div class="row" id="menu-cards">
          <?php
            $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "tfg";

                    try {
                      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  
                      $stmtMenu = $conn->prepare("SELECT * FROM menu");
                      $stmtMenu->execute();
                  
                      $stmtMenu->setFetchMode(PDO::FETCH_OBJ);
                  
                      while ($menuItem = $stmtMenu->fetch()) {
                          echo '<div class="col-md-4 mb-3">';
                          echo '<div class="card h-100">';
                          echo '<div class="card-body">';
                          echo '<h5 class="card-title">' . htmlspecialchars($menuItem->nombre) . '</h5>';
                          echo '<p class="card-text">' . htmlspecialchars($menuItem->descripcion) . '</p>';
                          echo '<p class="card-text">Precio: ' . htmlspecialchars($menuItem->precio) . '€</p>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                      }
                  } catch (PDOException $e) {
                      echo "Error de conexión: " . $e->getMessage();
                  }
                  
                  $conn = null;

          ?>
        </div><div class="col-12">
                <hr class="quote-divider">
            </div>
    </div>
</section>

<section id="chefs" class="container mt-4" style="scroll-margin-top: 10em">
<div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 d-flex align-items-center">
            <h1 class="restaurant-title" style="font-size: 40px;">Nuestros Chefs</h1>
            
          </div>
    <div class=" row d-flex flex-row justify-content-center align-items-center flex-wrap">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "tfg";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $conn->prepare("SELECT * FROM chefs");
                        $stmt->execute();

                        $stmt->setFetchMode(PDO::FETCH_OBJ);

                        while ($chef = $stmt->fetch()) {
                            
                            echo '<style>
                                    .card-img-top {
                                        width: 100%;
                                        object-fit: cover;
                                        height: 200px; 
                                    }   
                                </style>';
                            echo '<div class=" col-md-3 mb-3 mx-1 ">';
                            echo '<div class="card h-100">';
                            $imagenUrl = !empty($chef->Imagen) ? "../img/chefs/" . $chef->Imagen : "../img/chefs/icono.jpg";
                            // $imagenUrl = !empty ($chef->Imagen ) ? $chef->Imagen : '../img/icono.jpg';
                            echo '<img src="' . htmlspecialchars($imagenUrl) . '" class="card-img-top">';
                            echo '<div class="card-body">';
                            echo '<h5>' . htmlspecialchars($chef->nombre) . '</h5>';
                            echo '<p class="card-text">' . htmlspecialchars($chef->descripcion) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } catch (PDOException $e) {
                        echo "Error de conexión: " . $e->getMessage();
                    }

                    $conn = null;

                ?>
              <div class="col-12">
          <hr class="quote-divider">
        </div>
      </div>
    </div>
</section>

<section id="historia" class="container mt-4" style="scroll-margin-top: 10em">
<div class="container">
        <div class="row">
          <div class="d-flex align-items-center">
            <h1 class="restaurant-title" style="font-size: 40px;">Historia Raíces</h1>
          </div>
          <div class="col-12 col-lg-6">
              <p style="font-size: 16px;">Fundado en el corazón de la vibrante España de 1967, Raíces es un templo culinario donde la rica herencia 
                española se entrelaza con la innovación gastronómica. Inaugurado en un año emblemático de cambios y efervescencia
                cultural, Raíces se estableció como un refugio donde los sabores tradicionales cobran nueva vida bajo la batuta
                de visionarios chefs.
              </p> 
        </div>
        <div class="col-12 col-lg-6">
              <p style="font-size: 16px;">Con un nombre que rinde homenaje a las profundas tradiciones y al legado terrenal de sus orígenes, Raíces se 
                convirtió en el guardián de la esencia gastronómica del país. Su ubicación, a un paso de las calles empedradas 
                que han visto desfilar la historia, refleja el compromiso del restaurante con el pasado, el presente y el futuro 
                de la cocina española.
              </p> 
        </div>
        <div class="col-12 col-lg-6">
              <p style="font-size: 16px;">Cada plato en Raíces es una obra de arte, inspirada en la frescura de los ingredientes de temporada y en la 
                pasión por la excelencia. Desde su apertura, el restaurante ha sido un punto de encuentro para amantes de la 
                buena mesa y críticos gastronómicos, todos en busca de una experiencia que deleite los sentidos y rinda homenaje 
                a los sabores auténticos de España.
              </p> 
        </div>

        <div class="col-12 col-lg-6">
            <p style="font-size: 16px;">En las cocinas de Raíces, cada ingrediente es seleccionado meticulosamente, respetando el ciclo natural de la 
                tierra y el mar, lo que garantiza que cada plato sirva como un lienzo donde se plasman las estaciones. Los chefs 
                de Raíces, con su maestría y creatividad, han dado forma a un menú que es a la vez un homenaje y una odisea, 
                llevando a los comensales a través de un viaje que trasciende el paladar y nutre el alma.
            </p> 
        </div>

        <div class="col-12 col-lg-6">
            <p style="font-size: 16px;">A través de los años, Raíces ha evolucionado manteniendo sus raíces firmemente plantadas en la herencia cultural 
                española, al mismo tiempo que abraza las innovaciones que la modernidad y la cocina globalizada ofrecen. 
                El restaurante no solo se ha convertido en un emblema de la alta cocina española sino también en un espacio de 
                encuentro intergeneracional, donde las viejas y nuevas generaciones comparten la mesa y celebran la vida con 
                cada plato servido.
            </p>
        </div>

        <div class="col-12">
          <hr class="quote-divider">
        </div>
      </div>
    </div>
</section>


</section>

<footer>
<div class="footer">
    &copy;<span id="year"></span>
    <span> 
    2024 Raíces - Todos los derechos reservados || Diseñado por: Sandra Calahorra 
    </span>
</div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
