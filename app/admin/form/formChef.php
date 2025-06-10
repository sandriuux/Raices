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
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $targetDir = "../../img/chefs/";
    $defaultImage = "../../img/icono.jpg";

    if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {
        $imagen = $_FILES['imagen']['name'];
        $targetFilePath = $targetDir . basename($imagen);
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFilePath)) {
            $mensaje = "Error al subir la imagen.";
            $targetFilePath = $targetDir . $defaultImage;
        }
    } else {
        $targetFilePath = $targetDir . $defaultImage;
    }

    $query = "INSERT INTO chefs (nombre, descripcion, imagen) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sss", $nombre, $descripcion, $targetFilePath);
        if ($stmt->execute()) {
            $mensaje = "Chef añadido correctamente";
        } else {
            $mensaje = "Error al añadir al chef: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensaje = "Error al preparar la consulta: " . $conn->error;
    }

    $conn->close();
    echo $mensaje;
    exit;
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
    
<form id="formChef" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre">Nombre del chef:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="form-group">
        <label for="imagen" class="form-label">Imagen (opcional):</label>
        <input type="file" name="imagen" id="imagen" class="form-control">
        
        <button type="submit" class="btn btn-sm btn-outline-primary">Añadir nuevo chef</button>
    </form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../js/tablasPanel.js"></script>
<script src="../../js/formChef.js"></script>
</body>
</html>







