<?php
    if(session_status() !== PHP_SESSION_ACTIVE){session_start();}
    if(isset($_SESSION['upub087_nivel'])){
        if($_SESSION['upub087_nivel']!="1"){//deja entrar si es admin
            echo'
                <script language="javascript1.5" type="text/javascript">
                    window.location="../index1.php";
                </script>
            ';
        }
    }
    else{
        echo'
            <script language="javascript1.5" type="text/javascript">
                window.location="../index1.php";
            </script>
        ';
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link href="css/fileinput.css" rel="stylesheet">
    </head>
    <body style="text-align:center;">
        <br>
        <input id="respaldo" name="respaldo" type="file" class="file-loading">
        <script src="js/fileinput.js"></script>
        <script src="js/fileinput_locale_es.js"></script>
        <script type="text/javascript">
            $("#respaldo").fileinput({
                language: "es",
                allowedFileExtensions: ["sql"],
                showUpload: true,
                browseClass: "btn btn-primary",
                browseLabel: "Seleccionar respaldo",
                browseIcon: "<i class=\"glyphicon glyphicon-retweet\"></i> ",
                removeClass: "btn",
                removeLabel: "Limpiar",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                uploadClass: "btn btn-success",
                uploadLabel: "Ejecutar Restauracion",
                uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
                uploadAsync: false,
                uploadUrl: "ajax/back_rest.php",
                uploadExtraData: function() {
                    return {
                        accion: 'restaurar'
                    };
                }
            });
        </script>
    </body>
</html>