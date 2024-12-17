<?php
include 'conexion.php';

$conexion = conectar();
$codigo = $_GET['codigo'];
$sql = "DELETE FROM inmuebles WHERE IDinmuebles = $codigo";

if ($conexion->query($sql)) {
    //Libro borrado con éxito
    header('Location: listar.php');
} else {
    echo 'Ha ocurrido un error. ' . $conexion->error;
}

$conexion->close();
?>
