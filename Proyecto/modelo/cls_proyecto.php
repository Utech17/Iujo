<?php

require_once BASE_PATH . "/conexionPOD.php";

class cls_proyecto extends conexion
{

    private $ID_Proyecto;
    private $Nombre;
    private $Descripción;
    private $Estado;
    private $objbd;

    public function __construct()
    {
        parent::__construct();
        $this->objbd = parent::conectar();
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


    public function incluir()
    {
        // Verifica si ya existe un registro con los mismos valores en la base de datos
        $registro = "SELECT * FROM cliente WHERE ID_Proyecto='" . $this->ID_Proyecto . "'";
        $preparado = $this->objbd->prepare($registro);
        $preparado->execute();
        // Comprueba si la consulta devuelve algún resultado
        if ($preparado->rowCount() > 0) {
            // Mostrar mensaje de error al usuario
            echo "<script>alert('Registrado duplicado, por favor verifique')</script>";
        } else {
            // Insertar los datos en la base de datos
            $registro = "INSERT INTO cliente (Nombre,ID_Proyecto,Descripción,Estado) VALUES (:Nombre,:ID_Proyecto,:Descripción,:Estado)";
            $preparado = $this->objbd->prepare($registro);
            $preparado->bindParam(':Nombre', $this->Nombre);
            $preparado->bindParam(':ID_Proyecto', $this->ID_Proyecto);
            $preparado->bindParam(':Descripción', $this->Descripción);
            $preparado->bindParam(':Estado', $this->Estado);


            $resul = $preparado->execute();
            if ($resul) {
                $res = 1;
            } else {
                $res = 0;
            }
            return $res;
        }
    }

    public function buscar($rif)
    {
        // Busca registro con los mismos valores en la base de datos

        $registro = "SELECT * FROM cliente WHERE ID_Proyecto='" . $rif . "' AND activo=1";
        $preparado = $this->objbd->prepare($registro);
        $resul = $preparado->execute();
        $datos = $preparado->fetch(PDO::FETCH_ASSOC);

        if ($datos) {
            $encontro = 1;
            $this->Nombre = $datos['Nombre'];
            $this->ID_Proyecto = $datos['ID_Proyecto'];
            $this->Descripción = $datos['Descripción'];
            $this->Estado = $datos['Estado'];
        } else {

            $encontro = 0;
        }
        return $encontro;
    }

    public function modificar()
    {
        $registro = "UPDATE cliente SET Nombre='" . $this->Nombre . "', Descripción='" . $this->Descripción . "',Estado='" . $this->Estado . "' where ID_Proyecto='" . $this->ID_Proyecto . "'";
        $preparado = $this->objbd->prepare($registro);
        $resul = $preparado->execute();
        return $resul;
    }

    public function eliminar()
    {
        $registro = "UPDATE cliente SET activo = 0 WHERE ID_Proyecto='" . $this->ID_Proyecto . "'";
        $preparado = $this->objbd->prepare($registro);
        $resul = $preparado->execute();
        return $resul;
    }
}
