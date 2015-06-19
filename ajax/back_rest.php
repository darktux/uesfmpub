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
    function delTree($dir){
        $files = array_diff(scandir($dir), array('.','..'));
        foreach($files as $file){
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
    }
    require('pgconex.php');
    $con = new PgConex();
    $con->conectar();
    switch ($_POST["accion"]) {
        case 'backup':
            $con->consulta("BEGIN");
            delTree("bkp/");
            $backupname = "bkp/Backup_bib_ues_fmp".date('d.m.Y.G.i.s').".sql";
            $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se generó el backup ".explode("/", $backupname)[1]."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
            $salida = fopen($backupname,"w");
            ///////////////////////////////////////////////////////////////////////PARAMETROS ESTATICOS INICIALES
            fwrite($salida,"--
-- PostgreSQL database dump
--
SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--
CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--
COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
SET search_path = public, pg_catalog;
SET default_tablespace = '';
SET default_with_oids = false;
");
            $con->consulta("SELECT relname AS tabla FROM pg_class WHERE relkind IN ('r') AND relname not LIKE 'pg_%' AND relname not LIKE 'sql_%' ORDER BY tabla");
            $tablas=$con->getResultado();
            ///////////////////////////////////////////////////////////////////////ESTRUCTURA DE TABLA
            while($fila=pg_fetch_array($tablas, null, PGSQL_ASSOC)){
                $infotabla="\n--
-- Estrutura de tabla '".$fila['tabla']."'
--
DROP TABLE IF EXISTS ".$fila['tabla']." CASCADE;
CREATE TABLE ".$fila['tabla']." (";
                $con->consulta("
                    SELECT  attnum AS orden,attname AS nombre,typname AS tipo,atttypmod-4 AS longitud,attnotnull AS esnull,atthasdef AS haydefecto,adsrc AS defecto
                    FROM pg_attribute, pg_class, pg_type, pg_attrdef 
                    WHERE pg_class.oid=attrelid
                    AND pg_type.oid=atttypid 
                    AND attnum>0 
                    AND pg_class.oid=adrelid 
                    AND adnum=attnum
                    AND atthasdef='t' 
                    AND lower(relname)='".$fila['tabla']."' 
                    UNION
                    SELECT attnum AS orden,attname AS nombre,typname AS tipo,atttypmod-4 AS longitud,attnotnull AS esnull,atthasdef AS haydefecto,'' AS defecto
                    FROM pg_attribute, pg_class, pg_type 
                    WHERE pg_class.oid=attrelid
                    AND pg_type.oid=atttypid 
                    AND attnum>0 
                    AND atthasdef='f' 
                    AND lower(relname)='".$fila['tabla']."'
                    ORDER BY orden
                    ;
                ");
                $serial=false;
                $nameSerialSeq="";
                $nameSerial="";
                while($fila1=pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                    $infotabla.="\n\t".$fila1['nombre']." ";
                    if ($fila1['haydefecto']=="t"){
                        if(strpos($fila1['defecto'], "extval(")){
                            if ($fila1['tipo']=="int4"){
                                $infotabla.="integer";
                            }
                            else{
                                if ($fila1['tipo']=="int8"){
                                    $infotabla.="bigint";
                                }
                                else{
                                    $infotabla.=$fila1['tipo'];
                                }
                            }
                            $serial=true;
                            $nameSerial=$fila1['nombre'];
                        }
                    }else{
                        if($fila1['tipo']=="varchar"){
                            if($fila1['longitud']<0){
                                $fila1['longitud']=150;
                            }
                            $infotabla.="character varying(".$fila1['longitud'].")";
                        }else{
                            if ($fila1['tipo']=="float8"){
                                $infotabla.="double precision";
                            }
                            else{
                                if ($fila1['tipo']=="bool"){
                                    $infotabla.="boolean";
                                }
                                else{
                                    if ($fila1['tipo']=="int4"){
                                        $infotabla.="integer";
                                    }
                                    else{
                                        if ($fila1['tipo']=="time"){
                                            $infotabla.="time without time zone";
                                        }
                                        else{
                                            if ($fila1['tipo']=="bpchar"){
                                                if($fila1['longitud']<0){
                                                    $fila1['longitud']=150;
                                                }
                                                $infotabla.="character(".$fila1['longitud'].")";
                                            }
                                            else{
                                                if ($fila1['tipo']=="int8"){
                                                    $infotabla.="bigint";
                                                }
                                                else{
                                                    $infotabla.=$fila1['tipo'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if ($fila1['esnull']=="t"){
                        $infotabla.=" NOT NULL";
                    }
                    if ($fila1['haydefecto']=="t"){
                        $infotabla.=" DEFAULT ".$fila1['defecto'];
                        $nameSerialSeq=substr($fila1['defecto'],9,-12);
                    }
                    $infotabla.=",";
                }
                $infotabla=rtrim($infotabla,",");
                $infotabla.="\n);\n";
                $infosecuencia="";
                ///////////////////////////////////////////////////////////////////ESTRUCTURA DE SECUENCIA
                if($serial){
                    $con->consulta("SELECT last_value FROM ".$nameSerialSeq.";");
                    $start=1;
                    if($fila1=pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                        $start=$fila1['last_value'];
                    }
                    $infosecuencia = "\n--
-- Estrutura de secuencia ".$nameSerialSeq." para la tabla '".$fila['tabla']."'
--
DROP SEQUENCE IF EXISTS ".$nameSerialSeq." CASCADE;
CREATE SEQUENCE ".$nameSerialSeq."
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('".$nameSerialSeq."', ".$start.");
";
                    fwrite($salida,$infosecuencia);
                    fwrite($salida,$infotabla);
                    fwrite($salida,"\nALTER SEQUENCE ".$nameSerialSeq." OWNED BY ".$fila['tabla'].".".$nameSerial.";\n");
                }
                else{
                    fwrite($salida,$infotabla);
                }
                ///////////////////////////////////////////////////////////////////DATOS DE TABLA
                fwrite($salida,"\n--
-- Creando datos de '".$fila['tabla']."'
--
");
                $con->consulta("SELECT * FROM ".$fila['tabla'].";");
                while($fila1=pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                    $aux="INSERT INTO ".$fila['tabla']." VALUES('".utf8_decode(implode("','",$fila1))."');\n";
                    fwrite($salida,str_replace("''","NULL",$aux));
                }


                ////////////////////////////////////////////////////////////////////INDICES PRIMARY KEY DE TABLA
                $con->consulta("
                    SELECT pg_index.indisprimary,pg_catalog.pg_get_indexdef(pg_index.indexrelid)
                    FROM pg_catalog.pg_class c,pg_catalog.pg_class c2,pg_catalog.pg_index AS pg_index
                    WHERE c.relname = '".$fila['tabla']."'
                    AND c.oid = pg_index.indrelid
                    AND pg_index.indexrelid = c2.oid
                    AND pg_index.indisprimary
                    ;
                ");
                fwrite($salida,"--
-- Creando indices PrimaryKey de '".$fila['tabla']."'
--\n");
                while($fila1=pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                    $t = str_replace("CREATE UNIQUE INDEX", "", $fila1['pg_get_indexdef']);
                    $t = str_replace("USING btree", "|", $t);
                    $t = str_replace("ON", "|", $t);
                    $temp = explode("|", $t);
                    fwrite($salida,"ALTER TABLE ONLY ".$temp[1]." ADD CONSTRAINT ".$temp[0]." PRIMARY KEY ".$temp[2].";\n");
                } 
                ////////////////////////////////////////////////////////////////////INDICES UNIQUES DE TABLA
                $con->consulta("
                    select pco.conname as restriccion,pat.attname as columna
                    from pg_constraint pco
                    join pg_class pcl on (pco.conrelid = pcl.oid)
                    join pg_attribute pat on (pat.attrelid = pco.conindid)
                    where pco.contype = 'u'
                    and pcl.relname = '".$fila['tabla']."'
                    ;
                ");
                fwrite($salida,"--\n
-- Creando indices Unique de '".$fila['tabla']."'
--\n");
                $fk="";
                $campos="";
                while($fila1=pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                    if($fk!=$fila1['restriccion']){
                        if($campos!=""){
                            fwrite($salida,"ALTER TABLE ONLY ".$fila['tabla']." ADD CONSTRAINT ".$fk." UNIQUE (".$campos.");");

                            $fk=$fila1['restriccion'];
                            $campos=$fila1['columna'];
                        }else{
                            $fk=$fila1['restriccion'];
                            $campos=$fila1['columna'];
                        }
                    }else{
                        $campos.=",".$fila1['columna'];
                    }
                }
                if($campos!=""){
                    fwrite($salida,"ALTER TABLE ONLY ".$fila['tabla']." ADD CONSTRAINT ".$fk." UNIQUE (".$campos.");");
                }
                fwrite($salida,"\n\n");
            }
            /////////////////////////////////////////////////////////////////////////RELACIONES DE LAS TABLAS
            $con->consulta("
                SELECT cl.relname AS tabla,ct.conname,pg_get_constraintdef(ct.oid)
                FROM pg_catalog.pg_attribute a
                JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
                JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)
                JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND ct.confrelid != 0 AND ct.conkey[1] = a.attnum)
                JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r')
                JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)
                JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND af.attnum = ct.confkey[1]) order by cl.relname
                ;
            ");
            while($fila1=pg_fetch_array($con->getResultado(), null, PGSQL_ASSOC)){
                fwrite($salida,"\n\n--
-- Creando relaciones para '".$fila1['tabla']."'
--\n\n");
                fwrite($salida,"ALTER TABLE ONLY ".$fila1['tabla']." ADD CONSTRAINT ".$fila1['conname']." ".$fila1['pg_get_constraintdef'].";");
            }
            fclose($salida);
            if($con->getResultado()){
                $con->consulta("COMMIT");
                echo "Éxito,".$backupname;
            }
            else{
                $con->consulta("ROLLBACK");
                echo "Error al guardar, ninguna acción tendrá efecto";
            }
            //echo $backupname;
            break;
        case 'restaurar':
            if(empty($_FILES['respaldo'])){
                echo json_encode(['error'=>'No hay archivo para restaurar.']); 
            }
            $fichero = $_FILES["respaldo"]["tmp_name"];
            $entrada = fopen($fichero,"r");
            $contenido = fread($entrada, filesize($fichero));
            $con->consulta("BEGIN");
            $con->consulta(utf8_encode($contenido));
            $con->consulta("INSERT INTO tb_bitacora(interfaz,accion,fecha,hora,id_usuario)  VALUES(1,'Se restauro la base de datos con el archivo ".$_FILES["respaldo"]["name"]."','".date('Y-m-d')."','".date('G:i:s')."',".$_SESSION['upub087_id'].");");
            fclose($entrada);
            if($con->getResultado()){             
                $con->consulta("COMMIT");
                echo json_encode(['uploaded' => "Restauracion realizada con exito."]);
            }
            else{
                $con->consulta("ROLLBACK");
                echo json_encode(['error'=>'Error, la restauracion fallo, no se guardara ningun cambio.']);
            }
            break;
    }
    $con->limpiarConsulta();
    $con->desconectar();
?>
