<?php
    require_once("../modelo/conexionPDO.php");

    class ItemModelo extends Conexion {
        private $id_item;
        private $id_proyecto;
        private $id_categoria;
        private $nombre;
        private $estado;
        private $objbd;

        public function __construct(){
			parent::__construct();
			$this->objbd = parent::conectar();
		}
		 
		 // métodos 
		public function get_iditem(){
			return $this->iditem;
		}
		
		public function set_iditem( $iditem ){
			$this->iditem = $iditem;	
		}
	
		public function get_idproyecto(){
			return $this->idproyecto;
		}
		
		public function set_idproyecto( $idproyecto ){
			$this->idproyecto = $idproyecto;
		}
	
		public function get_idcategoria(){
			return $this->idcategoria;
		}
		
		public function set_idcategoria( $idcategoria ){
			$this->idcategoria = $idcategoria;
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
			$registro = "INSERT INTO item (id_item, id_proyecto, id_categoria, nombre, estado) VALUES (:idproyecto,:idcategoria,:nombre,:estado)";
			$preparado = $this->objbd->prepare($registro);
			$preparado->bindParam(':idproyecto', $this->idproyecto);
			$preparado->bindParam(':idcategoria', $this->idcategoria); 
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
			$registro="SELECT * from item where id_item='".$this->iditem."'";
			$preparado = $this->objbd->prepare($registro);
			$preparado->execute();
			$datos = $preparado->fetch(PDO::FETCH_ASSOC);
			if( $datos) {
				$encontro = 1;
				$this->iditem = $datos['id_item'];
				$this->idproyecto = $datos['id_proyecto'];
				$this->idcategoria = $datos['id_categoria'];
				$this->nombre = $datos['nombre'];
				$this->estado = $datos['estado'];
			} else
				$encontro = 0;
				
			return $encontro;
		} 
		 
		public function modificar(){ 
			$registro= "UPDATE item SET id_proyecto='".$this->idproyecto."',id_categoria='".$this->idcategoria."', nombre='".$this->nombre."', estado='".$this->estado."' WHERE id_item='".$this->iditem."'";  
			$preparado = $this->objbd->prepare($registro);
			$resul = $preparado->execute();
			return $resul;
			
		}
		
		public function eliminar() 	{ // funcion para Eliminar
			$registro = "DELETE FROM item WHERE id_item='".$this->iditem."'";
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