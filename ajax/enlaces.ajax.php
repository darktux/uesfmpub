<?php
    if(session_status() !== PHP_SESSION_ACTIVE){session_start();}
    if(isset($_SESSION['upub087_nivel'])){
        if($_SESSION['upub087_nivel']!="1"){//deja entrar si es admin
            echo'
                <script language="javascript1.5" type="text/javascript">
                    window.location="../index1.php";
                </script>
            ';
        }
    }
    else{
        echo'
            <script language="javascript1.5" type="text/javascript">
                window.location="../index1.php";
            </script>
        ';
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    	require('pgconex.php');
    	$con= new PgConex();
        $con->conectar();
        if(isset($_GET['accion'])){$_POST['accion']=$_GET['accion'];}
        switch ($_POST['accion']) {
        	case 'set':
                $con->consulta("BEGIN");
        		$con->consulta("INSERT INTO tb_enlaces(titulo,url,id_usuario) VALUES('".$_POST['titulo']."','".$_POST['url']."',".$_SESSION['upub087_id'].");");
    			$con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se guardo el enlace ".$_POST['titulo']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
                if($con->getResultado()){
                    $con->consulta("COMMIT");
    				echo "Éxito, todo guardado correctamente";
    			}
    			else{
                    $con->consulta("ROLLBACK");
    				echo "Error al guardar, ninguna acción tendrá efecto";
    			}
        		break;
        	case 'udp':
                $con->consulta("BEGIN");
        		$con->consulta("UPDATE tb_enlaces SET titulo='".$_POST['titulo']."', url='".$_POST['url']."', id_usuario=".$_SESSION['upub087_id']." WHERE id=".$_POST['id'].";");
                $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se modifico el enlace ".$_POST['titulo']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
                if($con->getResultado()){
                    $con->consulta("COMMIT");
    				echo "Éxito, todo modificado correctamente";
    			}
    			else{
                    $con->consulta("ROLLBACK");
    				echo "Error al guardar, ninguna acción tendrá efecto";
    			}
        		break;
            case 'rem':
                $con->consulta("BEGIN");
                $con->consulta("DELETE FROM tb_enlaces WHERE id='".$_POST['id']."';");
                $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se elimino el enlace ".$_POST['titulo']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
                if($con->getResultado()){
                    $con->consulta("COMMIT");
                    echo "Éxito, todo eliminado correctamente";
                }
                else{
                    $con->consulta("ROLLBACK");
                    echo "Error al eliminar, ninguna acción tendrá efecto";
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
    		case 'enlacesjson':
                    $con->consulta('SELECT * FROM tb_enlaces ORDER BY id ASC;');
                    $i=0;
                    $salida=array();
                    while ($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {       
                        $salida[$i]=$fila;   
                        $i++;
                    }
                    echo json_encode($salida);
                    break;
        	default:
        		echo "¡No se que hacer!";
        		break;
        }
    	$con->limpiarConsulta();
        $con->desconectar();
    }
    else{
        echo utf8_decode("ERROR: Intento de intrusión directa... \../");
    }
?>