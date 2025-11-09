<?php
session_start();
if (isset($_SESSION["nombre"])) {
    header("Location: index.php");
    exit;
}

//echo $_SESSION["nombre"];

require_once "clases/usuarios.php";
$database = new DatabaseConnection();
$db = $database->conectar();
$usuariosClase = new Usuarios($db);

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $pass = $_POST["pass"];

    if (!empty($nombre) && !empty($pass)) {
        if ($usuariosClase->loginUsuario($nombre, $pass)) {
            $_SESSION["nombre"] = $nombre;
            header("Location: index.php");
            exit;
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            display: flex;
            width: 300px;
        }
    </style>
</head>

<body>
    <h2>Login</h2>
    <div>
    <form action="" method="POST">
        <label for="nombre">Nombre usuario</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="contra">Contraseña</label>
        <input type="password" name="pass" id="pass" required>
        <input type="submit" value="Enviar" class="botonEnviar">
        <button><a href="register.php">Nuevo usuario</a></button>
    </form>
    </div>
</body>

</html>