/*
    Enunciado
*/
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

/********************************************
*                                           *
*********************************************/
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

/********************************************
*                                           *
*********************************************/
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

/********************************************
*                                           *
*********************************************/
function agregar() {
    //Pagina a enviar el POST
    var pagina = "./administracion.php";
    //Funciona Ajax
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM"
        },
        async: true
    })
    .then(function (html) {
        //Vacio la grilla, cargo el formulario 
        $("#divGrilla").html("");
        $("#divAbm").html(html);
        $('#cboTipo > option[value="usuario"]').attr('selected', 'selected');

    }, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

/********************************************
*                                           *
*********************************************/
function AgregarUsuario() {

    var pagina = "./administracion.php";

    var id = $("#hdnIdUsuario").val();
	var nombre = $("#txtNombre").val();
	var email = $("#txtEmail").val();    
	var perfil = $("#cboPerfil").val();	
    var pass = 1234;   
    //var foto = "foto";//$("#foto").val();

	var usuario = {};	
	
    usuario.id = id;
	usuario.nombre= nombre;
	usuario.email = email;
	usuario.perfil= perfil;
    usuario.pass  = pass;
  //  usuario.foto  = foto;
	
	$.ajax({
        url:pagina, 
        type:"post",
        dataType:"text",
        data:{
                queMuestro : "ALTA_USUARIO", 
                usuario : usuario
           }}
    )
	.then(function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
	  
      $("#divAbm").html("");
        MostrarGrilla();

	}, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	

}

/********************************************
*                                           *
*********************************************/
function EditarUsuario(usuario) {//#sin case

	usuario.accion="Modificar";
	
    var pagina = "./administracion.php";
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM",
            usuario: usuario
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

/********************************************
*                                           *
*********************************************/
function EliminarUsuario(usuario) {//#sin case

    usuario.accion="Eliminar";
    
    var pagina = "./administracion.php";
    
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM",
            usuario: usuario
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

/********************************************
*                                           *
*********************************************/
function ModificarUsuario() {//#3a

  if (!confirm("Se va a modificar el usuario,prosige?")) {
		//si es  Cancelar
        return;
    }
	//si es aceptar
	
    var pagina = "./administracion.php";
    var id = $("#hdnIdUsuario").val();
	var nombre = $("#txtNombre").val();
	var email = $("#txtEmail").val();
	var perfil = $("#cboPerfil").val();
	
	var usuario = {};
    usuario.id = id;
	usuario.nombre= nombre;
	usuario.email = email;
	usuario.perfil  = perfil;

	$.ajax({
            url:pagina, 
            type:"post",
            dataType:"text", 
            data:{
                    queMuestro : "MODIFICAR_USUARIO", 
                    usuario : usuario
                }
    }).then(function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
	
		       
        $("#divAbm").html("");
        MostrarGrilla();

	}, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	 

}

/********************************************
*                                           *
*********************************************/
function Eliminar() {//#3b

    if (!confirm("Eliminar USUARIO?")) {
        return;
    }

    var pagina = "./administracion.php";

    var id = $("#hdnIdUsuario").val();    
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            queMuestro: "ELIMINAR_USUARIO",
            id_usuario: id
        },
        async: true
    })
   .done(function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
		
        MostrarGrilla();
		
		})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	
 
}
