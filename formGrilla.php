<?php 
		
	//Libreria
	require_once('clases/lib/nusoap.php');
  
	//Capturo el usuario 
	$miUser = json_decode($_SESSION["Usuario"]);

	//Cliente NuSoap
	$host = 'http://localhost/abmUsuarios/clases/SERVIDOR/wsUsuarios.php';
	$client = new nusoap_client($host . '?wsdl');

	//Lista de usuarios 
	$arrayDeUsuarios = $client->call('TraerTodos');
	//$arrayDeUsuarios=Usuario::TraerTodosLosUsuarios();

	//Si hay error del Cliente 
	$err = $client->getError();
	if ($err) {
		echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
		die();
	}

?>
	<table class="table"  style=" background-color: beige;color:black;">
		<thead>
			<tr>
				<?php
					//Header a mostrar segun
					switch ($miUser->perfil) {
						case 'USUARIO':
										echo "<th>Borrar</th><th>Nombre</th><th>Email</th><th>Perfil</th>";
										break;						
						default:
										echo "<th>Editar</th><th>Borrar</th><th>Nombre</th><th>Email</th><th>Perfil</th>";
										break;
					}						
				?>
			</tr>
		</thead>
		<tbody>

	<?php 
		//Usuarios en BD
		foreach ($arrayDeUsuarios as $usuario) {
			
			//Agrego un atributo mas por array
			$usuario['accion'] = "";
			//Parseo a Json
			$ObjUsuario = json_encode($usuario);

			//Dependiendo del perfil se ven unos botones y otros no 
			switch ($miUser->perfil) {
				case 'USUARIO':
							$botones= "	<td>
											<a onclick='EliminarUsuario($ObjUsuario)' class='btn btn-danger'>
												<span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar
											</a>
										</td>";
							break;						
				default:
							$botones= "	<td>
											<a onclick='EditarUsuario($ObjUsuario)' class='btn btn-warning'>
												<span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar
											</a>
										</td>
										<td>
											<a onclick='EliminarUsuario($ObjUsuario)' class='btn btn-danger'>
												<span class='glyphicon glyphicon-trash'>&nbsp;</span>Borrar
											</a>
										</td>
										";						
			}

			//Registro a mostrar
			$grilla = "<tr>".$botones."<td>".$usuario['nombre']."</td><td>".$usuario['email']."</td><td>".$usuario['perfil']."</td></tr>";
			//Muestro
			echo $grilla;
		}			
	?>
	</tbody>
</table>
