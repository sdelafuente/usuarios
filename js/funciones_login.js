/*
    Login 
*/
function Login() {

    var pagina = "./login.php";

    var usuario = {Email: $("#email").val(), Password: $("#password").val()};

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            usuario: usuario
        }
    })
    .then( function (objJson) {		

        window.location.href = "index.php";	

    }, function (jqXHR, textStatus, errorThrown) {

        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);

    });

}

/*
    cargarUsuario
    Verifica el tipo de usuario a conectarse. 
*/
function cargarUsuario(perfil) {
    
    var pagina = "./leer_usuarios.php";
    var usuario = {perfil: perfil}; 
    
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: { usuario: usuario }
    })
    .then( function (objJson) {    
        var user = JSON.parse(objJson);

        $("#email").val(user.mail);
        $("#password").val(user.contrasena);
        Login();       
    
    }, function (jqXHR, textStatus, errorThrown) {

        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        
    });


}