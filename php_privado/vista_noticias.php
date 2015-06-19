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
	<meta charset="UTF-8">
    <!-- <link href="../bootstrap-3.3.4-dist/css/bootstrap.css" rel="stylesheet"> -->
    <link href="bootstrap-3.3.4-dist/css/bootstrap-table.css" rel="stylesheet">
</head>
<body>

	<div id="ventana_modal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="labelmodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="labelmodal">Modificar ...</h4>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="titulo"><div class="form-inline" role="form"><span style="font-size:25px;" > &nbsp;&nbsp;&nbsp;Noticias</span></div></div>        
	<table id="tabla" data-toggle="table" class="table table-striped table-hover"  data-url="ajax/noticia.ajax.php?accion=noticiasjson" data-click-to-select="true" data-search="true" data-show-refresh="true" data-toolbar="#titulo">
	    <thead>
		    <tr>
		    	<th data-field="operate" data-align="center" data-formatter="operateFormatter" data-events="operateEvents">Acciones</th>
		        <th data-field="id" data-align="center">Identificador</th>
	            <th data-field="titulo" data-align="center">Titulo</th>
	            <th data-field="contenido" data-align="center">Contenido</th>
	            <th data-field="fecha" data-align="center">Fecha</th>
	            <th data-field="hora" data-align="center">Hora</th>
	            <th data-field="id_imagen" data-align="center">Imagen</th>
	            <th data-field="id_usuario" data-align="center">Usuario</th>
	            <th data-field="state" data-radio="true"></th>
		    </tr>
	    </thead>
	</table>

    <script type="text/javascript">
    	function operateFormatter(value, row, index) {
	        return [
	            '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
	                '<i class="glyphicon glyphicon-edit"></i>',
	            '</a>&nbsp;',
	            '&nbsp;<a class="remove ml10" href="javascript:void(0)" title="Remove">',
	                '<i class="glyphicon glyphicon-remove"></i>',
	            '</a>'
	        ].join('');
	    }
	    window.operateEvents = {
	        'click .edit': function (e, value, row, index) {
	            //alert('You click edit icon, row: ' + JSON.stringify(row));
	            console.log(value, row, index);
	            $('#ventana_modal').modal('show');
	        },
	        'click .remove': function (e, value, row, index) {
	            //alert('You click remove icon, row: ' + JSON.stringify(row));
	            console.log(value, row, index);
	        }
	    };

        function actualizar(){       
        	$('#ventana_modal').modal('hide');
        }
        function limpiar(){
                      
        }   
        window.onload=function(){
          alert();
        }            
    </script>

    <!--<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.js"></script>-->
    <script src="bootstrap-3.3.4-dist/js/bootstrap-table.js"></script>
</body>
</html>