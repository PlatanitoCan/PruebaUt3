<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include "conexion.php";
$conexion = conectar();
$email = $_SESSION['email'];

// Obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}

$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil de Usuario</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            margin-top: 20px;
        }
        .empleado {
            background-color: #f8f9fa;
        }
        .encargado {
            background-color: #e9ecef;
        }
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card <?php echo $usuario['puesto'] == 'encargado' ? 'encargado' : 'empleado'; ?>">
            <div class="card-body text-center">
                <img src="<?php echo $usuario['puesto'] == 'encargado' ? 'avatar_encargado.png' : 'avatar_empleado.png'; ?>" class="avatar" alt="Avatar">
                <h5 class="card-title"><?php echo $usuario['Nombre']; ?></h5>
                <p class="card-text">Email: <?php echo $usuario['email']; ?></p>
                <p class="card-text">Puesto: <?php echo ucfirst($usuario['puesto']); ?></p>
                <a href="listar.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
