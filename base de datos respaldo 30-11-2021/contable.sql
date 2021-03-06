PGDMP     (                
    y            contable    13.4    13.4 ?    ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ?           1262    18225    contable    DATABASE     f   CREATE DATABASE contable WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Bolivia.1252';
    DROP DATABASE contable;
                postgres    false            ?            1259    18226    asiento_contable    TABLE     ?  CREATE TABLE public.asiento_contable (
    id integer NOT NULL,
    numero_asiento integer NOT NULL,
    fecha date NOT NULL,
    banderas character varying(36) NOT NULL,
    deber numeric NOT NULL,
    haber numeric NOT NULL,
    id_cuenta integer NOT NULL,
    id_diario integer NOT NULL,
    id_mayor integer NOT NULL,
    glosa character varying NOT NULL,
    id_user integer DEFAULT 5 NOT NULL,
    created_at date,
    updated_at date
);
 $   DROP TABLE public.asiento_contable;
       public         heap    postgres    false            ?            1259    18232    cuenta    TABLE     
  CREATE TABLE public.cuenta (
    id integer NOT NULL,
    nombre character varying(36) NOT NULL,
    descripcion character varying(40) NOT NULL,
    id_tipo_cuenta integer NOT NULL,
    id_subtipo_cuenta integer NOT NULL,
    created_at date,
    updated_at date
);
    DROP TABLE public.cuenta;
       public         heap    postgres    false            ?            1259    18235    l_mayor    VIEW     ?  CREATE VIEW public.l_mayor AS
 SELECT cu.id_tipo_cuenta,
    cu.id_subtipo_cuenta,
    cu.id AS id_cuenta,
    cu.nombre AS nombre_cuenta,
    sum(ac.deber) AS deber,
    sum(ac.haber) AS haber,
        CASE
            WHEN ((sum(ac.deber) - sum(ac.haber)) > (0)::numeric) THEN (sum(ac.deber) - sum(ac.haber))
            ELSE (0)::numeric
        END AS saldo_deudor,
        CASE
            WHEN ((sum(ac.haber) - sum(ac.deber)) > (0)::numeric) THEN (sum(ac.haber) - sum(ac.deber))
            ELSE (0)::numeric
        END AS saldo_acreedor
   FROM (public.asiento_contable ac
     JOIN public.cuenta cu ON ((ac.id_cuenta = cu.id)))
  GROUP BY cu.nombre, cu.id_tipo_cuenta, cu.id_subtipo_cuenta, cu.id
  ORDER BY cu.id_tipo_cuenta;
    DROP VIEW public.l_mayor;
       public          postgres    false    200    200    201    201    201    201    200            ?            1259    18240    activos    VIEW     ?   CREATE VIEW public.activos AS
 SELECT l_mayor.id_tipo_cuenta,
    l_mayor.nombre_cuenta,
    l_mayor.saldo_deudor AS deber,
    l_mayor.saldo_acreedor AS haber
   FROM public.l_mayor
  WHERE (l_mayor.id_tipo_cuenta = 1);
    DROP VIEW public.activos;
       public          postgres    false    202    202    202    202            ?            1259    18244    asiento_contable_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.asiento_contable_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.asiento_contable_id_seq;
       public          postgres    false    200            ?           0    0    asiento_contable_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.asiento_contable_id_seq OWNED BY public.asiento_contable.id;
          public          postgres    false    204            ?            1259    18246    estado_de_resultados    VIEW     ?  CREATE VIEW public.estado_de_resultados AS
 SELECT l_mayor.id_tipo_cuenta,
    l_mayor.id_subtipo_cuenta,
    l_mayor.id_cuenta,
    l_mayor.nombre_cuenta,
    l_mayor.saldo_deudor,
    l_mayor.saldo_acreedor
   FROM public.l_mayor
  WHERE ((l_mayor.id_tipo_cuenta >= 4) AND (l_mayor.id_tipo_cuenta <= 5))
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    NULL::integer AS id_subtipo_cuenta,
    NULL::integer AS id_cuenta,
    'totales'::character varying AS nombre_cuenta,
    sum(l_mayor.saldo_deudor) AS saldo_deudor,
    sum(l_mayor.saldo_acreedor) AS saldo_acreedor
   FROM public.l_mayor
  WHERE ((l_mayor.id_tipo_cuenta >= 4) AND (l_mayor.id_tipo_cuenta <= 5))
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    NULL::integer AS id_subtipo_cuenta,
    NULL::integer AS id_cuenta,
    'Utilidad Neta'::character varying AS nombre_cuenta,
        CASE
            WHEN ((sum(l_mayor.saldo_acreedor) - sum(l_mayor.saldo_deudor)) > (0)::numeric) THEN (0)::numeric
            ELSE (sum(l_mayor.saldo_acreedor) - sum(l_mayor.saldo_deudor))
        END AS saldo_deudor,
        CASE
            WHEN ((sum(l_mayor.saldo_acreedor) - sum(l_mayor.saldo_deudor)) < (0)::numeric) THEN (0)::numeric
            ELSE (sum(l_mayor.saldo_acreedor) - sum(l_mayor.saldo_deudor))
        END AS saldo_acreedor
   FROM public.l_mayor
  WHERE ((l_mayor.id_tipo_cuenta >= 4) AND (l_mayor.id_tipo_cuenta <= 5))
  ORDER BY 1;
 '   DROP VIEW public.estado_de_resultados;
       public          postgres    false    202    202    202    202    202    202            ?            1259    18251    estado_c    VIEW     ?  CREATE VIEW public.estado_c AS
 SELECT l_mayor.id_tipo_cuenta,
    l_mayor.id_subtipo_cuenta,
    l_mayor.id_cuenta,
    l_mayor.nombre_cuenta,
    l_mayor.saldo_deudor AS deber,
    l_mayor.saldo_acreedor AS haber
   FROM public.l_mayor
  WHERE (l_mayor.id_tipo_cuenta = 3)
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    NULL::integer AS id_subtipo_cuenta,
    NULL::integer AS id_cuenta,
    'Utilidad Neta'::character varying AS nombre_cuenta,
    estado_de_resultados.saldo_deudor AS deber,
    estado_de_resultados.saldo_acreedor AS haber
   FROM public.estado_de_resultados
  WHERE ((estado_de_resultados.nombre_cuenta)::text = 'Utilidad Neta'::text)
  ORDER BY 1;
    DROP VIEW public.estado_c;
       public          postgres    false    202    202    202    202    202    202    205    205    205            ?            1259    18256    estado_capital_contable    VIEW     0  CREATE VIEW public.estado_capital_contable AS
 SELECT estado_c.id_tipo_cuenta,
    estado_c.id_subtipo_cuenta,
    estado_c.id_cuenta,
    estado_c.nombre_cuenta,
    estado_c.deber,
    estado_c.haber
   FROM public.estado_c
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    NULL::integer AS id_subtipo_cuenta,
    NULL::integer AS id_cuenta,
    '-total'::character varying AS nombre_cuenta,
        CASE
            WHEN ((sum(estado_c.haber) - sum(estado_c.deber)) > (0)::numeric) THEN (0)::numeric
            ELSE (sum(estado_c.haber) - sum(estado_c.deber))
        END AS deber,
        CASE
            WHEN ((sum(estado_c.haber) - sum(estado_c.deber)) < (0)::numeric) THEN (0)::numeric
            ELSE (sum(estado_c.haber) - sum(estado_c.deber))
        END AS haber
   FROM public.estado_c
  ORDER BY 1;
 *   DROP VIEW public.estado_capital_contable;
       public          postgres    false    206    206    206    206    206    206            ?            1259    18261    pasivos    VIEW     ?   CREATE VIEW public.pasivos AS
 SELECT l_mayor.id_tipo_cuenta,
    l_mayor.nombre_cuenta,
    l_mayor.saldo_deudor AS deber,
    l_mayor.saldo_acreedor AS haber
   FROM public.l_mayor
  WHERE (l_mayor.id_tipo_cuenta = 2);
    DROP VIEW public.pasivos;
       public          postgres    false    202    202    202    202            ?            1259    18265    pasivos_capital    VIEW     ?  CREATE VIEW public.pasivos_capital AS
 SELECT pasivos.id_tipo_cuenta,
    pasivos.nombre_cuenta,
    pasivos.deber,
    pasivos.haber
   FROM public.pasivos
  WHERE (pasivos.id_tipo_cuenta = 2)
UNION
 SELECT estado_capital_contable.id_tipo_cuenta,
    'total capital'::character varying AS nombre_cuenta,
    estado_capital_contable.deber,
    estado_capital_contable.haber
   FROM public.estado_capital_contable
  WHERE ((estado_capital_contable.nombre_cuenta)::text = '-total'::text);
 "   DROP VIEW public.pasivos_capital;
       public          postgres    false    208    208    208    208    207    207    207    207            ?            1259    18269    res_activos    VIEW     ?   CREATE VIEW public.res_activos AS
 SELECT NULL::text AS id_tipo_cuenta,
    'total activos'::text AS nombre_cuenta,
    sum(activos.deber) AS deber,
    sum(activos.haber) AS haber
   FROM public.activos;
    DROP VIEW public.res_activos;
       public          postgres    false    203    203            ?            1259    18273    res_pasivos    VIEW     ?   CREATE VIEW public.res_pasivos AS
 SELECT NULL::text AS id_tipo_cuenta,
    'total pasivos y capital'::text AS nombre_cuenta,
    sum(pasivos_capital.deber) AS deber,
    sum(pasivos_capital.haber) AS haber
   FROM public.pasivos_capital;
    DROP VIEW public.res_pasivos;
       public          postgres    false    209    209            ?            1259    18277    balance_general    VIEW     |  CREATE VIEW public.balance_general AS
 SELECT activos.id_tipo_cuenta,
    activos.nombre_cuenta,
    activos.deber,
    activos.haber
   FROM public.activos
UNION
 SELECT pasivos_capital.id_tipo_cuenta,
    pasivos_capital.nombre_cuenta,
    pasivos_capital.deber,
    pasivos_capital.haber
   FROM public.pasivos_capital
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    res_activos.nombre_cuenta,
    res_activos.deber,
    res_activos.haber
   FROM public.res_activos
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    res_pasivos.nombre_cuenta,
    res_pasivos.deber,
    res_pasivos.haber
   FROM public.res_pasivos
  ORDER BY 4;
 "   DROP VIEW public.balance_general;
       public          postgres    false    211    211    211    210    210    210    209    209    209    203    203    203    203    209            ?            1259    18281    balanza_de_comprobacion    VIEW     ?  CREATE VIEW public.balanza_de_comprobacion AS
 SELECT l_mayor.id_tipo_cuenta,
    l_mayor.id_subtipo_cuenta,
    l_mayor.id_cuenta,
    l_mayor.nombre_cuenta,
    l_mayor.deber,
    l_mayor.haber,
    l_mayor.saldo_deudor,
    l_mayor.saldo_acreedor
   FROM public.l_mayor
UNION
 SELECT NULL::integer AS id_tipo_cuenta,
    NULL::integer AS id_subtipo_cuenta,
    NULL::integer AS id_cuenta,
    'total'::character varying AS nombre_cuenta,
    sum(l_mayor.deber) AS deber,
    sum(l_mayor.haber) AS haber,
    sum(l_mayor.saldo_deudor) AS saldo_deudor,
    sum(l_mayor.saldo_acreedor) AS saldo_acreedor
   FROM public.l_mayor
  ORDER BY 1;
 *   DROP VIEW public.balanza_de_comprobacion;
       public          postgres    false    202    202    202    202    202    202    202    202            ?            1259    18286    cuenta_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.cuenta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cuenta_id_seq;
       public          postgres    false    201            ?           0    0    cuenta_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.cuenta_id_seq OWNED BY public.cuenta.id;
          public          postgres    false    214            ?            1259    18288    estado    TABLE     ?   CREATE TABLE public.estado (
    id integer NOT NULL,
    nombre character varying(36) NOT NULL,
    descripcion character varying(40) NOT NULL
);
    DROP TABLE public.estado;
       public         heap    postgres    false            ?            1259    18291    estado_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.estado_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.estado_id_seq;
       public          postgres    false    215            ?           0    0    estado_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.estado_id_seq OWNED BY public.estado.id;
          public          postgres    false    216            ?            1259    18293    estados    VIEW     r   CREATE VIEW public.estados AS
 SELECT estado.id,
    estado.nombre,
    estado.descripcion
   FROM public.estado;
    DROP VIEW public.estados;
       public          postgres    false    215    215    215            ?            1259    18455    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            ?            1259    18453    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    241            ?           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    240            ?            1259    18297    l_diario    VIEW     ?   CREATE VIEW public.l_diario AS
 SELECT ac.numero_asiento,
    ac.fecha,
    cu.nombre AS nombre_cuenta,
    ac.glosa,
    ac.banderas,
    ac.deber,
    ac.haber
   FROM (public.asiento_contable ac
     JOIN public.cuenta cu ON ((ac.id_cuenta = cu.id)));
    DROP VIEW public.l_diario;
       public          postgres    false    200    200    200    200    200    200    200    201    201            ?            1259    18301    l_diario_resultado    VIEW     3  CREATE VIEW public.l_diario_resultado AS
 SELECT l_diario.numero_asiento,
    l_diario.fecha,
    l_diario.nombre_cuenta,
    l_diario.glosa,
    l_diario.banderas,
    l_diario.deber,
    l_diario.haber
   FROM public.l_diario
UNION
 SELECT NULL::integer AS numero_asiento,
    CURRENT_DATE AS fecha,
    'total'::character varying AS nombre_cuenta,
    'sumatoria de todas las cuentas'::character varying AS glosa,
    '--'::character varying AS banderas,
    sum(l_diario.deber) AS deber,
    sum(l_diario.haber) AS haber
   FROM public.l_diario
  ORDER BY 2;
 %   DROP VIEW public.l_diario_resultado;
       public          postgres    false    218    218    218    218    218    218    218            ?            1259    18306    libro_diario    TABLE     
  CREATE TABLE public.libro_diario (
    id integer NOT NULL,
    nombre_denominacion character varying(36) NOT NULL,
    fecha_apertura date NOT NULL,
    fecha_cierre date NOT NULL,
    id_user integer DEFAULT 5 NOT NULL,
    created_at date,
    updated_at date
);
     DROP TABLE public.libro_diario;
       public         heap    postgres    false            ?            1259    18309    libro_diario_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.libro_diario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.libro_diario_id_seq;
       public          postgres    false    220            ?           0    0    libro_diario_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.libro_diario_id_seq OWNED BY public.libro_diario.id;
          public          postgres    false    221            ?            1259    18311    libro_mayor    TABLE     ?   CREATE TABLE public.libro_mayor (
    id integer NOT NULL,
    nombre_denominacion character varying(36) NOT NULL,
    gestion date NOT NULL,
    id_user integer DEFAULT 5 NOT NULL,
    created_at date,
    updated_at date
);
    DROP TABLE public.libro_mayor;
       public         heap    postgres    false            ?            1259    18314    libro_mayor_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.libro_mayor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.libro_mayor_id_seq;
       public          postgres    false    222            ?           0    0    libro_mayor_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.libro_mayor_id_seq OWNED BY public.libro_mayor.id;
          public          postgres    false    223            ?            1259    18427 
   migrations    TABLE     ?   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            ?            1259    18425    migrations_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    236            ?           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    235            ?            1259    18446    password_resets    TABLE     ?   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    postgres    false            ?            1259    18469    personal_access_tokens    TABLE     ?  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            ?            1259    18467    personal_access_tokens_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    243            ?           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    242            ?            1259    18316    plan_de_cuentas    VIEW     ?   CREATE VIEW public.plan_de_cuentas AS
 SELECT cuenta.id_tipo_cuenta,
    cuenta.id_subtipo_cuenta,
    cuenta.id,
    cuenta.nombre,
    cuenta.descripcion
   FROM public.cuenta;
 "   DROP VIEW public.plan_de_cuentas;
       public          postgres    false    201    201    201    201    201            ?            1259    18320    rol    TABLE     ?   CREATE TABLE public.rol (
    id integer NOT NULL,
    nombre character varying(36) NOT NULL,
    descripcion character varying(40) NOT NULL
);
    DROP TABLE public.rol;
       public         heap    postgres    false            ?            1259    18323 
   rol_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.rol_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.rol_id_seq;
       public          postgres    false    225            ?           0    0 
   rol_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE public.rol_id_seq OWNED BY public.rol.id;
          public          postgres    false    226            ?            1259    18325    roles    VIEW     d   CREATE VIEW public.roles AS
 SELECT rol.id,
    rol.nombre,
    rol.descripcion
   FROM public.rol;
    DROP VIEW public.roles;
       public          postgres    false    225    225    225            ?            1259    18481    sessions    TABLE     ?   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    postgres    false            ?            1259    18329    subtipo_cuenta    TABLE     ?   CREATE TABLE public.subtipo_cuenta (
    id integer NOT NULL,
    nombre character varying(36) NOT NULL,
    updated_at date,
    created_at date
);
 "   DROP TABLE public.subtipo_cuenta;
       public         heap    postgres    false            ?            1259    18332    subtipo_cuenta_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.subtipo_cuenta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.subtipo_cuenta_id_seq;
       public          postgres    false    228            ?           0    0    subtipo_cuenta_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.subtipo_cuenta_id_seq OWNED BY public.subtipo_cuenta.id;
          public          postgres    false    229            ?            1259    18334    tipo_cuenta    TABLE     ?   CREATE TABLE public.tipo_cuenta (
    id integer NOT NULL,
    nombre character varying(36) NOT NULL,
    updated_at date,
    created_at date
);
    DROP TABLE public.tipo_cuenta;
       public         heap    postgres    false            ?            1259    18337    tipo_cuenta_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.tipo_cuenta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tipo_cuenta_id_seq;
       public          postgres    false    230            ?           0    0    tipo_cuenta_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tipo_cuenta_id_seq OWNED BY public.tipo_cuenta.id;
          public          postgres    false    231            ?            1259    18435    users    TABLE       CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    current_team_id bigint,
    profile_photo_path character varying(2048),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    two_factor_secret text,
    two_factor_recovery_codes text
);
    DROP TABLE public.users;
       public         heap    postgres    false            ?            1259    18433    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    238            ?           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    237            ?            1259    18339    usuario    TABLE     ?  CREATE TABLE public.usuario (
    id integer NOT NULL,
    nombres character varying(36) NOT NULL,
    apellidos character varying(36) NOT NULL,
    telefono numeric(12,0) NOT NULL,
    email character varying(40) NOT NULL,
    ci character varying(11) NOT NULL,
    nombreusuario character varying(36) NOT NULL,
    password character varying(36) NOT NULL,
    fecharegistro date NOT NULL,
    id_rol integer NOT NULL,
    id_estado integer NOT NULL
);
    DROP TABLE public.usuario;
       public         heap    postgres    false            ?            1259    18342    usuario_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.usuario_id_seq;
       public          postgres    false    232            ?           0    0    usuario_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;
          public          postgres    false    233            ?            1259    18344    usuarios    VIEW     &  CREATE VIEW public.usuarios AS
 SELECT usuario.id,
    usuario.nombres,
    usuario.apellidos,
    usuario.telefono,
    usuario.email,
    usuario.ci,
    usuario.nombreusuario,
    usuario.password,
    usuario.fecharegistro,
    usuario.id_rol,
    usuario.id_estado
   FROM public.usuario;
    DROP VIEW public.usuarios;
       public          postgres    false    232    232    232    232    232    232    232    232    232    232    232            ?           2604    18348    asiento_contable id    DEFAULT     z   ALTER TABLE ONLY public.asiento_contable ALTER COLUMN id SET DEFAULT nextval('public.asiento_contable_id_seq'::regclass);
 B   ALTER TABLE public.asiento_contable ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    204    200            ?           2604    18349 	   cuenta id    DEFAULT     f   ALTER TABLE ONLY public.cuenta ALTER COLUMN id SET DEFAULT nextval('public.cuenta_id_seq'::regclass);
 8   ALTER TABLE public.cuenta ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    201            ?           2604    18350 	   estado id    DEFAULT     f   ALTER TABLE ONLY public.estado ALTER COLUMN id SET DEFAULT nextval('public.estado_id_seq'::regclass);
 8   ALTER TABLE public.estado ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215            ?           2604    18458    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    241    240    241            ?           2604    18351    libro_diario id    DEFAULT     r   ALTER TABLE ONLY public.libro_diario ALTER COLUMN id SET DEFAULT nextval('public.libro_diario_id_seq'::regclass);
 >   ALTER TABLE public.libro_diario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    220            ?           2604    18352    libro_mayor id    DEFAULT     p   ALTER TABLE ONLY public.libro_mayor ALTER COLUMN id SET DEFAULT nextval('public.libro_mayor_id_seq'::regclass);
 =   ALTER TABLE public.libro_mayor ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            ?           2604    18430    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    236    235    236            ?           2604    18472    personal_access_tokens id    DEFAULT     ?   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    243    242    243            ?           2604    18353    rol id    DEFAULT     `   ALTER TABLE ONLY public.rol ALTER COLUMN id SET DEFAULT nextval('public.rol_id_seq'::regclass);
 5   ALTER TABLE public.rol ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    225            ?           2604    18354    subtipo_cuenta id    DEFAULT     v   ALTER TABLE ONLY public.subtipo_cuenta ALTER COLUMN id SET DEFAULT nextval('public.subtipo_cuenta_id_seq'::regclass);
 @   ALTER TABLE public.subtipo_cuenta ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    228            ?           2604    18355    tipo_cuenta id    DEFAULT     p   ALTER TABLE ONLY public.tipo_cuenta ALTER COLUMN id SET DEFAULT nextval('public.tipo_cuenta_id_seq'::regclass);
 =   ALTER TABLE public.tipo_cuenta ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    230            ?           2604    18438    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    238    237    238            ?           2604    18356 
   usuario id    DEFAULT     h   ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);
 9   ALTER TABLE public.usuario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    233    232            ?          0    18226    asiento_contable 
   TABLE DATA           ?   COPY public.asiento_contable (id, numero_asiento, fecha, banderas, deber, haber, id_cuenta, id_diario, id_mayor, glosa, id_user, created_at, updated_at) FROM stdin;
    public          postgres    false    200   w?       ?          0    18232    cuenta 
   TABLE DATA           t   COPY public.cuenta (id, nombre, descripcion, id_tipo_cuenta, id_subtipo_cuenta, created_at, updated_at) FROM stdin;
    public          postgres    false    201   Y?       ?          0    18288    estado 
   TABLE DATA           9   COPY public.estado (id, nombre, descripcion) FROM stdin;
    public          postgres    false    215   ??       ?          0    18455    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    241   ??       ?          0    18306    libro_diario 
   TABLE DATA           ~   COPY public.libro_diario (id, nombre_denominacion, fecha_apertura, fecha_cierre, id_user, created_at, updated_at) FROM stdin;
    public          postgres    false    220   
?       ?          0    18311    libro_mayor 
   TABLE DATA           h   COPY public.libro_mayor (id, nombre_denominacion, gestion, id_user, created_at, updated_at) FROM stdin;
    public          postgres    false    222   w?       ?          0    18427 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    236   ??       ?          0    18446    password_resets 
   TABLE DATA           C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public          postgres    false    239   ??       ?          0    18469    personal_access_tokens 
   TABLE DATA           ?   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
    public          postgres    false    243   ??       ?          0    18320    rol 
   TABLE DATA           6   COPY public.rol (id, nombre, descripcion) FROM stdin;
    public          postgres    false    225   ??       ?          0    18481    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public          postgres    false    244   &?       ?          0    18329    subtipo_cuenta 
   TABLE DATA           L   COPY public.subtipo_cuenta (id, nombre, updated_at, created_at) FROM stdin;
    public          postgres    false    228   ??       ?          0    18334    tipo_cuenta 
   TABLE DATA           I   COPY public.tipo_cuenta (id, nombre, updated_at, created_at) FROM stdin;
    public          postgres    false    230   ?       ?          0    18435    users 
   TABLE DATA           ?   COPY public.users (id, name, email, email_verified_at, password, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) FROM stdin;
    public          postgres    false    238   j?       ?          0    18339    usuario 
   TABLE DATA           ?   COPY public.usuario (id, nombres, apellidos, telefono, email, ci, nombreusuario, password, fecharegistro, id_rol, id_estado) FROM stdin;
    public          postgres    false    232   ?       ?           0    0    asiento_contable_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.asiento_contable_id_seq', 28, true);
          public          postgres    false    204            ?           0    0    cuenta_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.cuenta_id_seq', 17, true);
          public          postgres    false    214            ?           0    0    estado_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.estado_id_seq', 2, true);
          public          postgres    false    216            ?           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    240            ?           0    0    libro_diario_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.libro_diario_id_seq', 4, true);
          public          postgres    false    221            ?           0    0    libro_mayor_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.libro_mayor_id_seq', 5, true);
          public          postgres    false    223            ?           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 6, true);
          public          postgres    false    235            ?           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    242            ?           0    0 
   rol_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('public.rol_id_seq', 3, true);
          public          postgres    false    226            ?           0    0    subtipo_cuenta_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.subtipo_cuenta_id_seq', 13, true);
          public          postgres    false    229            ?           0    0    tipo_cuenta_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tipo_cuenta_id_seq', 13, true);
          public          postgres    false    231            ?           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 5, true);
          public          postgres    false    237            ?           0    0    usuario_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.usuario_id_seq', 3, true);
          public          postgres    false    233            ?           2606    18358 &   asiento_contable asiento_contable_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.asiento_contable
    ADD CONSTRAINT asiento_contable_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.asiento_contable DROP CONSTRAINT asiento_contable_pkey;
       public            postgres    false    200            ?           2606    18360    cuenta cuenta_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.cuenta
    ADD CONSTRAINT cuenta_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cuenta DROP CONSTRAINT cuenta_pkey;
       public            postgres    false    201            ?           2606    18362    estado estado_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.estado DROP CONSTRAINT estado_pkey;
       public            postgres    false    215            ?           2606    18464    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    241            ?           2606    18466 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    241            ?           2606    18364    libro_diario libro_diario_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.libro_diario
    ADD CONSTRAINT libro_diario_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.libro_diario DROP CONSTRAINT libro_diario_pkey;
       public            postgres    false    220            ?           2606    18366    libro_mayor libro_mayor_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.libro_mayor
    ADD CONSTRAINT libro_mayor_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.libro_mayor DROP CONSTRAINT libro_mayor_pkey;
       public            postgres    false    222            ?           2606    18432    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    236            ?           2606    18477 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    243            ?           2606    18480 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    243            ?           2606    18368    rol rol_pkey 
   CONSTRAINT     J   ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.rol DROP CONSTRAINT rol_pkey;
       public            postgres    false    225            ?           2606    18488    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            postgres    false    244            ?           2606    18370 "   subtipo_cuenta subtipo_cuenta_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.subtipo_cuenta
    ADD CONSTRAINT subtipo_cuenta_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.subtipo_cuenta DROP CONSTRAINT subtipo_cuenta_pkey;
       public            postgres    false    228            ?           2606    18372    tipo_cuenta tipo_cuenta_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tipo_cuenta
    ADD CONSTRAINT tipo_cuenta_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.tipo_cuenta DROP CONSTRAINT tipo_cuenta_pkey;
       public            postgres    false    230            ?           2606    18445    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    238            ?           2606    18443    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    238            ?           2606    18374    usuario usuario_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    232            ?           1259    18506 !   fki_asiento_contable_id_user_fkey    INDEX     a   CREATE INDEX fki_asiento_contable_id_user_fkey ON public.asiento_contable USING btree (id_user);
 5   DROP INDEX public.fki_asiento_contable_id_user_fkey;
       public            postgres    false    200            ?           1259    18513    fki_libro_diario_id_user_fkey    INDEX     Y   CREATE INDEX fki_libro_diario_id_user_fkey ON public.libro_diario USING btree (id_user);
 1   DROP INDEX public.fki_libro_diario_id_user_fkey;
       public            postgres    false    220            ?           1259    18520    fki_libro_mayor_id_user_fkey    INDEX     W   CREATE INDEX fki_libro_mayor_id_user_fkey ON public.libro_mayor USING btree (id_user);
 0   DROP INDEX public.fki_libro_mayor_id_user_fkey;
       public            postgres    false    222            ?           1259    18452    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            postgres    false    239            ?           1259    18478 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     ?   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    243    243            ?           1259    18490    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            postgres    false    244            ?           1259    18489    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            postgres    false    244            ?           2606    18375 0   asiento_contable asiento_contable_id_cuenta_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.asiento_contable
    ADD CONSTRAINT asiento_contable_id_cuenta_fkey FOREIGN KEY (id_cuenta) REFERENCES public.cuenta(id) NOT VALID;
 Z   ALTER TABLE ONLY public.asiento_contable DROP CONSTRAINT asiento_contable_id_cuenta_fkey;
       public          postgres    false    201    200    3025            ?           2606    18380 0   asiento_contable asiento_contable_id_diario_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.asiento_contable
    ADD CONSTRAINT asiento_contable_id_diario_fkey FOREIGN KEY (id_diario) REFERENCES public.libro_diario(id) NOT VALID;
 Z   ALTER TABLE ONLY public.asiento_contable DROP CONSTRAINT asiento_contable_id_diario_fkey;
       public          postgres    false    3030    200    220            ?           2606    18385 /   asiento_contable asiento_contable_id_mayor_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.asiento_contable
    ADD CONSTRAINT asiento_contable_id_mayor_fkey FOREIGN KEY (id_mayor) REFERENCES public.libro_mayor(id) NOT VALID;
 Y   ALTER TABLE ONLY public.asiento_contable DROP CONSTRAINT asiento_contable_id_mayor_fkey;
       public          postgres    false    222    3033    200            ?           2606    18501 .   asiento_contable asiento_contable_id_user_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.asiento_contable
    ADD CONSTRAINT asiento_contable_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.users(id) NOT VALID;
 X   ALTER TABLE ONLY public.asiento_contable DROP CONSTRAINT asiento_contable_id_user_fkey;
       public          postgres    false    3047    200    238            ?           2606    18395 $   cuenta cuenta_id_subtipo_cuenta_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.cuenta
    ADD CONSTRAINT cuenta_id_subtipo_cuenta_fkey FOREIGN KEY (id_subtipo_cuenta) REFERENCES public.subtipo_cuenta(id) NOT VALID;
 N   ALTER TABLE ONLY public.cuenta DROP CONSTRAINT cuenta_id_subtipo_cuenta_fkey;
       public          postgres    false    201    228    3037            ?           2606    18400 !   cuenta cuenta_id_tipo_cuenta_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.cuenta
    ADD CONSTRAINT cuenta_id_tipo_cuenta_fkey FOREIGN KEY (id_tipo_cuenta) REFERENCES public.tipo_cuenta(id) NOT VALID;
 K   ALTER TABLE ONLY public.cuenta DROP CONSTRAINT cuenta_id_tipo_cuenta_fkey;
       public          postgres    false    3039    201    230            ?           2606    18508 &   libro_diario libro_diario_id_user_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.libro_diario
    ADD CONSTRAINT libro_diario_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.users(id) NOT VALID;
 P   ALTER TABLE ONLY public.libro_diario DROP CONSTRAINT libro_diario_id_user_fkey;
       public          postgres    false    3047    220    238            ?           2606    18515 $   libro_mayor libro_mayor_id_user_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.libro_mayor
    ADD CONSTRAINT libro_mayor_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.users(id) NOT VALID;
 N   ALTER TABLE ONLY public.libro_mayor DROP CONSTRAINT libro_mayor_id_user_fkey;
       public          postgres    false    222    238    3047            ?           2606    18415    usuario usuario_id_estado_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES public.estado(id) NOT VALID;
 H   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_id_estado_fkey;
       public          postgres    false    215    3027    232            ?           2606    18420    usuario usuario_id_rol_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.rol(id) NOT VALID;
 E   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_id_rol_fkey;
       public          postgres    false    232    3035    225            ?   ?  x????o?0?s?+z7,???q?????^?ZMmI???__?ւS?ԃ?އ??BA4?$Ii??:GYj(???S??0??
??5??Fھ?׌Ƶs[u?^<????K??RW[???Ba???g?+mp?p#?J{'8	N"O9ʂ?A???&s
ק?0w?I*Y7F??Q?%??av?܈?l????\0???K??t=WK5?ja??9??FpQ?n%?K??2v׮S????+??wI?g???}??Μ?1?????????T???h??Z??X?????_%'t$?nd??F66?? ??|d??N&??p???xz??%h?? >????o?jX??pi??	?!?6^𻉟???Cc50???K??B???C??>??o???s]_?^??FC?@(??+}HC8??=2?g?i݆t???~j???M?B߯??????"??-;??Fߺ??ʰb?~??e6?? ?п?      ?   5  x?mRkn?0?mN?L???K??c??\??9I??~?Z?
?D?????J6?=???[??#c??P?w?Կ?A"?a]?0N?1?̮aW??<???d?W??<Y??aG????l&?0U5#?(?E?S?C?PQ}V?b?<?8c????9???-N
???Q(?&??n?M!???c?I?<C?1?[?S?c!|@?1?L???ØvAp?+???yT(9???V?p.R??K-?C???C??uO?????g??E?K?wZq?n????I?i?/?[????7s???_#?;	??-????{??UU??)??      ?   ?   x?3?LL.?,??,-.M,??WH?S ?d?$?pq????d? T %?D?BRbV"W? S,#      ?      x?????? ? ?      ?   ]   x?3?L??IM??Wptr?4202?50?50?3?,8M9c???˘3%5/?73/193?O?(1/%?????@??H????Ąr??`&W? ??s      ?   N   x?3?L??IM??Wptr?4202?5 !NS?? ?2?LI?????KL???S(J?K??5??44?52 ??s???b???? ??U      ?   ?   x?]?Q?0@??a?:??]L????Ԭ#\?M?????{}????"X??3?Sf???b?.??ۂ?_?:K
?X9?J?UܢP?g??|??^???"???W??{??i??.݊????.8??+ge???=kM=x\?s1 @m9?ƺ??d?ގƘ7?;_?      ?      x?????? ? ?      ?      x?????? ? ?      ?   Y   x?EL?? =?):????
???@I_Ш???_??? 7?KŘ?P)l.?id?(????zࢰ;?'SŻuH??y?n?/ p?.)?      ?   ^  x??VK??<]O~E???i
?AU3!??`?C? &?a?L?	?__g2j??4R?.F,??}??=G?xO?U@[??,ٝ???Jb?}>?z@\?ٺ???d0???%?9?P2?|????SP?iӞ?????ױ(h??q???Ǐ?˃<]??/P??+???r?9??Ƭ????gu?y<-?Ͽ蚀W5M?W?x?l?c???.??ݟ???ӥ?YZ.&??H?є?kl?!?S3 ????4?p&c%f?;??ˈ?#R?NN?Ip.7????[?r???3??ך*j?t?Y?1?o?$44e2?Rf4?@???x?Vb]??/':)
?%??2
?"刅?
?G??Pd???jh?z??????????9?bO???٣?}????I????????9$?W??&?O??֊????%??n?0ن?~'kʃ????2?V_?b?Bm_???G????c5,?9?????}{??;)`8?g}?a*?j???S??????jt???? vVy3h?[????6?یrv???gF~?Fq4??????U?W)?"?)?@)???%?eQ??\qc???0?_?????l?;?E?-??Q???!?j{?n) e8?0??q??-??*??޺u<_u?H?q?@$?)???Q?np??5??߼?uʣ?t-*??-??kS@v?5L78?懙???hpx??ax?|????L?E??j?M0?w??a?%?\?{?HE?????????w??W?o?߾?LzPd??^?^?Ej.x7?4ۂl1???|??$J7[???#?ԿgRn?T<3??@Al?2?S??07lU??M?Bx?	+l\??>??d????5U?%Y?#?????g[?/mCS}?M?jz?s??dǰs??zཞ?!?=????4?aqr???#?̧ ?䔀??E ^nx?Q???>2????b?S???e֩?\"n?? V1??q Y&???D??)???B$?????7??	ʢ[????6lh?ֶ??d3??L???2W?n?L?7s2??B??-!^?w?<0K?T?R"3? ???%???s??_?@?n\?O???ͺs???L%~aes4'???Hg?1(I?B???"?Pʉ?S#nr?P?9+??<c???:Ǳ?.????adu??~܏F????>?      ?   v   x?]?K
?0е|?? ?O??DO????R??.r??{?f3??U?l?O=w?ጷZ?\???????f?/???<@4??䃞?T`OQ????l=?C"?l?F???????E5M      ?   @   x?3?LL.?,????".#΂?b??-)????˄	?pf????CL9??K??=... L]Z      ?   ?   x?3?tK??,HUp??/J-?R??)??y鹉?9z????1~?*F?*?*9???n??aN??ޞ??Y?.UIy%?AE%fQ?&??I?Yn?~%ّ???? ?dd`d?kh?k`?`dle`ae`34P00?2"K?j?=... b?-?      ?   ?   x?m??
?0?s?.??????%h???Na???B$?|_?	??a??E*??<:m????Jb?P????4?)d^AJv?딄:B??9Th?_l??????ǜ?f?|?J?V֐??~????"???????s???>{!?[?El     