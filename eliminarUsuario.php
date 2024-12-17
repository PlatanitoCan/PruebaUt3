<?php
session_start();

if (isset($_SESSION['email'])) {
    include "conexion.php";
    $conexion = conectar();
    $email = $_SESSION['email'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE email = '$email'";
    if ($conexion->query($sql) === TRUE) {
        // Mostrar mensaje personalizado
        echo '<p style="color: green">El usuario ha sido eliminado satisfactoriamente.</p>';
        // Destruir la sesión
        session_destroy();
        // Redirigir a la página de login
        header('Refresh: 3; URL=login.php');
    } else {
        echo '<p style="color: red">Error al eliminar el usuario: ' . $conexion->error . '</p>';
    }

    $conexion->close();
} else {
    // Si no hay sesión iniciada, redirigir a la página de login
    header('Location: login.php');
    exit();
}
?>
