<?php
    session_start();
    require_once "clases/usuarios.php";

    $database = new DatabaseConnection();
    $db = $database->conectar();
    $usuariosClase = new Usuarios($db);
    
    if (isset($_SESSION["nombre"])) {
        header("Location: index.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nombre = $_POST["nombre"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $contra = $_POST["contra"];

        $resultado = $usuariosClase->registerUsuario($nombre, $fecha_nacimiento, $contra);

        if($resultado){
            header("Location: login.php");
            exit;
        }else{
            echo "Error";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Crear cuanta</h2>

    <form action="" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="fecha">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>

        <label for="contra">Contraseña</label>
        <input type="password" name="contra" id="pass" required>

        <input type="submit" value="Crear cuenta" class="botonEnviar">
 
    </form>

    <b>¿Ya tienes una cuenta ? <a href="login.php">Inicia sesión aquí</a></b>
</body>
</html>