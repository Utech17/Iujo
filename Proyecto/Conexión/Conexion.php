<?php
class Conexion {
    // atributos
    private $conexion;
    
    function __construct() {
        // Datos de conexión
        $host = 'localhost';
        $usuario = 'root';
        $contrasena = '';
        $nombre_bd = 'fiscor';

        try {
            // Conexión a la base de datos
            $this->conexion = new PDO("mysql:host=$host; dbname=$nombre_bd", $usuario, $contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexion Exitosa"; // Comentado para no imprimir mensaje
        } catch (PDOException $men) {
            die ("Conexión Fallida ".$men->getMessage());
        }
    }
    
    protected function getConexion() {
        return $this->conexion;
    }

    function cerrarConexion() {
        $this->conexion = null;
      return $this->conexion;
    }
}
?>