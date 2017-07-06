<?php 

require_once("../lib/nusoap.php"); 
include_once("../Usuario.php");
include_once("../Materiales.php"); //Por que al sacar Materiales, rompe el webserice??
include_once("../Cd.php");

$server = new nusoap_server(); 

$server->configureWSDL('WEB Server Usuarios', 'urn:userWS'); 

//$server->register('Ingresar',                	// METODO
//					array('usuario' => 'xsd:string',
//					'clave' => 'xsd:string', 'correo' => 'xsd:string'),
//					array('return' => 'xsd:Array'),    		// PARAMETROS DE SALIDA
//					'urn:userWS'               		// NAMESPACE				  
//				);

$server->register('TraerUno',                	
					array('id' => 'xsd:int'),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);

$server->register('Baja',                	
					array('id_usuario' => 'xsd:int'),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Baja',             
					'rpc',                        		
					'encoded',                    		
					'Baja de Un Usuario por Parametros'    			
				);

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

$server->register('Agregar',                	
					array('nombre' => 'xsd:string',
							'email'  => 'xsd:string',
						  	'perfil' => 'xsd:string',
						  	'pass'   => 'xsd:string'),  
					array('return' => 'xsd:int'),   
					'urn:userWS',                		
					'urn:userWS#Agregar',             
					'rpc',                        		
					'encoded',                    		
					'Agregar un usuario'    			
				);

$server->register('TraerTodos',                	
					array(),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);


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


function TraerTodos()
{
	return Usuario::TraerTodosLosUsuarios();
}


function Agregar($nombre,$email,$perfil,$pass)
{
	$obj->nombre 	= $nombre;
	$obj->email		= $email;
	$obj->perfil 	= $perfil;
	$obj->pass 		= $pass;

	$variable = Usuario::Agregar($obj);
	return $variable;
}


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

function ObtenerTodosLosCds(){
	return Cd::TraerTodos();	

}


$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
$server->service($HTTP_RAW_POST_DATA);



?>