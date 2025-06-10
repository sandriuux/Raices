<?php
session_start();
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

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM chefs WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../panel.php ");
        exit;
    } else {
        echo "Error al intentar eliminar.";
    }

    $stmt->close();
} else {
    echo "ID proporcionado.";
}
?>
