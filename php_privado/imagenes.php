<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="../bootstrap-3.3.4-dist/css/fileinput.css" rel="stylesheet">
		<title>Imagenes</title>
		<link href="../css/estilos.css" rel="stylesheet">
		<link href="../css/alert2.css" rel="stylesheet">
	</head>
	<body>
		<div id="divcontacto" class="formulario" >
			<p id="titulo">Información de Imágenes</p>
			<form id="form_imagenes" name="form_imagenes" enctype="multipart/form-data" method="post">
				<div class="row">
					<div class="col-md-6">
						<label for="nombre">Nombre:</label>
						<input  id="nombre" name="nombre" class="form-control" type="text" required>
					</div>
					<div class="col-md-6">
						<label   for="descripcion">Descripción:</label>
						<textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
					</div>
				</div>
				<label for="imagen">Imágenes:</label>
                <input  id="imagen" name="imagen[]" class="file form-control" type="file" multiple accept="image/*">
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
		        uploadUrl: "../ajax/imagen.ajax.php",
		        uploadExtraData: function() {
		            return {
		                nombre: $("#nombre").val(),
		                descripcion: $("#descripcion").val(),
		                accion: 'nueva'
		            };
		        }
		    });

		    function validar(){
		    	var msj="<table align='center' border='0'><tr><td>Rellene los siguientes campos:<br><br><td><tr>";
	            var e =false;
	            if($.trim($("#nombre").val())==""){
	                msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Nombre<td><tr>";
	                e=true;
	            }
	            if($.trim($("#descripcion").val())==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Descripción<td><tr>";
	                e=true;
	            }
	  	        if(!document.getElementById('miniaturas').hasChildNodes()){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Imágenes<td><tr>";
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

		    function limpiar(){
		    	document.getElementById('form_imagenes').reset();
		    }

	    </script>
	</body>
</html>

		   


