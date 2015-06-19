<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="../bootstrap-3.3.4-dist/css/fileinput.css" rel="stylesheet">
		<title>Noticias</title>
		<link href="../css/estilos.css" rel="stylesheet">
		<link href="../css/alert2.css" rel="stylesheet">
	</head>
	<body>
		<div id="divcontacto" class="formulario">
			<p id="titulo">Información de Noticias</p>
			<form id="form_noticias" name="form_noticias" enctype="multipart/form-data" method="post">
				<label for="titulo1">Titulo:</label>
				<input  id="titulo1" name="titulo1" class="form-control" type="text">
				<label   for="contenido">Contenido:</label>
				<textarea id="contenido" name="contenido" class="form-control" rows="15"></textarea>
				<label for="imagen">Imagen:</label>
				<input  id="imagen" name="imagen" class="file form-control" type="file" accept="image/*">
			</form>
		</div>
		<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
		<script src="../bootstrap-3.3.4-dist/js/fileinput.js"></script>
	    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	    <script src="../js/alert2.js"></script>
	    <script type="text/javascript">
	    	 $("#imagen").fileinput({
		    	allowedFileExtensions: ["jpg","jpeg","png"],
		    	showUpload: true,
		    	previewFileType: "image",
				browseClass: "btn btn-warning",
				browseLabel: "Seleccionar Imagenes",
				browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
				removeClass: "btn btn-danger",
				removeLabel: "Cancelar",
				removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
				uploadClass: "btn btn-success",
				uploadLabel: "Guardar",
				uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
		        uploadAsync: false,
		        uploadUrl: "../ajax/noticia.ajax.php",
		        uploadExtraData: function() {
		            return {
		                titulo1: $("#titulo1").val(),
		                contenido: $("#contenido").val()
		            };
		        }
		    });

		    function validar(){
		    	var tit = $("#titulo1").val();
		    	var con = $("#contenido").val();
		    	var ima = $("#imagen").val();

		    	

		    	var msj="<table align='center' border='0'><tr><td>Rellene los siguientes campos:<br><br><td><tr>";
	            var e =false;
	            if($.trim(tit)==""){
	                msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Titulo<td><tr>";
	                e=true;
	            }
	            if($.trim(con)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Contenido<td><tr>";
	                e=true;
	            }

	            if(!document.getElementById('miniaturas').hasChildNodes()){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Imagen<td><tr>";
	                e=true;
	            }

	          
	           if(e){
	            	msj=msj+"</table>";
	            	alert(msj);
	            	return false;
	            }else{
	            	return true;
	            }   
			}
		</script>
	</body>
</html>