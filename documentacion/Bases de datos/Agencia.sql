

CREATE TABLE public.destino (
    id_destino integer NOT NULL,
    ciudad character varying(50) NOT NULL,
    pais character varying(50) NOT NULL,
    requiere_pasaporte boolean DEFAULT false NOT NULL
);


ALTER TABLE public.destino OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 27527)
-- Name: destino_id_destino_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.destino_id_destino_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.destino_id_destino_seq OWNER TO postgres;

--
-- TOC entry 4921 (class 0 OID 0)
-- Dependencies: 221
-- Name: destino_id_destino_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.destino_id_destino_seq OWNED BY public.destino.id_destino;


--
-- TOC entry 224 (class 1259 OID 27536)
-- Name: especialidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.especialidad (
    id_especialidad integer NOT NULL,
    nombre character varying(20) NOT NULL,
    descripcion text
);


ALTER TABLE public.especialidad OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 27535)
-- Name: especialidad_id_especialidad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.especialidad_id_especialidad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.especialidad_id_especialidad_seq OWNER TO postgres;

--
-- TOC entry 4922 (class 0 OID 0)
-- Dependencies: 223
-- Name: especialidad_id_especialidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.especialidad_id_especialidad_seq OWNED BY public.especialidad.id_especialidad;


--
-- TOC entry 226 (class 1259 OID 27547)
-- Name: guia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.guia (
    id_guia integer NOT NULL,
    dni character varying(20) NOT NULL,
    nombre character varying(50) NOT NULL,
    apellidos character varying(100) NOT NULL,
    id_especialidad integer NOT NULL,
    id_destino integer NOT NULL
);


ALTER TABLE public.guia OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 27546)
-- Name: guia_id_guia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.guia_id_guia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.guia_id_guia_seq OWNER TO postgres;

--
-- TOC entry 4923 (class 0 OID 0)
-- Dependencies: 225
-- Name: guia_id_guia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.guia_id_guia_seq OWNED BY public.guia.id_guia;


--
-- TOC entry 219 (class 1259 OID 27505)
-- Name: pasaporte; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pasaporte (
    numero character varying(50) NOT NULL,
    pais_exp character varying(50) NOT NULL,
    fecha_validez date NOT NULL
);


ALTER TABLE public.pasaporte OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 27510)
-- Name: posee; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.posee (
    dni_usuario character varying(20) NOT NULL,
    numero_pasaporte character varying(50) NOT NULL
);


ALTER TABLE public.posee OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 27494)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id_usuario integer NOT NULL,
    dni character varying(20),
    nombre character varying(50) NOT NULL,
    apellidos character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    edad integer NOT NULL,
    CONSTRAINT usuario_edad_check CHECK ((edad >= 18))
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 27493)
-- Name: usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuario_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 4924 (class 0 OID 0)
-- Dependencies: 217
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_id_usuario_seq OWNED BY public.usuario.id_usuario;


--
-- TOC entry 229 (class 1259 OID 27596)
-- Name: usuarios_destinos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios_destinos (
    id integer NOT NULL,
    id_usuario integer NOT NULL,
    id_destino integer NOT NULL,
    fecha_inscripcion date DEFAULT CURRENT_DATE
);


ALTER TABLE public.usuarios_destinos OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 27595)
-- Name: usuarios_destinos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_destinos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_destinos_id_seq OWNER TO postgres;

--
-- TOC entry 4925 (class 0 OID 0)
-- Dependencies: 228
-- Name: usuarios_destinos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_destinos_id_seq OWNED BY public.usuarios_destinos.id;


--
-- TOC entry 227 (class 1259 OID 27565)
-- Name: viajar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.viajar (
    dni_usuario character varying(20) NOT NULL,
    id_destino integer NOT NULL,
    fecha_viaje date DEFAULT CURRENT_DATE
);


ALTER TABLE public.viajar OWNER TO postgres;

--
-- TOC entry 4728 (class 2604 OID 27531)
-- Name: destino id_destino; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.destino ALTER COLUMN id_destino SET DEFAULT nextval('public.destino_id_destino_seq'::regclass);


--
-- TOC entry 4730 (class 2604 OID 27539)
-- Name: especialidad id_especialidad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.especialidad ALTER COLUMN id_especialidad SET DEFAULT nextval('public.especialidad_id_especialidad_seq'::regclass);


--
-- TOC entry 4731 (class 2604 OID 27550)
-- Name: guia id_guia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guia ALTER COLUMN id_guia SET DEFAULT nextval('public.guia_id_guia_seq'::regclass);


--
-- TOC entry 4727 (class 2604 OID 27497)
-- Name: usuario id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuario_id_usuario_seq'::regclass);


--
-- TOC entry 4733 (class 2604 OID 27599)
-- Name: usuarios_destinos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_destinos ALTER COLUMN id SET DEFAULT nextval('public.usuarios_destinos_id_seq'::regclass);


--
-- TOC entry 4749 (class 2606 OID 27534)
-- Name: destino destino_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.destino
    ADD CONSTRAINT destino_pkey PRIMARY KEY (id_destino);


--
-- TOC entry 4751 (class 2606 OID 27545)
-- Name: especialidad especialidad_nombre_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.especialidad
    ADD CONSTRAINT especialidad_nombre_key UNIQUE (nombre);


--
-- TOC entry 4753 (class 2606 OID 27543)
-- Name: especialidad especialidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.especialidad
    ADD CONSTRAINT especialidad_pkey PRIMARY KEY (id_especialidad);


--
-- TOC entry 4755 (class 2606 OID 27554)
-- Name: guia guia_id_guia_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guia
    ADD CONSTRAINT guia_id_guia_key UNIQUE (id_guia);


--
-- TOC entry 4757 (class 2606 OID 27552)
-- Name: guia guia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guia
    ADD CONSTRAINT guia_pkey PRIMARY KEY (dni);


--
-- TOC entry 4743 (class 2606 OID 27509)
-- Name: pasaporte pasaporte_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pasaporte
    ADD CONSTRAINT pasaporte_pkey PRIMARY KEY (numero);


--
-- TOC entry 4745 (class 2606 OID 27516)
-- Name: posee posee_numero_pasaporte_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posee
    ADD CONSTRAINT posee_numero_pasaporte_key UNIQUE (numero_pasaporte);


--
-- TOC entry 4747 (class 2606 OID 27514)
-- Name: posee posee_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posee
    ADD CONSTRAINT posee_pkey PRIMARY KEY (dni_usuario);


--
-- TOC entry 4737 (class 2606 OID 27502)
-- Name: usuario usuario_dni_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_dni_key UNIQUE (dni);


--
-- TOC entry 4739 (class 2606 OID 27504)
-- Name: usuario usuario_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_email_key UNIQUE (email);


--
-- TOC entry 4741 (class 2606 OID 27500)
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);


--
-- TOC entry 4761 (class 2606 OID 27602)
-- Name: usuarios_destinos usuarios_destinos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_destinos
    ADD CONSTRAINT usuarios_destinos_pkey PRIMARY KEY (id);


--
-- TOC entry 4759 (class 2606 OID 27570)
-- Name: viajar viajar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.viajar
    ADD CONSTRAINT viajar_pkey PRIMARY KEY (dni_usuario, id_destino);


--
-- TOC entry 4764 (class 2606 OID 27560)
-- Name: guia guia_id_destino_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guia
    ADD CONSTRAINT guia_id_destino_fkey FOREIGN KEY (id_destino) REFERENCES public.destino(id_destino) ON DELETE RESTRICT;


--
-- TOC entry 4765 (class 2606 OID 27555)
-- Name: guia guia_id_especialidad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.guia
    ADD CONSTRAINT guia_id_especialidad_fkey FOREIGN KEY (id_especialidad) REFERENCES public.especialidad(id_especialidad);


--
-- TOC entry 4762 (class 2606 OID 27517)
-- Name: posee posee_dni_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posee
    ADD CONSTRAINT posee_dni_usuario_fkey FOREIGN KEY (dni_usuario) REFERENCES public.usuario(dni) ON DELETE CASCADE;


--
-- TOC entry 4763 (class 2606 OID 27522)
-- Name: posee posee_numero_pasaporte_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posee
    ADD CONSTRAINT posee_numero_pasaporte_fkey FOREIGN KEY (numero_pasaporte) REFERENCES public.pasaporte(numero) ON DELETE CASCADE;


--
-- TOC entry 4768 (class 2606 OID 27608)
-- Name: usuarios_destinos usuarios_destinos_id_destino_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_destinos
    ADD CONSTRAINT usuarios_destinos_id_destino_fkey FOREIGN KEY (id_destino) REFERENCES public.destino(id_destino) ON DELETE CASCADE;


--
-- TOC entry 4769 (class 2606 OID 27603)
-- Name: usuarios_destinos usuarios_destinos_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios_destinos
    ADD CONSTRAINT usuarios_destinos_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario) ON DELETE CASCADE;


--
-- TOC entry 4766 (class 2606 OID 27571)
-- Name: viajar viajar_dni_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.viajar
    ADD CONSTRAINT viajar_dni_usuario_fkey FOREIGN KEY (dni_usuario) REFERENCES public.usuario(dni) ON DELETE CASCADE;


--
-- TOC entry 4767 (class 2606 OID 27576)
-- Name: viajar viajar_id_destino_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.viajar
    ADD CONSTRAINT viajar_id_destino_fkey FOREIGN KEY (id_destino) REFERENCES public.destino(id_destino) ON DELETE CASCADE;


-- Completed on 2025-04-23 21:00:04

--
-- PostgreSQL database dump complete
--

