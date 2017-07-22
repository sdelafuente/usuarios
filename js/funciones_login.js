/********************************************
*                                           *
*********************************************/
function Login() {

    var pagina = "./login.php";

    var usuario = {email: $("#email").val(), pass: $("#password").val()};

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            usuario: usuario
        }
    })
    .then( function (objJson) {		
        //alert(objJson);
        //$("#divError").html(objJson);
        window.location.href = "index.php";	

    }, function (jqXHR, textStatus, errorThrown) {

        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);

    });

}

/********************************************
*                                           *
*********************************************/
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

        //Vuelvo al Log In
        window.location.href = "login.php";

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
