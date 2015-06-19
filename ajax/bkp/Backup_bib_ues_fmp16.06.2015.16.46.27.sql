--
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

--
-- Estrutura de tabla 'tb_actividad_imagenes'
--
DROP TABLE IF EXISTS tb_actividad_imagenes CASCADE;
CREATE TABLE tb_actividad_imagenes (
	id_actividad integer NOT NULL,
	id_imagen bigint NOT NULL
);

--
-- Creando datos de 'tb_actividad_imagenes'
--
--
-- Creando indices PrimaryKey de 'tb_actividad_imagenes'
--
--

-- Creando indices Unique de 'tb_actividad_imagenes'
--



--
-- Estrutura de secuencia tb_actividades_id_seq para la tabla 'tb_actividades'
--
DROP SEQUENCE IF EXISTS tb_actividades_id_seq CASCADE;
CREATE SEQUENCE tb_actividades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_actividades_id_seq', 1);

--
-- Estrutura de tabla 'tb_actividades'
--
DROP TABLE IF EXISTS tb_actividades CASCADE;
CREATE TABLE tb_actividades (
	id integer NOT NULL DEFAULT nextval('tb_actividades_id_seq'::regclass),
	titulo character varying(100) NOT NULL,
	contenido text NOT NULL,
	fecha_inicio date NOT NULL,
	hora_inicio time without time zone NOT NULL,
	objetivo character varying(200),
	id_usuario int2 NOT NULL,
	fecha_fin date,
	hora_fin time without time zone
);

ALTER SEQUENCE tb_actividades_id_seq OWNED BY tb_actividades.id;

--
-- Creando datos de 'tb_actividades'
--
INSERT INTO tb_actividades VALUES('1','ertyu','eyty','2011-11-11','00:00:00','ew','1',NULL,NULL);
--
-- Creando indices PrimaryKey de 'tb_actividades'
--
ALTER TABLE ONLY  tb_actividades  ADD CONSTRAINT  pk_actividad  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_actividades'
--



--
-- Estrutura de secuencia tb_audiovisuales_id_seq para la tabla 'tb_audiovisuales'
--
DROP SEQUENCE IF EXISTS tb_audiovisuales_id_seq CASCADE;
CREATE SEQUENCE tb_audiovisuales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_audiovisuales_id_seq', 1);

--
-- Estrutura de tabla 'tb_audiovisuales'
--
DROP TABLE IF EXISTS tb_audiovisuales CASCADE;
CREATE TABLE tb_audiovisuales (
	id integer NOT NULL DEFAULT nextval('tb_audiovisuales_id_seq'::regclass),
	nombre character varying(50) NOT NULL,
	tipo int2 NOT NULL,
	descripcion text NOT NULL,
	autor character varying(50) NOT NULL,
	url character varying(100) NOT NULL,
	id_usuario int2 NOT NULL
);

ALTER SEQUENCE tb_audiovisuales_id_seq OWNED BY tb_audiovisuales.id;

--
-- Creando datos de 'tb_audiovisuales'
--
--
-- Creando indices PrimaryKey de 'tb_audiovisuales'
--
ALTER TABLE ONLY  tb_audiovisuales  ADD CONSTRAINT  pk_audiovisual  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_audiovisuales'
--



--
-- Estrutura de secuencia tb_bitacora_id_seq para la tabla 'tb_bitacora'
--
DROP SEQUENCE IF EXISTS tb_bitacora_id_seq CASCADE;
CREATE SEQUENCE tb_bitacora_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_bitacora_id_seq', 46);

--
-- Estrutura de tabla 'tb_bitacora'
--
DROP TABLE IF EXISTS tb_bitacora CASCADE;
CREATE TABLE tb_bitacora (
	id bigint NOT NULL DEFAULT nextval('tb_bitacora_id_seq'::regclass),
	interfaz int2,
	accion character varying(100) NOT NULL,
	fecha date NOT NULL,
	hora time without time zone,
	id_usuario int2
);

ALTER SEQUENCE tb_bitacora_id_seq OWNED BY tb_bitacora.id;

--
-- Creando datos de 'tb_bitacora'
--
INSERT INTO tb_bitacora VALUES('1','1','sdfds','2011-11-11','01:01:01','1');
INSERT INTO tb_bitacora VALUES('2','2','sdfgu6','2012-12-12','02:02:02','1');
INSERT INTO tb_bitacora VALUES('3','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.06.09.sql','2015-06-15','14:06:09','1');
INSERT INTO tb_bitacora VALUES('4','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.06.25.sql','2015-06-15','14:06:25','1');
INSERT INTO tb_bitacora VALUES('5','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.07.33.sql','2015-06-15','14:07:33','1');
INSERT INTO tb_bitacora VALUES('6','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.07.53.sql','2015-06-15','14:07:53','1');
INSERT INTO tb_bitacora VALUES('7','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.07.55.sql','2015-06-15','14:07:55','1');
INSERT INTO tb_bitacora VALUES('8','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.08.08.sql','2015-06-15','14:08:08','1');
INSERT INTO tb_bitacora VALUES('9','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.08.15.sql','2015-06-15','14:08:15','1');
INSERT INTO tb_bitacora VALUES('10','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.08.18.sql','2015-06-15','14:08:18','1');
INSERT INTO tb_bitacora VALUES('11','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.08.34.sql','2015-06-15','14:08:34','1');
INSERT INTO tb_bitacora VALUES('12','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.08.40.sql','2015-06-15','14:08:40','1');
INSERT INTO tb_bitacora VALUES('13','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.08.45.sql','2015-06-15','14:08:45','1');
INSERT INTO tb_bitacora VALUES('14','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.12.20.sql','2015-06-15','14:12:20','1');
INSERT INTO tb_bitacora VALUES('15','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.12.41.sql','2015-06-15','14:12:41','1');
INSERT INTO tb_bitacora VALUES('16','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.13.16.sql','2015-06-15','14:13:16','1');
INSERT INTO tb_bitacora VALUES('17','1','Se generó el backup Backup_bib_ues_fmp15.06.2015.14.17.01.sql','2015-06-15','14:17:01','1');
INSERT INTO tb_bitacora VALUES('18','1','Se restauro la base de datos con el archivo Backup_bib_ues_fmp15.06.2015.14.17.01.sql','2015-06-16','00:34:38','1');
INSERT INTO tb_bitacora VALUES('19','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.0.44.26.sql','2015-06-16','00:44:26','1');
INSERT INTO tb_bitacora VALUES('20','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.14.09.33.sql','2015-06-16','14:09:33','1');
INSERT INTO tb_bitacora VALUES('21','1','Se guardo el usuario pp de nivel 2','2015-06-16','14:24:42','1');
INSERT INTO tb_bitacora VALUES('22','1','Se guardo el usuario jj de nivel 1','2015-06-16','14:25:21','1');
INSERT INTO tb_bitacora VALUES('23','1','Se guardo el usuario jj de nivel 1','2015-06-16','14:25:24','1');
INSERT INTO tb_bitacora VALUES('24','1','Se guardo el usuario jj de nivel 1','2015-06-16','14:25:25','1');
INSERT INTO tb_bitacora VALUES('25','1','Se elimino el usuario  de nivel ','2015-06-16','14:31:51','1');
INSERT INTO tb_bitacora VALUES('26','1','Se elimino el usuario  de nivel ','2015-06-16','14:31:54','1');
INSERT INTO tb_bitacora VALUES('27','1','Se elimino el usuario  de nivel ','2015-06-16','14:31:56','1');
INSERT INTO tb_bitacora VALUES('28','1','Se guardo el usuario jj de nivel 1','2015-06-16','14:35:02','1');
INSERT INTO tb_bitacora VALUES('29','1','Se guardo el usuario jjj de nivel 1','2015-06-16','14:35:36','1');
INSERT INTO tb_bitacora VALUES('30','1','Se elimino el usuario  de nivel ','2015-06-16','14:35:46','1');
INSERT INTO tb_bitacora VALUES('31','1','Se elimino el usuario  de nivel ','2015-06-16','14:35:48','1');
INSERT INTO tb_bitacora VALUES('32','1','Se elimino el usuario  de nivel ','2015-06-16','14:35:51','1');
INSERT INTO tb_bitacora VALUES('33','1','Se elimino el usuario  de nivel ','2015-06-16','14:35:53','1');
INSERT INTO tb_bitacora VALUES('34','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.14.39.18.sql','2015-06-16','14:39:18','1');
INSERT INTO tb_bitacora VALUES('35','1','Se modifico el usuario admin de nivel 1','2015-06-16','14:45:00','1');
INSERT INTO tb_bitacora VALUES('36','1','Se modifico el usuario admin de nivel 1','2015-06-16','14:45:08','1');
INSERT INTO tb_bitacora VALUES('37','1','Se modifico el usuario admin de nivel 1','2015-06-16','14:45:22','1');
INSERT INTO tb_bitacora VALUES('38','1','Se modifico el usuario admin de nivel 1','2015-06-16','14:45:54','1');
INSERT INTO tb_bitacora VALUES('39','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.14.51.09.sql','2015-06-16','14:51:09','1');
INSERT INTO tb_bitacora VALUES('40','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.14.51.55.sql','2015-06-16','14:51:55','1');
INSERT INTO tb_bitacora VALUES('41','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.14.56.53.sql','2015-06-16','14:56:53','1');
INSERT INTO tb_bitacora VALUES('42','1','Se guardo el usuario Esmeralda de nivel 1','2015-06-16','16:41:55','1');
INSERT INTO tb_bitacora VALUES('43','1','Se modifico el usuario Esmeralda de nivel 2','2015-06-16','16:43:11','1');
INSERT INTO tb_bitacora VALUES('44','1','Se modifico el usuario Esmeralda de nivel 1','2015-06-16','16:43:21','1');
INSERT INTO tb_bitacora VALUES('45','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.16.44.52.sql','2015-06-16','16:44:52','1');
INSERT INTO tb_bitacora VALUES('46','1','Se generó el backup Backup_bib_ues_fmp16.06.2015.16.46.27.sql','2015-06-16','16:46:27','1');
--
-- Creando indices PrimaryKey de 'tb_bitacora'
--
ALTER TABLE ONLY  tb_bitacora  ADD CONSTRAINT  pk_bitacora  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_bitacora'
--



--
-- Estrutura de secuencia tb_enlaces_id_seq para la tabla 'tb_enlaces'
--
DROP SEQUENCE IF EXISTS tb_enlaces_id_seq CASCADE;
CREATE SEQUENCE tb_enlaces_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_enlaces_id_seq', 11);

--
-- Estrutura de tabla 'tb_enlaces'
--
DROP TABLE IF EXISTS tb_enlaces CASCADE;
CREATE TABLE tb_enlaces (
	id int2 NOT NULL DEFAULT nextval('tb_enlaces_id_seq'::regclass),
	titulo character varying(100) NOT NULL,
	url character varying(200) NOT NULL,
	id_usuario int2 NOT NULL
);

ALTER SEQUENCE tb_enlaces_id_seq OWNED BY tb_enlaces.id;

--
-- Creando datos de 'tb_enlaces'
--
INSERT INTO tb_enlaces VALUES('1','Biblioteca virtual','http://biblioteca.ues.edu.sv/portal/','1');
INSERT INTO tb_enlaces VALUES('2','Repositorio Institucional','http://ri.ues.edu.sv/','1');
INSERT INTO tb_enlaces VALUES('4','Libros Electronicos','http://biblioteca.ues.edu.sv/pearson/index.php','1');
INSERT INTO tb_enlaces VALUES('5','Consorcio de Biblioteca (Libros Digitales)','http://bc.ues.edu.sv/','1');
INSERT INTO tb_enlaces VALUES('6','Correo Electronico Institucional','http://correoweb.ues.edu.sv/','1');
INSERT INTO tb_enlaces VALUES('7','Aula Virtual','http://campusvirtual.ues.edu.sv/login/index.php','1');
INSERT INTO tb_enlaces VALUES('8','prueba','https://www.google.com','1');
INSERT INTO tb_enlaces VALUES('11','enlace uno','www.facebook.com','1');
--
-- Creando indices PrimaryKey de 'tb_enlaces'
--
ALTER TABLE ONLY  tb_enlaces  ADD CONSTRAINT  pk_enlace  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_enlaces'
--
ALTER TABLE ONLY tb_enlaces ADD CONSTRAINT un_url UNIQUE (url);


--
-- Estrutura de tabla 'tb_general'
--
DROP TABLE IF EXISTS tb_general CASCADE;
CREATE TABLE tb_general (
	id int2 NOT NULL,
	titular character varying(50) NOT NULL,
	telefono character(9),
	fax character(9),
	direccion text,
	correo character varying(50),
	mision text,
	vision text,
	id_usuario int2 NOT NULL
);

--
-- Creando datos de 'tb_general'
--
INSERT INTO tb_general VALUES('1','Licda. Esmeralda del Carmen Quintanilla','2393-6254','2393-6254','Final Avenida Crescencio Miranda, frente Estadio Vicentino','unidadbibliotecaria.fmp@gmail.com','Ofrecer servicios de calidad a nuestros usuarios de la comunidad universitaria y de la Zona Paracentral, mediante recursos bibliográficos, audiovisuales y digitales accesibles a la biblioteca, garantizando el derecho al conocimiento y a la información de los usuarios.','Ser una institución que provea servicios bibliotecarios innovadores a fin de contribuir con el desarrollo científico en la Región Paracentral de El Salvador, facilitando recursos bibliográficos, audiovisuales y digitales, apoyando la adquisición y ampliación de los aprendizajes de la comunidad universitaria.
','1');
--
-- Creando indices PrimaryKey de 'tb_general'
--
ALTER TABLE ONLY  tb_general  ADD CONSTRAINT  pk_general  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_general'
--



--
-- Estrutura de secuencia tb_imagenes_id_seq para la tabla 'tb_imagenes'
--
DROP SEQUENCE IF EXISTS tb_imagenes_id_seq CASCADE;
CREATE SEQUENCE tb_imagenes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_imagenes_id_seq', 25);

--
-- Estrutura de tabla 'tb_imagenes'
--
DROP TABLE IF EXISTS tb_imagenes CASCADE;
CREATE TABLE tb_imagenes (
	id bigint NOT NULL DEFAULT nextval('tb_imagenes_id_seq'::regclass),
	nombre character varying(50) NOT NULL,
	descripcion text NOT NULL,
	url character varying(100) NOT NULL,
	estado boolean NOT NULL,
	acordeon boolean NOT NULL,
	id_usuario int2 NOT NULL
);

ALTER SEQUENCE tb_imagenes_id_seq OWNED BY tb_imagenes.id;

--
-- Creando datos de 'tb_imagenes'
--
INSERT INTO tb_imagenes VALUES('15','ejemplo','ues fmp, central','../carga_imagenes/3078ce762ef5d7907d6a67e76be3539c.jpeg','f','f','1');
--
-- Creando indices PrimaryKey de 'tb_imagenes'
--
ALTER TABLE ONLY  tb_imagenes  ADD CONSTRAINT  pk_imagenes  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_imagenes'
--



--
-- Estrutura de secuencia tb_noticias_id_seq para la tabla 'tb_noticias'
--
DROP SEQUENCE IF EXISTS tb_noticias_id_seq CASCADE;
CREATE SEQUENCE tb_noticias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_noticias_id_seq', 3);

--
-- Estrutura de tabla 'tb_noticias'
--
DROP TABLE IF EXISTS tb_noticias CASCADE;
CREATE TABLE tb_noticias (
	id bigint NOT NULL DEFAULT nextval('tb_noticias_id_seq'::regclass),
	titulo character varying(100) NOT NULL,
	contenido text NOT NULL,
	fecha date NOT NULL,
	hora time without time zone NOT NULL,
	id_imagen bigint,
	id_usuario int2 NOT NULL
);

ALTER SEQUENCE tb_noticias_id_seq OWNED BY tb_noticias.id;

--
-- Creando datos de 'tb_noticias'
--
INSERT INTO tb_noticias VALUES('3','fhh','dsfghj','2011-11-11','00:00:00','15','1');
--
-- Creando indices PrimaryKey de 'tb_noticias'
--
ALTER TABLE ONLY  tb_noticias  ADD CONSTRAINT  pk_noticia  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_noticias'
--



--
-- Estrutura de secuencia tb_objetivos_id_seq para la tabla 'tb_objetivos'
--
DROP SEQUENCE IF EXISTS tb_objetivos_id_seq CASCADE;
CREATE SEQUENCE tb_objetivos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_objetivos_id_seq', 1);

--
-- Estrutura de tabla 'tb_objetivos'
--
DROP TABLE IF EXISTS tb_objetivos CASCADE;
CREATE TABLE tb_objetivos (
	id int2 NOT NULL DEFAULT nextval('tb_objetivos_id_seq'::regclass),
	objetivo text NOT NULL,
	id_general int2 NOT NULL
);

ALTER SEQUENCE tb_objetivos_id_seq OWNED BY tb_objetivos.id;

--
-- Creando datos de 'tb_objetivos'
--
--
-- Creando indices PrimaryKey de 'tb_objetivos'
--
ALTER TABLE ONLY  tb_objetivos  ADD CONSTRAINT  pk_objetivo  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_objetivos'
--



--
-- Estrutura de secuencia tb_roles_id_seq para la tabla 'tb_roles'
--
DROP SEQUENCE IF EXISTS tb_roles_id_seq CASCADE;
CREATE SEQUENCE tb_roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_roles_id_seq', 14);

--
-- Estrutura de tabla 'tb_roles'
--
DROP TABLE IF EXISTS tb_roles CASCADE;
CREATE TABLE tb_roles (
	id int2 NOT NULL DEFAULT nextval('tb_roles_id_seq'::regclass),
	nombre character varying(30) NOT NULL,
	id_imagen bigint
);

ALTER SEQUENCE tb_roles_id_seq OWNED BY tb_roles.id;

--
-- Creando datos de 'tb_roles'
--
INSERT INTO tb_roles VALUES('8','logo',NULL);
INSERT INTO tb_roles VALUES('9','organigrama',NULL);
INSERT INTO tb_roles VALUES('10','inicio',NULL);
INSERT INTO tb_roles VALUES('11','noticias',NULL);
INSERT INTO tb_roles VALUES('12','quienes',NULL);
INSERT INTO tb_roles VALUES('13','contacto',NULL);
INSERT INTO tb_roles VALUES('14','enlaces',NULL);
--
-- Creando indices PrimaryKey de 'tb_roles'
--
ALTER TABLE ONLY  tb_roles  ADD CONSTRAINT  pk_rol  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_roles'
--



--
-- Estrutura de secuencia tb_sugerencias_id_seq para la tabla 'tb_sugerencias'
--
DROP SEQUENCE IF EXISTS tb_sugerencias_id_seq CASCADE;
CREATE SEQUENCE tb_sugerencias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_sugerencias_id_seq', 1);

--
-- Estrutura de tabla 'tb_sugerencias'
--
DROP TABLE IF EXISTS tb_sugerencias CASCADE;
CREATE TABLE tb_sugerencias (
	id bigint NOT NULL DEFAULT nextval('tb_sugerencias_id_seq'::regclass),
	titulo character varying(100) NOT NULL,
	contenido text NOT NULL,
	fecha date NOT NULL,
	hora time without time zone,
	id_general int2 NOT NULL
);

ALTER SEQUENCE tb_sugerencias_id_seq OWNED BY tb_sugerencias.id;

--
-- Creando datos de 'tb_sugerencias'
--
INSERT INTO tb_sugerencias VALUES('1','hola','prueba','2011-11-11','00:00:00','1');
--
-- Creando indices PrimaryKey de 'tb_sugerencias'
--
ALTER TABLE ONLY  tb_sugerencias  ADD CONSTRAINT  pk_sugerencia  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_sugerencias'
--



--
-- Estrutura de secuencia tb_usuario_id_seq para la tabla 'tb_usuario'
--
DROP SEQUENCE IF EXISTS tb_usuario_id_seq CASCADE;
CREATE SEQUENCE tb_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_usuario_id_seq', 14);

--
-- Estrutura de tabla 'tb_usuario'
--
DROP TABLE IF EXISTS tb_usuario CASCADE;
CREATE TABLE tb_usuario (
	id int2 NOT NULL DEFAULT nextval('tb_usuario_id_seq'::regclass),
	nombre character varying(50),
	usuario character varying(25) NOT NULL,
	contrasena character(40) NOT NULL,
	nivel int2 NOT NULL
);

ALTER SEQUENCE tb_usuario_id_seq OWNED BY tb_usuario.id;

--
-- Creando datos de 'tb_usuario'
--
INSERT INTO tb_usuario VALUES('1','admin','admin','ec04321e2c7bf2e0b01bac41896796b19f22a244','1');
INSERT INTO tb_usuario VALUES('14','Esmeralda del Carmen Quintanilla Segovia','Esmeralda','d340d500c421283e689b43015904846b29610f66','1');
--
-- Creando indices PrimaryKey de 'tb_usuario'
--
ALTER TABLE ONLY  tb_usuario  ADD CONSTRAINT  pk_usuario  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_usuario'
--
ALTER TABLE ONLY tb_usuario ADD CONSTRAINT u_usuario UNIQUE (usuario);


--
-- Estrutura de secuencia tb_valores_id_seq para la tabla 'tb_valores'
--
DROP SEQUENCE IF EXISTS tb_valores_id_seq CASCADE;
CREATE SEQUENCE tb_valores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

SELECT setval ('tb_valores_id_seq', 1);

--
-- Estrutura de tabla 'tb_valores'
--
DROP TABLE IF EXISTS tb_valores CASCADE;
CREATE TABLE tb_valores (
	id int2 NOT NULL DEFAULT nextval('tb_valores_id_seq'::regclass),
	valor character varying(25) NOT NULL,
	id_general int2 NOT NULL
);

ALTER SEQUENCE tb_valores_id_seq OWNED BY tb_valores.id;

--
-- Creando datos de 'tb_valores'
--
--
-- Creando indices PrimaryKey de 'tb_valores'
--
ALTER TABLE ONLY  tb_valores  ADD CONSTRAINT  pk_valor  PRIMARY KEY  (id);
--

-- Creando indices Unique de 'tb_valores'
--




--
-- Creando relaciones para 'tb_actividad_imagenes'
--

ALTER TABLE ONLY tb_actividad_imagenes ADD CONSTRAINT fk_imagen FOREIGN KEY (id_imagen) REFERENCES tb_imagenes(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_actividad_imagenes'
--

ALTER TABLE ONLY tb_actividad_imagenes ADD CONSTRAINT fk_actividad FOREIGN KEY (id_actividad) REFERENCES tb_actividades(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_actividades'
--

ALTER TABLE ONLY tb_actividades ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_audiovisuales'
--

ALTER TABLE ONLY tb_audiovisuales ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_bitacora'
--

ALTER TABLE ONLY tb_bitacora ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_enlaces'
--

ALTER TABLE ONLY tb_enlaces ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_general'
--

ALTER TABLE ONLY tb_general ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_imagenes'
--

ALTER TABLE ONLY tb_imagenes ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_noticias'
--

ALTER TABLE ONLY tb_noticias ADD CONSTRAINT fk_imagen FOREIGN KEY (id_imagen) REFERENCES tb_imagenes(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_noticias'
--

ALTER TABLE ONLY tb_noticias ADD CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id);

--
-- Creando relaciones para 'tb_objetivos'
--

ALTER TABLE ONLY tb_objetivos ADD CONSTRAINT fk_general FOREIGN KEY (id_general) REFERENCES tb_general(id);

--
-- Creando relaciones para 'tb_roles'
--

ALTER TABLE ONLY tb_roles ADD CONSTRAINT fk_imagen FOREIGN KEY (id_imagen) REFERENCES tb_imagenes(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_sugerencias'
--

ALTER TABLE ONLY tb_sugerencias ADD CONSTRAINT fk_general FOREIGN KEY (id_general) REFERENCES tb_general(id) ON DELETE RESTRICT;

--
-- Creando relaciones para 'tb_valores'
--

ALTER TABLE ONLY tb_valores ADD CONSTRAINT fk_general FOREIGN KEY (id_general) REFERENCES tb_general(id);