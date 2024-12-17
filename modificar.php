<?php
session_start();
include('conexion.php');
$conexion = conectar();
$codigo = $_GET['codigo'];

if (isset($_POST['enviar'])) {
    $descripcion = $_POST['descripcion'];
    $tamano = $_POST['tamano'];
    $numerohabitaciones = $_POST['numerohabitaciones'];
    $precioventa = $_POST['precioventa'];
    $fechAlta = $_POST['fechAlta'];

    $sql = "UPDATE inmuebles SET descripcion='$descripcion',tamano='$tamano', 
    numerohabitaciones= '$numerohabitaciones', precioventa= '$precioventa', 
    fechAlta= '$fechAlta' where codigo=$codigo";

    if ($conexion->query($sql) == TRUE) {
        //Libro modificado con éxito
        $conexion->close();
        header('Location: listar.php');
    } else {
        echo 'Ha ocurrido un error. ' . $conexion->error;
    }

} else {
    $sql = "SELECT * FROM inmuebles WHERE IDinmuebles=$codigo";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
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
        <h3>Modifica una casa</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label" for="descripcion">Viviendas</label>
                <input class="form-control" id="descripcion" type="text" name="descripcion" value="<?= $fila['descripcion'] ?>"
                    required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="tamano">Tamaño</label>
                <input class="form-control" id="tamano" type="text" name="tamano" value="<?= $fila['tamano'] ?>" required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="numerohabitaciones">Numero de habitaciones</label>
                <input class="form-control" id="numerohabitaciones" type="text" name="numerohabitaciones" 
                value="<?= $fila['numerohabitaciones'] ?>" required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="precioventa">Precio de venta</label>
                <input class="form-control" id="precioventa" type="text" name="precioventa" value="<?= $fila['precioventa'] ?>" required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="fechAlta">Fecha de alta</label>
                <input class="form-control" id="fechAlta" type="text" name="fechAlta" value="<?= $fila['fechAlta'] ?>" required>
            </div>
        <!--
            <div class=" mb-3">
                <div>¿Disponible?</div>
                <input class="form-check-input" id="sidisponible" type="radio" name="disponible" value="1"
                    <?= $fila['disponible'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="sidisponible">Si</label>
                <input class="form-check-input" id="nodisponible" type="radio" name="disponible" value="0"
                    <?= $fila['disponible'] ? '' : 'checked' ?>>
                <label class="form-check-label" for="nodisponible">No</label>
            </div>
        -->
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="enviar">Enviar
            </div>
        </form>

    </div>
</body>

</html>