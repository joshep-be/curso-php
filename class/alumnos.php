<?php
class alumnos{

	var $db;
	var $id_alumno;
	var $matricula;
	var $nombre;
	var $sexo_id;

	function alumnos($db){
		$this->db=$db;
		$this->table="alumnos";
	}// Fin de constructor

	function agregar_alumno(){
		$oData = new Data($this->db);
		$sql="INSERT INTO " . $this->table . " (
		id_alumno,
		matricula,
		nombre,
		sexo_id
		) 
		VALUES (
		'',
		'" . $this->matricula . "',
		'" . $this->nombre . "',
		'" . $this->sexo_id . "'
		)";
		return $oData->add($sql); 
	}// Fin de método add


	function actualizar_alumno($id_alumno){		
		$sql="UPDATE " . $this->table . " SET 
			matricula   = '" . $this->matricula . "',
			nombre      = '" . $this->nombre . "',
			sexo_id     = '" . $this->sexo_id . "'
		WHERE id_alumno ='" . $id_alumno . "' LIMIT 1";
		$oData = new Data($this->db);
		$oData->upDate($sql);
	}// Fin de método upDate


	function obtener_alumno($id_alumno){
		$oData = new Data($this->db);
		$sql = "SELECT * FROM " . $this->table . " WHERE id_alumno = '" . $id_alumno  . "'";		
		$a_res = $oData->get($sql); // Retorna un recorset
		if( $a_res == false ){ // Si no hay resultados
		}else{ // Si encuentra resultados
			$this->matricula  = $a_res["matricula"];
			$this->nombre     = $a_res["nombre"];
			$this->sexo_id    = $a_res["sexo_id"];
			return true;
		}// Fin de if						
	}// Fin de método 

	function lista_alumnos(){
		$sql = "SELECT * FROM ".$this->table." 
				LEFT JOIN sexo 
				ON  alumnos.sexo_id = sexo.id_sexo";	
		$oData = new Data($this->db);		
		return $oData->getList($sql);
	}
}

?>