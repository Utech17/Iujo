<?php
require_once("../modelo/conexionPDO.php");

class Proyecto
{
    private $conexion;
    private $ID_Proyecto;
    private $Nombre;
    private $Descripcion;
    private $Estado;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function get_ID_Proyecto()
    {
        return $this->ID_Proyecto;
    }

    public function set_ID_Proyecto($ID_Proyecto)
    {
        $this->ID_Proyecto = $ID_Proyecto;
    }

    public function get_Nombre()
    {
        return $this->Nombre;
    }

    public function set_Nombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function get_Descripcion()
    {
        return $this->Descripcion;
    }

    public function set_Descripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

    public function get_Estado()
    {
        return $this->Estado;
    }

    public function set_Estado($Estado)
    {
        $this->Estado = $Estado;
    }

    public function agregarProyecto()
    {
        $sql = "INSERT INTO proyecto (Nombre, Descripcion) VALUES (:Nombre, :Descripcion)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Descripcion', $this->Descripcion);
        $result = $stmt->execute();
        return $result ? 1 : 0;
    }

    public function buscarTodos()
    {
        try {
            $sql = "SELECT * FROM proyecto";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar todos los Proyectos: " . $e->getMessage(), 0);
            return array();
        }
    }

    public function buscarProyectoPorID($ID_Proyecto)
    {
        $sql = "SELECT * FROM proyecto WHERE ID_Proyecto = :ID_Proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Proyecto', $ID_Proyecto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarProyecto()
    {
        $sql = "UPDATE proyecto SET Nombre = :Nombre, Descripcion = :Descripcion, Estado = :Estado WHERE ID_Proyecto = :ID_Proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Descripcion', $this->Descripcion);
        $stmt->bindParam(':Estado', $this->Estado);
        return $stmt->execute();
    }

    public function eliminarCategoriasPorProyecto()
    {
        $sql = "DELETE FROM categoria WHERE ID_Proyecto = :ID_Proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
        return $stmt->execute();
    }

    public function eliminarProyecto()
    {
        try {
            $this->conexion->beginTransaction();
            $this->eliminarCategoriasPorProyecto();
            $sql = "DELETE FROM proyecto WHERE ID_Proyecto = :ID_Proyecto";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
            $stmt->execute();
            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
