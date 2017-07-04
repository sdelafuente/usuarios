<?php
//Verifico la session
if(!isset($_SESSION))
    //Start Session     
	session_start();
   if(!isset($_SESSION['appLucasRodriguezSession_on'])){
      header("location:frmLogin.php");
   }
    require_once('clases/lib/nusoap.php');
	require_once('clases/Usuario.php');
	require_once('clases/AccesoDatos.php');
	
	//Capturo el Usuario logueado 
    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
	
    //Clase Standard 
    $obj = new stdClass();
    $obj->Exito = TRUE;
    $obj->Mensaje = "";
	$obj->email = $usuario->Email;
	$obj->pass = $usuario->Password;
	$obj->nombre ="";
	$obj->perfil = "";

    //Usuarios 
	$db_txt = 'usuarios.txt';
	

		
	
	
if(is_file($db_txt)) {
    //
	$lineas = file($db_txt);
	foreach($lineas as $linea) {
	    list($user,$pass,$perfil) = explode("=>",trim($linea),3);
		if(is_string($user)  &&  is_string($pass)) {
			
			if( $user == $obj->email && $obj->pass) {
				
                setcookie("miCookie",$unUsuario->email ,  time()+30 , '/');
				
                $obj->nombre = strstr($unUsuario->email, '@', true);
				$obj->perfil = $perfil;
				
                $_SESSION['Usuario']= json_encode($obj);
					
			}
        }
    }
} else {
        $obj->Exito = false;
   }	
		
echo json_encode($obj);