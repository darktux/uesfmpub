<?php

	require('../ajax/pgconex.php');
	$con= new PgConex();
    $con->conectar();
    $con->consulta("SELECT i.url FROM tb_roles r LEFT JOIN tb_imagenes i ON r.id_imagen=i.id WHERE r.nombre='nosotros' ORDER BY r.id ASC;");
    if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {
    	$url = str_replace("../", "", $fila['url']);
    	if($url==""){
    		$url='imagen/noimagen.jpg';
    	}
    }
    else{
    	$url='imagen/noimagen.jpg';
    }
    $con->consulta("SELECT titular,mision,vision FROM tb_general WHERE id=1;");
?>
<!DOCTYPE html>
<html>
	<head>
        <style type="text/css">
            .div1 {
              display: block;
              position: relative;
              text-align:center; 
              width:100%; 
              height:600px; 
            }

            .div1::after {
              content: "";
              background: url(<?php echo $url; ?>);
              opacity: 0.3;

              top: 0;
              left: 0;
              bottom: 0;
              right: 0;
              position: absolute;
              z-index: -1;   
              background-size: 100%; 
              background-repeat: no-repeat;
            }
        </style>
    </head>
	<body>  
		<div class="div1">
			
			<?php
				if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {		
				    echo'
						<strong>Titular: </strong> <br>
						'.$fila['titular'].'
						<br><br>
						<strong>Misión</strong><br>
						'.$fila['mision'].'
						<br><br>
						<strong>Visión</strong><br>
						'.$fila['vision'].'
						<br><br>
						<strong>Dependencia Directa: </strong> <br> 
						<img src="'.$fila['titular'].'" alt="">
				    ';
				}
				else{
					echo'
						<strong>Titular: </strong> <br>
						---
						<br><br>
						<strong>Dependencia Directa: </strong> <br> 
						<img src="---" alt="">
						<br><br>
						<strong>Misión</strong><br>
						---
						<br><br>
						<strong>Visión</strong><br>
						---
				    ';
				}
			?>
		</div>
	</body>
</html>
<?php
	$con->limpiarConsulta();
    $con->desconectar();
?>