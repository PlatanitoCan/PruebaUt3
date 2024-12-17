<?php
    function conectar(){
        $servidor = 'localhost';
        $usuario = 'root';
        $password = '';
        $base = 'realStates';
        $conexion = new mysqli($servidor, $usuario, $password, $base);
        if($conexion->connect_error){
            die('Hubo un fallo en la conexión ' . $conexion->connect_error);
        }
        return $conexion;
    }
?>
