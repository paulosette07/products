PGDMP                         x            softexpert_db    9.4.0    12.4 5               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16393    softexpert_db    DATABASE     ?   CREATE DATABASE softexpert_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE softexpert_db;
                postgres    false                       0    0    SCHEMA public    ACL     ?   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                   postgres    false    7                        3079    16384 	   adminpack 	   EXTENSION     A   CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;
    DROP EXTENSION adminpack;
                   false                       0    0    EXTENSION adminpack    COMMENT     M   COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';
                        false    1            ?            1259    16407    client    TABLE       CREATE TABLE public.client (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    cpf character varying(45),
    phone character varying(45),
    birthday date,
    insert_dt timestamp without time zone,
    update_dt timestamp without time zone
);
    DROP TABLE public.client;
       public            postgres    false            ?            1259    16405    client_id_seq    SEQUENCE     v   CREATE SEQUENCE public.client_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.client_id_seq;
       public          postgres    false    175                       0    0    client_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;
          public          postgres    false    174            ?            1259    16426    product    TABLE       CREATE TABLE public.product (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    note text,
    price numeric(10,2) NOT NULL,
    product_type_id integer NOT NULL,
    insert_dt timestamp without time zone,
    update_dt timestamp without time zone
);
    DROP TABLE public.product;
       public            postgres    false            ?            1259    16424    product_id_seq    SEQUENCE     w   CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.product_id_seq;
       public          postgres    false    179                       0    0    product_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;
          public          postgres    false    178            ?            1259    16415    product_type    TABLE     ?   CREATE TABLE public.product_type (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    note text,
    tax real NOT NULL,
    insert_dt timestamp without time zone,
    update_dt timestamp without time zone
);
     DROP TABLE public.product_type;
       public            postgres    false            ?            1259    16413    product_type_id_seq    SEQUENCE     |   CREATE SEQUENCE public.product_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.product_type_id_seq;
       public          postgres    false    177                       0    0    product_type_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.product_type_id_seq OWNED BY public.product_type.id;
          public          postgres    false    176            ?            1259    16443    sale    TABLE     ?  CREATE TABLE public.sale (
    id integer NOT NULL,
    date date NOT NULL,
    total_price numeric(10,2) NOT NULL,
    total_tax numeric(10,2) NOT NULL,
    note text,
    status integer DEFAULT 1,
    client_id integer NOT NULL,
    insert_dt timestamp without time zone,
    update_dt timestamp without time zone
);
    DROP TABLE public.sale;
       public            postgres    false            ?            1259    16441    sale_id_seq    SEQUENCE     t   CREATE SEQUENCE public.sale_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.sale_id_seq;
       public          postgres    false    181                       0    0    sale_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.sale_id_seq OWNED BY public.sale.id;
          public          postgres    false    180            ?            1259    16460    sale_product    TABLE       CREATE TABLE public.sale_product (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    amount integer NOT NULL,
    price numeric(10,2) NOT NULL,
    tax numeric(10,2) NOT NULL,
    product_id integer NOT NULL,
    sale_id integer NOT NULL
);
     DROP TABLE public.sale_product;
       public            postgres    false            ?            1259    16458    sale_product_id_seq    SEQUENCE     |   CREATE SEQUENCE public.sale_product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.sale_product_id_seq;
       public          postgres    false    183                       0    0    sale_product_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.sale_product_id_seq OWNED BY public.sale_product.id;
          public          postgres    false    182            ?            1259    16489    sys_user    TABLE     0  CREATE TABLE public.sys_user (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(64) NOT NULL,
    status integer DEFAULT 1,
    insert_dt timestamp without time zone,
    update_dt timestamp without time zone
);
    DROP TABLE public.sys_user;
       public            postgres    false            ?            1259    16487    sys_user_id_seq    SEQUENCE     x   CREATE SEQUENCE public.sys_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.sys_user_id_seq;
       public          postgres    false    185                       0    0    sys_user_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.sys_user_id_seq OWNED BY public.sys_user.id;
          public          postgres    false    184            }           2604    16410 	   client id    DEFAULT     f   ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);
 8   ALTER TABLE public.client ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    175    174    175                       2604    16429 
   product id    DEFAULT     h   ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);
 9   ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    179    178    179            ~           2604    16418    product_type id    DEFAULT     r   ALTER TABLE ONLY public.product_type ALTER COLUMN id SET DEFAULT nextval('public.product_type_id_seq'::regclass);
 >   ALTER TABLE public.product_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    176    177    177            ?           2604    16446    sale id    DEFAULT     b   ALTER TABLE ONLY public.sale ALTER COLUMN id SET DEFAULT nextval('public.sale_id_seq'::regclass);
 6   ALTER TABLE public.sale ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    181    180    181            ?           2604    16463    sale_product id    DEFAULT     r   ALTER TABLE ONLY public.sale_product ALTER COLUMN id SET DEFAULT nextval('public.sale_product_id_seq'::regclass);
 >   ALTER TABLE public.sale_product ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    183    182    183            ?           2604    16492    sys_user id    DEFAULT     j   ALTER TABLE ONLY public.sys_user ALTER COLUMN id SET DEFAULT nextval('public.sys_user_id_seq'::regclass);
 :   ALTER TABLE public.sys_user ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    184    185    185                      0    16407    client 
   TABLE DATA           V   COPY public.client (id, name, cpf, phone, birthday, insert_dt, update_dt) FROM stdin;
    public          postgres    false    175   ?;                 0    16426    product 
   TABLE DATA           _   COPY public.product (id, name, note, price, product_type_id, insert_dt, update_dt) FROM stdin;
    public          postgres    false    179   j<                 0    16415    product_type 
   TABLE DATA           Q   COPY public.product_type (id, name, note, tax, insert_dt, update_dt) FROM stdin;
    public          postgres    false    177   `=       	          0    16443    sale 
   TABLE DATA           o   COPY public.sale (id, date, total_price, total_tax, note, status, client_id, insert_dt, update_dt) FROM stdin;
    public          postgres    false    181   ?=                 0    16460    sale_product 
   TABLE DATA           Y   COPY public.sale_product (id, name, amount, price, tax, product_id, sale_id) FROM stdin;
    public          postgres    false    183   7>                 0    16489    sys_user 
   TABLE DATA           [   COPY public.sys_user (id, name, email, password, status, insert_dt, update_dt) FROM stdin;
    public          postgres    false    185   ?>                  0    0    client_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.client_id_seq', 13, true);
          public          postgres    false    174                       0    0    product_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.product_id_seq', 7, true);
          public          postgres    false    178                       0    0    product_type_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.product_type_id_seq', 4, true);
          public          postgres    false    176                       0    0    sale_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.sale_id_seq', 17, true);
          public          postgres    false    180                        0    0    sale_product_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.sale_product_id_seq', 33, true);
          public          postgres    false    182            !           0    0    sys_user_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.sys_user_id_seq', 1, true);
          public          postgres    false    184            ?           2606    16412    client client_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.client DROP CONSTRAINT client_pkey;
       public            postgres    false    175            ?           2606    16435    product product_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    179            ?           2606    16423    product_type product_type_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.product_type
    ADD CONSTRAINT product_type_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.product_type DROP CONSTRAINT product_type_pkey;
       public            postgres    false    177            ?           2606    16452    sale sale_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.sale
    ADD CONSTRAINT sale_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.sale DROP CONSTRAINT sale_pkey;
       public            postgres    false    181            ?           2606    16468    sale_product sale_product_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.sale_product
    ADD CONSTRAINT sale_product_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.sale_product DROP CONSTRAINT sale_product_pkey;
       public            postgres    false    183            ?           2606    16498    sys_user sys_user_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sys_user
    ADD CONSTRAINT sys_user_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sys_user DROP CONSTRAINT sys_user_pkey;
       public            postgres    false    185            ?           2606    16436 $   product product_product_type_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_product_type_id_fkey FOREIGN KEY (product_type_id) REFERENCES public.product_type(id);
 N   ALTER TABLE ONLY public.product DROP CONSTRAINT product_product_type_id_fkey;
       public          postgres    false    1928    179    177            ?           2606    16453    sale sale_client_id_fkey    FK CONSTRAINT     z   ALTER TABLE ONLY public.sale
    ADD CONSTRAINT sale_client_id_fkey FOREIGN KEY (client_id) REFERENCES public.client(id);
 B   ALTER TABLE ONLY public.sale DROP CONSTRAINT sale_client_id_fkey;
       public          postgres    false    1926    181    175            ?           2606    16469 )   sale_product sale_product_product_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.sale_product
    ADD CONSTRAINT sale_product_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.product(id);
 S   ALTER TABLE ONLY public.sale_product DROP CONSTRAINT sale_product_product_id_fkey;
       public          postgres    false    179    183    1930            ?           2606    16474 &   sale_product sale_product_sale_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.sale_product
    ADD CONSTRAINT sale_product_sale_id_fkey FOREIGN KEY (sale_id) REFERENCES public.sale(id);
 P   ALTER TABLE ONLY public.sale_product DROP CONSTRAINT sale_product_sale_id_fkey;
       public          postgres    false    1932    181    183               j   x?3?H,???4G NsK?4??0?50?52?4202?5??54W02?26?B32P02?20?21?24?????Sp?O????"?fKC?f#+S4͆fV?\1z\\\ b         ?   x?u??N?@@?w???5?;/??NC?&?DWl?0?????~?k????MLH]?Gι???2?w|??.V]=F?V??c???w??????M4%?M(????<?Z?v?/?h???c>I??2?R^??A?I(\y??Q78??`uY?`ۓǓ??5????m??{cq?̟3?K?U?g?????v??_Mv??n?9i??4???q_?:?b????k;e?? ʏ^p         ]   x?3???K?/?=??$39??44?4202?5??5?P02?2??2?????2?t?I-):?%/39??44DWldej??T04?21?24?????? ?x?      	   Z   x?U??? ?w2E 9?@?!:??Q???Òe?u!??+Rd?v?5n?XYv?q?????چ??????B???*?:7YU???         ?   x?M̱?0??n?? ???D@A???hd$?????9X;??_????????5???~?~?os?"%;?-?p?6w`?^Ͷ
~?B?>?W҂th?4?Q?A??q???X8??Z?Q???L[̵A?P?'?         M   x?3?tL????,.)J,?/?L???^r~.?????Q???y?)%??[X?$??$Z?%sr??W? ς?     