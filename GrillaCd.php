<html>
<head>
	<meta charset="UTF-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/animacion.css">
</head>
<body>
	<div class="page-header" >
	 
<?php
	//Librerias 
	require_once('clases/lib/nusoap.php');
	require_once('clases/Cd.php');

	//Verifico la session 
	if(!isset($_SESSION))
		session_start();

	Error_reporting(0);

	//Cliente NuSoap
	$host = 'http://localhost/usuarios/clases/SERVIDOR/wsUsuarios.php';
	//$host = 'http://localhost/abmUsuarios/clases/SERVIDOR/wsUsuarios.php';
	$client = new nusoap_client($host . '?wsdl');

	//Verifico que no haya error 
	$err = $client->getError();
	if ($err) {
		echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
		die();
	}

	//INVOCO AL METODO DE MI WS		
	$cds = $client->call('ObtenerTodosLosCds');
	//$cds = Cd::TraerTodos(); //

	//Error en el metodo 
	if ($client->fault) {
		echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
		print_r($cds);
		echo '</pre>';
	} else {
		//Error en el cliente
		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
		} 
		else {
			//Lista de Cds
			$lista_cds = "";
			$lista_cds .= "<h2>Uso WS Obtener CDs</h2>";
			$lista_cds .= "<br/>";
			$lista_cds .= "<table border='1' width='70%' Style='color:white;'>
								<tr>
									<th>ID</th><th>CANTANTE</th><th>A&Ntilde;O</th><th>TITULO</th>
							</tr>";
			//Listo los CDs en la BD					
			foreach($cds as $cd)
			{
				$lista_cds .= 	"<tr>
									<td>".$cd['id']."</td>
									<td>".$cd['interpret']."</td>
									<td>".$cd['jahr']."</td>
									<td>".$cd['titel']."</td>
					  			</tr>";
			}
			$lista_cds .= "</table>";
			$lista_cds .= "<br/>";

			echo $lista_cds;
		}
	}
?>
	</div>
</body>
</html>