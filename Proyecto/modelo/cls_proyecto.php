<?php
require_once("../modelo/conexionPDO.php");

class cls_proyecto extends Conexion
{
    // Attributes
    private $ID_Proyecto;
    private $Nombre;
    private $Descripción;
    private $Estado;

    private $conexion;

    // Constructor
    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    // Getters and Setters
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

    public function get_Descripción()
    {
        return $this->Descripción;
    }

    public function set_Descripción($Descripción)
    {
        $this->Descripción = $Descripción;
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

        $sql = "INSERT INTO proyecto (Nombre,Descripción,Estado) VALUES (:Nombre,:Descripción,:Estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Descripción', $this->Descripción);
        $stmt->bindParam(':Estado', $this->Estado);
        echo $stmt->debugDumpParams();
        $result = $stmt->execute();

        return $result ? 1 : 0;
        $stmt->execute();
        $errorInfo = $stmt->errorInfo();

        if ($errorInfo[0] !== 0) {
            echo "Error Code: " . $errorInfo[0] . "\n";
            echo "Error Message: " . $errorInfo[1] . "\n";
        }
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
        $sql = "UPDATE proyecto SET Nombre = :Nombre, Descripción = :Descripción, Estado = :Estado WHERE ID_proyecto = :ID_Proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Descripción ', $this->Descripción);
        $stmt->bindParam(':Estado', $this->Estado);
        $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
        return $stmt->execute();
    }

    public function eliminarProyecto()
    {
        $sql = "DELETE FROM proyecto WHERE ID_Proyecto = :ID_Proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':ID_Proyecto', $this->ID_Proyecto);
        return $stmt->execute();
    }
}
