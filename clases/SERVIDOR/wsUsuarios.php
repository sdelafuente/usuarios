<?php 

require_once('../lib/nusoap.php'); 
require_once('../Usuario.php');
include_once("../Materiales.php");
include_once("../Cd.php");

$server = new nusoap_server(); 

$server->configureWSDL('WEB Server Usuarios', 'urn:userWS'); 

$server->wsdl->addComplexType(
    'Material',
    'complexType',
    'struct',
    'all',
    '',
    array(
        //'id_user' => array('name' => 'id_user', 'type' => 'xsd:int'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'tipo' => array('name' => 'tipo', 'type' => 'xsd:string'),
        'precio' => array('name' => 'precio', 'type' => 'xsd:int')
    )
);

//
$server->register('Ingresar',                	// METODO
					array('usuario' => 'xsd:string',
					'clave' => 'xsd:string', 'correo' => 'xsd:string'),
					array('return' => 'xsd:Array'),    		// PARAMETROS DE SALIDA
					'urn:userWS'               		// NAMESPACE				  
				);
//
$server->register('TraerTodos',                	
					array(),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);
/*
$server->register('TraerUno',                	
					array('id' => 'xsd:int'),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);
*/
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
/*
$server->register('Baja',                	
					array('usuario' => 'xsd:int'),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Baja',             
					'rpc',                        		
					'encoded',                    		
					'Baja de Un Producto por Parametros'    			
				);
//
$server->register('Modificar',                	
					array('usuario' => 'xsd:string', 'correo' => 'xsd:string', 'clave' => 'xsd:string', 'tipo' => 'xsd:string', 'id' => 'xsd:string'),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Baja',             
					'rpc',                        		
					'encoded',                    		
					'Baja de Un Usuario por Parametros'    			
				);
//
$server->register('InsertarFoto',                	
				array('nombre' => 'xsd:string', 'id' => 'xsd:string'),  
				array('return' => 'xsd:string'),   
				'urn:userWS',                		
				'urn:userWS#Baja',             
				'rpc',                        		
				'encoded',                    		
				'Baja de Un Usuario por Parametros'    			
			);
//
$server->register('AltaMaterial',                	
					array('nombre' => 'xsd:string',
							'precio' => 'xsd:int',
							'tipo' => 'xsd:string'),  
					array('return' => 'xsd:int'),   
					'urn:userWS',                		
					'urn:userWS#AltaMaterial',             
					'rpc',                        		
					'encoded',                    		
					'Alta de Un Producto'    			
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
*/

/**
* 
*
* @return	Traer la lista completa de materiales 
* @access	public
*/	
function TraerTodos()
{
	return Usuario::TraerTodosLosUsuarios();
}

/**
* 
*
* @return	Nada
* @access	public
*/

function Agregar($nombre,$email,$perfil,$pass)
{
	$obj->nombre 	= $nombre;
	$obj->email		= $email;
	$obj->perfil 	= $perfil;
	$obj->pass 		= $pass;

	$variable = Usuario::Agregar($obj);
	return $variable;
}

/**
* 
*
* @return	
* @access	public
*/
function Baja($id)
{
		$cantidad = Material::BorrarMaterial($id);
		
		if($cantidad ==1)
			$Mensaje = "el user fue eliminado correctamente";
		else	
		{
			$Mensaje ="no se pudo eliminar";
		}
			
        return $Mensaje;
}

/**
* 
*
* @return	
* @access	public
*/
function Modificar($Codigo,$Nombre,$Precio,$Tipo)
{
		$cantidad = Material::Modificar($Codigo,$Nombre,$Precio,$Tipo);
		
		if($cantidad ==1)
			$Mensaje = "el user fue Updateado correctamente";
		else	
		{
			$Mensaje ="no se pudo eliminar";
		}
			
        return $Mensaje;
	
}

/**
* 
*
* @return	
* @access	public
*/
function ObtenerTodosLosCds(){
	return Cd::TraerTodos();	

}


$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
$server->service($HTTP_RAW_POST_DATA);



?>