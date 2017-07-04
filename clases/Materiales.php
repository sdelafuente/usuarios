<?php 
include_once("AccesoDatos.php");

class Material
{
    /*
      Atributos 
    */
	public $Codigo;
 	public $Nombre;
  	public $Precio;
	public $Tipo;
	
  	
	public static function TraerTodos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
		$sql = "SELECT *
				FROM materiales";

		$consulta = $objetoAccesoDato->RetornarConsulta($sql);
		$consulta->execute();

		return $consulta->fetchall();	        
	}

	 public  static function InsertarMaterial($nombre,$precio,$tipo)
	 {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into materiales (nombre, precio,tipo)values(:nombre,:precio,:tipo)");

        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }

	 public static function BorrarMaterial($id)
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from materiales 				
				WHERE Codigo=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->RowCount();
	 }
	 
	  public static function TraerTipos() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $sql = "SELECT DISTINCT(U.Tipo) AS Tipo
                FROM materiales U";

        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();

        return $consulta->fetchall(PDO::FETCH_ASSOC);
    }
	
	 public static function Modificar($Codigo,$Nombre,$Precio,$Tipo)
	 {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = "UPDATE materiales 
                SET Nombre = :nombre, Precio = :precio, Tipo = :tipo
                WHERE Codigo=:codigo";
        
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':codigo', $Codigo, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $Nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $Precio, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $Tipo, PDO::PARAM_STR);
        $consulta->execute();
        
        return $consulta->rowCount();
    }
  }