<?php
include "conf/conexion.php";

class Usuarios extends DatabaseConnection {
    
    public function obtenerUsuarios($id){
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->execute([$id]);
        $usuarios = $stmt->fetchAll();

        foreach($usuarios as $usuario){
            echo "<br>Usuario: " . $usuario['nombre'] . " " ;
        }
    }
    
}


//echo $conexion;


?>