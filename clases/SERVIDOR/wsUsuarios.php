<?php 
//Libreria
include_once("../lib/nusoap.php"); 
include_once("../AccesoDatos.php");
include_once("../Usuario.php");
include_once("../Cd.php");

//Objeto Servidor 
$server = new nusoap_server(); 

//Namespace
$ns = 'urn:userWS';

//configuracion 
$server->configureWSDL('WEB Server Usuarios', $ns); 

//Metodo Ingresar
$server->register('Ingresar',                	// METODO
					array('email' => 'xsd:string','pass' => 'xsd:string'),
					array('return' => 'xsd:Array'),
					'urn:userWS', // NAMESPACE				                  		
					'urn:userWS#Ingresar',             
					'rpc',                        		
					'encoded',                    		
					'Ingresar por usuario'
				);

//Metodo TraerUno(Usuario)
$server->register('TraerUno',                	
					array('id' => 'xsd:int'),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);

//Metodo Agregar
$server->register('Agregar',                	
					array('nombre' => 'xsd:string',
							'email'  => 'xsd:string',
						  	'perfil' => 'xsd:string',
						  	'pass'   => 'xsd:string',
						  	'foto' => 'xsd:string'),  
					array('return' => 'xsd:int'),   
					'urn:userWS',                		
					'urn:userWS#Agregar',             
					'rpc',                        		
					'encoded',                    		
					'Agregar un usuario'    			
				);

//Metodo Baja
$server->register('Baja',                	
					array('id_usuario' => 'xsd:int'),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Baja',             
					'rpc',                        		
					'encoded',                    		
					'Baja de Un Usuario por Parametros'    			
				);

//Metodo Modificar
$server->register('Modificar',                	
					array(
							'id' => 'xsd:string',
							'nombre' => 'xsd:string',
							'email'	=> 'xsd:string',
							'perfil'=> 'xsd:string'
						),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Modificar',             
					'rpc',                        		
					'encoded',                    		
					'Modificacion de un usuario'
				);

//Metodo TraerTodos(Usuarios)
$server->register('TraerTodos',                	
					array(),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);

//Metodo Obtener Cds
$server->register('ObtenerTodosLosCds',
					array(),
					array('return' => 'xsd:Array'),
					'urn:userWS',
					'urn:userWS#ObtenerTodosLosCds',
					'rpc',
					'encoded',
					'Trae Todos Los Cds'
				);
/*

$server->register('InsertarFoto',                	
				array('nombre' => 'xsd:string', 'id' => 'xsd:string'),  
				array('return' => 'xsd:string'),   
				'urn:userWS',                		
				'urn:userWS#Baja',             
				'rpc',                        		
				'encoded',                    		
				'Baja de Un Usuario por Parametros'    			
			);

*/

/*
*	Nombre: ObtenerTodosLosCds
*
*/
function ObtenerTodosLosCds(){
	return Cd::TraerTodos();	

}


/*
*	Nombre: TraerTodos
*
*/
function TraerTodos()
{
	return Usuario::TraerTodosLosUsuarios();
}

/*
*	Nombre: Ingresar
*
*/
function Ingresar($email,$pass) {

	$obj->email = $email;
	$obj->pass  = $pass;

	return Usuario::TraerUsuarioLogueado($obj);

}

/*
*	Nombre: Agregar
*
*/
function Agregar($nombre,$email,$perfil,$pass,$foto)
{
	$obj->nombre 	= $nombre;
	$obj->email		= $email;
	$obj->perfil 	= $perfil;
	$obj->pass 		= $pass;
	$obj->foto 		= $foto;

	if(!guardarFoto($foto))		
		$variable = Usuario::Agregar($obj);
	return $variable;
}

/*
*	Nombre: Modificar
*
*/
function Modificar($id,$nombre,$email,$perfil)
{
	$obj->id 		= $id;
	$obj->nombre 	= $nombre;
	$obj->email		= $email;
	$obj->perfil 	= $perfil;		

	$cantidad = Usuario::Modificar($obj);

	if($cantidad == 1) {
		$Mensaje = "el usuario fue Updateado";
	} else {
		$Mensaje ="no se pudo modificar";
	}
	return $Mensaje;
}

/*
*	Nombre: Baja
*
*/
function Baja($id)
{
	$cantidad = Usuario::Borrar($id);
		
	if($cantidad ==1)
		$Mensaje = "el user fue eliminado correctamente";
	else	
	{
		$Mensaje ="no se pudo eliminar";
	}
			
    return $Mensaje;
}

/*
*	Nombre: guardarFoto
*
*/
function guardarFoto($foto) {
	if ( isset($_FILES[$foto]["type"]) ) {
	    //
	    $validextensions = array("jpeg", "jpg", "png");
	    //
	    $temporary = explode(".", $_FILES[$foto]["name"]);
	    //
	    $file_extension = end($temporary);
	    //
	    $ruta = "C:/xampp/htdocs/images/";
	    //
	    if (
	        ( 
	            ($_FILES[$foto]["type"] == "image/png") || 
	            ($_FILES[$foto]["type"] == "image/jpg") || 
	            ($_FILES[$foto]["type"] == "image/jpeg") ) && 
	            ($_FILES[$foto]["size"] < 100000) &&     //Approx. 100kb files can be uploaded.
	            in_array($file_extension, $validextensions)
	        )
	        {
	            if ($_FILES[$foto]["error"] > 0) {
	                //echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
	            	return 1;
	            } else {
	                //Ver si existe 
	                if (file_exists($ruta . $_FILES[$foto]["name"])) {
	                    //Ya existe 
	                    //echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
	                    return 1;
	                }
	                else
	                {
	                    //    
	                    $sourcePath = $_FILES[$foto]['tmp_name']; // Storing source path of the file in a variable
	                    $targetPath = $ruta . $_FILES[$foto]['name']; // Target path where file is to be stored
	                    move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
	                    return 0;
	                }
	            }
	        }
	    else
	    {
	        //echo "<span id='invalid'>***Invalid file Size or Type***<span>";
	        return 1;
	    }
	}	
}

//Esta función es similar a file(), excepto que file_get_contents() devuelve el fichero a un string, 
//comenzando por el offset especificado hasta maxlen bytes. Si falla, file_get_contents() devolverá
$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
$server->service($HTTP_RAW_POST_DATA);



?>