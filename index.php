<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Biblioteca Paracentral Usuario</title>
	<link href="bootstrap-3.3.4-dist/css/bootstrap.css" rel="stylesheet">
	<link href="css/romeo.css" rel="stylesheet">
	<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

	 <table width="100%" border="0">
	 	<tr>
	 		<td width="219" valign="top" align="center" bgcolor="white">
				 <a href="index.php"><img src="imagen/biblioteca.png" width="150"></a>
	 		</td>
			<td valign="top" bgcolor="white">
				<div id="sistema">
					UNIVERSIDAD DE EL SALVADOR FACULTAD MULTIDISCIPLINARIA PARACENTRAL
					<br>
					UNIDAD BIBLIOTECARIA
				</div>
			</td>
	 	</tr>
    	<tr>
    		<td width="219" valign="top">
    			<div id="menu">
			       
					<ul id="opciones" class="nav">
			            <li id="opc1"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/inicio.php');">   		<em><i class="glyphicon glyphicon-book"></i></em> 		Inicio</a></li>
			            <li id="opc2"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/noticias.php');"> 		<em><i class="glyphicon glyphicon-bullhorn"></i></em> 	Noticias</a></li>
			            <li id="opc3"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/actividades.php');"> 		<em><i class="glyphicon glyphicon-calendar"></i></em> 	Actividades</a></li>
			            <li id="opc4"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/nosotros.php');">    		<em><i class="fa fa-users"></i></em> 					Quienes somos</a></li>
			            <li id="opc5"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/mapa.php');">        		<em><i class="glyphicon glyphicon-map-marker"></i></em> Mapa</a></li>   
			            <li id="opc6"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/contacto.php');"> 		<em><i class="glyphicon glyphicon-earphone"></i></em> 	Contacto</a></li>
			            <li id="opc7"><a style="cursor:pointer;" onclick="$('#usuario').load('php_publico/enlaces.php');">  		<em><i class="glyphicon glyphicon-plus"></i></em> 		Enlaces..</a></li>   
			        </ul>
			        <hr>
			        <img src="imagen/minerva.png" width="80">
			        <br>Copyright @ 2015, Universidad de El Salvador
			    </div>
    		</td>
    		<td valign="top">
    			<div id="contenido">
    				
    				<div id="usuario"></div>
    			</div>
    		</td>
    	</tr>
    </table>


	<script src="bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
    <script src="bootstrap-3.3.4-dist/js/bootstrap.js"></script>
    <script type="text/javascript">
		window.onload=function(){ $('#usuario').load('php_publico/inicio.php'); }
    </script>
</body>
</html>