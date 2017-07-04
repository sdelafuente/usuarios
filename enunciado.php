<div class="animated bounceInRight" style="height:460px;overflow:auto;border-style:solid">
    UTILIZANDO PDO Y LA CLASE USUARIO (ud. debe crearla con atributos y m&eacute;todos necesarios) SE PIDE:<br>
    <ul>
        <li>
            <br>1)&nbsp;(2 pts.) MOSTRAR los usuarios registrados en la BASE DE DATOS (men&uacute; GRILLA).<br/>                                               
        </li>
        <li>
            <br>2)&nbsp;(2 pts.) AGREGAR un nuevo usuario (men&uacute; AGREGAR USUARIO).<br/>
        </li>
        <li>
            <br>3)&nbsp;(4 pts. en total) Desde la GRILLA, habilitar botones para poder:<br/>
            &nbsp;&nbsp;a)&nbsp;(2 pts.)MODIFICAR al usuario seleccionado<br/>
            &nbsp;&nbsp;b)&nbsp;(2 pts.)BORRAR al usuario seleccionado.<br/>
        </li>
        <li>
            <br>4)&nbsp;(1 pt. en total) LOGUEARSE a la aplicaci&oacute;n desde 'login.php' (UTILIZANDO WEBSERVICE FORANEO).<br/>
            url = http://maxineiner.tuars.com/webservice/ws_segundo_parcial.php<br>
            <ul>
                <li>
                    &nbsp;&nbsp;a)&nbsp;(0.5 pts.) GUARDAR en una VARIABLE de SESION los datos del usuario LOGUEADO. Utilizar 'verificar_sesion.php' para mantener segura la aplicaci&oacute;n WEB.<br>
                </li>
                <li>
                    &nbsp;&nbsp;b)&nbsp;(0.5 pts.) Mostrar en el encabezado NOMBRE y PERFIL del usuario LOGUEADO.<br>
                </li>
            </ul>            
        </li>
        <li>
            <br>5)&nbsp;(1 pt.) DESLOGUEARSE (men&uacute; LOGOUT).<br/>Redirigir a 'login.php'.
        </li>
        <li>
            <br>6)&nbsp;(1 pt) Utilizar VARIABLES de SESION de tal manera que, seg&uacute;n el PERFIL:<br/>
            &nbsp;&nbsp;a)&nbsp;(0.5 pts.) El men&uacute;: Perfil 'ADMINISTRADOR'-> se vea completo; Perfil 'USUARIO'-> NO se vea AGREGAR USUARIO; Perfil 'INVITADO'-> NO se vea GRILLA, AGREGAR USUARIO ni EDITAR PERFIL <br>
            &nbsp;&nbsp;b)&nbsp;(0.5 pts.) La grilla: Perfil 'ADMINISTRADOR'-> se vea completa; Perfil 'USUARIO'-> NO se vea la columna de 'EDICION'; Perfil 'INVITADO'-> NO ve la grilla<br>
        </li>
        <li>
            <br>7)&nbsp;(0.5 pts.) EDITAR datos del usuario LOGUEADO (men&uacute; EDITAR PERFIL).<br/>
        </li>
        <li>
            <br>8)&nbsp;(2 pts.) Crear y consumir un WEBSERVICE que traiga y muestre el listado de CDS de la base 'cdcols'. Agregar una nueva opci&oacute;n de men&uacute; (MOSTRAR CDS)<br/>
        </li>
        <li>
            <br>9)&nbsp;(0.5 pts.) Guardar en una COOKIE (que expire en 30 segundos), los valores recuperados de la variable de SESION. Mostrarla en el 'divAbm'.<br>
        </li>
    </ul>
</div>