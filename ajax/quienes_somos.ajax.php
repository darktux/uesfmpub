<?php
	require('pgconex.php');
	$con= new PgConex();
	$con->conectar();
	switch ($_POST['accion']) {
    	case 'upd':
		    $con->consulta("UPDATE tb_general SET titular='".$_POST['titular']."', mision='".$_POST['mision']."', vision='".$_POST['vision']."';");
			if($con->getResultado()){
				echo "Información de quienes somos fue guardada correctamente.";
			}
			else{
				echo "Error, no se pudo guardar la información de quienes somos en la base de datos.";
			}
    		break;
    	case 'get':
    		$con->consulta("SELECT titular,mision,vision FROM tb_general WHERE id=1;");
			if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {		
			    echo $fila['titular'].'*'.$fila['mision'].'*'.$fila['vision'];
			}else{
				echo " * * * ";
			}
			break;
    	default:
    		echo "¡No se que hacer!";
    		break;
    }
	$con->limpiarConsulta();
    $con->desconectar();
?>