<?php
    
    
    require_once "clases/usuarios.php";
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    setlocale(LC_ALL, 'es_ES.UTF-8');
    $ola = "Hola mundo";

    for ($i = 0; $i < 9; $i++) {
       echo  "<h1> " .  $ola . " </h1>";
    }

    echo date("D-M-Y H:i:s");

    $db = new Usuarios();
    $db->obtenerUsuarios(3);

    // print_r(PDO::getAvailableDrivers());

    /* $usuairos = new Usuarios();
    
    print_r($usuairos->obtenerUsuarios()); */

    //$usuarios = $usuario->obtenerUsuarios();
    
    
    ?>
</body>

</html>