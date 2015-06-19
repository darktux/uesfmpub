<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<iframe id="iframemul" src='php_privado/vista_multimedia.php' width='100%'  frameborder='0' onload='altura();'></iframe>
		<script type="text/javascript">
			window.onresize = function(){
				altura();
			};
			function altura(){
				document.getElementById('iframemul').style.height=(window.innerHeight-77)+'px';
			}
		</script>
	</body>
</html>