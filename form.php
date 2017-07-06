<?php
    require_once("verificar_sesion.php");
    require_once("clases/AccesoDatos.php");
    require_once("clases/Usuario.php");

    if (!isset($usuario)) {//alta
        $id = "";
        $nombre = "";
        $email = "";
    	$perfil = "";
        $botonClick = "AgregarUsuario()";
        $botonTitulo = "Guardar";
    } else {
        $id     = $usuario->id;
        $nombre = $usuario->nombre;
        $perfil = $usuario->perfil;        
        $email  = $usuario->email;
    
        if(isset($usuario->accion)){
            $botonClick = $usuario->accion == "Modificar" ? "ModificarUsuario()" : "Eliminar()";    
            $botonTitulo = $usuario->accion;
        }
        else {
            $botonClick = "ModificarUsuario()";    
            $botonTitulo = "Editar";        
        }
    }

    $perfiles = Usuario::TraerTodosLosPerfiles();

?>
<div id="divFrm" class="animated bounceInLeft divAbm" >
    <input type="hidden" id="hdnIdUsuario" value="<?php echo $id; ?>" />
    <input type="text" placeholder="Nombre usuario" id="txtNombre" value="<?php echo $nombre; ?>" />
    <input type="text" placeholder="Email" id="txtEmail" value="<?php echo $email; ?>" />
 
    <h5>Seleccione el perfil</h5>
    <select id="cboPerfil" >
        <?php
        foreach ($perfiles AS $p) {
            $miTipo = isset($usuario->perfil) ? $usuario->perfil : "";
            $selected = $miTipo == $p["perfil"] ? "selected" : "";
            echo "<option value='" . $p["perfil"] . "' " . $selected . ">" . $p["perfil"] . "</option>";
        }
        ?>	
    </select>
    <br/><br/>

    <input type="button" class="MiBotonUTN" onclick="<?php echo $botonClick; ?>" value="<?php echo $botonTitulo; ?>"  />
    <input type="hidden" id="hdnQueHago" value="agregar" />
</div>