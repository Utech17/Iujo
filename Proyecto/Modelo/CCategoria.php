<?php
require_once ("../Conexión/Conexion.php");

class CCliente extends Conexion{
    // atributos
    private $cedula;
    private $nombre;
    private $apellido;
    private $tipo_lector;

    private $conexion;
    // constructor
	public function __construct(){
		$this->conexion = new Conexion();
		$this->conexion = $this->conexion->getConexion();
	}
    // métodos
    public function get_cedula(){
        return $this->cedula;
    }

    public function set_cedula($cedula){
        $this->cedula = $cedula;	
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function set_nombre($nombre){
        $this->nombre = $nombre;	
    }

    public function get_apellido(){
        return $this->apellido;
    }

    public function set_apellido($apellido){
        $this->apellido = $apellido;
    }

    public function get_tipo_lector(){
        return $this->tipo_lector;
    }

    function set_tipo_lector($tipo_lector){
        $this->tipo_lector = $tipo_lector;
    }

    // Función para agregar un nuevo Cliente
    public function agregarCliente(){
        $sql = "INSERT INTO cliente (cedula, nombre, apellido, tipo_lector) VALUES (:cedula, :nombre, :apellido, :tipo_lector)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':cedula', $this->cedula);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':tipo_lector', $this->tipo_lector);
        $resul = $stmt->execute();
        if ($resul) {
            $res = 1;
        } else {
            $res = 0;
        }
        return $res; 
    }

    public function buscarTodos() {
        try {
            $sql = "SELECT * FROM cliente";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al buscar todos los clientes: " . $e->getMessage(), 0);
            return array(); // Devuelve un array vacío en caso de error
        }
    }

    // Función para buscar Cliente por cédula
    public function buscarClientePorCedula($cedula) {
        $sql = "SELECT * FROM cliente WHERE cedula = :cedula";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':cedula', $cedula); 
        $resul = $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($datos) {
            $encontro = 1;
            $this->cedula = $datos['Cedula']; 
            $this->nombre = $datos['Nombre']; 
            $this->apellido = $datos['Apellido']; 
            $this->tipo_lector = $datos['Tipo_lector']; 
        } else {
            $encontro = 0;
        }
        return $datos; // Devuelve los datos del cliente encontrado
    }

    // Función para actualizar los datos de un Cliente
    public function actualizarCliente(){
        $sql = "UPDATE cliente SET nombre = :nombre, apellido = :apellido, tipo_lector = :tipo_lector WHERE cedula = :cedula";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':tipo_lector', $this->tipo_lector);
        $stmt->bindParam(':cedula', $this->cedula);
        $resul = $stmt->execute();
		return $resul;	
    }

    // Función para eliminar un Cliente
    public function eliminarCliente(){
        $sql = "DELETE FROM cliente WHERE cedula = :cedula";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':cedula', $this->cedula);
        $resul = $stmt->execute();
        return $resul;
    }
}
?>