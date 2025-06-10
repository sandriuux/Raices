<?php
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

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $query = "INSERT INTO menu (nombre, descripcion, precio) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);

        if ($stmt->execute()) {
            $mensaje = "Plato añadido correctamente";
        } else {
            $mensaje = "Error al añadir el plato: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensaje = "Error al preparar la consulta: " . $conn->error;
    }

    $conn->close();
    exit($mensaje);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Raíces</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="icon" href="../../img/restaurante.png">
</head>

<body>

<img src="../svg/volver.svg" alt="volver" width="30px" class="volver" onclick="location.href='../panel.php'">
    
<form id="formMenu" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del plato:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-sm btn-outline-primary">Añadir nuevo plato al menú</button>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../js/tablasPanel.js"></script>
<script src="../../js/formMenu.js"></script>
</body>
</html>







