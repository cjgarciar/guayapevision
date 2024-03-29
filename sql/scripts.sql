CREATE TABLE IF NOT EXISTS EQUIPOS(
	ID SERIAL,
	NOMBRE TEXT,
	DESCRIPCION TEXT,
	CREATED_AT TIMESTAMP WITHOUT TIME ZONE DEFAULT NOW(),
	UPDATED_AT TIMESTAMP WITHOUT TIME ZONE,
	DELETED_AT TIMESTAMP WITHOUT TIME ZONE,
	CONSTRAINT EQUIPOS_pk PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS CALENDARIO_PARTIDOS (
	ID SERIAL,
	ID_EQUIPO INTEGER,
	ID_EQUIPO_2 INTEGER,	
	PRECIO NUMERIC,
	FECHA_HORA_INICIO TIMESTAMP WITHOUT TIME ZONE,
	FECHA_HORA_FIN TIMESTAMP WITHOUT TIME ZONE,
	CREATED_AT TIMESTAMP WITHOUT TIME ZONE DEFAULT NOW(),
	UPDATED_AT TIMESTAMP WITHOUT TIME ZONE,
	DELETED_AT TIMESTAMP WITHOUT TIME ZONE,
	CONSTRAINT CALENDARIO_PARTIDOS_pk PRIMARY KEY (id),
	CONSTRAINT EQUIPOS_fkey FOREIGN KEY (ID_EQUIPO)
        REFERENCES EQUIPOS (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	
	CONSTRAINT EQUIPOS2_fkey FOREIGN KEY (ID_EQUIPO_2)
        REFERENCES EQUIPOS (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

ALTER TABLE USERS ADD COLUMN TELEFONO TEXT;


CREATE TABLE IF NOT EXISTS PAGOS_PARTIDOS(
	ID SERIAL,
	ID_USER INTEGER,
	ID_CALENDARIO_PARTIDO INTEGER,
	CREATED_AT TIMESTAMP WITHOUT TIME ZONE DEFAULT NOW(),
	UPDATED_AT TIMESTAMP WITHOUT TIME ZONE,
	DELETED_AT TIMESTAMP WITHOUT TIME ZONE,
	CONSTRAINT PAGOS_PARTIDOS_pk PRIMARY KEY (id),
	CONSTRAINT ID_USER_fkey FOREIGN KEY (ID_USER)
        REFERENCES USERS (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	
	CONSTRAINT CALENDARIO_PARTIDOS_fkey FOREIGN KEY (ID_CALENDARIO_PARTIDO)
        REFERENCES CALENDARIO_PARTIDOS (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);


CREATE TABLE IF NOT EXISTS tbl_cuenta_paypal(
	id SERIAL not null primary key,
	email text,
	clientId text,
	secretKey text,	
	CREATED_AT TIMESTAMP WITHOUT TIME ZONE,
	UPDATED_AT TIMESTAMP WITHOUT TIME ZONE,
	DELETED_AT TIMESTAMP WITHOUT TIME ZONE	
);


drop table public.tbl_productos;
drop table public.tbl_inventario;
drop table public.tbl_cuadrillas_empleados;
drop table public.tbl_cuadrillas;
drop table public.tbl_asignaciones_tipo_empleado;
drop table public.tbl_asignaciones_inventario;
drop table public.ran_facturas;
drop table public.facturas;
drop table public.cat_unidades_medida;
drop table public.cat_sucursales;