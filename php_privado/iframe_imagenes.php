<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<iframe id="iframeimg" src='php_privado/vista_imagenes.php' width='100%'  frameborder='0' onload='altura();'></iframe>
		<script type="text/javascript">
			window.onresize = function() {
				altura();
			};
			function altura(){
				document.getElementById('iframeimg').style.height=(window.innerHeight-77)+'px';
			}
		</script>
	</body>
</html>