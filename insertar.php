<?php
session_start();
include('conexion.php');

if (isset($_POST['enviar'])) {

    if (!isset($_POST['descripcion']) || !isset($_POST['tamano']) || !isset($_POST['numerohabitaciones'])
     || !isset($_POST['precioventa']) || !isset($_POST['fechAlta'])) {

        echo 'Descripción no es obligatorio';
    } else {
        $descripcion = $_POST['descripcion'];
        $tamano = $_POST['tamano'];
        $numerohabitaciones = $_POST['numerohabitaciones'];
        $precioventa = $_POST['precioventa'];
        $fechAlta = $_POST['fechAlta'];

        $conexion = conectar();

        $sql = "INSERT INTO inmuebles(descripcion,tamano,numerohabitaciones,precioventa,fechAlta) 
        VALUES ('$descripcion','$tamano','$numerohabitaciones','$precioventa','$fechAlta')";

        if ($conexion->query($sql) == TRUE) {
            //Libro creado con éxito
            header('Location: listar.php');
        } else {
            echo 'Ha ocurrido un error. ' . $conexion->error;
        }

        $conexion->close();
    }
            //======================================================================
            // PROCESAR IMAGEN 
            //======================================================================
            // Comprobamos si nos llega los datos por POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Definir directorio donde se guardará
                $dir_subida = './imagenes/';
                // Definir la ruta final del archivo
                $fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
                // Mueve el archivo de la carpeta temporal a la ruta definida
                echo sha1_file($_FILES['fichero_usuario']['tmp_name']);
                
                if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
                    // Mensaje de confirmación donde todo ha ido bien
                    echo '<p>Se subió perfectamente.</p>';
                    // Muestra la imagen que acaba de ser subida
                    echo '<p><img width="500" src="' . $fichero_subido . '"></p>';
                } else {
                    // Mensaje de error: ¿Límite de tamaño? ¿Ataque?
                    echo '<p>¡Ups! Algo ha pasado.</p>';
                }
            }
        


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
</head>

<body>
    <div class="container">
        <h3>Formulario para la adquisición de Vivienda</h3>
        <form action="insertar.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label" for="titulo">Descripcion</label>
                <input class="form-control" id="titulo" type="text" name="descripcion">
            </div>
            <div class="mb-3">
                <label class="form-label" for="tamano">Tamaño Vivienda</label>
                <input class="form-control" id="tamano" type="text" name="tamano" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="numerohabitaciones">Numero de habitaciones</label>
                <input class="form-control" id="numerohabitaciones" type="text" name="numerohabitaciones" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="precioventa">Precio de venta</label>
                <input class="form-control" id="precioventa" type="text" name="precioventa" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="fechAlta">Fecha de alta</label>
                <input class="form-control" id="fechAlta" type="text" name="fechAlta" required>
            </div>
            <p>
                <!-- Campo imagen -->
                <input type="file" name="fichero_usuario">
            </p>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="enviar">Enviar
            </div>
        </form>

    </div>
</body>

</html>