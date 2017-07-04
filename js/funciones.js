function Enunciado() {

    var pagina = "./enunciado.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        async: true
    })
    .done(function (grilla) {

        $("#divGrilla").html(grilla);

        var pagina = "./puntaje.php";

        $.ajax({
            type: 'POST',
            url: pagina,
            dataType: "html",
            async: true
        })
        .done(function (grilla) {

            $("#divAbm").html(grilla);

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function MostrarGrilla() {
var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "MOSTRAR_GRILLA"
        },
        async: true
    })
    .done(function (html) {

        $("#divGrilla").html(html);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function MostrarCd() {
var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "MOSTRAR_CD"
        },
        async: true
    })
    .done(function (html) {

        $("#divGrilla").html(html);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function CargarFormNuevoMaterial() {

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM"
        },
        async: true
    })
    .done(function (html) {

        $("#divAbm").html(html);
        $('#cboTipo > option[value="usuario"]').attr('selected', 'selected');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function AgregarMaterial() {
   var pagina = "./administracion.php";
    var id = $("#hdnIdMaterial").val();
	var nombre = $("#txtNombre").val();
	var precio = $("#txtPrecio").val();
	var tipo = $("#cboTipo").val();	
	var material = {};	
	
    material.Codigo = id;
	material.Nombre= nombre;
	material.Precio = precio;
	material.Tipo= tipo;
	
	$.ajax({
        url:pagina, 
        type:"post",
        dataType:"text",
        data:{
                queMuestro : "ALTA_MATERIAL", 
                material : material
           }}
    )
	.done(function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
	   alert(objJson);
		// var objJsonPaseado = JSON.parse(objJson);
		
        // alert(objJsonPaseado.Mensaje);
        // if (!objJsonPaseado.Exito) {
            // alert(objJsonPaseado.Mensaje);
            // return;
        // }

        $("#divAbm").html("");
        MostrarGrilla();
		// var objJsona = JSON.parse(objJson);
		// alert(objJsona.Mensaje);
         // console.log("recibirJSON()");
         // console.log(resultado);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	

}

function EditarUsuario(material) {//#sin case

	material.accion="Modificar";
	
    var pagina = "./administracion.php";
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM",
            material: material
        },
        async: true
    })
    .done(function (html) {

        $("#divAbm").html(html);

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}
function ModificarMaterial() {//#3a
  if (!confirm("Modificar USUARIO?")) {
		//si es  Cancelar
        return;
    }
	//si es aceptar
	
    var pagina = "./administracion.php";
    var Codigo = $("#hdnIdMaterial").val();
	var Nombre = $("#txtNombre").val();
	var Precio = $("#txtPrecio").val();
	var Tipo = $("#cboTipo").val();
	
	var material = {};
    material.Codigo = Codigo;
	material.Nombre= Nombre;
	material.Precio = Precio;
	material.Tipo  = Tipo;
	
	$.ajax({url:pagina, type:"post",dataType:"text", data:{queMuestro : "MODIFICAR_USUARIO", material : material}})
	
	.done(function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
	
		// var objJsonPaseado = JSON.parse(objJson);
		// alert(objJsonPaseado);
       
        // if (!objJsonPaseado.Exito) {
			        // MostrarGrilla();

            // alert(objJsonPaseado.Mensaje);
            // return;
        // }


        $("#divAbm").html("");
        MostrarGrilla();
		// var objJsona = JSON.parse(objJson);
		// alert(objJsona.Mensaje);
         // console.log("recibirJSON()");
         // console.log(resultado);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	


 

}


function EliminarUsuario(objMaterial) {//#3b

    if (!confirm("Eliminar USUARIO?")) {
        return;
    }

    var pagina = "./administracion.php";

    var codigoBorrar = objMaterial.Codigo;
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            queMuestro: "ELIMINAR_USUARIO",
            codigoBorrar: codigoBorrar
        },
        async: true
    })
   .done(function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
		alert(objJson);
        MostrarGrilla();
		
		})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	
 
}
function Logout() {//#5

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "LOGOUT"
        },
        async: true
    })
    .done(function (html) {

        window.location.href = "login.php";

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
