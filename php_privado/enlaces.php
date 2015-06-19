<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
		<title>Enlaces</title>
		<link href="../css/estilos.css" rel="stylesheet">
		<link href="../css/alert2.css" rel="stylesheet">
	</head>
	<body>
		<div id="divcontacto" class="formulario">
			<p>Información de Enlaces</p>
			<form>
				<label   for="titulo">Titulo:</label>
				<textarea id="titulo" class="form-control" required></textarea>
				<label for="url">URL:</label>
				<input  id="url" class="form-control" type="text" required>
			</form>
			<br>
			<button class="btn btn-success pull-right" onclick="validar();">
			<i class="glyphicon glyphicon-upload"></i>
			Guardar
			</button>
		</div>
		<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
	    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	    <script src="../js/alert2.js"></script>
	    <script type="text/javascript">
		    function validar(){
		    	var tit = $("#titulo").val();
		    	var url = $("#url").val();
		    	var msj="<table align='center' border='0'><tr><td>Rellene los siguientes campos:<br><br><td><tr>";
	            var e =false;
	            if($.trim(tit)==""){
	                msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Titulo<td><tr>";
	                e=true;
	            }
	            if($.trim(url)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  URL<td><tr>";
	                e=true;
	            }
	            if(e){
	            	msj=msj+"</table>";
	            	alert(msj);
	            	return false;
	            }
	            else{
	            	$.ajax({
			            type:"post",
			            url: "../ajax/enlaces.ajax.php",
			            data:{titulo:tit, url:url, accion:'set'},
			            success:function(responseText){
				        	alert(responseText);
			            }
				    });    
	            	return true; 
				}
			}
	    </script>
	</body>
</html>