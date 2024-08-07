<?php
require_once("../modelo/conexionPDO.php");

class Categoria extends Conexion {
    // Attributes
    private $ID_Categoria;
    private $ID_Proyecto;
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

    public function getID_Proyecto() {
        return $this->ID_Proyecto;
    }

    public function setID_Proyecto($ID_Proyecto) {
        $this->ID_Proyecto = $ID_Proyecto;
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
        $sql = "INSERT INTO Categoria (ID_Proyecto, Nombre, Estado ) VALUES (:ID_Proyecto, :Nombre, :Estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Estado', $this->Estado);
        $result = $stmt->execute();
        return $result ? 1 : 0;
    }

    public function buscarProyectoNombreId(){ // funcion para Buscar
        $res = array();
        $registro="SELECT nombre from proyecto where ID_Proyecto ='".$this->ID_Proyecto."' LIMIT 1";
        $preparado = $this->conexion->prepare($registro);
        $preparado->execute();
        $datos = $preparado->fetch(PDO::FETCH_ASSOC);
        if( $datos) {
            $res['nombre'] = $datos['nombre'];
        }
        return $res;
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

    public function buscarCategoriaPorIDProyecto($ID_Proyecto) {
        try {
            $sql = "SELECT * FROM Categoria WHERE ID_Proyecto = :ID_Proyecto";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':ID_Proyecto', $ID_Proyecto);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar categorías por ID de proyecto: " . $e->getMessage(), 0);
            return array();
        }
    }

    public function buscarPresupuestoPorIDProyecto() {
        try {
            $sql = "SELECT item.id_item, item.ID_Categoria, presupuesto.id_proyecto, presupuesto.monto_presupuesto FROM item, presupuesto WHERE presupuesto.id_proyecto = :ID_Proyecto && item.id_item = presupuesto.id_item";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar todos los Proyectos: " . $e->getMessage(), 0);
            return array();
        }
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