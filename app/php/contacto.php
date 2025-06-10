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
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/reservas.css">
  <link rel="stylesheet" href="../css/nav.css">

  <script src="../js/reservaConfirmada.js"></script>
</head>

<body>


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

  <section id="banner" class="container-fluid p-0">
    <div class="banner-img" style="background-image: url('../img/imagen3.jpg'); background-position: center; background-size: cover; height: 400px;">
      <div class="banner-text" style="position: relative; top: 50%; transform: translateY(-50%); text-align: center; color: white;">
        <h1 class="title">Habla con nosotros</h1>
      </div>
    </div>
  </section>


  <section>
    <div class="container">
      <br>
      <h2 class="text-center mb-4 subtitle">Escríbenos los que quieras</h2>

      <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="/tfg_DAW/app/admin/login.php" method="post" class="p-4 shadow rounded">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" id="nombre" name="nombre" required class="form-control">
            </div>
            <br>
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico:</label>
              <input type="email" id="email" name="email" required class="form-control">
            </div>
            <br>
            <div class="mb-3">
              <label for="text" class="form-label">Mensaje:</label>
              <textarea type="text" id="text" name="text" required class="form-control"></textarea>
            </div>
            <br>
            <div class="text-center">
              <input type="submit" value="Enviar" class="btn btn-primary">

          </form>

        </div>
      </div>
    </div>

  </section>

  <br>


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