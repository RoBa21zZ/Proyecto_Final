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
    
    public function registerUsuario($nombre, $fecha_nacimiento,$contra){
        $sqlComprobar = "Select * from usuario where nombre = ?";
        $stmtComprobar = $this->conn->prepare($sqlComprobar);
        $stmtComprobar->execute([$nombre]);

        if($stmtComprobar->fetch(PDO::FETCH_ASSOC)){
            return false;
        }

        $sql = "INSERT INTO usuario (nombre,fechaDeNacimiento,contra) VALUES(?,?,?)";
        $hash_password = password_hash($contra, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare($sql);    
        
        return $stmt->execute([$nombre,$fecha_nacimiento,$hash_password]);
            
        
    }

    public function loginUsuario($nombre,$contra){
        $sql = "Select * from usuario where nombre = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario && password_verify($contra,$usuario['contra'])){
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_fechaDeNacimiento'] = $usuario['fechaDeNacimiento'];
            return true;
        }

        return false;
    }

    public function logoutUsuario(){
        session_unset();
        session_destroy();
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