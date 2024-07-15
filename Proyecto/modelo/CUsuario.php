<?php
require_once("conexionPDO.php");

class Usuario extends Conexion {
    private $id_usuario;
    private $usuario;
    private $clave;
    private $nombre;
    private $apellido;
    private $objbd;

    public function __construct(){
        parent::__construct();
        $this->objbd = parent::conectar();
    }

    public function get_idusuario(){
        return $this->id_usuario;
    }

    public function set_idusuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function get_usuario() {
        return $this->usuario;
    }

    public function set_usuario($usuario){
        $this->usuario = $usuario;
    }

    public function get_clave(){
        return $this->clave;
    }

    public function set_clave($clave){
        $this->clave = $clave;
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

    public function autenticarUsuario($usuario, $clave) {
        $query = "SELECT * FROM usuario WHERE Usuario = :usuario AND Contraseña = :clave";
        $stmt = $this->objbd->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':clave', $clave);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($datos) {
            $this->id_usuario = $datos['ID_Usuario'];
            return true;
        } else {
            return false;
        }
    }
}
?>