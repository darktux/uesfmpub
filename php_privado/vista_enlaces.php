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
			<div class="modal-content" style="background-color:#BA1010; color:#fff;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="labelmodal">Nuevo enlace</h4>
				</div>
				<div class="modal-body">
					<input  id="id" type="hidden" value="">

					<label for="tituloe">Titulo:</label>
					<textarea id="tituloe" class="form-control" required></textarea>

					<label for="url">URL:</label>
					<input id="url" class="form-control" type="text" required>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="actualiza();">Guardar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="titulo">
		<div class="form-inline" role="form">
			<span style="font-size:25px;" > &nbsp;&nbsp;&nbsp;Enlaces</span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-ms" onclick="nuevo();">Nuevo Enlace</button>
		</div>
	</div>        
	<table id="tabla" data-toggle="table" class="table table-striped table-hover"  data-url="ajax/enlaces.ajax.php?accion=enlacesjson" data-click-to-select="true" data-search="true" data-show-refresh="true" data-toolbar="#titulo">
	    <thead>
		    <tr>
		    	<th data-field="operate" data-align="center" data-formatter="operateFormatter" data-events="operateEvents">Acciones</th>
		        <th data-field="id" data-align="center">Identificador</th>
	            <th data-field="titulo" data-align="center">Titulo</th>
	            <th data-field="url" data-align="center">Dirección web</th>
	            <th data-field="state" data-radio="true"></th>
		    </tr>
	    </thead>
	</table>

    <script type="text/javascript">
    	function nuevo(){
        	if($("#id").val()!=""){limpiar();}
        	$('#labelmodal').html("Nuevo enlace");
        	$('#ventana_modal').modal('show');
        }
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
	            limpiar();
	            $("#id").val( JSON.stringify(row.id).replace(/"/gi,'') );
	            $("#tituloe").val( JSON.stringify(row.titulo).replace(/"/gi,'') );
	            $("#url").val( JSON.stringify(row.url).replace(/"/gi,'') );
	            $('#labelmodal').html("Modificar enlace");
	            $('#ventana_modal').modal('show');
	        },
	        'click .remove': function (e, value, row, index) {
	            var i = JSON.stringify(row.id).replace(/"/gi,'');
	            var t = JSON.stringify(row.titulo).replace(/"/gi,'');
	            $.ajax({
		            type:"post",
		            url: "ajax/enlaces.ajax.php",
		            data:{id:i, titulo:t, accion:'rem'},
		            success:function(responseText){
		            	$('#tabla').bootstrapTable('refresh',{
                        	url: 'ajax/enlaces.ajax.php?accion=enlacesjson'
                        });
			        	alert(responseText);
		            }
			    }); 
	        }
	    };

         function actualiza(){
        	var i = $("#id").val();
        	var t = $("#tituloe").val();
        	var u = $("#url").val();
        	var cadena="Los siguientes campos están vacíos o tienen algún problema: \n";
            var v=false;
            if(t==""){cadena=cadena+"\n Titulo";v=true;}
            if(u==""){cadena=cadena+"\n URL";v=true;}
            if(v){
                alert(cadena);
            }
            else{
            	if(i==""){action = 'set';}else{action = 'udp';}
            	$.ajax({
		            type:"post",
		            url: "ajax/enlaces.ajax.php",
		            data:{id:i, titulo:t, url:u, accion:action},
		            success:function(responseText){
		            	if(/Éxito/.test(responseText)){
		            		$('#tabla').bootstrapTable('refresh',{url: 'ajax/enlaces.ajax.php?accion=enlacesjson'});
		            		$('#ventana_modal').modal('hide');
		            		alert(responseText);
		            		limpiar();
		            	}
		            	else{
		            		if(i==""){alert('La URL que intenta guardar ya existe en la base de datos');}
		            		else{alert(responseText);}
		            	}
		            }
			    });
            }
        }
        function limpiar(){
        	$("#id").val('');
            $("#tituloe").val('');
            $("#url").val('');
        }        
    </script>

    <!--<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.js"></script>-->
    <script src="bootstrap-3.3.4-dist/js/bootstrap-table.js"></script>
</body>
</html>