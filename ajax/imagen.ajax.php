<?php
    require('pgconex.php');
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        switch($_POST['accion']){
            case 'nueva':
                if(empty($_FILES['imagen'])){
                    echo json_encode(['error'=>'No hay imágenes para subir.']); 
                    return;
                }
                $nombre = empty($_POST['nombre']) ? '' : $_POST['nombre'];
                $descripcion = empty($_POST['descripcion']) ? '' : $_POST['descripcion'];
                $imagenes = $_FILES['imagen'];

                $exito = null;
                $rutas= [];
                $filenames = $imagenes['name'];
                for($i=0; $i < count($filenames); $i++){
                    $ext = explode('.', basename($filenames[$i]));
                    $target = "../carga_imagenes" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
                    if(move_uploaded_file($imagenes['tmp_name'][$i], $target)){
                        $exito = true;
                        $rutas[] = $target;
                    } else {
                        $exito = false;
                        break;
                    }
                }
                if($exito === true) {
                    // call the function to save all data to database
                    // code for the following function `save_data` is not 
                    // mentioned in this example
                    ////////////////////////////////////////////////////////////////////////////////////save_data($userid, $username, $paths);
                    $con= new PgConex();
                    $con->conectar();
                    for($i=0; $i < count($rutas); $i++){
                        $con->consulta("INSERT INTO tb_imagenes(nombre,descripcion,url,estado,acordeon,id_usuario) VALUES('".$nombre."','".$descripcion."','".$rutas[$i]."',true,false,1);");
                    }
                    $con->limpiarConsulta();
                    $con->desconectar();
                    // store a successful response (default at least an empty array). You
                    // could return any additional response info you need to the plugin for
                    // advanced implementations.
                    $output = [];
                    // for example you can get the list of files uploaded this way
                    $output = ['uploaded' => $paths];
                }
                else{
                    if ($exito === false){
                        $output = ['error'=>'Error al cargar las imágenes. Póngase en contacto con el administrador del sistema.' ];
                        // delete any uploaded files
                        foreach ($rutas as $file) {
                            unlink($file);
                        }
                    }
                    else {
                        $output = ['error'=>'No hay archivos que procesar.'];
                    }
                }
                echo json_encode($output);
                break;

            case 'obtieneimagenes':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("SELECT * FROM tb_imagenes WHERE estado=TRUE ORDER BY id;");
                $nimagen=0;
                echo '<h3 style="text-align:center;">Gestión de imágenes</h3>';
                while ($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){       
                    if($nimagen==0){
                        echo '<div class="row">';
                    }
                    echo '
                        <div class="col-md-2">
                            <div class="thumbnail">
                                <img id="'.$fila['id'].'" src="'.$fila['url'].'" alt="alto" draggable="true" ondragstart="drag(event)">
                                <p class="caption">
                                    <b>'.$fila['nombre'].'</b>
                                    <br>
                                    '.$fila['descripcion'].'
                                </p>
                            </div>
                        </div>
                    ';
                    $nimagen++;
                    if($nimagen==6){
                        echo '</div>';
                        $nimagen=0;
                    }
                }
                if($nimagen!=0){
                    echo '</div><br><br><br><br><br><br>';
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break;
            case 'controlimagenes':
                $con= new PgConex();
                $con->conectar();
                echo '<table width="100%"><tr>';
                $con->consulta("SELECT r.id,r.nombre,i.url FROM tb_roles r LEFT JOIN tb_imagenes i ON r.id_imagen=i.id ORDER BY r.id ASC;");
                while($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){ 
                    if($fila['url']==""){
                        echo '
                            <td width="120">
                                <div class="objetivo" id="'.$fila['nombre'].'" ondrop="dropimagenes(event,'.$fila['id'].',\'fondo'.explode(" ",$fila['nombre'])[0].'\')" ondragover="allowDrop(event)">
                                    '.$fila['nombre'].'
                                    <img id="fondo'.explode(" ",$fila['nombre'])[0].'" title="'.$fila['nombre'].'" src="../imagen/noimg.png" width="100px">
                                </div>
                            </td>
                        ';
                    }
                    else{
                        echo '
                            <td width="120">
                                <div class="objetivo" id="'.$fila['nombre'].'" ondrop="dropimagenes(event,'.$fila['id'].',\'fondo'.explode(" ",$fila['nombre'])[0].'\')" ondragover="allowDrop(event)">
                                    '.$fila['nombre'].'
                                    <img id="fondo'.explode(" ",$fila['nombre'])[0].'" title="'.$fila['nombre'].'" src="'.$fila['url'].'" width="100px">
                                </div>
                            </td>
                        ';
                    }
                }
                 echo '
                    <td width="120">
                        <div onclick="cambio2();" class="objetivo" id="galeria" ondrop="dropgaleria(event,\'true\')" ondragover="allowDrop(event)">
                            Galeria
                            <img id="imagengaleria" title="Galeria de imagenes" src="../imagen/galeria.png" width="100px">
                        </div>
                    </td>
                ';
                 echo '
                    <td width="120">
                        <div class="objetivo" id="modificar" ondrop="dropgaleria(event)" ondragover="allowDrop(event)">
                            Modificar
                            <img id="imagenmodificar" title="Modificar imagenes" src="../imagen/modificar.png" width="100px">
                        </div>
                    </td>
                ';
                $con->consulta("SELECT * FROM tb_imagenes WHERE estado=FALSE;");
                if($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                    echo '
                        <td align="right">
                            <div onclick="cambio3();" class="basurero" id="basurero" ondrop="dropbasurero(event,\'false\')" ondragover="allowDrop(event)">
                                Basurero&nbsp&nbsp&nbsp&nbsp&nbsp;
                                <img id="imagenbasurero" title="Basurero de imagenes" src="../imagen/basurerolleno.png" width="100px">
                            </div>
                        </td>
                    ';
                }
                else{
                    echo '
                        <td align="right">
                            <div class="basurero" id="basurero" ondrop="dropbasurero(event,\'false\')" ondragover="allowDrop(event)">
                                Basurero&nbsp&nbsp&nbsp&nbsp&nbsp;
                                <img id="imagenbasurero" title="Basurero de imagenes" src="../imagen/basurerovacio.png" width="100px">
                            </div>
                        </td>
                    ';
                }
                echo '</tr></table>';
                $con->limpiarConsulta();
                $con->desconectar();
                break;
            case 'imagenes':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("UPDATE tb_roles SET id_imagen=".$_POST['idimagen']." WHERE id='".$_POST['idrol']."';");
                if($con->getResultado()){
                    echo "Éxito, todo guardado correctamente";
                }
                else{
                    echo "Error al guardar, ninguna acción tendrá efecto";
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break;
            case 'obtienegaleria':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("SELECT * FROM tb_imagenes WHERE acordeon=true;");
                $nimagen=0;
                echo '<h3 style="text-align:center;">Galería de imágenes</h3>';
                while ($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){       
                    if($nimagen==0){
                        echo '<div class="row">';
                    }
                    echo '
                        <div class="col-md-2">
                            <div class="thumbnail">
                                <img id="'.$fila['id'].'" src="'.$fila['url'].'" alt="alto" draggable="true" ondragstart="drag(event)">
                                <p class="caption">
                                    <b>'.$fila['nombre'].'</b>
                                    <br>
                                    '.$fila['descripcion'].'
                                </p>
                            </div>
                        </div>
                    ';
                    $nimagen++;
                    if($nimagen==6){
                        echo '</div>';
                        $nimagen=0;
                    }
                }
                if($nimagen!=0){
                    echo '</div><br><br><br><br><br><br>';
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break;
            case 'controlgaleria':
                echo '
                    <table width="100%">
                        <tr>
                            <td width="120">
                                <div onclick="cambio1();" class="objetivo" id="atras">
                                    Atras
                                    <img id="imagengaleria" title="Galeria de imagenes" src="../imagen/atras.png" width="100px">
                                </div>
                            </td>
                            <td align="right">
                                <div class="basurero" id="basurero" ondrop="dropgaleria(event,\'false\')" ondragover="allowDrop(event)">
                                    Quitar&nbsp&nbsp&nbsp&nbsp&nbsp;
                                    <img id="imagenquitar" title="Quitar" src="../imagen/elimina.png" width="100px">
                                </div>
                            </td>
                        </tr>
                    </table>
                ';
                break;
            case 'galeria':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("UPDATE tb_imagenes SET acordeon='".$_POST['cambio']."' WHERE id=".$_POST['idimagen'].";");
                $exito= array('agregada a','quitada de');
                $error= array('agregar','quitar');
                $n=1;
                if($_POST['cambio']=='true'){$n=0;}
                if($con->getResultado()){
                    echo "Éxito, imagen ".$exito[$n]." la galeria correctamente";
                }
                else{
                    echo "Error al ".$error[$n]." la imagen, ninguna acción tendrá efecto";
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break;

            case 'obtienebasurero':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("SELECT * FROM tb_imagenes WHERE estado=FALSE;");
                $nimagen=0;
                echo '<h3 style="text-align:center;">Basurero de imágenes</h3>';
                while ($fila = pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){     
                    if($nimagen==0){
                        echo '<div class="row">';
                    }
                    echo '
                        <div class="col-md-2">
                            <div class="thumbnail">
                                <img id="'.$fila['id'].'" src="'.$fila['url'].'" alt="alto" draggable="true" ondragstart="drag(event)">
                                <p class="caption">
                                    <b>'.$fila['nombre'].'</b>
                                    <br>
                                    '.$fila['descripcion'].'
                                </p>
                            </div>
                        </div>
                    ';
                    $nimagen++;
                    if($nimagen==6){
                        echo '</div>';
                        $nimagen=0;
                    }
                }
                if($nimagen!=0){
                    echo '</div><br><br><br><br><br><br>';
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break;
            case 'controlbasurero':
                echo '
                    <table width="100%">
                        <tr>
                            <td width="120">
                                <div onclick="cambio1();" class="objetivo" id="atras">
                                    Atras
                                    <img id="imagengaleria" title="Galeria de imagenes" src="../imagen/atras.png" width="100px">
                                </div>
                            </td>
                             <td align="right">
                                <div class="objetivo" id="recuperar" ondrop="dropbasurero(event,\'true\')" ondragover="allowDrop(event)">
                                    Recuperar&nbsp&nbsp&nbsp&nbsp&nbsp;
                                    <img id="imagenrecuperar" title="Recuperacion de imagenes" src="../imagen/restaurar.png" width="100px">
                                </div>
                            </td>
                            <td align="right">
                                <div class="basurero" id="eliminar" ondrop="dropeliminar(event)" ondragover="allowDrop(event)">
                                    Eliminar&nbsp&nbsp&nbsp&nbsp&nbsp;
                                    <img id="imagenEliminar" title="Eliminacion de imagenes" src="../imagen/eliminarfinal.png" width="100px">
                                </div>
                            </td>
                        </tr>
                    </table>
                ';
                break;
            case 'basurero':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("UPDATE tb_imagenes SET estado='".$_POST['cambio']."' WHERE id=".$_POST['idimagen'].";");
                $exito= array('recuperada','desactivada');
                $error= array('recuperar','desactivar');
                $n=1;
                if($_POST['cambio']=='true'){$n=0;}
                if($con->getResultado()){
                    echo "Éxito, imagen ".$exito[$n]." correctamente";
                }
                else{
                    echo "Error al ".$error[$n]." la imagen, ninguna acción tendrá efecto";
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break;
            case 'eliminar':
                $con= new PgConex();
                $con->conectar();
                $con->consulta("BEGIN");
                $con->consulta("UPDATE tb_roles SET id_imagen=null WHERE id_imagen='".$_POST['idimagen']."';");
                $con->consulta("DELETE FROM tb_imagenes WHERE id='".$_POST['idimagen']."';");
                if($con->getResultado()){
                    echo "Éxito, imagen eliminada correctamente";
                    $con->consulta("COMMIT");
                }
                else{
                    echo "Error al eliminar, ninguna acción tendrá efecto";
                    $con->consulta("ROLLBACK");
                }
                $con->limpiarConsulta();
                $con->desconectar();
                break; 
        }
    }
?>