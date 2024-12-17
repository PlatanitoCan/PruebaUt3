<?php
// Comprobamos que nos llega los datos del formulario
if (isset($_POST['login'])) {

    include "conexion.php";
    $conexion = conectar();
    $emailFormulario = $_POST['email'];
    $contrasenyaFormulario = $_POST['contrasenya'];
    
    // Verificar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE email = '$emailFormulario'";
    echo $sql;
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        // obtenemos los datos de ese usuario
        if ($fila['email']==$emailFormulario)
        echo "Son iguales los correos";
        if (password_verify($contrasenyaFormulario, hash: $fila['passw']))
        echo "Son iguales las contraseñas";
        if ($fila['email'] == $emailFormulario && password_verify($contrasenyaFormulario, $fila['passw'])) {
            // Si son correctos, creamos la sesión
            session_start();
            $_SESSION['email'] = $emailFormulario;
            $_SESSION['usuario'] = $fila['usuario'];
            // Redireccionamos a la página segura
            header('Location: listar.php');
            // REVISAR listar
            die();
        } else {
            // Si no son correctos, informamos al usuario
            echo '<p style="color: red">El email o la contraseña es incorrecta.</p>';
            header("Refresh: 3; URL=login.php");
        }
        
    }
}
if (isset($_POST['registro'])) {
    echo '<p style="color: blue">Se le está redirigiendo al registro, sabía que puede crear 
    otros usuarios sin tener los mismo correos ni contraseñas</p>';
        header('Location: registro.php');
    exit();
}

?>
<!DOCTYPE html>
<html>

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
        <h3>LOGIN de Usuario</h3>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="text" id="email" name="email" required placeholder="Email">
            </div>
            <div class="form-group">
                <label for="constrasenya">Contraseña:</label>
                <input class="form-control" type="password" id="contrasenya" name="contrasenya" required
                placeholder="Contraseña">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="login">
                    Entrar
                </button>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="registro" formnovalidate>
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</body>

</html>