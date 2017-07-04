<?php 
//Archivos JSON
$json_users = "users.json";

//Capturo el Usuario logueado 
$usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;


//Si existe el archivo
if(is_file($json_users)) {
    //Capturo el contenido en un string y lo decodifico en un Array
    $json_a = json_decode(file_get_contents($json_users),true);
    
    //Array
    foreach ($json_a["users"] as $registro) {
        //Genero dinamicamente el Input
        if ($registro["categoria"] == $usuario->perfil )
        {
            //Devuelva un STRING con formato JSON        
            echo json_encode($registro);    
        } 
        
    }

}

 ?>