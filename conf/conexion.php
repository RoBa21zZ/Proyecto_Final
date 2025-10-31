<?php
    class DatabaseConnection {
    
        private $host   = "localhost";
        private $dbname = "pruebas";
        private $user   = "root";
        private $pass   = "";
        //private $conexion;
        
        public function conectar() {
            

            try {
                $conexion = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                    $this->user,
                    $this->pass
                );

                $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // ✅ Mensaje opcional de éxito
                echo "<br>Conexión realizada correctamente.<br>";
            } catch (PDOException $e) {
                echo "❌ Error de conexión: " . $e->getMessage();
            }

            return $conexion;
        }
    }
?>