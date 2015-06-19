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
        switch($_POST['accion']){
            case 'set':
                $con->consulta("BEGIN");
                $con->consulta("INSERT INTO tb_usuario(nombre,usuario,contrasena,nivel)  VALUES('".$_POST['nombre']."','".$_POST['usuario']."','".sha1(md5(trim($_POST['usuario']).trim($_POST['contrasena'])))."','".$_POST['nivel']."');");
                $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se guardo el usuario ".$_POST['usuario']." de nivel ".$_POST['nivel']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
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
                if($_POST['contrasena']!="*****"){
                    $contra = "contrasena='".sha1(md5(trim($_POST['usuario']).trim($_POST['contrasena'])))."',";
                }
                else{
                    $contra="";
                }
                $con->consulta("BEGIN");
                $con->consulta("UPDATE tb_usuario SET nombre='".$_POST['nombre']."', ".$contra." nivel='".$_POST['nivel']."' WHERE id='".$_POST['id']."';");
                $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se modifico el usuario ".$_POST['usuario']." de nivel ".$_POST['nivel']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
                if($con->getResultado()){
                    $con->consulta("COMMIT");
                    echo "Éxito, todo modificado correctamente";
                }
                else{
                    $con->consulta("ROLLBACK");
                    echo "Error al modificar, ninguna acción tendrá efecto";
                }
                break;
            case 'udpcontra':
                $con->consulta('SELECT contrasena FROM tb_usuario WHERE id='.$_SESSION['upub087_id'].';');
                if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {       
                    if($fila['contrasena']==sha1(md5($_SESSION['upub087_usuario'].trim($_POST['actual'])))){
                        $con->consulta("BEGIN");
                        $con->consulta("UPDATE tb_usuario SET contrasena='".sha1(md5($_SESSION['upub087_usuario'].trim($_POST['nueva'])))."' WHERE id='".$_SESSION['upub087_id']."';");
                        $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se auto-modifico la contraseña, el usuario ".$_SESSION['upub087_usuario']." de nivel ".$_SESSION['upub087_nivel']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
                        if($con->getResultado()){
                            $con->consulta("COMMIT");
                            echo "Éxito, contraseña modificada correctamente";
                        }
                        else{
                            $con->consulta("ROLLBACK");
                            echo "Error al modificar, ninguna acción tendrá efecto";
                        }
                    }
                    else{
                        echo "Error al modificar,\nla contraseña actual no es correcta y ninguna acción tendrá efecto";
                    }
                }
                break;
            case 'rem':
                $con->consulta("BEGIN");
                $con->consulta("DELETE FROM tb_usuario WHERE id='".$_POST['id']."';");
                $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se elimino el usuario ".$_POST['usuario']." de nivel ".$_POST['nivel']."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
                if($con->getResultado()){
                    $con->consulta("COMMIT");
                    echo "Éxito, todo eliminado correctamente";
                }
                else{
                    $con->consulta("ROLLBACK");
                    echo "Error al eliminar, ninguna acción tendrá efecto";
                }
                break;
            case 'usuariosjson':
                $con->consulta('SELECT * FROM tb_usuario ORDER BY nivel ASC;');
                $i=0;
                $salida=array();
                while ($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)) {       
                    $salida[$i]=$fila;   
                    $i++;
                }
                echo json_encode($salida);
                break;
        }
        $con->limpiarConsulta();
        $con->desconectar();
    }
    else{
        echo utf8_decode("ERROR: Intento de intrusión directa... \../");
    }
?>