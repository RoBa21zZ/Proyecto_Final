<?php
include "conf/conexion.php";

class Usuarios {
    private $conn;
    private $id;
    private $nombre;
    private $fecha_nacimiento;

    public function __construct($db) {
       $this->conn = $db;
    }
    
    public function obtenerUsuarios(){
        $sql = "SELECT * FROM usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll();

        return $usuarios;
    }

    public function obtenerFechaDeNacimiento($id){
        $sql = "Select fechaDeNacimiento from usuario where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $resultado = $stmt->fetchAll();

        return $resultado[0]['fechaDeNacimiento'];
    }

    public function introducirUsuario($nombre, $fecha_nacimiento){
        $sql = "INSERT INTO usuario (nombre, fechaDeNacimiento) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nombre, $fecha_nacimiento]);

    }

    public function mostrarEdad($fecha){
        
        $fechaDate = new DateTime($fecha);
        $hoy = new DateTime();
        $annos = $hoy->diff($fechaDate)->y;

        return $annos . "<br>";
    }
    
}


//echo $conexion;


?>