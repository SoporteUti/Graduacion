--
-- PostgreSQL database dump
--

-- Dumped from database version 11.4 (Debian 11.4-1)
-- Dumped by pg_dump version 11.4 (Debian 11.4-1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: actividades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.actividades (
    idactividad integer NOT NULL,
    nombre text,
    condicion boolean
);


ALTER TABLE public.actividades OWNER TO postgres;

--
-- Name: actividades_idactividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.actividades_idactividad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.actividades_idactividad_seq OWNER TO postgres;

--
-- Name: actividades_idactividad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.actividades_idactividad_seq OWNED BY public.actividades.idactividad;


--
-- Name: alumno_asistencias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumno_asistencias (
    id integer NOT NULL,
    grupo_asistencia_id integer NOT NULL,
    idestudiante integer NOT NULL,
    asistencia boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.alumno_asistencias OWNER TO postgres;

--
-- Name: alumno_asistencias_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.alumno_asistencias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.alumno_asistencias_id_seq OWNER TO postgres;

--
-- Name: alumno_asistencias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.alumno_asistencias_id_seq OWNED BY public.alumno_asistencias.id;


--
-- Name: alumnos_reprobacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumnos_reprobacion (
    idalumnos_reprobacion integer NOT NULL,
    idestudiante integer,
    idgrupsol integer,
    motivo text
);


ALTER TABLE public.alumnos_reprobacion OWNER TO postgres;

--
-- Name: alumnos_reprobacion_idalumnos_reprobacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.alumnos_reprobacion_idalumnos_reprobacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.alumnos_reprobacion_idalumnos_reprobacion_seq OWNER TO postgres;

--
-- Name: alumnos_reprobacion_idalumnos_reprobacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.alumnos_reprobacion_idalumnos_reprobacion_seq OWNED BY public.alumnos_reprobacion.idalumnos_reprobacion;


--
-- Name: asesorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.asesorias (
    idasesoria integer NOT NULL,
    idestudiante integer,
    horainicio text,
    horafin text,
    fecha text
);


ALTER TABLE public.asesorias OWNER TO postgres;

--
-- Name: asesorias_idasesoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.asesorias_idasesoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asesorias_idasesoria_seq OWNER TO postgres;

--
-- Name: asesorias_idasesoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.asesorias_idasesoria_seq OWNED BY public.asesorias.idasesoria;


--
-- Name: bitacora; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bitacora (
    idbitacora integer NOT NULL,
    idusuario integer,
    accion text,
    fecha text,
    datos text
);


ALTER TABLE public.bitacora OWNER TO postgres;

--
-- Name: bitacora_idbitacora_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bitacora_idbitacora_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bitacora_idbitacora_seq OWNER TO postgres;

--
-- Name: bitacora_idbitacora_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bitacora_idbitacora_seq OWNED BY public.bitacora.idbitacora;


--
-- Name: cambio_tema; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cambio_tema (
    idcambiotema integer NOT NULL,
    nuevotema text,
    motivo text,
    idgrupsol integer
);


ALTER TABLE public.cambio_tema OWNER TO postgres;

--
-- Name: cambio_tema_idcambiotema_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cambio_tema_idcambiotema_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cambio_tema_idcambiotema_seq OWNER TO postgres;

--
-- Name: cambio_tema_idcambiotema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cambio_tema_idcambiotema_seq OWNED BY public.cambio_tema.idcambiotema;


--
-- Name: carrera_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.carrera_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.carrera_id OWNER TO postgres;

--
-- Name: carreras; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carreras (
    idcarrera integer DEFAULT nextval('public.carrera_id'::regclass) NOT NULL,
    nombre text,
    iddepartamento integer NOT NULL,
    codigo text,
    condicion boolean
);


ALTER TABLE public.carreras OWNER TO postgres;

--
-- Name: categorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categorias (
    idcategoria integer NOT NULL,
    nombrecat text,
    condicion boolean
);


ALTER TABLE public.categorias OWNER TO postgres;

--
-- Name: categorias_idcategoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categorias_idcategoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categorias_idcategoria_seq OWNER TO postgres;

--
-- Name: categorias_idcategoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categorias_idcategoria_seq OWNED BY public.categorias.idcategoria;


--
-- Name: dep; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dep
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dep OWNER TO postgres;

--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departamentos (
    iddepartamento integer DEFAULT nextval('public.dep'::regclass) NOT NULL,
    nombre text,
    idfacultad integer NOT NULL,
    condicion integer,
    codigo text
);


ALTER TABLE public.departamentos OWNER TO postgres;

--
-- Name: secuencia_docente; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.secuencia_docente
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.secuencia_docente OWNER TO postgres;

--
-- Name: docentes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.docentes (
    iddocente integer DEFAULT nextval('public.secuencia_docente'::regclass) NOT NULL,
    titulo text,
    idcategoria integer,
    idpersona integer,
    lugar text
);


ALTER TABLE public.docentes OWNER TO postgres;

--
-- Name: docentes_tribunal_iddocentes_tribunal_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.docentes_tribunal_iddocentes_tribunal_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.docentes_tribunal_iddocentes_tribunal_seq OWNER TO postgres;

--
-- Name: docentes_tribunal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.docentes_tribunal (
    iddocentes_tribunal integer DEFAULT nextval('public.docentes_tribunal_iddocentes_tribunal_seq'::regclass) NOT NULL,
    iddocente integer,
    idgrupsol integer
);


ALTER TABLE public.docentes_tribunal OWNER TO postgres;

--
-- Name: est_renuncia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.est_renuncia (
    id_est_renuncia integer NOT NULL,
    idestudiante integer,
    condicion boolean,
    idgrupsol integer
);


ALTER TABLE public.est_renuncia OWNER TO postgres;

--
-- Name: est_renuncia_id_est_renuncia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.est_renuncia_id_est_renuncia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.est_renuncia_id_est_renuncia_seq OWNER TO postgres;

--
-- Name: est_renuncia_id_est_renuncia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.est_renuncia_id_est_renuncia_seq OWNED BY public.est_renuncia.id_est_renuncia;


--
-- Name: estudiante_grupos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estudiante_grupos (
    idestgru integer NOT NULL,
    idestudiante integer,
    idgrupo integer
);


ALTER TABLE public.estudiante_grupos OWNER TO postgres;

--
-- Name: estudiante_grupos_idestgru_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estudiante_grupos_idestgru_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estudiante_grupos_idestgru_seq OWNER TO postgres;

--
-- Name: estudiante_grupos_idestgru_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.estudiante_grupos_idestgru_seq OWNED BY public.estudiante_grupos.idestgru;


--
-- Name: estudiantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estudiantes (
    idestudiante integer NOT NULL,
    carnet text,
    idcarrera integer,
    anioegreso text,
    pera boolean,
    horassoc boolean,
    curriculum text,
    partida text,
    idpersona integer,
    carta text
);


ALTER TABLE public.estudiantes OWNER TO postgres;

--
-- Name: estudiantes_idestudiante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estudiantes_idestudiante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estudiantes_idestudiante_seq OWNER TO postgres;

--
-- Name: estudiantes_idestudiante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.estudiantes_idestudiante_seq OWNED BY public.estudiantes.idestudiante;


--
-- Name: etapa; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.etapa
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etapa OWNER TO postgres;

--
-- Name: etapas_grupos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etapas_grupos (
    idetapa_grupo integer NOT NULL,
    idgrupo integer,
    idnuevaetapa integer,
    estado integer,
    condicion boolean
);


ALTER TABLE public.etapas_grupos OWNER TO postgres;

--
-- Name: etapas_grupo_idetapa_grupo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.etapas_grupo_idetapa_grupo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etapas_grupo_idetapa_grupo_seq OWNER TO postgres;

--
-- Name: etapas_grupo_idetapa_grupo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.etapas_grupo_idetapa_grupo_seq OWNED BY public.etapas_grupos.idetapa_grupo;


--
-- Name: secuencia_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.secuencia_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.secuencia_id OWNER TO postgres;

--
-- Name: facultades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.facultades (
    idfacultad integer DEFAULT nextval('public.secuencia_id'::regclass) NOT NULL,
    nombre text,
    telefono text,
    direccion text,
    condicion boolean DEFAULT true,
    codigo text,
    foto text
);


ALTER TABLE public.facultades OWNER TO postgres;

--
-- Name: fechas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fechas (
    idfecha integer NOT NULL,
    idperiodo integer,
    idnuevaetapa integer,
    fechasetapas text,
    condicion boolean
);


ALTER TABLE public.fechas OWNER TO postgres;

--
-- Name: fechas_idfechas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fechas_idfechas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fechas_idfechas_seq OWNER TO postgres;

--
-- Name: fechas_idfechas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fechas_idfechas_seq OWNED BY public.fechas.idfecha;


--
-- Name: grupo_asistencia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_asistencia (
    id integer NOT NULL,
    fecha_asistencia date NOT NULL,
    hora_inicio time(0) without time zone NOT NULL,
    hora_final time(0) without time zone NOT NULL,
    idgrupo integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grupo_asistencia OWNER TO postgres;

--
-- Name: grupo_asistencia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_asistencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_asistencia_id_seq OWNER TO postgres;

--
-- Name: grupo_asistencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_asistencia_id_seq OWNED BY public.grupo_asistencia.id;


--
-- Name: grupo_solicitud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_solicitud (
    idgrupsol integer NOT NULL,
    idsolicitud integer,
    idgrupo integer,
    estado integer,
    condicion boolean,
    pdf text,
    etapa integer,
    nacuerdo text,
    fecha text,
    pdfrecibido text,
    aprobado text,
    solicitudcoor text,
    solicituddir text
);


ALTER TABLE public.grupo_solicitud OWNER TO postgres;

--
-- Name: grupo_solicitud_idgrupsol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_solicitud_idgrupsol_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_solicitud_idgrupsol_seq OWNER TO postgres;

--
-- Name: grupo_solicitud_idgrupsol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_solicitud_idgrupsol_seq OWNED BY public.grupo_solicitud.idgrupsol;


--
-- Name: grupos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupos (
    idgrupo integer NOT NULL,
    "codigoG" text,
    tema text,
    condicion boolean,
    idtipotema integer,
    fecharegistro text,
    propuesta text,
    idcarrera integer,
    carta text
);


ALTER TABLE public.grupos OWNER TO postgres;

--
-- Name: grupos_docentes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupos_docentes (
    idgrudoc integer NOT NULL,
    idgrupo integer,
    iddocente integer,
    idtipoasesor integer
);


ALTER TABLE public.grupos_docentes OWNER TO postgres;

--
-- Name: grupos_docentes_idgrudoc_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupos_docentes_idgrudoc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupos_docentes_idgrudoc_seq OWNER TO postgres;

--
-- Name: grupos_docentes_idgrudoc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupos_docentes_idgrudoc_seq OWNED BY public.grupos_docentes.idgrudoc;


--
-- Name: grupos_idgrupo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupos_idgrupo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupos_idgrupo_seq OWNER TO postgres;

--
-- Name: grupos_idgrupo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupos_idgrupo_seq OWNED BY public.grupos.idgrupo;


--
-- Name: id_telefono; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.id_telefono
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.id_telefono OWNER TO postgres;

--
-- Name: idetapas; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.idetapas
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.idetapas OWNER TO postgres;

--
-- Name: inasistencias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.inasistencias (
    idinasistencia integer NOT NULL,
    idgrupssol integer NOT NULL,
    "fechaIuno" text,
    "fechaIdos" text,
    "fechaItres" text,
    ciclo text,
    dia text,
    "horaInicio" text,
    "horaFinal" text
);


ALTER TABLE public.inasistencias OWNER TO postgres;

--
-- Name: inasistencias_idinasistencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.inasistencias_idinasistencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inasistencias_idinasistencia_seq OWNER TO postgres;

--
-- Name: inasistencias_idinasistencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.inasistencias_idinasistencia_seq OWNED BY public.inasistencias.idinasistencia;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: notas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notas (
    idnotas integer NOT NULL,
    idgrupo integer,
    idestudiante integer,
    nota real,
    idetapa integer,
    condicion boolean
);


ALTER TABLE public.notas OWNER TO postgres;

--
-- Name: notas_idnotas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.notas_idnotas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notas_idnotas_seq OWNER TO postgres;

--
-- Name: notas_idnotas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.notas_idnotas_seq OWNED BY public.notas.idnotas;


--
-- Name: notificacion_inasistencia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notificacion_inasistencia (
    id integer NOT NULL,
    idestudiante integer,
    idsolicitud integer,
    condicion boolean,
    idgrupsol integer,
    numero text,
    idgrupo integer
);


ALTER TABLE public.notificacion_inasistencia OWNER TO postgres;

--
-- Name: notificacion_inasistencia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.notificacion_inasistencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notificacion_inasistencia_id_seq OWNER TO postgres;

--
-- Name: notificacion_inasistencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.notificacion_inasistencia_id_seq OWNED BY public.notificacion_inasistencia.id;


--
-- Name: notifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notifications (
    id character varying(255) NOT NULL,
    type character varying(255) NOT NULL,
    notifiable_id integer NOT NULL,
    notifiable_type character varying(255) NOT NULL,
    data text NOT NULL,
    read_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.notifications OWNER TO postgres;

--
-- Name: nuevaetapa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nuevaetapa (
    idtipotrabajo integer,
    idetapa integer,
    idnuevaetapa integer NOT NULL,
    condicion boolean,
    idnombreetapa text
);


ALTER TABLE public.nuevaetapa OWNER TO postgres;

--
-- Name: nuevaetapa_idnuevaetapa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nuevaetapa_idnuevaetapa_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nuevaetapa_idnuevaetapa_seq OWNER TO postgres;

--
-- Name: nuevaetapa_idnuevaetapa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nuevaetapa_idnuevaetapa_seq OWNED BY public.nuevaetapa.idnuevaetapa;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: periodos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.periodos (
    idperiodo integer NOT NULL,
    idgrupo integer,
    "fInicio" text,
    "fFin" text
);


ALTER TABLE public.periodos OWNER TO postgres;

--
-- Name: periodo_idperiodo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.periodo_idperiodo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodo_idperiodo_seq OWNER TO postgres;

--
-- Name: periodo_idperiodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.periodo_idperiodo_seq OWNED BY public.periodos.idperiodo;


--
-- Name: personas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personas (
    idpersona integer NOT NULL,
    nombres text,
    apellidos text,
    telefono text,
    correo text,
    direccion text,
    condicion boolean,
    tipo text,
    sexo integer,
    fechanac text,
    dui text,
    foto_url text
);


ALTER TABLE public.personas OWNER TO postgres;

--
-- Name: personas_idpersona_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personas_idpersona_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personas_idpersona_seq OWNER TO postgres;

--
-- Name: personas_idpersona_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personas_idpersona_seq OWNED BY public.personas.idpersona;


--
-- Name: ponderacion_idponderacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ponderacion_idponderacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ponderacion_idponderacion_seq OWNER TO postgres;

--
-- Name: ponderacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ponderacion (
    idponderacion integer DEFAULT nextval('public.ponderacion_idponderacion_seq'::regclass) NOT NULL,
    idetapa integer,
    porcentaje real DEFAULT 0
);


ALTER TABLE public.ponderacion OWNER TO postgres;

--
-- Name: prorrogai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prorrogai (
    idprorrogai integer NOT NULL,
    "fechaInicio" text,
    "fechaFinal" text,
    motivo text,
    idgrupsol integer
);


ALTER TABLE public.prorrogai OWNER TO postgres;

--
-- Name: prorrogai_idprorrogai_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prorrogai_idprorrogai_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prorrogai_idprorrogai_seq OWNER TO postgres;

--
-- Name: prorrogai_idprorrogai_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prorrogai_idprorrogai_seq OWNED BY public.prorrogai.idprorrogai;


--
-- Name: prorrogajd; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prorrogajd (
    idprorrogajd integer NOT NULL,
    motivo text,
    idgrupsol integer
);


ALTER TABLE public.prorrogajd OWNER TO postgres;

--
-- Name: prorrogajd_idprorrogajd_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prorrogajd_idprorrogajd_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prorrogajd_idprorrogajd_seq OWNER TO postgres;

--
-- Name: prorrogajd_idprorrogajd_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prorrogajd_idprorrogajd_seq OWNED BY public.prorrogajd.idprorrogajd;


--
-- Name: ratificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ratificaciones (
    idratificaciones integer NOT NULL,
    idgrupsol integer
);


ALTER TABLE public.ratificaciones OWNER TO postgres;

--
-- Name: ratificaciones_idratificaciones_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ratificaciones_idratificaciones_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ratificaciones_idratificaciones_seq OWNER TO postgres;

--
-- Name: ratificaciones_idratificaciones_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ratificaciones_idratificaciones_seq OWNED BY public.ratificaciones.idratificaciones;


--
-- Name: rol_carreras; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rol_carreras (
    idrol_carrera integer NOT NULL,
    idrol integer,
    idcarrera integer,
    condicion boolean,
    iddocente integer,
    anio text
);


ALTER TABLE public.rol_carreras OWNER TO postgres;

--
-- Name: rol_carrera_idrol_carrera_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rol_carrera_idrol_carrera_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_carrera_idrol_carrera_seq OWNER TO postgres;

--
-- Name: rol_carrera_idrol_carrera_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rol_carrera_idrol_carrera_seq OWNED BY public.rol_carreras.idrol_carrera;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    idrol integer NOT NULL,
    nombre text,
    condicion boolean
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_idrol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_idrol_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_idrol_seq OWNER TO postgres;

--
-- Name: roles_idrol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_idrol_seq OWNED BY public.roles.idrol;


--
-- Name: solicitudes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitudes (
    idsolicitud integer NOT NULL,
    nombre text,
    condicion boolean
);


ALTER TABLE public.solicitudes OWNER TO postgres;

--
-- Name: solicitudes_c; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitudes_c (
    id integer NOT NULL,
    motivo text,
    condicion boolean,
    idgrupsol integer
);


ALTER TABLE public.solicitudes_c OWNER TO postgres;

--
-- Name: solicitudes_c_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitudes_c_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitudes_c_id_seq OWNER TO postgres;

--
-- Name: solicitudes_c_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitudes_c_id_seq OWNED BY public.solicitudes_c.id;


--
-- Name: solicitudes_idsolicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitudes_idsolicitud_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitudes_idsolicitud_seq OWNER TO postgres;

--
-- Name: solicitudes_idsolicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitudes_idsolicitud_seq OWNED BY public.solicitudes.idsolicitud;


--
-- Name: tipoasesores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipoasesores (
    tipoasesor text NOT NULL,
    condicion boolean,
    idtipoasesor integer NOT NULL,
    idcarrera integer
);


ALTER TABLE public.tipoasesores OWNER TO postgres;

--
-- Name: tipoasesores_idtipoasesor_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipoasesores_idtipoasesor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipoasesores_idtipoasesor_seq OWNER TO postgres;

--
-- Name: tipoasesores_idtipoasesor_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipoasesores_idtipoasesor_seq OWNED BY public.tipoasesores.idtipoasesor;


--
-- Name: tipotemas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipotemas (
    idtipotema integer NOT NULL,
    tema text,
    condicion boolean,
    idcarrera integer
);


ALTER TABLE public.tipotemas OWNER TO postgres;

--
-- Name: tipotemas_idtipotema_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipotemas_idtipotema_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipotemas_idtipotema_seq OWNER TO postgres;

--
-- Name: tipotemas_idtipotema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipotemas_idtipotema_seq OWNED BY public.tipotemas.idtipotema;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    condicion boolean,
    idpersona integer,
    idcarrera integer DEFAULT 0,
    idrol integer DEFAULT 0,
    api_token text
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    idusuario integer NOT NULL,
    usuario text,
    pass text,
    iddocente integer,
    condicion boolean
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_idusuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_idusuario_seq OWNER TO postgres;

--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_idusuario_seq OWNED BY public.usuarios.idusuario;


--
-- Name: actividades idactividad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actividades ALTER COLUMN idactividad SET DEFAULT nextval('public.actividades_idactividad_seq'::regclass);


--
-- Name: alumno_asistencias id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno_asistencias ALTER COLUMN id SET DEFAULT nextval('public.alumno_asistencias_id_seq'::regclass);


--
-- Name: alumnos_reprobacion idalumnos_reprobacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos_reprobacion ALTER COLUMN idalumnos_reprobacion SET DEFAULT nextval('public.alumnos_reprobacion_idalumnos_reprobacion_seq'::regclass);


--
-- Name: asesorias idasesoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asesorias ALTER COLUMN idasesoria SET DEFAULT nextval('public.asesorias_idasesoria_seq'::regclass);


--
-- Name: bitacora idbitacora; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora ALTER COLUMN idbitacora SET DEFAULT nextval('public.bitacora_idbitacora_seq'::regclass);


--
-- Name: cambio_tema idcambiotema; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cambio_tema ALTER COLUMN idcambiotema SET DEFAULT nextval('public.cambio_tema_idcambiotema_seq'::regclass);


--
-- Name: categorias idcategoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias ALTER COLUMN idcategoria SET DEFAULT nextval('public.categorias_idcategoria_seq'::regclass);


--
-- Name: est_renuncia id_est_renuncia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.est_renuncia ALTER COLUMN id_est_renuncia SET DEFAULT nextval('public.est_renuncia_id_est_renuncia_seq'::regclass);


--
-- Name: estudiante_grupos idestgru; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiante_grupos ALTER COLUMN idestgru SET DEFAULT nextval('public.estudiante_grupos_idestgru_seq'::regclass);


--
-- Name: estudiantes idestudiante; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes ALTER COLUMN idestudiante SET DEFAULT nextval('public.estudiantes_idestudiante_seq'::regclass);


--
-- Name: etapas_grupos idetapa_grupo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas_grupos ALTER COLUMN idetapa_grupo SET DEFAULT nextval('public.etapas_grupo_idetapa_grupo_seq'::regclass);


--
-- Name: fechas idfecha; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fechas ALTER COLUMN idfecha SET DEFAULT nextval('public.fechas_idfechas_seq'::regclass);


--
-- Name: grupo_asistencia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_asistencia ALTER COLUMN id SET DEFAULT nextval('public.grupo_asistencia_id_seq'::regclass);


--
-- Name: grupo_solicitud idgrupsol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_solicitud ALTER COLUMN idgrupsol SET DEFAULT nextval('public.grupo_solicitud_idgrupsol_seq'::regclass);


--
-- Name: grupos idgrupo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos ALTER COLUMN idgrupo SET DEFAULT nextval('public.grupos_idgrupo_seq'::regclass);


--
-- Name: grupos_docentes idgrudoc; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos_docentes ALTER COLUMN idgrudoc SET DEFAULT nextval('public.grupos_docentes_idgrudoc_seq'::regclass);


--
-- Name: inasistencias idinasistencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inasistencias ALTER COLUMN idinasistencia SET DEFAULT nextval('public.inasistencias_idinasistencia_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: notas idnotas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notas ALTER COLUMN idnotas SET DEFAULT nextval('public.notas_idnotas_seq'::regclass);


--
-- Name: notificacion_inasistencia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_inasistencia ALTER COLUMN id SET DEFAULT nextval('public.notificacion_inasistencia_id_seq'::regclass);


--
-- Name: nuevaetapa idnuevaetapa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nuevaetapa ALTER COLUMN idnuevaetapa SET DEFAULT nextval('public.nuevaetapa_idnuevaetapa_seq'::regclass);


--
-- Name: periodos idperiodo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.periodos ALTER COLUMN idperiodo SET DEFAULT nextval('public.periodo_idperiodo_seq'::regclass);


--
-- Name: personas idpersona; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas ALTER COLUMN idpersona SET DEFAULT nextval('public.personas_idpersona_seq'::regclass);


--
-- Name: prorrogai idprorrogai; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorrogai ALTER COLUMN idprorrogai SET DEFAULT nextval('public.prorrogai_idprorrogai_seq'::regclass);


--
-- Name: prorrogajd idprorrogajd; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorrogajd ALTER COLUMN idprorrogajd SET DEFAULT nextval('public.prorrogajd_idprorrogajd_seq'::regclass);


--
-- Name: ratificaciones idratificaciones; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratificaciones ALTER COLUMN idratificaciones SET DEFAULT nextval('public.ratificaciones_idratificaciones_seq'::regclass);


--
-- Name: rol_carreras idrol_carrera; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_carreras ALTER COLUMN idrol_carrera SET DEFAULT nextval('public.rol_carrera_idrol_carrera_seq'::regclass);


--
-- Name: roles idrol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN idrol SET DEFAULT nextval('public.roles_idrol_seq'::regclass);


--
-- Name: solicitudes idsolicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes ALTER COLUMN idsolicitud SET DEFAULT nextval('public.solicitudes_idsolicitud_seq'::regclass);


--
-- Name: solicitudes_c id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes_c ALTER COLUMN id SET DEFAULT nextval('public.solicitudes_c_id_seq'::regclass);


--
-- Name: tipoasesores idtipoasesor; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipoasesores ALTER COLUMN idtipoasesor SET DEFAULT nextval('public.tipoasesores_idtipoasesor_seq'::regclass);


--
-- Name: tipotemas idtipotema; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipotemas ALTER COLUMN idtipotema SET DEFAULT nextval('public.tipotemas_idtipotema_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: usuarios idusuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN idusuario SET DEFAULT nextval('public.usuarios_idusuario_seq'::regclass);


--
-- Data for Name: actividades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.actividades (idactividad, nombre, condicion) FROM stdin;
\.


--
-- Data for Name: alumno_asistencias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alumno_asistencias (id, grupo_asistencia_id, idestudiante, asistencia, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: alumnos_reprobacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alumnos_reprobacion (idalumnos_reprobacion, idestudiante, idgrupsol, motivo) FROM stdin;
\.


--
-- Data for Name: asesorias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.asesorias (idasesoria, idestudiante, horainicio, horafin, fecha) FROM stdin;
\.


--
-- Data for Name: bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bitacora (idbitacora, idusuario, accion, fecha, datos) FROM stdin;
112	59	Editó un Docente	16-05-2019 09:15:44	Nombre: Julio ,  Apellidos: Perez , Correo:julio@dreux.com
113	59	Registró un nuevo Estudiante	20-05-2019 10:55:12	Carnet:CC11036,Nombre: Moisés Amilcar ,  Apellidos: Chávez Cortez , Correo:correo1paraprueba@gmail.com
114	59	Registró un nuevo Estudiante	20-05-2019 10:59:47	Carnet:LO11005,Nombre: Marvyn Javier ,  Apellidos: López Ortiz , Correo:correo2paraprueba@outlook.com
115	59	Registró un nuevo Estudiante	20-05-2019 11:05:53	Carnet:VH10011,Nombre: Marvin Ovidio ,  Apellidos: Vásquez Hernandez , Correo:correo3paraprueba@outlook.com
116	59	Registró un nuevo Docente	20-05-2019 01:15:55	Nombre: Dagoberto ,  Apellidos: Pérez , Correo:correo4paraprueba@outlook.com
117	59	Registró un nuevo Departamento	20-05-2019 01:18:35	Código:  ,  Nombre: Ciencias Agronómicas
118	59	Registró una nueva Carrera	20-05-2019 01:19:44	Código: I70304-2008 ,  Nombre: Ingeniería Agronómica
119	59	Registró un nuevo Departamento	21-05-2019 10:22:58	Código:  ,  Nombre: Ciencias Económicas
120	59	Editó un Docente	21-05-2019 10:27:26	Nombre: Santos David ,  Apellidos: Alvarado , Correo:alexJ8520@outlook.com
121	59	Registró una nueva Carrera	21-05-2019 10:31:15	Código: L70802-1994 ,  Nombre: Licenciatura en Contaduría Pública
122	59	Editó un Docente	21-05-2019 10:49:30	Nombre: joussue humberto ,  Apellidos: henriquez , Correo:henriquezjossuehumberto@gmail.com
123	59	Registró un nuevo Departamento	21-05-2019 11:02:31	Código:  ,  Nombre: Ciencias de la Educación
124	59	Registró una nueva Carrera	21-05-2019 11:03:37	Código: L70439-2019 ,  Nombre: Licenciatura en Trabajo Social
125	59	Registró una nueva Carrera	21-05-2019 11:05:50	Código: L70803-2013 ,  Nombre: Licenciatura en Administración de Empresas
126	59	Editó una Carrera	21-05-2019 11:06:14	Código: L70439-2009 ,  Nombre: Licenciatura en Trabajo Social
127	59	Registró un nuevo Docente	21-05-2019 11:06:36	Nombre: Yohani ,  Apellidos: Muñoz , Correo:gsmithb_j840h@ymail4.com
128	59	Registró una nueva Carrera	21-05-2019 11:08:00	Código: I70305-2008 ,  Nombre: Ingenieria Agroindustrial
129	59	Registró un nuevo Estudiante	21-05-2019 11:37:05	Carnet:MU09288,Nombre: JOSE ANTONIO ,  Apellidos: MIRA UMAÑA , Correo:ritchie.daisyh_k364k@ymail4.com
130	59	Editó un Estudiante	21-05-2019 11:38:53	Carnet:MU09288,Nombre: JOSE ANTONIO ,  Apellidos: MIRA UMAÑA , Correo:ritchie.daisyh_k364k@ymail4.com
131	59	Registró un nuevo Estudiante	21-05-2019 11:40:50	Carnet:RA01873,Nombre: ERIKA BEATRIZ ,  Apellidos: RIVERA ARGUETA , Correo:zdietrichm_b441z@ymail4.com
132	59	Registró un nuevo Estudiante	21-05-2019 11:44:00	Carnet:RE12181,Nombre: ZULMA IRENE ,  Apellidos: RUIZ ECHEVERRIA , Correo:clyde08m_s218q@ymail4.com
133	59	Registró un nuevo Estudiante	21-05-2019 11:47:23	Carnet:MC12129,Nombre: ROSARIO DE MARÍA ,  Apellidos: MELÉNDEZ CRESPIN , Correo:qyundtd_s628g@ymail4.com
134	59	Editó un Estudiante	21-05-2019 11:48:50	Carnet:MU09288,Nombre: Jose Antonio ,  Apellidos: Mira Umaña , Correo:ritchie.daisyh_k364k@ymail4.com
135	59	Editó un Estudiante	21-05-2019 11:49:24	Carnet:RA01873,Nombre: Erika Beatriz ,  Apellidos: Rivera Argueta , Correo:zdietrichm_b441z@ymail4.com
136	59	Editó un Estudiante	21-05-2019 11:49:56	Carnet:RE12181,Nombre: Zulma Irene ,  Apellidos: Ruiz Echeveria , Correo:clyde08m_s218q@ymail4.com
137	59	Registró un nuevo Estudiante	21-05-2019 11:54:13	Carnet:RA65325,Nombre: Pedro Cesar ,  Apellidos: Ramirez Anaya , Correo:monroe.roobl_d887z@ymail4.com
138	59	Registró un nuevo Estudiante	21-05-2019 12:03:10	Carnet:RM12191,Nombre: Santos Evelyn ,  Apellidos: Rodriguez Martinez , Correo:tromp.aubreyw_c717d@ymail4.com
139	59	Registró un nuevo Estudiante	21-05-2019 12:05:32	Carnet:UP39839,Nombre: Erika Elizabeth ,  Apellidos: Urbina Pineda , Correo:walsh.annamaer_r138i@ymail4.com
140	59	Registró un nuevo Estudiante	21-05-2019 12:10:19	Carnet:HV12998,Nombre: Francisco Javier ,  Apellidos: Hernadez Ventura , Correo:elouise.runolfsdottirq_o494h@ymail4.com
141	59	Registró un nuevo Estudiante	21-05-2019 12:12:39	Carnet:HL12998,Nombre: Alirio Napoleon ,  Apellidos: Hernandez Leiva , Correo:sipes.ruperts_w391j@ymail4.com
142	59	Editó un Estudiante	21-05-2019 12:14:51	Carnet:MU09288,Nombre: Jose Antonio ,  Apellidos: Mira Umaña , Correo:ritchie.daisyh_k364k@ymail4.com
143	59	Editó un Estudiante	21-05-2019 12:39:38	Carnet:CC11036,Nombre: Moisés Amilcar ,  Apellidos: Chávez Cortez , Correo:correo1paraprueba@gmail.com
144	59	Editó un Estudiante	21-05-2019 12:40:08	Carnet:CC11036,Nombre: Moisés Amilcar ,  Apellidos: Chávez Cortez , Correo:correo1paraprueba@gmail.com
145	65	Solicitó ratificación deresultados	21-05-2019 01:32:42	Grupo INFO10/2016
146	65	Editó un Estudiante	21-05-2019 01:44:08	Carnet:CC11036,Nombre: Moisés Amilcar ,  Apellidos: Chávez Cortez , Correo:correo1paraprueba@gmail.com
147	59	Editó un Docente	21-05-2019 11:31:07	Nombre: virna yasmina ,  Apellidos: urquilla , Correo:virnayasminau@gmail.com
148	59	Editó un Docente	21-05-2019 11:32:01	Nombre: virna yasmina ,  Apellidos: urquilla , Correo:virnayasminau@gmail.com
149	65	Editó un Docente	22-05-2019 09:16:21	Nombre: Dagoberto ,  Apellidos: Perez , Correo:correo4paraprueba@outlook.com
150	65	Editó un Docente	22-05-2019 10:29:33	Nombre: César Emilio ,  Apellidos: Castro Figueroa , Correo:sylvia22l_r718e@ymail4.com
151	65	Registró un nuevo Estudiante	22-05-2019 10:41:20	Carnet:RR12903,Nombre: Wendy Esmeralda ,  Apellidos: Rivas Rivas , Correo:wendyesrivas@gmail.com
152	59	Registró una nueva Facultad	06-08-2019 03:29:42	Código:  ,  Nombre: Fmpoparacen  Telefóno: 6262-7272     Direccion: 6262-7272
153	65	Solicitó ratificación deresultados	06-08-2019 09:33:17	Grupo INFO02/2019
154	65	Editó un Estudiante	09-08-2019 09:43:41	Carnet:LO11005,Nombre: Marvyn Javier ,  Apellidos: López Ortiz , Correo:correo2paraprueba@outlook.com
155	65	Editó un Estudiante	09-08-2019 10:19:21	Carnet:CC11036,Nombre: Moisés Amilcar ,  Apellidos: Chávez Cortez , Correo:correo1paraprueba@gmail.com
156	65	Registró un nuevo Estudiante	03-09-2019 09:14:00	Carnet:APGUES1,Nombre: mar ,  Apellidos: vasq , Correo:farkesopsu@desoz.com
\.


--
-- Data for Name: cambio_tema; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cambio_tema (idcambiotema, nuevotema, motivo, idgrupsol) FROM stdin;
\.


--
-- Data for Name: carreras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.carreras (idcarrera, nombre, iddepartamento, codigo, condicion) FROM stdin;
1	Ingeniería de Sistemas Informáticos	1	I70515-1998	t
13	Ingeniería Agronómica	9	I70304-2008	t
14	Licenciatura en Contaduría Pública	10	L70802-1994	t
16	Licenciatura en Administración de Empresas	10	L70803-2013	t
15	Licenciatura en Trabajo Social	11	L70439-2009	t
17	Ingenieria Agroindustrial	9	I70305-2008	t
\.


--
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categorias (idcategoria, nombrecat, condicion) FROM stdin;
1	DU	t
5	PU I	t
6	PU II	t
7	PU III	t
\.


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.departamentos (iddepartamento, nombre, idfacultad, condicion, codigo) FROM stdin;
1	Departamento de Informática	1	1	\N
10	Ciencias Económicas	1	1	\N
11	Ciencias de la Educación	1	1	\N
9	Ciencias Agronómicas	1	0	\N
\.


--
-- Data for Name: docentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.docentes (iddocente, titulo, idcategoria, idpersona, lugar) FROM stdin;
1	Ing.	1	1	UES FMP
30	Ing.MSc	1	69	
31	Ing.MSc	5	70	
32	Lic.	5	71	
33	Msc.	6	72	
34	 Msc.	6	73	ues-fmp
35	Lic.	5	74	
29	Ing.	1	68	
36	Msc.	5	85	
37	Lic.	5	86	
38	Lic.	5	87	
\.


--
-- Data for Name: docentes_tribunal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.docentes_tribunal (iddocentes_tribunal, iddocente, idgrupsol) FROM stdin;
67	29	358
68	32	358
69	30	358
70	34	363
71	35	363
72	37	363
\.


--
-- Data for Name: est_renuncia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.est_renuncia (id_est_renuncia, idestudiante, condicion, idgrupsol) FROM stdin;
1	34	t	365
\.


--
-- Data for Name: estudiante_grupos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estudiante_grupos (idestgru, idestudiante, idgrupo) FROM stdin;
38	31	20
39	32	20
40	33	20
42	35	21
\.


--
-- Data for Name: estudiantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estudiantes (idestudiante, carnet, idcarrera, anioegreso, pera, horassoc, curriculum, partida, idpersona, carta) FROM stdin;
33	VH10011	1	2018	t	t	\N	\N	67	\N
35	RA01873	1		f	f	\N	\N	77	\N
36	RE12181	1		f	f	\N	\N	78	\N
37	MC12129	16		f	f	\N	\N	79	\N
38	RA65325	16		f	f	\N	\N	80	\N
39	RM12191	16		f	f	\N	\N	81	\N
40	UP39839	16		f	f	\N	\N	82	\N
41	HV12998	13		f	f	\N	\N	83	\N
42	HL12998	13	2018-08-12	f	f	\N	\N	84	\N
34	MU09288	1	2017-01-21	f	f	\N	\N	76	\N
31	CC11036	1	2019-05-01	t	f	CC11036/CC11036-Curriculum.pdf	CC11036/CC11036-Partida.pdf	65	\N
43	RR12903	1		f	f	\N	\N	88	\N
32	LO11005	1		t	f	LO11005/LO11005-Curriculum.pdf	\N	66	\N
44	CC11037	1	2017-12-15	t	f	CC11037/CC11037-Curriculum.pdf	\N	89	\N
45	APGUES1	1		f	f	\N	\N	90	\N
\.


--
-- Data for Name: etapas_grupos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.etapas_grupos (idetapa_grupo, idgrupo, idnuevaetapa, estado, condicion) FROM stdin;
222	20	1	0	t
223	20	2	0	t
224	20	3	0	t
225	21	1	0	t
226	21	2	0	t
227	21	3	1	t
\.


--
-- Data for Name: facultades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.facultades (idfacultad, nombre, telefono, direccion, condicion, codigo, foto) FROM stdin;
1	Facultad Multidisciplinaria Paracentral	 2393-1993	Avenida Crescencio Miranda, frente al estadio	t	\N	\N
17	Fmpoparacen	6262-7272	San vicente	t	\N	\N
\.


--
-- Data for Name: fechas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fechas (idfecha, idperiodo, idnuevaetapa, fechasetapas, condicion) FROM stdin;
13	23	13	2019-05-21	t
14	23	14	2019-06-21	t
15	23	15	2019-10-21	t
17	24	14	2019-08-22	t
18	24	15	2019-12-22	t
16	24	13	2019-05-22	t
\.


--
-- Data for Name: grupo_asistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_asistencia (id, fecha_asistencia, hora_inicio, hora_final, idgrupo, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: grupo_solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_solicitud (idgrupsol, idsolicitud, idgrupo, estado, condicion, pdf, etapa, nacuerdo, fecha, pdfrecibido, aprobado, solicitudcoor, solicituddir) FROM stdin;
356	1	20	1	t	20/20-solicitud-aprobaciontema.pdf	1	12368-989-7	20-05-2019	20/20-aprobaciontema.pdf	\N	\N	\N
357	2	20	3	f	\N	2	\N	2019-05-21	\N	\N	\N	\N
359	5	20	1	t	20/20-solicitud-ratificacion de resultados.pdf	3	ajsj-713	21-05-2019	20/20-ratificacion de resultados.pdf	\N	\N	\N
362	3	21	0	t	\N	1	\N	22-05-2019	\N	\N	\N	\N
364	10	21	0	t	\N	3	\N	04-06-2019	\N	\N	\N	\N
365	9	21	1	t	21/21-solicitud-renuncia al proceso.pdf	3	31-05-19-renuncia	04-06-2019	\N	\N	\N	\N
358	4	20	1	t	20/20-solicitud-tribunalcalificador.pdf	3	buy23u	21-05-2019	20/20-tribunalcalificador.pdf	0	\N	\N
363	4	21	0	t	\N	3	\N	27-05-2019	\N	\N	\N	\N
361	2	21	4	t	21/21-documento-361.pdf	1	\N	2019-05-22	\N	\N	21/21-solicitud-361.pdf	\N
360	1	21	1	t	21/21-solicitud-aprobaciontema-360.pdf	1	28/22-05-2019XXII-22	22-05-2019	21/21-aprobaciontema-360.pdf	\N	21/21-solicitud-360.pdf	21/21-aprobaciontema-360.pdf
366	5	21	4	t	\N	3	\N	06-08-2019	\N	\N	\N	\N
367	10	21	1	t	21/21-solicitud-ratificacion de resultados.pdf	3	XX-12354556688	06-08-2019	21/21-ratificacion de resultados.pdf	\N	\N	\N
\.


--
-- Data for Name: grupos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupos (idgrupo, "codigoG", tema, condicion, idtipotema, fecharegistro, propuesta, idcarrera, carta) FROM stdin;
20	INFO10/2016	SISTEMA INFORMÁTICO EN AMBIENTE WEB CON APLICACIÓN MÓVIL PARA EL CONTROL  DE PROCESOS ADMINISTRATIVOS DEL LABORATORIO CLÍNICO MM FISHER'ST DEL MUNICIPIO DE SAN VICENTE, DEPARTAMENTO DE SAN VICENTE	t	13	2019-05-20	20/20-Propuesta.pdf	1	\N
21	INFO02/2019	SISTEMA INFORMATICO PARA LA ADMINISTRACION, SEGUIMIENTO Y CONTROL\r\nDE LOS ESCRITOS CREADOS EN LA SECRETARIA GENERAL DE LA FACULTAD\r\nMULTIDISCIPLINARIA PARACENTRAL DE LA UNIVERSIDAD DE EL SALVADOR	t	13	2019-05-22	/-Propuesta.pdf	1	\N
\.


--
-- Data for Name: grupos_docentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupos_docentes (idgrudoc, idgrupo, iddocente, idtipoasesor) FROM stdin;
22	20	29	8
23	21	29	8
\.


--
-- Data for Name: inasistencias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inasistencias (idinasistencia, idgrupssol, "fechaIuno", "fechaIdos", "fechaItres", ciclo, dia, "horaInicio", "horaFinal") FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2018_09_29_091224_create_grupo_asistencia_table	2
4	2018_09_29_101914_create_alumno_asistencias_table	2
\.


--
-- Data for Name: notas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notas (idnotas, idgrupo, idestudiante, nota, idetapa, condicion) FROM stdin;
101	20	32	7.82999992	1	t
102	20	33	7.82999992	1	t
103	20	31	7.82999992	1	t
104	20	32	6	2	t
105	20	33	6	2	t
106	20	31	6	2	t
107	20	32	7.80000019	3	t
108	20	33	7.80000019	3	t
109	20	31	7.80000019	3	t
110	21	35	7.59000015	1	t
111	21	34	8.5	1	t
112	21	35	8	2	t
113	21	34	8	2	t
\.


--
-- Data for Name: notificacion_inasistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notificacion_inasistencia (id, idestudiante, idsolicitud, condicion, idgrupsol, numero, idgrupo) FROM stdin;
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notifications (id, type, notifiable_id, notifiable_type, data, read_at, created_at, updated_at) FROM stdin;
d0320f32-de10-4de6-b76e-be8982a5204f	sispg\\Notifications\\SolicitudAprobacionTema	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	2019-05-21 12:44:10	2019-05-20 13:21:43	2019-05-21 12:44:10
0b4fd2d5-c607-4897-8127-d7c71fd6ff57	sispg\\Notifications\\SolicitudIrorrogaInterna	65	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/steps\\/20"}	2019-05-21 13:10:50	2019-05-21 13:10:10	2019-05-21 13:10:50
1f3f5697-351a-4b1b-93ba-7a7d7700ac02	sispg\\Notifications\\SolicitudRatificacionTribunal	65	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/steps\\/20"}	2019-05-21 13:20:57	2019-05-21 13:17:02	2019-05-21 13:20:57
f7aa4a11-d669-4f66-aa5e-09bcc9aa3605	sispg\\Notifications\\SolicitudRatificacionResultados	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	2019-05-22 09:53:02	2019-05-21 13:32:42	2019-05-22 09:53:02
02e7bcf2-9f4f-4cb6-bb0c-19a504ae017d	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	2019-05-22 09:53:06	2019-05-21 13:21:04	2019-05-22 09:53:06
4b942c1b-2d51-4f88-b58e-a6a072908298	sispg\\Notifications\\SolicitudAprobacionTema	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	2019-05-22 11:07:03	2019-05-22 11:06:11	2019-05-22 11:07:03
dbbafd6b-212a-4b35-8e5d-db20f38e14a7	sispg\\Notifications\\SolicitudIrorrogaInterna	65	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/steps\\/21"}	2019-05-22 11:24:55	2019-05-22 11:23:41	2019-05-22 11:24:55
84fc23d1-95df-408c-8cef-988c1f1fa814	sispg\\Notifications\\SolicitudPJD	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	2019-05-22 11:34:48	2019-05-22 11:32:50	2019-05-22 11:34:48
85366eb9-93a5-49c4-b1a9-b816c1cb2a24	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	\N	2019-05-27 20:00:51	2019-05-27 20:00:51
560865c9-c76d-4909-8b0f-d56e941ef283	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	\N	2019-05-27 20:02:29	2019-05-27 20:02:29
edce014c-f5c8-4434-87c4-1f789bc2def2	sispg\\Notifications\\SolicitudRatificacionTribunal	65	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/steps\\/21"}	2019-05-27 20:03:00	2019-05-27 20:02:19	2019-05-27 20:03:00
00e25698-1783-4cc1-a076-757a949dab9e	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	\N	2019-05-27 20:03:51	2019-05-27 20:03:51
3cc23525-c50c-4244-b2b8-554acd9109ac	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	\N	2019-05-27 20:04:13	2019-05-27 20:04:13
29310a5a-3c75-4504-a9ab-cfb6e8942125	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	\N	2019-07-10 19:34:26	2019-07-10 19:34:26
f20738cf-1028-4938-9c97-50e14d161dde	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	\N	2019-07-10 19:36:52	2019-07-10 19:36:52
beefdcd0-72e2-4049-987b-2006537eb71d	sispg\\Notifications\\SolicitudPJD	65	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/steps\\/21"}	2019-08-06 20:37:54	2019-05-22 11:32:19	2019-08-06 20:37:54
72563b56-0033-41d6-8e34-038c64c8d81c	sispg\\Notifications\\SolicitudRatificacionResultados	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	2019-08-06 21:34:38	2019-08-06 21:33:17	2019-08-06 21:34:38
8e581d17-ac7d-477c-a647-164b15f9dca6	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	2019-08-06 21:34:42	2019-08-06 20:50:39	2019-08-06 21:34:42
d74ecdc6-746f-47ef-8b4d-cfe4a9a3e694	sispg\\Notifications\\SolicitudPJD	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO02\\/2019","url_location":"\\/ues\\/grupos\\/vista_director\\/21"}	2019-08-06 21:34:45	2019-07-22 11:31:07	2019-08-06 21:34:45
a00986d4-7bb9-4a2d-859d-649f40518b55	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	2019-08-06 21:34:48	2019-07-10 20:11:26	2019-08-06 21:34:48
879e50cb-3cf7-48ca-9be3-0445122fab6e	sispg\\Notifications\\SolicitudRatificacionTribunal	66	sispg\\User	{"carrera":"Ingenier\\u00eda de Sistemas Inform\\u00e1ticos","grupo_codigo":"INFO10\\/2016","url_location":"\\/ues\\/grupos\\/vista_director\\/20"}	2019-08-06 21:34:51	2019-07-10 19:59:36	2019-08-06 21:34:51
\.


--
-- Data for Name: nuevaetapa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nuevaetapa (idtipotrabajo, idetapa, idnuevaetapa, condicion, idnombreetapa) FROM stdin;
13	1	13	t	Ante-Proyecto
13	2	14	t	Desarrollo
13	3	15	t	Implementación
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: periodos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.periodos (idperiodo, idgrupo, "fInicio", "fFin") FROM stdin;
23	20	2019-05-21	2022-05-21
24	21	2019-05-22	2022-05-22
\.


--
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personas (idpersona, nombres, apellidos, telefono, correo, direccion, condicion, tipo, sexo, fechanac, dui, foto_url) FROM stdin;
2	dreux	martinez	1234-1234	dreux@darken.com	jsbjsbjsbshjbhsh uyshsbsah hsgbh	t	estudiante	1	1996-11-14	12345678-9	\N
1	Julio	Perez	1234-1234	julio@dreux.com	jsbjsbjsbshjbhsh uyshsbsah hsgbh	t	docente	1	1996-11-14	12345678-9	julio@dreux.com/julio@dreux.com-foto.png
67	Marvin Ovidio	Vásquez Hernandez	7987-4654	correo3paraprueba@outlook.com		t	estudiante	1		48498798-7	VH10011/VH10011-foto.png
71	Santos David	Alvarado	8989-7982	alexJ8520@outlook.com		t	docente	1			alexJ8520@outlook.com/alexJ8520@outlook.com-foto.png
72	René Francisco	Vásquez	7897-1324	kaory133@outlook.com		t	docente	1			\N
73	Nelson Wilfredo	Escoto Carrillo	7356-8676	kenshiSA@outlook.com	8av nortes calle al cementerio	t	docente	1	1987-09-23	92389898-9	kenshiSA@outlook.com/kenshiSA@outlook.com-foto.png
69	joussue humberto	henriquez	7777-7777	henriquezjossuehumberto@gmail.com		t	docente	1			henriquezjossuehumberto@gmail.com/henriquezjossuehumberto@gmail.com-foto.png
74	Yohani	Muñoz	7412-3338	gsmithb_j840h@ymail4.com		t	docente	0			\N
79	ROSARIO DE MARÍA	MELÉNDEZ CRESPIN		qyundtd_s628g@ymail4.com		t	estudiante	0			MC12129/MC12129-foto.png
76	Jose Antonio	Mira Umaña		ritchie.daisyh_k364k@ymail4.com		t	estudiante	1			MU09288/MU09288-foto.png
77	Erika Beatriz	Rivera Argueta		zdietrichm_b441z@ymail4.com		t	estudiante	0			RA01873/RA01873-foto.png
78	Zulma Irene	Ruiz Echeveria		clyde08m_s218q@ymail4.com		t	estudiante	0			\N
80	Pedro Cesar	Ramirez Anaya		monroe.roobl_d887z@ymail4.com		t	estudiante	1			RA65325/RA65325-foto.png
81	Santos Evelyn	Rodriguez Martinez		tromp.aubreyw_c717d@ymail4.com		t	estudiante	0			RM12191/RM12191-foto.png
82	Erika Elizabeth	Urbina Pineda		walsh.annamaer_r138i@ymail4.com		t	estudiante	0			UP39839/UP39839-foto.png
83	Francisco Javier	Hernadez Ventura		elouise.runolfsdottirq_o494h@ymail4.com		t	estudiante	1			HV12998/HV12998-foto.png
84	Alirio Napoleon	Hernandez Leiva		sipes.ruperts_w391j@ymail4.com		t	estudiante	1			HL12998/HL12998-foto.png
68	virna yasmina	urquilla	7777-7777	virnayasminau@gmail.com		t	docente	0			virnayasminau@gmail.com/virnayasminau@gmail.com-foto.png
85	José Alfredo	Hernández Mercado	6589-7898	pgibsonf_e513v@ymail4.com		t	docente	1			\N
87	Wendy Yamileth	Rodríguez Torres	7897-9841	griffin.powlowskif_l716g@ymail4.com		t	docente	0			\N
70	Dagoberto	Perez	6568-7987	correo4paraprueba@outlook.com		t	docente	1		32335468-7	correo4paraprueba@outlook.com/correo4paraprueba@outlook.com-foto.png
88	Wendy Esmeralda	Rivas Rivas		wendyesrivas@gmail.com		t	estudiante	0			RR12903/RR12903-foto.png
86	César Emilio	Castro Figueroa	6489-7987	sylvia22l_r718e@ymail4.com		t	docente	1			sylvia22l_r718e@ymail4.com/sylvia22l_r718e@ymail4.com-foto.png
66	Marvyn Javier	López Ortiz	6233-4565	correo2paraprueba@outlook.com		t	estudiante	1		54498798-7	LO11005/LO11005-foto.png
65	Moisés Amilcar	Chávez Cortez	6258-9699	correo1paraprueba@outlook.com		t	estudiante	1		23645879-6	CC11036/CC11036-foto.png
89	Alex Sandro	Cruz Cruz	7879-7779	chavezamilcar7@gmail.com	San vicente, San Vicente	t	estudiante	1	1993-03-04	54487987-9	CC11037/CC11037-foto.png
90	mar	vasq		farkesopsu@desoz.com		t	estudiante	1			\N
\.


--
-- Data for Name: ponderacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ponderacion (idponderacion, idetapa, porcentaje) FROM stdin;
13	13	20
14	14	40
15	15	40
\.


--
-- Data for Name: prorrogai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prorrogai (idprorrogai, "fechaInicio", "fechaFinal", motivo, idgrupsol) FROM stdin;
61	2019-05-21	2019-07-21	Dificultades en la recoleccion de datos	357
62	2019-05-22	2019-07-22	Dificultades en la recolección de información	361
\.


--
-- Data for Name: prorrogajd; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prorrogajd (idprorrogajd, motivo, idgrupsol) FROM stdin;
8	tiempos caducados	362
\.


--
-- Data for Name: ratificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ratificaciones (idratificaciones, idgrupsol) FROM stdin;
\.


--
-- Data for Name: rol_carreras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rol_carreras (idrol_carrera, idrol, idcarrera, condicion, iddocente, anio) FROM stdin;
1	1	1	t	1	2019
38	3	1	t	30	2019
39	5	1	t	29	\N
40	5	1	t	30	\N
41	4	13	t	31	\N
42	2	1	t	29	\N
43	3	14	t	32	2019
44	5	15	t	35	\N
45	2	16	t	34	\N
46	2	13	t	33	\N
47	5	13	t	31	\N
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (idrol, nombre, condicion) FROM stdin;
1	ADMINISTRADOR	t
2	JEFE DE DEPARTAMENTO	t
5	ASESOR	t
6	ESTUDIANTE	t
3	COORDINADOR GENERAL	t
4	DIRECTOR GENERAL	t
\.


--
-- Data for Name: solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitudes (idsolicitud, nombre, condicion) FROM stdin;
2	Prórroga interna	t
3	Prórroga J.D.	t
4	Ratificación del Tribunal Calificador 	t
5	Ratificación de los resultados	t
6	Modificación del tema	t
7	Notificacíon de inasistencia	t
8	Reprobación por abandono	t
9	Renuncia al Proceso de Graduación	t
1	Aprobación de tema	t
10	Impugnación de Resultados	t
\.


--
-- Data for Name: solicitudes_c; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitudes_c (id, motivo, condicion, idgrupsol) FROM stdin;
6	las fechas no corresponden	t	357
\.


--
-- Data for Name: tipoasesores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipoasesores (tipoasesor, condicion, idtipoasesor, idcarrera) FROM stdin;
Coordinador	t	8	1
Metodológico	t	9	1
Especialista	t	10	1
\.


--
-- Data for Name: tipotemas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipotemas (idtipotema, tema, condicion, idcarrera) FROM stdin;
13	Desarrollo de Sistemas Informáticos	t	1
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, password, remember_token, created_at, updated_at, condicion, idpersona, idcarrera, idrol, api_token) FROM stdin;
75	RA65325	monroe.roobl_d887z@ymail4.com	$2y$10$Ee3RmOJFRPGaEeM4tCkPb.DSL6D7aeRbc49JJyw6cK8njwHaMWJ4u	\N	\N	2019-08-09 21:22:44	\N	80	0	0	895f964bc2f17deeda18a76128c05b5051cd69dd
76	RM12191	tromp.aubreyw_c717d@ymail4.com	$2y$10$W8Vw9EXKMeoGoJioAUIe..7YUC8I/t6Isuc8h1J5YyBfIj6.i40vi	\N	\N	2019-08-09 21:22:44	\N	81	0	0	3c1c1cb0c06adeabc06f247298d68e029eaf6cd7
77	UP39839	walsh.annamaer_r138i@ymail4.com	$2y$10$/fr/h9JiOP29JNvdsIIOHOwU05ehS.JXGEFW7yMHnTQEJBOjhOgjW	\N	\N	2019-08-09 21:22:44	\N	82	0	0	910006a55cc7ffda221dd87e65ce95f63da1416e
60	dreux	dreux@darken.com	$2y$10$3NqASQbR06LW4z.HKztN4ec/OLLWtVFT03hs5NPi0K.B56WrxzoUS	\N	2019-05-06 12:46:48	2019-08-09 21:22:44	\N	\N	0	0	1d65db01c166f51f373dbc7d19e56b3613506c2f
63	VH10011	correo3paraprueba@outlook.com	$2y$10$PJiG7pXWJImfVLMPy0fIWOC6ghkMHnPL0.UNl9qm.yq/.C6rnO3H2	\N	\N	2019-08-09 21:22:44	\N	67	0	0	dcfd3aced3126242afdd674ca68c63ddabd0dea1
67	Santos David	alexJ8520@outlook.com	$2y$10$gtM1zXRp59AZMMpU09z5VeTLs0S5Hm3aYKC.0xVN0wnDzljS2RYq2	\N	\N	2019-08-09 21:22:44	\N	71	0	0	6ce40bae53d9f9edbb2e4a20087d4791af934dd2
68	René Francisco	kaory133@outlook.com	$2y$10$XjRxX4kEZFCAZ25wESxN/.PlYCMpMMzSnUx.iEyxbA/Gyf5wJLap6	\N	\N	2019-08-09 21:22:44	\N	72	0	0	9478efab4dcf3f98f8c30b0173e2d8b3a735f8a4
69	Nelson Wilfredo	kenshiSA@outlook.com	$2y$10$knECq6ho2dPzD7i9Lv7Kuem2cCf79maoTJu8yXrY5Aekq8BZPEZzW	\N	\N	2019-08-09 21:22:44	\N	73	0	0	23851e91ce024a078df9ad63454671a88176652f
70	Yohani	gsmithb_j840h@ymail4.com	$2y$10$T.2YAFeXbplAkn6cYMlOTuimrbLPRn.UhRUAas.xkl5uxwXTdVTz2	2DfZMnThZ8guQ2PnK88LuJxb9J8SklyRXt4sg8wqQj76HxQHJBWNjrcicZT5	\N	2019-08-09 21:22:44	\N	74	15	5	ad73a8ed03dd3fcdd20498cd5bc01c2f2dd1f278
71	MU09288	ritchie.daisyh_k364k@ymail4.com	$2y$10$fjvUT7RDh/R6pYPGlTo3..3zRxJXHlD/2u4thBfLv4ojds2nBhOAi	\N	\N	2019-08-09 21:22:44	\N	76	0	0	459c4eaf425df360b88d0046b860f8cc9854c89d
72	RA01873	zdietrichm_b441z@ymail4.com	$2y$10$tUcYXCsChaKdaZ9uIM5OROFYAAkDLkY0A8VcxJRtsk2DgW8jwLILa	\N	\N	2019-08-09 21:22:44	\N	77	0	0	bd4afb63cc7f96776c8f1492936ab63a1e1be454
73	RE12181	clyde08m_s218q@ymail4.com	$2y$10$CioZcIGnuXP.3ZM0PkKobOYH.PuAHw5ADh7rCqM317tp8/Z.GMtEu	\N	\N	2019-08-09 21:22:44	\N	78	0	0	8871ed33f32bb3371d403bfcead767dea0e069b8
74	MC12129	qyundtd_s628g@ymail4.com	$2y$10$CMssHS9IELzt5e3hCjvO3.5ws6MD1z8Mr05n2mSoRT.s.ANXZTSwm	\N	\N	2019-08-09 21:22:44	\N	79	0	0	9c43eb6050b2ab359a9d0a637d2ece80d8f83688
78	HV12998	elouise.runolfsdottirq_o494h@ymail4.com	$2y$10$z9BQapKUYlKfG8F/4FcUOux9pFrbQblnTo6cQZYDLpsrHSVbDUy8W	\N	\N	2019-08-09 21:22:44	\N	83	0	0	63dc273934b31222b7c25e1c1b55a84c3440577d
79	HL12998	sipes.ruperts_w391j@ymail4.com	$2y$10$j2LukAqYGw/CnJhcbXEBRuATvoGeTDBxtJYWsEgPbgqZeKwPNhXHe	\N	\N	2019-08-09 21:22:44	\N	84	0	0	cb6672eccbd0c0c75108b08687d7be48f2132ec2
80	José Alfredo	pgibsonf_e513v@ymail4.com	$2y$10$JkEwJwtayJ.X/IIN7eMUleB7epyxOlg1W/GJcqORKw8meCqK3V3qi	\N	\N	2019-08-09 21:22:44	\N	85	0	0	1f0ab865ae18ad6fdd1abaee5f9248504e1c916c
81	César Emilio	sylvia22l_r718e@ymail4.com	$2y$10$MudUoF3/cA.zbpDwMUesZeWPVHTWN6U/3GvfflTVJDt1IwRqli3JS	\N	\N	2019-08-09 21:22:44	\N	86	0	0	a4467e0096fa83c33633a8248f24f8846b7c115a
82	Wendy Yamileth	griffin.powlowskif_l716g@ymail4.com	$2y$10$mzNm9cWu16ZAUHQKP3SD2uhaTB5z/TrW/T1DDH09xGL2Q9dYzjDUi	\N	\N	2019-08-09 21:22:44	\N	87	0	0	24a9bf068620267c8a82009384b4d730ccecd658
83	RR12903	wendyesrivas@gmail.com	$2y$10$iY0LUzIrk5q/lKgiFDoObeWImRRAwOH16IX1bCVBvE/03Uz8bSfae	\N	\N	2019-08-09 21:22:44	\N	88	0	0	6a094dfff60a7dd3895daa886b4ac4e66dd5ec16
64	virna yasmina	virnayasminau@gmail.com	$2y$10$5RT78PjzBcggC8Jj05.3a.PQdT0oCcrNDfz78Kf0P0iixEygqozUC	p54imGAbkxxCTZSb4YYuG6vBImOg9liXJZ4cpPdcLUMIRu7LNesQdtSuT3wA	\N	2019-08-09 21:22:44	\N	68	1	5	6243d08d6f270c77e9619df7cdd802b35d09c73e
65	joussue humberto	henriquezjossuehumberto@gmail.com	$2y$10$gQW9/Z3cYXgKDXW0EPmtH.jC5wSVBrB6N.sJbCW6yESF25ZqKC00C	KnDkJuQIT5iMygH5vhfbSeeUpN5xWoNNLfzJVVtWxlGY5Zf7kacKUHR0D9n8	\N	2019-09-04 10:22:21	\N	69	1	3	327cfedc3f3c130b6dfb6bc55d7d9f584a2d9a52
59	Julio	julio@dreux.com	$2y$10$hF2Sa.T4a0pFQjUxF9Qq5O88SBPp.YoCMobwv.UkEUEcL6UTyo6Fu	rVEhiUbXxbAFpw6eUIrzU0MBBsqITjZmD7pke2xTDnAOvsYVcOIvSrFHmMHZ	2019-05-06 12:46:48	2019-09-04 11:11:16	t	1	1	1	8ac7d8bc708ef75eea4c7ef2b85eea8996c9f1dd
61	CC11036	correo1paraprueba@outlook.com	$2y$10$iEyu/gJsTiDg5j1ONe1zROhjgejb.X4x7Uki5Ug9yV3PgmObZnMZ.	AmO0GvcmERxOzN5qkVkNXHnaS0QOVkjDtmCs9GnuyTEF929WgHf1UUrbsNFf	\N	2019-08-12 21:33:20	\N	65	1	6	96dfe29e52869299ea3b1959342925b67a9bb154
62	LO11005	correo2paraprueba@outlook.com	$2y$10$ni55O0OPNTIIGZWP26r4p.UIQLF4HOD/ee/ouYK1Kdeoeu9aERyxC	UJf1jdZcbM8KtaR933wYDDuf6XTwEOIk4F5SdHSGUjvRlEkd8bkfgoeXq6gW	\N	2019-08-12 21:54:59	\N	66	1	6	b3fbe0689e723e29a8902405cd62fcd8be438a0e
66	Dagoberto	correo4paraprueba@outlook.com	$2y$10$GifsoP7Rke4OUG.AUHdN0u98WZOV1aG5EPIo/feWzqwN59qOmxZGS	k1M0X1b259GajWT61WfrO0DtQsO8561geOFhiLcAed4tKaQoHjEU96HdULN1	\N	2019-09-03 10:16:44	\N	70	13	4	f50f11bf2ace3dd40cd3fe2343056806356e52be
84	CC11037	chavezamilcar7@gmail.com	$2y$10$5m1dd7akJKTeAK2kQOjRceqBe/94TV.9P2dUr0GunMidAjytbPrZm	\N	\N	\N	\N	89	0	0	884198f6df3c8c75329f14d1c6dcf8b10987d29c
85	APGUES1	farkesopsu@desoz.com	$2y$10$NezRP4FXe9RyUOqCqScbRu0r83Rm3.tf0V8nlWhCmMNob1.y//gti	\N	\N	\N	\N	90	0	0	0f994fb1de462ec9efbf18d6e805caa16001cb09
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (idusuario, usuario, pass, iddocente, condicion) FROM stdin;
\.


--
-- Name: actividades_idactividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.actividades_idactividad_seq', 1, false);


--
-- Name: alumno_asistencias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.alumno_asistencias_id_seq', 302, true);


--
-- Name: alumnos_reprobacion_idalumnos_reprobacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.alumnos_reprobacion_idalumnos_reprobacion_seq', 43, true);


--
-- Name: asesorias_idasesoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.asesorias_idasesoria_seq', 1, false);


--
-- Name: bitacora_idbitacora_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bitacora_idbitacora_seq', 156, true);


--
-- Name: cambio_tema_idcambiotema_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cambio_tema_idcambiotema_seq', 79, true);


--
-- Name: carrera_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.carrera_id', 17, true);


--
-- Name: categorias_idcategoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categorias_idcategoria_seq', 7, true);


--
-- Name: dep; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dep', 11, true);


--
-- Name: docentes_tribunal_iddocentes_tribunal_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.docentes_tribunal_iddocentes_tribunal_seq', 72, true);


--
-- Name: est_renuncia_id_est_renuncia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.est_renuncia_id_est_renuncia_seq', 1, true);


--
-- Name: estudiante_grupos_idestgru_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estudiante_grupos_idestgru_seq', 42, true);


--
-- Name: estudiantes_idestudiante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estudiantes_idestudiante_seq', 45, true);


--
-- Name: etapa; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etapa', 1, false);


--
-- Name: etapas_grupo_idetapa_grupo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etapas_grupo_idetapa_grupo_seq', 227, true);


--
-- Name: fechas_idfechas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fechas_idfechas_seq', 18, true);


--
-- Name: grupo_asistencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_asistencia_id_seq', 111, true);


--
-- Name: grupo_solicitud_idgrupsol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_solicitud_idgrupsol_seq', 367, true);


--
-- Name: grupos_docentes_idgrudoc_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupos_docentes_idgrudoc_seq', 23, true);


--
-- Name: grupos_idgrupo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupos_idgrupo_seq', 21, true);


--
-- Name: id_telefono; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.id_telefono', 1, false);


--
-- Name: idetapas; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.idetapas', 1, false);


--
-- Name: inasistencias_idinasistencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.inasistencias_idinasistencia_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 4, true);


--
-- Name: notas_idnotas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.notas_idnotas_seq', 113, true);


--
-- Name: notificacion_inasistencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.notificacion_inasistencia_id_seq', 16, true);


--
-- Name: nuevaetapa_idnuevaetapa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nuevaetapa_idnuevaetapa_seq', 15, true);


--
-- Name: periodo_idperiodo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.periodo_idperiodo_seq', 24, true);


--
-- Name: personas_idpersona_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personas_idpersona_seq', 90, true);


--
-- Name: ponderacion_idponderacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ponderacion_idponderacion_seq', 15, true);


--
-- Name: prorrogai_idprorrogai_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prorrogai_idprorrogai_seq', 62, true);


--
-- Name: prorrogajd_idprorrogajd_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prorrogajd_idprorrogajd_seq', 8, true);


--
-- Name: ratificaciones_idratificaciones_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ratificaciones_idratificaciones_seq', 22, true);


--
-- Name: rol_carrera_idrol_carrera_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rol_carrera_idrol_carrera_seq', 47, true);


--
-- Name: roles_idrol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_idrol_seq', 6, true);


--
-- Name: secuencia_docente; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.secuencia_docente', 38, true);


--
-- Name: secuencia_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.secuencia_id', 17, true);


--
-- Name: solicitudes_c_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitudes_c_id_seq', 6, true);


--
-- Name: solicitudes_idsolicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitudes_idsolicitud_seq', 9, true);


--
-- Name: tipoasesores_idtipoasesor_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipoasesores_idtipoasesor_seq', 10, true);


--
-- Name: tipotemas_idtipotema_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipotemas_idtipotema_seq', 13, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 85, true);


--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_idusuario_seq', 3, true);


--
-- Name: docentes_tribunal Pk_docentes_tribunal; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docentes_tribunal
    ADD CONSTRAINT "Pk_docentes_tribunal" PRIMARY KEY (iddocentes_tribunal);


--
-- Name: actividades actividades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actividades
    ADD CONSTRAINT actividades_pkey PRIMARY KEY (idactividad);


--
-- Name: alumno_asistencias alumno_asistencias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno_asistencias
    ADD CONSTRAINT alumno_asistencias_pkey PRIMARY KEY (id);


--
-- Name: alumnos_reprobacion alumnos_reprobacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos_reprobacion
    ADD CONSTRAINT alumnos_reprobacion_pkey PRIMARY KEY (idalumnos_reprobacion);


--
-- Name: asesorias asesorias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asesorias
    ADD CONSTRAINT asesorias_pkey PRIMARY KEY (idasesoria);


--
-- Name: bitacora bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (idbitacora);


--
-- Name: cambio_tema cambio_tema_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cambio_tema
    ADD CONSTRAINT cambio_tema_pkey PRIMARY KEY (idcambiotema);


--
-- Name: carreras carreras_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carreras
    ADD CONSTRAINT carreras_pkey PRIMARY KEY (idcarrera);


--
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (idcategoria);


--
-- Name: departamentos departamemtos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamentos
    ADD CONSTRAINT departamemtos_pkey PRIMARY KEY (iddepartamento);


--
-- Name: docentes docentes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docentes
    ADD CONSTRAINT docentes_pkey PRIMARY KEY (iddocente);


--
-- Name: est_renuncia est_renuncia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.est_renuncia
    ADD CONSTRAINT est_renuncia_pkey PRIMARY KEY (id_est_renuncia);


--
-- Name: estudiante_grupos estudiante_grupos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiante_grupos
    ADD CONSTRAINT estudiante_grupos_pkey PRIMARY KEY (idestgru);


--
-- Name: estudiantes estudiantes_carnet_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT estudiantes_carnet_key UNIQUE (carnet);


--
-- Name: estudiantes estudiantes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT estudiantes_pkey PRIMARY KEY (idestudiante);


--
-- Name: etapas_grupos etapas_grupos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas_grupos
    ADD CONSTRAINT etapas_grupos_pkey PRIMARY KEY (idetapa_grupo);


--
-- Name: fechas fechas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fechas
    ADD CONSTRAINT fechas_pkey PRIMARY KEY (idfecha);


--
-- Name: grupo_asistencia grupo_asistencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_asistencia
    ADD CONSTRAINT grupo_asistencia_pkey PRIMARY KEY (id);


--
-- Name: grupo_solicitud grupo_solicitud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_solicitud
    ADD CONSTRAINT grupo_solicitud_pkey PRIMARY KEY (idgrupsol);


--
-- Name: grupos_docentes grupos_docentes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos_docentes
    ADD CONSTRAINT grupos_docentes_pkey PRIMARY KEY (idgrudoc);


--
-- Name: grupos grupos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos
    ADD CONSTRAINT grupos_pkey PRIMARY KEY (idgrupo);


--
-- Name: facultades id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facultades
    ADD CONSTRAINT id PRIMARY KEY (idfacultad);


--
-- Name: ponderacion idponderacion_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ponderacion
    ADD CONSTRAINT idponderacion_pk PRIMARY KEY (idponderacion);


--
-- Name: inasistencias inasistencias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inasistencias
    ADD CONSTRAINT inasistencias_pkey PRIMARY KEY (idinasistencia);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: notas notas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notas
    ADD CONSTRAINT notas_pkey PRIMARY KEY (idnotas);


--
-- Name: notificacion_inasistencia notificacion_inasistencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_inasistencia
    ADD CONSTRAINT notificacion_inasistencia_pkey PRIMARY KEY (id);


--
-- Name: nuevaetapa nuevaetapa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nuevaetapa
    ADD CONSTRAINT nuevaetapa_pkey PRIMARY KEY (idnuevaetapa);


--
-- Name: periodos periodos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.periodos
    ADD CONSTRAINT periodos_pkey PRIMARY KEY (idperiodo);


--
-- Name: personas personas_correo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_correo_key UNIQUE (correo);


--
-- Name: personas personas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (idpersona);


--
-- Name: prorrogai prorrogai_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorrogai
    ADD CONSTRAINT prorrogai_pkey PRIMARY KEY (idprorrogai);


--
-- Name: prorrogajd prorrogajd_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorrogajd
    ADD CONSTRAINT prorrogajd_pkey PRIMARY KEY (idprorrogajd);


--
-- Name: ratificaciones ratificaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratificaciones
    ADD CONSTRAINT ratificaciones_pkey PRIMARY KEY (idratificaciones);


--
-- Name: rol_carreras rol_carrera_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_carreras
    ADD CONSTRAINT rol_carrera_pkey PRIMARY KEY (idrol_carrera);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (idrol);


--
-- Name: solicitudes_c solicitudes_c_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes_c
    ADD CONSTRAINT solicitudes_c_pkey PRIMARY KEY (id);


--
-- Name: solicitudes solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (idsolicitud);


--
-- Name: tipoasesores tipoasesores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipoasesores
    ADD CONSTRAINT tipoasesores_pkey PRIMARY KEY (idtipoasesor);


--
-- Name: tipotemas tipoprocesos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipotemas
    ADD CONSTRAINT tipoprocesos_pkey PRIMARY KEY (idtipotema);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (idusuario);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email) WITH (fillfactor='90');


--
-- Name: docentes_tribunal Fk_grupos_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docentes_tribunal
    ADD CONSTRAINT "Fk_grupos_solicitud" FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol) MATCH FULL;


--
-- Name: alumno_asistencias alumno_asistencias_grupo_asistencia_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno_asistencias
    ADD CONSTRAINT alumno_asistencias_grupo_asistencia_id_foreign FOREIGN KEY (grupo_asistencia_id) REFERENCES public.grupo_asistencia(id);


--
-- Name: alumno_asistencias alumno_asistencias_idestudiante_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno_asistencias
    ADD CONSTRAINT alumno_asistencias_idestudiante_foreign FOREIGN KEY (idestudiante) REFERENCES public.estudiantes(idestudiante);


--
-- Name: alumnos_reprobacion alumnos_reprobacion_idestudiante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos_reprobacion
    ADD CONSTRAINT alumnos_reprobacion_idestudiante_fkey FOREIGN KEY (idestudiante) REFERENCES public.estudiantes(idestudiante);


--
-- Name: alumnos_reprobacion alumnos_reprobacion_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos_reprobacion
    ADD CONSTRAINT alumnos_reprobacion_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: asesorias asesorias_idestudiante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asesorias
    ADD CONSTRAINT asesorias_idestudiante_fkey FOREIGN KEY (idestudiante) REFERENCES public.estudiantes(idestudiante);


--
-- Name: bitacora bitacora_idusuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_idusuario_fkey FOREIGN KEY (idusuario) REFERENCES public.users(id);


--
-- Name: cambio_tema cambio_tema_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cambio_tema
    ADD CONSTRAINT cambio_tema_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: docentes docentes_idcategoria_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docentes
    ADD CONSTRAINT docentes_idcategoria_fkey FOREIGN KEY (idcategoria) REFERENCES public.categorias(idcategoria);


--
-- Name: docentes docentes_idpersona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docentes
    ADD CONSTRAINT docentes_idpersona_fkey FOREIGN KEY (idpersona) REFERENCES public.personas(idpersona);


--
-- Name: est_renuncia est_renuncia_idestudiante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.est_renuncia
    ADD CONSTRAINT est_renuncia_idestudiante_fkey FOREIGN KEY (idestudiante) REFERENCES public.estudiantes(idestudiante);


--
-- Name: est_renuncia est_renuncia_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.est_renuncia
    ADD CONSTRAINT est_renuncia_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: estudiante_grupos estudiante_grupos_idestudiante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiante_grupos
    ADD CONSTRAINT estudiante_grupos_idestudiante_fkey FOREIGN KEY (idestudiante) REFERENCES public.estudiantes(idestudiante);


--
-- Name: estudiante_grupos estudiante_grupos_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiante_grupos
    ADD CONSTRAINT estudiante_grupos_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: estudiantes estudiantes_idcarrera_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT estudiantes_idcarrera_fkey FOREIGN KEY (idcarrera) REFERENCES public.carreras(idcarrera);


--
-- Name: estudiantes estudiantes_idpersona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT estudiantes_idpersona_fkey FOREIGN KEY (idpersona) REFERENCES public.personas(idpersona);


--
-- Name: etapas_grupos etapas_grupos_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas_grupos
    ADD CONSTRAINT etapas_grupos_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: fechas fechas_idnuevaetapa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fechas
    ADD CONSTRAINT fechas_idnuevaetapa_fkey FOREIGN KEY (idnuevaetapa) REFERENCES public.nuevaetapa(idnuevaetapa);


--
-- Name: fechas fechas_idperiodo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fechas
    ADD CONSTRAINT fechas_idperiodo_fkey FOREIGN KEY (idperiodo) REFERENCES public.periodos(idperiodo);


--
-- Name: docentes_tribunal fk_docentes_grupos solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docentes_tribunal
    ADD CONSTRAINT "fk_docentes_grupos solicitud" FOREIGN KEY (iddocente) REFERENCES public.docentes(iddocente) MATCH FULL;


--
-- Name: carreras fk_idfacultades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carreras
    ADD CONSTRAINT fk_idfacultades FOREIGN KEY (iddepartamento) REFERENCES public.departamentos(iddepartamento) ON UPDATE CASCADE;


--
-- Name: departamentos fk_idfacultades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamentos
    ADD CONSTRAINT fk_idfacultades FOREIGN KEY (idfacultad) REFERENCES public.facultades(idfacultad) ON UPDATE CASCADE;


--
-- Name: grupo_asistencia grupo_asistencia_idgrupo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_asistencia
    ADD CONSTRAINT grupo_asistencia_idgrupo_foreign FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: grupo_solicitud grupo_solicitud_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_solicitud
    ADD CONSTRAINT grupo_solicitud_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: grupo_solicitud grupo_solicitud_idsolicitud_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_solicitud
    ADD CONSTRAINT grupo_solicitud_idsolicitud_fkey FOREIGN KEY (idsolicitud) REFERENCES public.solicitudes(idsolicitud);


--
-- Name: grupos_docentes grupos_docentes_iddocente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos_docentes
    ADD CONSTRAINT grupos_docentes_iddocente_fkey FOREIGN KEY (iddocente) REFERENCES public.docentes(iddocente);


--
-- Name: grupos_docentes grupos_docentes_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos_docentes
    ADD CONSTRAINT grupos_docentes_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: grupos_docentes grupos_docentes_idtipoasesor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos_docentes
    ADD CONSTRAINT grupos_docentes_idtipoasesor_fkey FOREIGN KEY (idtipoasesor) REFERENCES public.tipoasesores(idtipoasesor);


--
-- Name: grupos grupos_idtipotema_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupos
    ADD CONSTRAINT grupos_idtipotema_fkey FOREIGN KEY (idtipotema) REFERENCES public.tipotemas(idtipotema);


--
-- Name: inasistencias inasistencias_idgrupssol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inasistencias
    ADD CONSTRAINT inasistencias_idgrupssol_fkey FOREIGN KEY (idgrupssol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: notas notas_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notas
    ADD CONSTRAINT notas_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: notificacion_inasistencia notificacion_inasistencia_idestudiante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_inasistencia
    ADD CONSTRAINT notificacion_inasistencia_idestudiante_fkey FOREIGN KEY (idestudiante) REFERENCES public.estudiantes(idestudiante);


--
-- Name: notificacion_inasistencia notificacion_inasistencia_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_inasistencia
    ADD CONSTRAINT notificacion_inasistencia_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: notificacion_inasistencia notificacion_inasistencia_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_inasistencia
    ADD CONSTRAINT notificacion_inasistencia_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: password_resets password_resets_email_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_resets
    ADD CONSTRAINT password_resets_email_fkey FOREIGN KEY (email) REFERENCES public.users(email);


--
-- Name: periodos periodos_idgrupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.periodos
    ADD CONSTRAINT periodos_idgrupo_fkey FOREIGN KEY (idgrupo) REFERENCES public.grupos(idgrupo);


--
-- Name: ponderacion ponderacion_idetapa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ponderacion
    ADD CONSTRAINT ponderacion_idetapa_fkey FOREIGN KEY (idetapa) REFERENCES public.nuevaetapa(idnuevaetapa);


--
-- Name: prorrogai prorrogai_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorrogai
    ADD CONSTRAINT prorrogai_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: prorrogajd prorrogajd_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorrogajd
    ADD CONSTRAINT prorrogajd_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: ratificaciones ratificaciones_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratificaciones
    ADD CONSTRAINT ratificaciones_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: rol_carreras rol_carrera_idcarrera_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_carreras
    ADD CONSTRAINT rol_carrera_idcarrera_fkey FOREIGN KEY (idcarrera) REFERENCES public.carreras(idcarrera);


--
-- Name: rol_carreras rol_carrera_iddocente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_carreras
    ADD CONSTRAINT rol_carrera_iddocente_fkey FOREIGN KEY (iddocente) REFERENCES public.docentes(iddocente);


--
-- Name: rol_carreras rol_carrera_idrol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_carreras
    ADD CONSTRAINT rol_carrera_idrol_fkey FOREIGN KEY (idrol) REFERENCES public.roles(idrol);


--
-- Name: solicitudes_c solicitudes_c_idgrupsol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes_c
    ADD CONSTRAINT solicitudes_c_idgrupsol_fkey FOREIGN KEY (idgrupsol) REFERENCES public.grupo_solicitud(idgrupsol);


--
-- Name: tipoasesores tipoasesores_idcarrera_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipoasesores
    ADD CONSTRAINT tipoasesores_idcarrera_fkey FOREIGN KEY (idcarrera) REFERENCES public.carreras(idcarrera);


--
-- Name: tipotemas tipotemas_idcarrera_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipotemas
    ADD CONSTRAINT tipotemas_idcarrera_fkey FOREIGN KEY (idcarrera) REFERENCES public.carreras(idcarrera);


--
-- Name: users users_idpersona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_idpersona_fkey FOREIGN KEY (idpersona) REFERENCES public.personas(idpersona);


--
-- Name: usuarios usuarios_iddocente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_iddocente_fkey FOREIGN KEY (iddocente) REFERENCES public.docentes(iddocente);


--
-- PostgreSQL database dump complete
--

