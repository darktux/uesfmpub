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
					<h3 class="modal-title" id="labelmodal">Nuevo usuario</h3>
				</div>
				<div class="modal-body">
					<input  id="id" type="hidden" value="">

					<label  for="nombre">Nombre Completo:</label>
					<input  id="nombre" class="form-control" type="text" required>

					<label  for="usuario">Usuario:</label>
					<input  id="usuario" class="form-control" type="text" required>

					<label  for="contra">Contraseña:</label>
					<input  id="contra" class="form-control" type="password" required>

					<label  for="contra2">Confirmación de contraseña:</label>
					<input  id="contra2" class="form-control" type="password" required>

					<label  for="nivel">Nivel:</label>
					<select id="nivel" class="form-control" required>
						<option value="1">Nivel 1 (Administrador)</option>
						<option value="2">Nivel 2 (Asistente)</option>
						<option value="3">Nivel 3 (Estudiante colaborador)</option>
					</select>
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
			<span style="font-size:25px;"> &nbsp;&nbsp;&nbsp;Control de usuarios</span> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-ms" onclick="nuevo();">Nuevo Usuario</button>
		</div> 
	</div>     

	<table id="tabla" data-toggle="table" class="table table-striped table-hover"  data-url="ajax/usuarios.ajax.php?accion=usuariosjson" data-click-to-select="true" data-search="true" data-show-refresh="true" data-toolbar="#titulo">
	    <thead>
		    <tr>
		    	<th data-field="operate" data-align="center" data-formatter="operateFormatter" data-events="operateEvents">Acciones</th>
		        <th data-field="id" data-align="center">Identificador</th>
	            <th data-field="nombre" data-align="center">Nombre</th>
	            <th data-field="usuario" data-align="center">Usuario</th>
	            <th data-field="nivel" data-align="center">Nivel</th>
	            <th data-field="state" data-radio="true"></th>
		    </tr>
	    </thead>
	</table>
    <script type="text/javascript">
    	function nuevo(){
        	if($("#id").val()!=""){limpiar();}
        	$('#labelmodal').html("Nuevo usuario");
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
	        	//console.log(value, row, index);
	        	limpiar();
	            $("#id").val( JSON.stringify(row.id).replace(/"/gi,'') );
	            $("#nombre").val( JSON.stringify(row.nombre).replace(/"/gi,'') );
	            $("#usuario").val( JSON.stringify(row.usuario).replace(/"/gi,'') );
	            document.getElementById('usuario').disabled=true;
	            $("#contra").val( '*****' );
            	$("#contra2").val( '*****' );
	            $("#nivel").val( JSON.stringify(row.nivel).replace(/"/gi,'') );
	            $('#labelmodal').html("Modificar usuario");
	            $('#ventana_modal').modal('show');
	        },
	        'click .remove': function (e, value, row, index) {
	            //alert('You click remove icon, row: ' + JSON.stringify(row));
	            //console.log(value, row, index);
	            var i = JSON.stringify(row.id).replace(/"/gi,'');
	            var u = JSON.stringify(row.usuario).replace(/"/gi,'');
	            var n = JSON.stringify(row.nivel).replace(/"/gi,'');
	            $.ajax({
		            type:"post",
		            url: "ajax/usuarios.ajax.php",
		            data:{id:i, usuario:u, nivel:n, accion:'rem'},
		            success:function(responseText){
		            	$('#tabla').bootstrapTable('refresh',{
                        	url: 'ajax/usuarios.ajax.php?accion=usuariosjson'
                        });
			        	alert(responseText);
		            }
			    }); 
	        }
	    };
        function actualiza(){
        	var i = $("#id").val();
        	var n = $("#nombre").val();
        	var u = $("#usuario").val();
        	var c = $("#contra").val();
        	var cc = $("#contra2").val();
        	var ni = $("#nivel").val();
        	var cadena="Los siguientes campos están vacíos o tienen algún problema: \n";
            var v=false;
            if(n==""){cadena=cadena+"\n Nombre";v=true;}
            if(u==""){cadena=cadena+"\n Usuario";v=true;}
            if(c==""){cadena=cadena+"\n Contraseña";v=true;}
            if(cc==""){cadena=cadena+"\n Confirmación de contraseña";v=true;}
            if(c!=cc){cadena=cadena+"\n Las Contraseña no coinciden";v=true;}
            if(ni=="" || ni=="-1"){cadena=cadena+"\n Nivel";v=true;}
            if(v){
                alert(cadena);
            }
            else{
            	if(i==""){action = 'set';}else{action = 'udp';}
            	$.ajax({
		            type:"post",
		            url: "ajax/usuarios.ajax.php",
		            data:{id:i, nombre:n, usuario:u, contrasena:c, nivel:ni, accion:action},
		            success:function(responseText){
		            	if(/Éxito/.test(responseText)){
		            		$('#tabla').bootstrapTable('refresh',{url: 'ajax/usuarios.ajax.php?accion=usuariosjson'});
		            		$('#ventana_modal').modal('hide');
		            		alert(responseText);
		            		limpiar();
		            	}
		            	else{
		            		if(i==""){alert('El usuario que intenta guardar ya existe en la base de datos');}
		            		else{alert(responseText);}
		            		
		            	}
		            }
			    });
            }
        }
        function limpiar(){
        	$("#id").val('');
            $("#nombre").val('');
            $("#usuario").val('');
            document.getElementById('usuario').disabled=false;
            $("#contra").val('');
            $("#contra2").val('');
            $("#nivel").val(1);
        }
    </script>
    <!--<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
    <script src="../bootstrap-3.3.4-dist/js/bootstrap.js"></script>-->
    <script src="bootstrap-3.3.4-dist/js/bootstrap-table.js"></script>
</body>
</html>