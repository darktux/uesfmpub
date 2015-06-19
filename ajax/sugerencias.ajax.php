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
            case 'nueva':

                break;
            case 'sugerenciasjson':
                $con->consulta('SELECT * FROM tb_sugerencias ORDER BY fecha,hora ASC;');
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