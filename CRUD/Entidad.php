<?php

class Datos   
{

	private $Identificador;
	private $Nombre_Proyecto;
	private $Autores;
	private $Nombre_Asesor;
    private $Fecha_Ingreso;
	private $Nota;
	private $Linea_Investigacion;

	public function __GET($k){ return $this->$k; }   
	public function __SET($k, $v){ return $this->$k = $v; } 
}
?>