
<?php
ob_start(); // Iniciar el buffering de salida
session_start();

// require '../admin/lib/PHPMailer-master/src/PHPMailer.php';
// require '../admin/lib/PHPMailer-master/src/SMTP.php';
// require '../admin/lib/PHPMailer-master/src/Exception.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "tfg";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Verificar la conexión
// if ($conn->connect_error) {
//     die("La conexión ha fallado: " . $conn->connect_error);
// }

require '../database/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre'], $_POST['fecha'], $_POST['hora'], $_POST['personas'], $_POST['telefono'], $_POST['email'], $_POST['comentarios'])) {
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $personas = $_POST['personas'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $comentarios = $_POST['comentarios'];
        
        $horaApertura = '12:00';
        $horaCierre = '23:30';

    } if ($hora < $horaApertura || $hora > $horaCierre) {
        $error = "La hora de reserva debe estar entre las 12:00 y las 23:30.";
    } else {
  
        $stmt = $conn->prepare("INSERT INTO Reservas (NombreCliente, FechaReserva, HoraReserva, NumeroPersonas, TelefonoContacto, EmailContacto, Comentarios) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiiss", $nombre, $fecha, $hora, $personas, $telefono, $email, $comentarios);

        if ($stmt->execute()) {

            $idReserva = $stmt->insert_id;
            
            $mail = new PHPMailer(true);
            
            try {
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'restauranteraices.tfg@gmail.com';
                $mail->Password   = 'fenyqddjioetzkvc';
                $mail->Port       = 465;
                $mail->SMTPOptions=['ssl'=>[
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true]];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                
                $mail->setFrom('restauranteraices.tfg@gmail.com', 'Raíces');
                $mail->addAddress($email, $nombre);
                
                $mail->isHTML(true);
                $mail->Subject = '¡RESERVA CONFIRMADA!';
                $mail->Body    = "<p>La reserva a nombre de <strong>$nombre</strong> ha sido realizada correctamente para el día <strong>$fecha</strong> con la hora <strong>$hora</strong>.</p>
                                  <p> Confirma tu reserva <a href=\"http://localhost/tfg_daw/app/php/confirmaReserva.php?idReserva=$idReserva\">aquí.</a>";
                $mail->AltBody = "La reserva a nombre de $nombre ha sido realizada correctamente para el día $fecha con la hora $hora.";

                $mail->send();
                echo 'Message has been sent';
            }catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                echo '<pre>';
                print_r($mail);
                die();
            }
            
            header("Location: " . htmlspecialchars($_SERVER["PHP_SELF"]) . "?success=true");
            exit();
        } else {            
            $error = "Error al realizar la reserva: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    $error = "Todos los campos son obligatorios.";
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
    
    <script src="../js/reservaRealizada.js"></script>
    <script src="../js/validacionFechaYHora.js"></script>
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
    <div class="banner-img" style="background-image: url('../img/imagen2.jpg'); background-position: center; background-size: cover; height: 400px;">
        <div class="banner-text" style="position: relative; top: 50%; transform: translateY(-50%); text-align: center; color: white;">
            <h1 class="title">Reservas</h1>
        </div>            
    </div>
</section>

<section>
<div class="container">
    <br>
    <h2 class="text-center mb-4 subtitle">Reserva de Mesas</h2>

    <div id="successMessage" class="alert alert-success text-center" <?php echo (isset($_GET['success']) && $_GET['success'] == 'true') ? '' : 'style="display: none;"'; ?>>
    <i class="fa fa-check-circle"></i> Reserva realizada con éxito.
</div>

    <div class= "row justify-content-center">
        <div class="col-md-8">
        <form method="post" class="p-4 shadow rounded">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="form-control">
            </div>
        <br>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Reserva:</label>
                <input type="date" id="fecha" name="fecha" required class="form-control">
            </div>
        <br>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de Reserva:</label>
                <input type="time" id="hora" name="hora" required class="form-control">
            </div>
        <br>
            <div class="mb-3">
                <label for="personas" class="form-label">Número de Personas:</label>
                <input type="number" id="personas" name="personas" required min="1" class="form-control">
            </div>
        <br>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono de Contacto:</label>
                <input type="tel" id="telefono" name="telefono" min="9" class="form-control">
            </div>
        <br>
            <div class="mb-3">
                <label for="email" class="form-label">Email de Contacto:</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>
        <br>
            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentarios:</label>
                <textarea id="comentarios" name="comentarios" class="form-control"></textarea>
            </div>
        <br>
            <div class="text-center">
            <input type="submit" value="Reservar" class="btn btn-primary">
            
        </form>

        </div>
    </div>
</div>

</section>
<br>

<footer class="footer">
    <div class="text">
        Copyright © 2024 Raíces - Todos los derechos reservados || Diseñado por: Sandra Calahorra 
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

