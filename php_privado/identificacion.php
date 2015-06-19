<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Identificación</title>
	</head>
	<body>
		<div style="margin:auto; background-color:#ddaaff; width:300px; padding:10px;">
			<h2 align="center">Identificación de usuarios</h2>
			<table align="center">
				<tr>
					<td>
						<label for="usuario">Usuario: </label>
					</td>
					<td>
						<input type="text" id="usuario" name="usuario">
					</td>
				</tr>
				<tr>
					<td>
						<label for="contrasena">Contraseña: </label>
					</td>
					<td>
						<input type="password" id="contrasena" name="contrasena">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button onclick="comprobar();">Comprobar</button></td>
				</tr>
			</table>
		</div>
		<div id="avisos">
			
		</div>
		<script type="text/javascript">
			function comprobar(){
				var usuario=document.getElementById('usuario').value;
				var contrasena=document.getElementById('contrasena').value;
				var xmlhttp = new XMLHttpRequest();
	            xmlhttp.onreadystatechange=function(){
	                if(xmlhttp.readyState==4 && xmlhttp.status==200){

	                	alert('QUE PASO');


	                	/*if(/exito/.test(xmlhttp.responseText)){
	                		//redireccion
	                	}
	                	else{
	                		$(#avisos).innerHTML=xmlhttp.responseText;
	                	}*/
	                }
	            }
	            xmlhttp.open('GET','ajaxseguridad.php?caso=identificar&usuario='+usuario+'&contrasena='+contrasena,true);

	            xmlhttp.send();
	        }

		</script>
	</body>
</html>