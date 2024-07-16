<?php
    require_once("../modelo/conexionPDO.php");

    class ItemModelo extends Conexion {
        private $id_item;
		private $id_categoria;
		private $id_proyecto;
        private $nombre;
        private $estado;
		private $cantidad;
        private $presupuesto;
        private $objbd;

        public function __construct(){
			parent::__construct();
			$this->conexion = parent::conectar();
		}

		 // métodos 
		public function getID_Item(){
			return $this->id_item;
		}

		public function setID_Item( $id_item ){
			$this->id_item = $id_item;	
		}

		public function getID_Categoria(){
			return $this->id_categoria;
		}

		public function setID_Categoria( $id_categoria ){
			$this->id_categoria = $id_categoria;
		}

		public function getID_Proyecto(){
			return $this->id_proyecto;
		}

		public function setID_Proyecto( $id_proyecto ){
			$this->id_proyecto = $id_proyecto;
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre( $nombre ){
			$this->nombre = $nombre;
		}

		public function getEstado(){
			return $this->estado;
		}

		public function setEstado( $estado ){
			$this->estado = $estado;
		}

		public function getCantidad(){
			return $this->cantidad;
		}

		public function setCantidad( $cantidad ){
			$this->cantidad = $cantidad;
		}

		public function getPresupuesto(){
			return $this->presupuesto;
		}

		public function setPresupuesto( $presupuesto ){
			$this->presupuesto = $presupuesto;
		}

		public function agregarItem() { // funcion para Incluir
			$registro = "INSERT INTO item (id_item, ID_Categoria, nombre, estado) VALUES (:id_item,:ID_Categoria,:nombre,:estado)";
			$preparado = $this->conexion->prepare($registro);
			$preparado->bindParam(':id_item', $this->id_item);
			$preparado->bindParam(':ID_Categoria', $this->id_categoria);
			$preparado->bindParam(':nombre', $this->nombre);
			$preparado->bindParam(':estado', $this->estado);
			$resul= $preparado->execute();

			if( $resul ){
				$this->id_item = $this->conexion->lastInsertId();
				$result2 = $this->agregarPresupuesto();
				if( $result2 )
					$res = 1;
				else {
					$this->eliminarItem(1);
					$res = 0;
				}
			} else
				$res = 0;

			return $res;
		}

		public function agregarPresupuesto() { // funcion para Incluir
			$registro = "INSERT INTO presupuesto (id_item, id_proyecto, cantidad, monto_presupuesto) VALUES (:id_item,:id_proyecto,:cantidad,:presupuesto)";
			$preparado = $this->conexion->prepare($registro);
			$preparado->bindParam(':id_item', $this->id_item);
			$preparado->bindParam(':id_proyecto', $this->id_proyecto);
			$preparado->bindParam(':cantidad', $this->cantidad);
			$preparado->bindParam(':presupuesto', $this->presupuesto);
			$resul= $preparado->execute();

			if( $resul )
				$res = 1;
			else
				$res = 0;

			return $res;
		}

		public function buscarProyectoNombreId(){ // funcion para Buscar
			$res = array();
			$registro="SELECT nombre from proyecto where ID_Proyecto ='".$this->id_proyecto."' LIMIT 1";
			$preparado = $this->conexion->prepare($registro);
			$preparado->execute();
			$datos = $preparado->fetch(PDO::FETCH_ASSOC);
			if( $datos ){
				$res['nombre'] = $datos['nombre'];
			}
			return $res;
		}

		public function buscarCategoriaNombreId(){ // funcion para Buscar
			$res = array();
			$registro="SELECT nombre from categoria where ID_Categoria ='".$this->id_categoria."' LIMIT 1";
			$preparado = $this->conexion->prepare($registro);
			$preparado->execute();
			$datos = $preparado->fetch(PDO::FETCH_ASSOC);
			if( $datos){
				$res['nombre'] = $datos['nombre'];
			}
			return $res;
		}

		public function buscarItemPorIDCategoria($ID_Categoria) {
			try {
				$sql = "SELECT * FROM Item WHERE ID_Categoria = :ID_Categoria";
				$stmt = $this->conexion->prepare($sql);
				$stmt->bindParam(':ID_Categoria', $ID_Categoria);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Error al buscar item por ID de categoria: " . $e->getMessage(), 0);
				return array();
			}
		}

		public function buscarPresupuestoPorProyecto($ID_Proyecto) {
			try {
				$sql = "SELECT * FROM Presupuesto WHERE id_proyecto = :ID_Proyecto";
				$stmt = $this->conexion->prepare($sql);
				$stmt->bindParam(':ID_Proyecto', $ID_Proyecto);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Error al buscar presupuesto por ID de proyecto: " . $e->getMessage(), 0);
				return array();
			}
		}

		public function actualizarItem(){ 
			$registro= "UPDATE item SET nombre='".$this->nombre."', estado='".$this->estado."' WHERE id_item='".$this->id_item."'";  
			$preparado = $this->conexion->prepare($registro);
			$resul = $preparado->execute();
			if( $resul ){
				$registro2= "UPDATE presupuesto SET cantidad='".$this->cantidad."', monto_presupuesto='".$this->presupuesto."' WHERE id_item='".$this->id_item."'";  
				$preparado2 = $this->conexion->prepare($registro2);
				$result2 = $preparado2->execute();
			}
			return $resul;
		}

		public function eliminarItem( $tipo = 0 ){ // funcion para Eliminar
			if( $tipo != 1 ){ // Eliminar de tabla presupuesto
				$registro2 = "DELETE FROM presupuesto WHERE id_item='".$this->id_item."'";
				$preparado2 = $this->conexion->prepare( $registro2 );
				$resul2 = $preparado2->execute();
			}
			$registro = "DELETE FROM item WHERE id_item='".$this->id_item."'";
			$preparado = $this->conexion->prepare( $registro );
			$resul = $preparado->execute(); 

			return $resul;
		}
	}
?>