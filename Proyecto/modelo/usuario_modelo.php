<?php
require_once("conexionPDO.php");

class Usuario extends Conexion {
    private $ID_Usuario;
    private $Usuario;
    private $Contraseña;
    private $Nombre;
    private $Apellido;
    private $objbd;

    public function __construct(){
        parent::__construct();
        $this->objbd = parent::conectar();
    }

    public function get_ID_Usuario(){
        return $this->ID_Usuario;
    }
    
    public function set_ID_Usuario($ID_Usuario){
        $this->ID_Usuario = $ID_Usuario;
    }

    public function get_Usuario() {
        return $this->Usuario;
    }
    
    public function set_Usuario($Usuario){
        $this->Usuario = $Usuario;
    }

    public function get_Contraseña(){
        return $this->Contraseña;
    }
    
    public function set_Contraseña($Contraseña){
        $this->Contraseña = $Contraseña;
    }

    public function get_Nombre(){
        return $this->Nombre;
    }
    
    public function set_Nombre($Nombre){
        $this->Nombre = $Nombre;
    }

    public function get_Apellido(){
        return $this->Apellido;
    }
    
    public function set_Apellido($Apellido){
        $this->Apellido = $Apellido;
    }

    public function usuario_buscar(){
        $lista = array();
        $consulta = $this->objbd->query("SELECT * FROM usuario");
        while($filas = $consulta->fetch(PDO::FETCH_ASSOC)){
            $lista[] = $filas;
        }
        return $lista;    
    }

    public function autenticarUsuario($usuario, $clave) {
        $registro = "SELECT * FROM usuario WHERE Usuario = :usuario AND Contraseña = :clave";
        $preparado = $this->objbd->prepare($registro);
        $preparado->bindParam(':usuario', $usuario);
        $preparado->bindParam(':clave', $clave);
        $preparado->execute();
        $datos = $preparado->fetch(PDO::FETCH_ASSOC);
        if ($datos) {
            $this->ID_Usuario = $datos['ID_Usuario'];
            $this->Usuario = $datos['Usuario'];
            $this->Contraseña = $datos['Contraseña'];
            $this->Nombre = $datos['Nombre'];
            $this->Apellido = $datos['Apellido'];
            return true;
        } else {
            return false;
        }
    }    
}
?>