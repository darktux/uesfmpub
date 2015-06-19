<?php
	require('pgconex.php');
	$con= new PgConex();
    $con->conectar();
    switch ($_POST['accion']) {
    	case 'upd':
    		$con->consulta("UPDATE tb_general SET direccion='".$_POST['direccion']."', telefono='".$_POST['telefono']."', fax='".$_POST['fax']."', correo='".$_POST['correo']."';");
			if($con->getResultado()){
				echo "Información de contacto guardada correctamente.";
			}
			else{
				echo "Error, no se pudo guardar la información de contacto en la base de datos.";
			}
    		break;
    	case 'get':
    		$con->consulta("SELECT direccion,telefono,fax,correo FROM tb_general WHERE id=1;");
			if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {		
			    echo $fila['direccion'].'*'.$fila['telefono'].'*'.$fila['fax'].'*'.$fila['correo'];
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