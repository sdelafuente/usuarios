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
	

//Si existe como archivo 	
if(is_file($db_txt)) {
    
    //Capturo todos los registros 
	$lineas = file($db_txt);

    //Loopeao 
	foreach($lineas as $linea) {

        //Genero una lista de casa registros 
	    list($user,$pass,$perfil) = explode("=>",trim($linea),3);
		
        //Verificacion de tipo string 
        if(is_string($user)  &&  is_string($pass)) {
			
            //Si los datos que ingresaron son correctos, entra. 
			if( $user == $obj->email && $obj->pass) {
				
                //Set de mi cookie
                setcookie("miCookie",$obj->email ,  time()+30 , '/');
				
                //Cargo el nombre y el perfil
                $obj->nombre = strstr($obj->email, '@', true);
				$obj->perfil = $perfil;
				
                //Creo la session del Usuario activo. 
                $_SESSION['Usuario'] = json_encode($obj);
					
			}
        }
    }
} else {
        //Por el momento Irrelevante.
        $obj->Exito = false;
   }	

//Devuelvo el Objeto Json		
echo json_encode($obj);