<?php
    require_once("../modelo/conexionPDO.php");

    class ItemModelo extends Conexion {
        private $id_item;
        private $nombre;
        private $estado;
        private $objbd;

        public function __construct(){
			parent::__construct();
			$this->objbd = parent::conectar();
		}
		 
		 // métodos 
		public function get_iditem(){
			return $this->id_item;
		}
		
		public function set_iditem( $id_item ){
			$this->id_item = $id_item;	
		}
	
		public function get_nombre(){
			return $this->nombre;
		}
		
		public function set_nombre( $nombre ){
			$this->nombre = $nombre;
		}
		
		public function get_estado(){
			return $this->estado;
		}
		
		public function set_estado( $estado ){
			$this->estado = $estado;
		}
	
		/*public function consultar(){ // funcion para Buscar
			$lista = array();
			$registro = "SELECT * FROM item";
			$preparado = $this->objbd->prepare($registro);
			$resul = $preparado->execute();
			// Almacenar en un arreglo todos los registros
			while( $datos = $preparado->fetch(PDO::FETCH_ASSOC) ){
				$lista[] = $datos;
			}
			return $lista;
		} */
		
		public function incluir() { // funcion para Incluir
			$registro = "INSERT INTO item (nombre, estado) VALUES (:nombre,:estado)";
			$preparado = $this->objbd->prepare($registro);
			$preparado->bindParam(':nombre', $this->nombre);
			$preparado->bindParam(':estado', $this->estado);
			$resul= $preparado->execute();
			
			if( $resul )
				$res = 1;
			else
				$res = 0;
			return $res;   		
		}
	
		 public function buscar(){ // funcion para Buscar
			$registro="SELECT * from item where id_item='".$this->id_item."'";
			$preparado = $this->objbd->prepare($registro);
			$preparado->execute();
			$datos = $preparado->fetch(PDO::FETCH_ASSOC);
			if( $datos) {
				$encontro = 1;
				$this->id_item = $datos['id_item'];
				$this->nombre = $datos['nombre'];
				$this->estado = $datos['estado'];
			} else
				$encontro = 0;
				
			return $encontro;
		} 
		 
		public function modificar(){ 
			$registro= "UPDATE item SET nombre='".$this->nombre."', estado='".$this->estado."' WHERE id_item='".$this->id_item."'";  
			$preparado = $this->objbd->prepare($registro);
			$resul = $preparado->execute();
			return $resul;
			
		}
		
		public function eliminar() 	{ // funcion para Eliminar
			$registro = "DELETE FROM item WHERE id_item='".$this->id_item."'";
			$preparado = $this->objbd->prepare( $registro );
			$resul = $preparado->execute();
			return $resul;
		}
		// Fin de funciones CRUD de Producto
		// Consultar lista de proveedores
		/*public function proveedor_consultar(){
			$lista = array();
			$registro = "SELECT * FROM proveedor";
			$preparado = $this->objbd->prepare($registro);
			$resul = $preparado->execute();
			// Almacenar en un arreglo todos los registros
			while( $datos = $preparado->fetch(PDO::FETCH_ASSOC) ){
				$lista[] = $datos;
			}
			return $lista;
		} */

		public function totalItem(){
			$consulta = "SELECT COUNT(*) AS total FROM item";
			$preparado = $this->objbd->prepare($consulta);
			$preparado->execute();
			$resultado = $preparado->fetch(PDO::FETCH_ASSOC);
			return $resultado['total'];
		}
	}
?>