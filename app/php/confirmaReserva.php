<?php
ob_start();
session_start();

require '../database/conexion.php';

$message = '';
$isSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idReserva'])) {
    $idReserva = (int)$_POST['idReserva'];
    
    echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                var messageContainer = document.getElementById('messageContainer');
                var messageHTML = '" . ($isSuccess ? "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> " : "<div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times\"></i> ") . $message . "</div>';
                messageContainer.innerHTML = messageHTML;
                
                // Añadir animación
                messageContainer.classList.add('animate__animated', 'animate__fadeIn');
            });
          </script>";
}

$idReserva = isset($_GET['idReserva']) ? (int)$_GET['idReserva'] : 0;

if ($idReserva > 0) {
    $stmt = $conn->prepare("UPDATE Reservas SET EstadoReserva = 'Confirmada' WHERE ReservaID = ? AND EstadoReserva = 'Pendiente'");
    $stmt->bind_param("i", $idReserva);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $message = "Reserva confirmada con éxito.";
            $isSuccess = true;
        } else {
            $message = "La reserva ya está confirmada o no existe.";
            $isSuccess = false;
        }
    } else {
        $message = "Error al confirmar la reserva.";
        $isSuccess = false;
    }

    $stmt->close();
} else {
    $message = "ID de reserva inválido.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

        
    <link rel="icon" href="../img/restaurante.png">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/reservas.css">
    <link rel="stylesheet" href="../css/nav.css">
    
</head>

<script type='text/javascript'>
    document.addEventListener('DOMContentLoaded', function() {
        var messageContainer = document.getElementById('messageContainer');
        var confirmationForm = document.getElementById('confirmationForm');
        
        if(messageContainer.innerHTML.trim() == '') {
            confirmationForm.style.display = 'block';
        }
    });
</script>


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
    <div class="container text-center">
        <h2>Confirmación de Reserva</h2>
        <div id="messageContainer">
            <?php if ($message): ?>
                <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-danger'; ?> animate__animated animate__fadeIn" role="alert">
                    <?php if ($isSuccess): ?>
                        <i class="fa fa-check"></i>
                    <?php else: ?>
                        <i class="fa fa-times"></i>
                    <?php endif; ?>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
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


