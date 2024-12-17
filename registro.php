<?php

include "conexion.php";
$conexion = conectar();

// Manejo del formulario de registro
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $passw = password_hash($_POST['passw'], PASSWORD_DEFAULT); // Hashear la contraseña
    $puesto = $_POST['puesto'];

    // Verificar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // email ya registrado
        echo "<p>El correo electrónico ya está registrado. Por favor, intenta con otro.</p>";
    } else {
        // Insertar nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (Nombre, email, passw, puesto) VALUES ('$nombre', '$email', '$passw', '$puesto')";
        if ($conexion->query($sql) === TRUE) {
            // Registro exitoso, redirigir a la página de login
            echo "<p>Usuario registrado exitosamente. Redirigiendo a la página de inicio de sesión...</p>";
            header("Refresh: 3; URL=login.php");
            exit();
        } else {
            echo "<p>Error al registrar el usuario: " . $conexion->error . "</p>";
        }
    }
}
if (isset($_POST['login'])) {
    echo '<p style="color: blue">Se le está redirigiendo al login, 
    sabía que la programación a veces puede ser un tema coompilado</p>';
        header('Location: login.php');
    exit();
}


// Cerrar conexión
$conexion->close();
?>

<!-- Formulario de registro -->
<!DOCTYPE html>
<html lang="es">

<head>
    <title>RealStates</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .container {
            margin-top: 10%;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
    </style>

</head>

<body>
    <div class="container">
        <h3>Registro de Usuario</h3>
        <form method="POST" action="registro.php">
            <div class="form-group">
                <label for="nombre">Nombre de Usuario:</label>
                <input class="form-control" type="text" id="nombre" name="nombre" ><br>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input class="form-control" type="email" id="email" name="email" required><br>
            </div>
            <div class="form-group">
                <label for="passw">Contraseña:</label>
                <input class="form-control" type="passw" id="passw" name="passw" required><br>
            </div>
            <div class="form-group"> 
                <label for="puesto">
                    Puesto:
                </label> 
                <select class="form-control" id="puesto" name="puesto" required> 
                    <option value="empleado">Empleado</option> 
                    <option value="encargado">Encargado</option> 
                </select>
                <br> 
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="registrar">Registrar
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="login" formnovalidate>
                    Login
                </button>
            </div>
        </form>
    </div>
</body>

</html>