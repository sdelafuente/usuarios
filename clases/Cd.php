<?php
/*
	Clase: Cd
*/
class Cd
{
	//Atributos	
	public $id;
	public $interpret;
	public $jahr;
	public $titel;
	
	//Metodo: TraerTodos
	public static function TraerTodos()
	{
		
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
		$sql = "SELECT id, interpret, jahr, titel
				FROM cds";

		$consulta = $objetoAccesoDato->RetornarConsulta($sql);
		$consulta->execute();
		
		//return $consulta->fetchall(PDO::FETCH_CLASS, "Cd");
		//Devuelvo un Array de los CDs en la base
		return $consulta->fetchall();
		
	}
}