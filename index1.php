<?php
    if (session_status() !== PHP_SESSION_ACTIVE){session_start();}
    if(isset($_POST['cerrar'])){
        unset($_SESSION['upub087_id']);
        unset($_SESSION['upub087_nombre']);
        unset($_SESSION['upub087_usuario']);
        unset($_SESSION['upub087_nivel']);
    }
    if(!isset($_SESSION['upub087_id']) && isset($_POST['usuario'])){
        require('ajax/pgconex.php');
        $con= new PgConex();
        $con->conectar();
        $con->consulta("SELECT * FROM tb_usuario WHERE usuario='".trim($_POST['usuario'])."';");
        if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {       
            if($fila['contrasena']==sha1(md5(trim($_POST['usuario']).trim($_POST['contrasena'])))){
                $_SESSION['upub087_id']      = $fila['id'];
                $_SESSION['upub087_nombre']  = $fila['nombre'];
                $_SESSION['upub087_usuario'] = $fila['usuario'];
                $_SESSION['upub087_nivel']   = $fila['nivel'];
            }
            else{
                $msj= "Error: Usuario o contraseña inválidos, por favor verifique. ";
            } 
        }
        else{
            $msj= "Error: Usuario o contraseña inválidos, por favor verifique. ";
        }
        $con->limpiarConsulta();
        $con->desconectar();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Paracentral Administrador</title>
    <link href="bootstrap-3.3.4-dist/css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/romeo.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index1.php"> <i class="glyphicon glyphicon-folder-open"></i> Administración</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                    if(!isset($_SESSION['upub087_id'])){
                        echo '
                            <form class="navbar-form navbar-left" method="post">
                                <div class="form-group">
                                    <i class="glyphicon glyphicon-user"></i> <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuario">
                                    <i class="glyphicon glyphicon-option-horizontal"></i> <input id="contrasena" name="contrasena" type="password" class="form-control" placeholder="Contraseña">
                                </div>
                                <button type="submit" class="btn btn-default"><i class="fa fa-key"></i>Entrar</button>
                            </form>
                        ';
                        if(isset($msj)){
                            echo '<span class="alert alert-danger"><i class="fa fa-exclamation-triangle""></i> '.$msj.'</span>';
                        }
                    }else{
                        echo '
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-rss"></i> Publicaciones <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_noticias.php\');"><i class="fa fa-newspaper-o"></i> Noticias</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_actividades.php\');"><i class="fa fa-calendar-o"></i> Actividades</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-university"></i> Información Institucional <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/quienes_somos.php\');carga_quienes();"><i class="fa fa-sitemap"></i> ¿Quienes somos?</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/contacto.php\');carga_contacto();"><i class="glyphicon glyphicon-earphone"></i> Contacto</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-play-circle-o"></i> Gestión de contenido <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/iframe_imagenes.php\');"><i class="fa fa-picture-o"></i> Imágenes</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_enlaces.php\');"><i class="fa fa-link"></i> Enlaces</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/iframe_multimedia.php\');"><i class="fa fa-laptop"></i> Multimedia</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users"></i> Información de los usuarios <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_sugerencias.php\');"><i class="fa fa-comments-o"></i> Sugerencias y comentarios</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_estadisticas.php\');"><i class="fa fa-bar-chart"></i> Estadísticas</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-unlock-alt"></i> Seguridad <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_usuarios.php\');"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
                                        <li><a style="cursor:pointer;" onclick="backup1();"><i class="glyphicon glyphicon-save"></i> Crear respaldo de datos</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/restaurar.php\');"><i class="glyphicon glyphicon-open"></i> Restaurar base de datos</a></li>
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_bitacora.php\');"><i class="glyphicon glyphicon-eye-open"></i> Ver bitácora</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> '.$_SESSION['upub087_usuario'].' <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a style="cursor:pointer;" onclick="$(\'#cuerpo\').load(\'php_privado/vista_ayuda.php\');"><i class="fa fa-question"></i> Ayuda</a></li>
                                        <li><a tabindex="-1" href="#ventana_modal2" role="button" data-toggle="modal" ><i class="fa fa-exclamation"></i> Acerca de</a></li>
                                        <li><a tabindex="-1" href="#ventana_modal1" role="button" data-toggle="modal" ><i class="fa fa-user-secret"></i> Actualizar contraseña</a></li>
                                        <li><a style="cursor:pointer;" onclick="redirect_by_post(\'index1.php\', { cerrar: \'Ok\'}, false);"><i class="fa fa-times"></i> Cerrar Sesión</a></li>
                                    </ul>
                                </li>
                             </ul>
                        ';
                    }
                ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        <div id="cuerpo"></div>
    </nav>

    <div id="ventana_modal1" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="labelmodal1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#BA1010; color:#fff;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="labelmodal1">Actualizar contraseña</h4>
                </div>
                <div class="modal-body">

                    <label for="contra0">Contraseña actual:</label>
                    <input id="contra0" class="form-control" type="password" required>

                    <label for="contra1">Nueva contraseña:</label>
                    <input id="contra1" class="form-control" type="password" required>

                    <label for="contra2">Confirmación de nueva contraseña:</label>
                    <input id="contra2" class="form-control" type="password" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualiza_contra();">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="ventana_modal2" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="labelmodal2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#BA1010; color:#fff;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="labelmodal2">Acerca de</h4>
                </div>
                <div class="modal-body">
                    
                    Información del sistema versión alfa

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
    <script src="bootstrap-3.3.4-dist/js/bootstrap.js"></script>
    <script src="php_privado/jquery.fileDownload-master/src/Scripts/jquery.fileDownload.js"></script>
    
    
    <script type="text/javascript">
        function redirect_by_post(purl, pparameters, in_new_tab) {
            pparameters = (typeof pparameters == 'undefined') ? {} : pparameters;
            in_new_tab = (typeof in_new_tab == 'undefined') ? true : in_new_tab;
            var form = document.createElement("form");
            $(form).attr("id", "reg-form").attr("name", "reg-form").attr("action", purl).attr("method", "post").attr("enctype", "multipart/form-data");
            if (in_new_tab) {
                $(form).attr("target", "_blank");
            }
            $.each(pparameters, function(key) {
                $(form).append('<input type="text" name="' + key + '" value="' + this + '" />');
            });
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
            return false;
        }
        function carga_quienes(){
            $.ajax({
                type:"post",
                url: "ajax/quienes_somos.ajax.php",
                data:{accion:'get'},
                success:function(responseText){
                    datos = responseText.split('*');
                    document.getElementById('titular').value=datos[0];
                    document.getElementById('mision').value=datos[1];
                    document.getElementById('vision').value=datos[2];
                    //document.getElementById('organigrama').value=datos[3];
                }
            }); 
        }
        function carga_contacto(){
            $.ajax({
                type:"post",
                url: "ajax/contacto.ajax.php",
                data:{accion:'get'},
                success:function(responseText){
                    datos = responseText.split('*');
                    document.getElementById('direccion').value=datos[0];
                    document.getElementById('telefono').value=datos[1];
                    document.getElementById('fax').value=datos[2];
                    document.getElementById('correo').value=datos[3];
                }
            });
        }
        function backup1(){
            $.ajax({
                type:"post",
                url: "ajax/back_rest.php",
                data:{accion:'backup'},
                success:function(responseText){
                    if(/Éxito/.test(responseText)){
                        $.fileDownload("ajax/"+responseText.split(',')[1]);
                    }
                }
            }); 
        }
        function actualiza_contra(){
            var c0 = $("#contra0").val();
            var c1 = $("#contra1").val();
            var c2 = $("#contra2").val();
            var cadena="Los siguientes campos están vacíos o tienen algún problema: \n";
            var v=false;
            if(c0==""){cadena=cadena+"\n Contraseña actual";v=true;}
            if(c1==""){cadena=cadena+"\n Nueva contraseña";v=true;}
            if(c2==""){cadena=cadena+"\n Confirmación de nueva contraseña";v=true;}
            if(c1!=c2){cadena=cadena+"\n Las Contraseña no coinciden";v=true;}
            if(v){
                alert(cadena);
            }
            else{
                $.ajax({
                    type:"post",
                    url: "ajax/usuarios.ajax.php",
                    data:{actual:c0, nueva:c1, accion:'udpcontra'},
                    success:function(responseText){
                       if(/Éxito/.test(responseText)){
                            $('#ventana_modal1').modal('hide');
                            limpiar_contra();
                        }
                        alert(responseText);
                    }
                });
            }
        }
        function limpiar_contra(){
            $("#contra0").val('');
            $("#contra1").val('');
            $("#contra2").val('');
        }

    </script>

</body>
</html>