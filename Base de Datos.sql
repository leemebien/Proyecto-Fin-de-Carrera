create database dbguarderia;

create table dbguarderia.relacion(
	id int,
	nombre varchar(255)
);

create table dbguarderia.categoria(
	id int,
	nombre varchar(255)
);

create table dbguarderia.plato(
	id int,
	nombre varchar(255)
);

create table dbguarderia.curso(
	id int,
	fecha_inicio date,
	fecha_fin date
);

create table dbguarderia.clase(
	id int,
	nombre varchar(255)
);

create table dbguarderia.alumno(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	padre int,
	madre int
);

create table dbguarderia.empleado(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	categoria int
);

create table dbguarderia.menu(
	id int,
	nombre varchar(255),
	plato1 varchar(255),
	plato2 varchar(255),
	postre varchar(255)
);

create table dbguarderia.padre(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255)
);

create table dbguarderia.responsable(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	relacion int
);

create table dbguarderia.emple_alum(
	empleado int,
	alumno int,
	curso int,
	clase int
);

create table dbguarderia.menu_alum(
	menu int,
	alumno int,
	curso int
);

create table dbguarderia.resp_alum(
	responsable int,
	alumno int,
	curso int
);

