<?php 
	//session_start();
	//if(isset($_SESSION['registrado']))
	//{

	require_once('clases/lib/nusoap.php');
		
	$host = 'http://localhost:8080/abmUsuarios/clases/SERVIDOR/wsUsuarios.php';
	$client = new nusoap_client($host . '?wsdl');

	$arrayDeUsuarios = $client->call('TraerTodos');
	//$arrayDeUsuarios=Usuario::TraerTodosLosUsuarios();

	$err = $client->getError();
	if ($err) {
		echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
		die();
	}

	$user = $_SESSION["Usuario"];

	$miUser = json_decode($user);

	?>
	<table class="table"  style=" background-color: beige;color:black;">
		<thead>
			<tr>
				<?php
				//Si el perfil es distinto de comprador 
				if ($miUser->perfil != "INVITADO") {
					echo "<th>Editar</th><th>Borrar</th><th>Nombre</th><th>Email</th><th>Perfil</th>";
				} else {
					echo "<th>Nombre</th><th>Email</th><th>Perfil</th>";
				}
				?>
			</tr>
		</thead>
		<tbody>

	<?php 

	foreach ($arrayDeUsuarios as $usuario) {

		$ObjUsuario = array();
		$ObjUsuario['id'] = $usuario['id'];
		$ObjUsuario['nombre'] = $usuario['nombre'];
		$ObjUsuario['email']  = $usuario['email'];	
		$ObjUsuario['perfil'] = $usuario['perfil'];
		$ObjUsuario['accion'] = "";
		
		$ObjUsuario = json_encode($ObjUsuario);
		
		$botones= "	<td><a onclick='EditarUsuario($ObjUsuario)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar</a></td>
					<td><a onclick='EliminarUsuario($ObjUsuario)' class='btn btn-danger'>   <span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar</a></td>
					";
		$grilla = "<td>".$usuario['nombre']."</td>
				   <td>".$usuario['email']."</td>
				   <td>".$usuario['perfil']."</td>
				   </tr>   ";

		if($miUser->perfil!='comprador')
			$grilla= "<tr>" . $botones. $grilla;
		else
			$grilla= "<tr>" . $grilla;				

		echo $grilla;
	}			
?>
	</tbody>
</table>
