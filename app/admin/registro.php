<?php
session_start();
ob_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tfg";
$successMsg = '';
$errorMsg = '';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['pass']) && isset($_POST['email'])) {
    $nombre = $_POST['nombre'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $email = $_POST['email'];


    $checkUser = $conn->prepare("SELECT * FROM admin WHERE nombre = ? OR email = ?");
    $checkUser->bind_param("ss", $nombre, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows == 0) {
        $imagen = isset($_FILES['imagen']) ? $_FILES['imagen']['name'] : null;
        $stmt = $conn->prepare("INSERT INTO admin (nombre, pass, email, imagen) VALUES (?, ?, ?, ?)");

        if ($imagen === null) {
            $stmt->bind_param("sss", $nombre, $pass, $email);
        } else {
            $stmt->bind_param("ssss", $nombre, $pass, $email, $imagen);
        }

        if ($stmt->execute()) {
            $successMsg = "Usuario registrado con éxito.";

            $user_id = $stmt->insert_id;

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imgName = $_FILES['imagen']['name'];
                $imgTmpPath = $_FILES['imagen']['tmp_name'];
                mkdir('../img/upload/' . $user_id);
                $imgNewPath = '../img/upload/' . $user_id . "/$imgName";

                move_uploaded_file($imgTmpPath, $imgNewPath);

            } else {
                $imgNewPath = '../img/icono.jpg';
            }
        } else {
            $errorMsg = "Error al registrar el usuario: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $errorMsg = "El nombre de usuario o el correo electrónico ya están en uso.";
    }
    $checkUser->close();
}

$conn->close();
ob_end_flush();

?>

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

    <script rel="script" src="../js/mensajeRegistro.js"></script>

</head>

<body class="body">



    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white font-family_nav" style="font-size: 25px;" href="../php/index.php #inicio">Raíces ||</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white font-family_nav" href="../php/index.php #historia">Historia |</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white font-family_nav" href="../php/index.php #menu">Menú |</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white font-family_nav" href="../php/index.php #chefs">Chefs | </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white font-family_nav" href="../php/contacto.php">Contacto |</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section>
        <div class="container">
            <br>
            <h2 class="text-center mb-4 subtitle">Registrate</h2>
            <?php if ($successMsg) : ?>
                <div class="alert alert-success text-center">
                    <?php echo $successMsg; ?>
                </div>
            <?php endif; ?>
            <?php if ($errorMsg) : ?>
                <div class="alert alert-danger text-center">
                    <?php echo $errorMsg; ?>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="/tfg_DAW/app/admin/registro.php" method="post" class="p-4 shadow rounded" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required class="form-control">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" required class="form-control">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="pass" name="pass" required class="form-control">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen (opcional):</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" value="Registrarse" class="btn btn-primary">
                        </div>

                    </form>

                </div>
                <p style="text-align: center;">
                    ¿Ya tienes una <a href="/tfg_DAW/app/admin/login.php">cuenta</a>?
                </p>

            </div>

    </section>

    <footer class="footer">
        <div class="text">
            Copyright © 2024 Raíces - Todos los derechos reservados || Diseñado por: Sandra Calahorra
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>


</html>