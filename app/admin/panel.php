<?php
session_start();
include "../database/conexion.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}


$stmt = $conn->prepare("SELECT id, nombre, imagen FROM admin WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$userImage = $user['imagen'] != '' ? '../img/upload/' . $user['id'] . '/' . $user['imagen'] : '../img/icono.jpg';
// $userImage = $user['imagen'] ? $user['imagen'] : '../img/icono.jpg';

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Raíces</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script rel="script" src="../js/tablasPanel.js"></script>
    <!-- <script rel="script" src="../js/formMenu.js"></script> -->
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="icon" href="../img/restaurante.png">
</head>

<body>
    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px; height: 100vh; background-color: #073D65;">
            <div class="sidebar-logo d-flex justify-content-center align-items-center" style="height: 120px;">
                <img src="../img/restaurante.png" alt="Logo del Restaurante" style="max-width: 40%;">
            </div>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center" data-section-id="chefs-section">
                        <img src="svg/chefs.svg" width="24" height="24">
                        <span class="nav-text">Chefs</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center" data-section-id="menu-section">
                        <img src="svg/menu.svg" width="24" height="24">
                        <span class="nav-text">Menu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center" data-section-id="reservas-section">
                        <img src="svg/reservas.svg" width="24" height="24">
                        <span class="nav-text">Reservas</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center" data-section-id="contacto-section">
                        <img src="svg/contacto.svg" width="24" height="24">
                        <span class="nav-text">Contacto</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex-grow-1">
            <!--Info panel -->
            <div class="user-panel d-flex justify-content-between align-items-center p-2 bg-light">
                <div>
                    <h4>Raíces</h4>
                </div>
                <div>
                    <span> <?php echo htmlspecialchars($user['nombre']); ?></span>
                    <img src="<?php echo $userImage; ?>" alt="Imagen del usuario" style="height: 50px; width: 50px; border-radius: 50%;">
                    <a href="logout.php" class="btn btn-sm btn-outline-secondary">Cerrar sesión</a>
                </div>
            </div>


            <!-- CHEFS -->
            <div class="flex-grow-1 p-3">
                <div id="chefs-section" style="display: none;">
                    <div class="mb-2">
                        <a href="form/formChef.php" class="btn btn-success" style="border-color:#1775bd; background-color: #1775bd;">Añadir Chef</a>
                    </div>
                    <!-- Tabla de chefs -->
                    <table class="table">
                        <thead class="center thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT id, nombre, descripcion, Imagen FROM chefs";
                            $result = $conn->query($query);

                            foreach ($conn->query($query) as $row) {

                                $nombre = htmlspecialchars($row['nombre']);
                                $descripcion = htmlspecialchars($row['descripcion']);
                                $imagen = htmlspecialchars($row['Imagen']);
                                $imagenUrl = $imagen ? '../img/chefs/' . $imagen : '../img/chefs/icono.jpg';

                                echo "<tr>";
                                echo "<td>{$nombre}</td>";
                                echo "<td>{$descripcion}</td>";
                                echo "<td><img src='{$imagenUrl}' style='height: 50px;'/></td>";
                                echo "<td>";
                                //CRUD
                                echo "<a href='form/formChef.php?id={$row['id']}' class='btn btn-primary btn-sm'>Editar</a> ";
                                echo "<a href='actions/delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Borrar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }

                            ?>


                        </tbody>
                    </table>
                </div>
            </div>


            <!-- MENU -->
            <div class="flex-grow-1 p-3">
                <div id="chefs-section" style="display: none;">
                    <div class="mb-2">
                        <a href="form/formChef.php" class="btn btn-success" style="border-color:#1775bd; background-color: #1775bd;">Añadir Chef</a>
                    </div>
                    <!-- Tabla de chefs -->
                    <table class="table">
                        <thead class="center thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT id, nombre, descripcion, precio FROM menu";
                        foreach ($conn->query($query) as $row) {
                            //Sanitize outputs
                            $nombre = htmlspecialchars($row['nombre']);
                            $descripcion = htmlspecialchars($row['descripcion']);
                            $precio = htmlspecialchars($row['precio']);

                            echo "<tr>";
                            echo "<td>{$nombre}</td>";
                            echo "<td>{$descripcion}</td>";
                            echo "<td>{$precio} €</td>";
                            echo "<td>";
                            //CRUD
                            echo "<a href='form/chefForm.php?id={$row['id']}' class='btn btn-primary btn-sm'>Editar</a> ";
                            echo "<a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Borrar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


        <!-- RESERVAS -->
        <div class="flex-grow-1 p-3">
            <div id="reservas-section" style="display: none;">

                <!-- Tabla de reservas -->
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Número de personas</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Comentarios</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT ReservaID, NombreCliente, FechaReserva, HoraReserva, NumeroPersonas, TelefonoContacto, EmailContacto, Comentarios, EstadoReserva FROM reservas";
                        foreach ($conn->query($query) as $row) {
                            $nombre = htmlspecialchars($row['NombreCliente']);
                            $fecha = htmlspecialchars($row['FechaReserva']);
                            $hora = htmlspecialchars($row['HoraReserva']);
                            $numero = htmlspecialchars($row['NumeroPersonas']);
                            $telefono = htmlspecialchars($row['TelefonoContacto']);
                            $email = htmlspecialchars($row['EmailContacto']);
                            $comantarios = htmlspecialchars($row['Comentarios']);
                            $estado = htmlspecialchars($row['EstadoReserva']);


                            echo "<tr>";
                            echo "<td>{$nombre}</td>";
                            echo "<td>{$fecha}</td>";
                            echo "<td>{$hora} h</td>";
                            echo "<td>{$numero}</td>";
                            echo "<td>{$telefono}</td>";
                            echo "<td>{$email}</td>";
                            echo "<td>{$comantarios}</td>";
                            echo "<td>{$estado}</td>";
                            echo "<td>";
                            //CRUD
                            echo "<a href='form/chefForm.php?id={$row['ReservaID']}' class='btn btn-primary btn-sm'>Editar</a> ";
                            echo "<a href='delete.php?id={$row['ReservaID']}' class='btn btn-danger btn-sm'>Borrar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- CONTACTO -->
        <div class="flex-grow-1 p-3">
            <div id="contacto-section" style="display: none;">

                <!-- Tabla de contactos -->
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Mensaje</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT id, nombre, email, mensaje FROM contacto";
                        foreach ($conn->query($query) as $row) {
                            $nombre = htmlspecialchars($row['nombre']);
                            $email = htmlspecialchars($row['email']);
                            $mensaje = htmlspecialchars($row['mensaje']);


                            echo "<tr>";
                            echo "<td>{$nombre}</td>";
                            echo "<td>{$email}</td>";
                            echo "<td>{$mensaje}</td>";
                            echo "<td>";
                            //CRUD
                            echo "<a class='btn btn-primary btn-sm'>Contestar</a> ";
                            echo "<a href='actions/delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Borrar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>




    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>




</html>