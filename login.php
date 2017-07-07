<?php
    //Librerias
    require_once('clases/lib/nusoap.php');
    require_once('clases/Usuario.php');
    require_once('clases/AccesoDatos.php'); 

    //Verifico la session
    if(!isset($_SESSION))    
    	session_start();

    //Siempre da TRUE
    if(!isset($_SESSION['sessionAbierta'])){
        header("location:frmLogin.php");
    }

    //Servido NuSoap
    $host   = 'http://localhost/abmUsuarios/clases/SERVIDOR/wsUsuarios.php';
    $client = new nusoap_client($host . '?wsdl');

    $err = $client->getError();
    if ($err) {
        echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
        die();
    }

	//Capturo el Usuario logueado 
    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
	
    //Objeto
    $obj = new stdClass();
    $obj->Exito = FALSE;
    $obj->Mensaje = "";
	$obj->email = isset($usuario->email) ? $usuario->email : NULL;
	$obj->pass = isset($usuario->pass) ? $usuario->pass : NULL;
	$obj->nombre ="";
	$obj->perfil = "";

    //$log = $client->call('Ingresar', array('email' => $obj->email, 'pass' => $obj->pass));
	
    //Busco el usuario
    $log = Usuario::TraerUsuarioLogueado($obj);    

    //Si existe, entro.
    if(is_object($log)) {
        
        //Actualizo el objeto con los datos de la persona
        $obj->id      = $log->id; 
        $obj->nombre  = $log->nombre;
        $obj->perfil  = $log->perfil;
        $obj->Exito   = TRUE;
        $obj->Mensaje = "User";

        //Creo la session del Usuario activo. 
        $_SESSION['Usuario'] = json_encode($obj);
        
        //Seteo la Cookie 
        setcookie("cookie_usuario", $obj->nombre .' - '.$obj->email ,  time()+30 , '/');

    } else {
            //Por el momento Irrelevante.
            $obj->Exito = false;
    }	

    //Devuelvo el Objeto Json		
    echo json_encode($obj);
?>    