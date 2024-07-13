<?php
require_once("../modelo/conexionPDO.php");

class Categoria extends Conexion {
    // Attributes
    private $ID_Categoria;
    private $Nombre;
    private $Estado;

    private $conexion;

    // Constructor
    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    // Getters and Setters
    public function getID_Categoria() {
        return $this->ID_Categoria;
    }

    public function setID_Categoria($ID_Categoria) {
        $this->ID_Categoria = $ID_Categoria;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    public function agregarCategoria() {
        $sql = "INSERT INTO Categoria (ID_Categoria, Nombre, Estado) VALUES (:ID_Categoria, :Nombre, :Estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Categoria', $this->ID_Categoria);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Estado', $this->Estado);
        $result = $stmt->execute();
        return $result ? 1 : 0;
    }

    public function buscarTodos() {
        try {
            $sql = "SELECT * FROM Categoria";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar todas las categorias: " . $e->getMessage(), 0);
            return array();
        }
    }

    public function buscarCategoriaPorID($ID_Categoria) {
        $sql = "SELECT * FROM Categoria WHERE ID_Categoria = :ID_Categoria";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Categoria', $ID_Categoria);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCategoria() {
        $sql = "UPDATE Categoria SET Nombre = :Nombre, Estado = :Estado WHERE ID_Categoria = :ID_Categoria";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Estado', $this->Estado);
        $stmt->bindParam(':ID_Categoria', $this->ID_Categoria);
        return $stmt->execute();
    }

    public function eliminarCategoria() {
        $sql = "DELETE FROM Categoria WHERE ID_Categoria = :ID_Categoria";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Categoria', $this->ID_Categoria);
        return $stmt->execute();
    }
}
?>
