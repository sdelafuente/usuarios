<?php
    require_once("verificar_sesion.php");
    require_once("clases/AccesoDatos.php");
    require_once("clases/Usuario.php");
    require_once("clases/Materiales.php");


    if (!isset($material)) {//alta
        $Nombre = "";
        $Precio = "";
    	$Tipo = "";
        $Codigo = "";
        $botonClick = "AgregarMaterial()";
        $botonTitulo = "Guardar";
    } else {
        $Nombre = $material->Nombre;
        $Precio = $material->Precio;
        $Codigo = $material->Codigo;
        $Tipo =   $material->Tipo;
    	
        if(isset($material->accion)){
            $botonClick = $material->accion == "Modificar" ? "ModificarMaterial()" : "EliminarMaterial()";    
            $botonTitulo = $material->accion;
        }
        else {
            $botonClick = "ModificarMaterial()";    
            $botonTitulo = "Editar Material";        
        }
    }

    $perfiles = Material::TraerTipos();


?>
<div id="divFrm" class="animated bounceInLeft" style="height:330px;overflow:auto;margin-top:0px;border-style:solid">
    <input type="hidden" id="hdnIdMaterial" value="<?php echo $Codigo; ?>" />
    <input type="text" placeholder="Nombre material" id="txtNombre" value="<?php echo $Nombre; ?>" />
    <input type="text" placeholder="Precio" id="txtPrecio" value="<?php echo $Precio; ?>" />
 
    <span>Seleccione Tipo de Material</span>
    <select id="cboTipo" >
        <?php
        foreach ($perfiles AS $p) {
            $miTipo = isset($material->Tipo) ? $material->Tipo : "";
            $selected = $miTipo == $p["Tipo"] ? "selected" : "";
            echo "<option value='" . $p["Tipo"] . "' " . $selected . ">" . $p["Tipo"] . "</option>";
        }
        ?>	
    </select>
    <br/><br/>

    <input type="button" class="MiBotonUTN" onclick="<?php echo $botonClick; ?>" value="<?php echo $botonTitulo; ?>"  />
    <input type="hidden" id="hdnQueHago" value="agregar" />
</div>