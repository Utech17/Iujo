<?php
    require_once("../modelo/conexionPDO.php");

    class PresupuestoModelo extends Conexion {
        private $id_item;
		private $id_proyecto;
        private $cantidad;
        private $monto_presupuesto;
        private $objbd;

        public function __construct(){
			parent::__construct();
			$this->objbd = parent::conectar();
		}
		 
		 // métodos 
		public function get_id(){
			return $this->id_item;
		}
		
		public function set_iditem( $id_item ){
			$this->id_item = $id_item;	
		}

        public function get_idproyecto(){
            return $this->id_proyecto;
        }
        
        public function set_idproyecto( $id_proyecto ){
            $this->id_proyecto = $id_proyecto;
        }

        public function get_cantidad(){
            return $this->cantidad;
        }
        
        public function set_cantidad( $cantidad ){
            $this->cantidad = $cantidad;
        }

        public function get_montopresupuesto(){
            return $this->monto_presupuesto;
        }
        
        public function set_montopresupuesto( $monto_presupuesto ){
            $this->monto_presupuesto = $monto_presupuesto;
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
			$registro = "INSERT INTO item (id_item, id_proyecto, cantidad, monto_presupuesto) VALUES (:id_item,:id_proyecto,:cantidad,:monto_presupuesto)";
			$preparado = $this->objbd->prepare($registro);
			$preparado->bindParam(':id_item', $this->id_item);
            $preparado->bindParam(':id_proyecto', $this->id_proyecto);
            $preparado->bindParam(':cantidad', $this->cantidad);
            $preparado->bindParam(':monto_presupuesto', $this->monto_presupuesto);
			$resul= $preparado->execute();
			
			if( $resul )
				$res = 1;
			else
				$res = 0;
			return $res;   		
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
    }
?>