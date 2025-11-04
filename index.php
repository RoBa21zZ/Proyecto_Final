<?php

use function PHPSTORM_META\type;

    require_once "clases/usuarios.php";    

    $database = new DatabaseConnection();
    $db = $database->conectar();

    //$mensaje = "";
    $usuariosClase = new Usuarios($db);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["nombre"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];

        if(!empty($nombre) && !empty($fecha_nacimiento)){
            if($usuariosClase->introducirUsuario($nombre, $fecha_nacimiento)){
                session_start();
                $_SESSION['mensaje'] = "Usuario introducido correctamente";
            } else {
                $_SESSION['mensaje'] = "Error al introducir el usuario";
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .div1{
            border: 1px solid black;
            width: 300px;
            height: auto;
            padding: 10px;
            margin: 10px;
        }

        form{
            border: 1px solid black;
            padding: 0px;
            margin: 0px;
            
        }
        
        .botonEnviar {
            background-color: blue;
            color: white;
            padding: 10px;
            border-radius: 5px;
            border: none;
            display: flex;
            
            
        }
    </style>
</head>

<body>

    <?php
    setlocale(LC_ALL, 'es_ES.UTF-8');
    $ola = "Hola mundo";

    for ($i = 0; $i < 9; $i++) {
       echo  "<h1> " .  $ola . " </h1>";
    }

    echo date("D-M-Y H:i:s");

    
    $usuariosClase->obtenerUsuarios(4);

    
    $fechaUsuario4 = $usuariosClase->obtenerFechaDeNacimiento(4);

    $fechaTransformada = date("d-M-Y",strtotime($fechaUsuario4));

    echo "<br>";

    echo "Tipo que viene de la base de datos " . gettype($fechaUsuario4);
    echo "<br> Tipo transformado " . gettype($fechaTransformada) . " " . $fechaTransformada;
    // print_r(PDO::getAvailableDrivers());

    /* $usuairos = new Usuarios();
    
    print_r($usuairos->obtenerUsuarios()); */

    $usuarios = $usuariosClase->obtenerUsuarios();
    
    foreach($usuarios as $usuario){
        echo "Nombre " . $usuario["nombre"] . " Edad " . $usuariosClase->mostrarEdad($usuario["fechaDeNacimiento"]);
    }
    ?>

    <h3>Formulario de prueba para ver tema  fehcas y cosas</h3>

    <div class="div1">
        <form action="" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            
            <br><br>
            
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>  
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
            
            <br><br>
            
            <input type="submit" value="Introducir usuairo" class="botonEnviar">
        </form>
    </div>
    <?php
    
    ?>
</body>

</html>