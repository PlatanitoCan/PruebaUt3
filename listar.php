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
    <?php
        session_start();
        include "conexion.php";
        $conexion = conectar();



        $sql = "SELECT * FROM inmuebles";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {

    ?>

        <div class="container">
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <a href="eliminarUsuario.php" class="btn btn-warning">Eliminar Cuenta</a>
            <a href="perfil.php" class="btn btn-info">Perfil</a>
            <h3 class="text-center">GESTIÓN DE VIVIENDAS</h3>
            <!-- Boton para insertar libro -->
            <p><a class="btn btn-success" href="insertar.php">Añadir vivienda</a></p>
            <table class="table table-hover ">
                <thead class="table-secondary">
                    <th>IDinmuebles</th>
                    <th>descripcion</th>
                    <th>tamano</th>
                    <th>numerohabitaciones</th>
                    <th>precioventa</th>
                    <th>fechAlta</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()) { 
                        echo '<tr> 
                        
                        <td>' . $fila['IDinmuebles'] . '</td> 
                        
                        <td>' . $fila['descripcion'] . '</td> 
                        
                        <td>' . $fila['tamano'] . '</td> 
                        
                        <td>' . $fila['numerohabitaciones'] . '</td>
                        
                        <td>' . $fila['precioventa'] . '</td> 
                        
                        <td>' . $fila['fechAlta'] . '</td> 
                        
                        <td>'; 
                        
                        if ($usuario['puesto'] == 'encargado') { 
                            echo '<a class="btn btn-primary" href="modificar.php?codigo=' . $fila['IDinmuebles'] . '">
                                Modificar
                            </a>'; 
                        } else { 
                            echo '<button class="btn btn-primary" disabled>Modificar</button>'; 
                        } echo '</td> 
                        
                        <td>'; 
                        
                        if ($usuario['puesto'] == 'encargado') { 
                            echo '<a class="btn btn-primary" href="borrar.php?codigo=' . $fila['IDinmuebles'] . '">
                                Borrar
                            </a>'; 
                        } else { 
                            echo '<button class="btn btn-primary" disabled>Borrar</button>'; 
                        } echo '</td> </tr>';
                    } 
                ?>    
                </tbody>
            </table>
        </div>
        
    <?php
    } else {
        echo 'No se encuentran datos';
    }
    $conexion->close();
    ?>
</body>

</html>