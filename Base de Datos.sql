
/*Creando la Base de Datos*/
create database dbguarderia;


/*---*/
/*Creando las tablas*/

	/* Indica los niveles de parentesco o relacion que tienen los alumnos con los responsables */
create table dbguarderia.relacion(
	id int,
	nombre varchar(255),
	primary key (id)
);

	/* Las diferentes categorias de empleados que existen */
create table dbguarderia.categoria(
	id int,
	nombre varchar(255),
	primary key (id)
);

	/* Nombre del plato que se elabora en la cocina */
create table dbguarderia.plato(
	id int,
	nombre varchar(255),
	descripcion varchar(255),
	primary key (id)
);

	/* Curso academico */
create table dbguarderia.curso(
	id int,
	nombre varchar(255),
	fecha_inicio date,
	fecha_fin date,
	primary key (id)
);

	/* Division de clases segun la edad */
create table dbguarderia.clase(
	id int,
	nombre varchar(255),
	rango varchar(255),
	primary key (id)
);

	/* actividad organizada para los alumnos */
create table dbguarderia.evento(
	id int,
	nombre varchar(225),
	descripcion varchar(225),
	autorizacion boolean,
	primary key (id)
);

	/* Imagenes de alumnos, eventos, etc */
create table dbguarderia.foto(
	id int,
	nombre varchar(255),
	direccion varchar(255),
	primary key (id)
);

	/* Indica los diferentes productos que se pueden almacenar */
create table dbguarderia.catalogo(
	id int,
	nombre varchar(255),
	foto int,
	primary key (id),
	constraint fk_catalogo_foto foreign key (foto) references foto(id)
);

	/* Indica las diferentes secciones en las que esta dividida la escuela infantil */
create table dbguarderia.seccion(
	id int,
	nombre varchar(255),
	primary key (id)
);

	/* informacion de los padres de cad alumno */
create table dbguarderia.padre(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	primary key (id)
);

	/* informacion de los alumnos */
create table dbguarderia.alumno(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	padre int,
	madre int,
	primary key (id),
	constraint fk_alumno_padre foreign key (padre) references padre(id),
	constraint fk_alumno_madre foreign key (madre) references padre(id)
);

	/* informacion de los empleados */
create table dbguarderia.empleado(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	categoria int,
	primary key (id),
	constraint fk_empleado_categoria foreign key (categoria) references categoria(id)
);

	/* platos que contiene cada menu */
create table dbguarderia.menu(
	id int,
	nombre varchar(255),
	plato1 int,
	plato2 int,
	postre int,
	primary key (id),
	constraint fk_menu_plato1 foreign key (plato1) references plato(id),
	constraint fk_menu_plato2 foreign key (plato2) references plato(id),
	constraint fk_menu_postre foreign key (postre) references plato(id)
);

	/* informacion de los responsables autorizados a recoger al alumno */
create table dbguarderia.responsable(
	id int,
	nombre varchar(255),
	ap1 varchar(255),
	ap2 varchar(255),
	relacion int,
	primary key (id),
	constraint fk_responsable_relacion foreign key (relacion) references relacion(id)
);

	/* Muestra la nomina de cada empleado */
create table dbguarderia.nomina(
	id int,
	empleado int,
	fecha date,
	cantidad int,
	primary key (id),
	constraint fk_nomina_empleado foreign key (empleado) references empleado(id)
);

	/* Muestra la contabilidad de la empresa */
create table dbguarderia.contabilidad(
	id int,
	fecha datetime,
	nombre varchar(255),
	descripcion varchar(255),
	empleado int,
	alumno int,
	catalogo int,
	debe int,
	haber int,
	primary key (id),
	constraint fk_contabilidad_empleado foreign key (empleado) references empleado(id),
	constraint fk_contabilidad_alumno foreign key (alumno) references alumno(id),
	constraint fk_contabilidad_catalogo foreign key (catalogo) references catalogo(id)
);

	/* Informa de lo ocurrido en cualquier situacion, evento o acontecimiento */
create table dbguarderia.informe(
	id int,
	fecha datetime,
	memoria varchar(255),
	primary key (id)
);

	/* Indica la evolucion del alumno a lo largo del curso */
create table dbguarderia.evolucion(
	id int,
	fecha datetime,
	alumno int,
	curso int,
	clase int,
	descripcion varchar(255),
	informe int,
	primary key (id),
	constraint fk_evolucion_alumno foreign key (alumno) references alumno(id),
	constraint fk_evolucion_curso foreign key (curso) references curso(id),
	constraint fk_evolucion_clase foreign key (clase) references clase(id),
	constraint fk_evolucion_informe foreign key (informe) references informe(id)
);

	/* Indica las notificaciones, noticias o anuncios para eventos o alumnos */
create table dbguarderia.notificacion(
	id int,
	nombre varchar(255),
	fecha datetime,
	texto varchar(255),
	curso int,
	clase int,
	evento int,
	alumno int,
	fecha_limite date,
	primary key (id),
	constraint fk_notificacion_curso foreign key (curso) references curso(id),
	constraint fk_notificacion_clase foreign key (clase) references clase(id),
	constraint fk_notificacion_evento foreign key (evento) references evento(id),
	constraint fk_notificacion_alumno foreign key (alumno) references alumno(id)
);

	/* Indica la cantidad de productos que hay para cad seccion o alumno */
create table dbguarderia.almacen(
	id int,
	producto int,
	cantidad int,
	seccion int,
	alumno int,
	primary key (id),
	constraint fk_almacen_producto foreign key (producto) references catalogo(id),
	constraint fk_almacen_seccion foreign key (seccion) references seccion(id),
	constraint fk_almacen_alumno foreign key (alumno) references alumno(id)
);

	/* Indica que profesor tiene cuales alumnos en un curso y una clase */
create table dbguarderia.emple_alum(
	empleado int,
	alumno int,
	curso int,
	clase int,
	primary key (empleado, alumno, curso, clase),
	constraint fk_emple_alum_empleado foreign key (empleado) references empleado(id),
	constraint fk_emple_alum_alumno foreign key (alumno) references alumno(id),
	constraint fk_emple_alum_curso foreign key (curso) references curso(id),
	constraint fk_emple_alum_clase foreign key (clase) references clase(id)
);

	/* Indica el menu que tiene cada alumno en cada curso */
create table dbguarderia.menu_alum(
	menu int,
	alumno int,
	curso int,
	primary key (menu, alumno, curso),
	constraint fk_menu_alum_menu foreign key (menu) references menu(id),
	constraint fk_menu_alum_alumno foreign key (alumno) references alumno(id),
	constraint fk_menu_alum_curso foreign key (curso) references curso(id)
);

	/* Indica los responsables autorizados para cada alumno */
create table dbguarderia.resp_alum(
	responsable int,
	alumno int,
	curso int,
	primary key (responsable, alumno, curso),
	constraint fk_resp_alum_responsable foreign key (responsable) references responsable(id),
	constraint fk_resp_alum_alumno foreign key (alumno) references alumno(id),
	constraint fk_resp_alum_curso foreign key (curso) references curso(id)
);

	/* Fotos relacionadas con cada alumno por curso */
create table dbguarderia.foto_alum(
	foto int,
	alumno int,
	curso int,
	primary key (foto, alumno, curso),
	constraint fk_foto_alum_foto foreign key (foto) references foto(id),
	constraint fk_foto_alum_alumno foreign key (alumno) references alumno(id),
	constraint fk_foto_alum_curso foreign key (curso) references curso(id)
);

	/* Indica los eventos en los que a participado cada alumno */
create table dbguarderia.even_alum(
	evento int,
	alumno int,
	curso int,
	foto int,
	informe int,
	primary key (evento, alumno, curso, foto),
	constraint fk_even_alum_evento foreign key (evento) references evento(id),
	constraint fk_even_alum_alumno foreign key (alumno) references alumno(id),
	constraint fk_even_alum_curso foreign key (curso) references curso(id),
	constraint fk_even_alum_foto foreign key (foto) references foto(id),
	constraint fk_even_alum_informe foreign key (informe) references informe(id)
);

	/* Indica los eventos en los que ha participado cada empleado */
create table dbguarderia.even_empl(
	evento int,
	empleado int,
	curso int,
	informe int,
	primary key (evento, empleado, curso),
	constraint fk_even_empl_evento foreign key (evento) references evento(id),
	constraint fk_even_empl_empleado foreign key (empleado) references empleado(id),
	constraint fk_even_empl_curso foreign key (curso) references curso(id),
	constraint fk_even_empl_informe foreign key (informe) references informe(id)
);

	/* Indica las fotos o imagenes relacionadas con cada notificacion */
create table dbguarderia.noti_foto(
	notificacion int,
	foto int,
	primary key (notificacion, foto),
	constraint fk_noti_foto_notificacion foreign key (notificacion) references notificacion(id),
	constraint fk_noti_foto_foto foreign key (foto) references foto(id)
);



/*---*/
/*Insertando valores de pruebas*/
insert into dbguarderia.relacion(id, nombre)
	values(1,"Padres - Familiar"),
		(2,"Hermanos - Familiar"),
		(3,"Tios - Familiar"),
		(4,"Abuelos - Familiar"),
		(5,"Primos - Familiar"),
		(6,"Padres Politicos - Familiar"),
		(7,"Vecinos"),
		(8,"Amigos"),
		(9,"Tutor Legal");

insert into dbguarderia.categoria(id, nombre)
	values(1,"Directora"),
		(2,"Cocinera"),
		(3,"Profesora"),
		(4,"Tecnico"),
		(5,"Auxiliar"),
		(6,"Administrativo");

insert into dbguarderia.plato(id, nombre, descripcion)
	values(1,"Sopa de fideos","sopa de pollo con fideos finos"),
		(2,"Lentejas","lentejas con arroz"),
		(3,"Cocido","cocido de garbanzos"),
		(4,"Tortilla de patatas","cuñas de tortilla de patatas con una cucharadita de tomate frito"),
		(5,"Filete con patatas","filete de pollo a la plancha con patatas fritas"),
		(6,"Pescado a la plancha con verduras","Filete de merluza a la plancha con judias, zanaorias y guisantes"),
		(7,"Yogur de sabores","Yogur de fresa, platano o limon"),
		(8,"Fruta variada","Una pieza de fruta a elegir entre manzana, pera o naranja"),
		(9,"Helado","Bola de helado de yogur con frutas");

insert into dbguarderia.curso(id, nombre, fecha_inicio, fecha_fin)
	values(1,"Curso 2012-2013","2012-09-01","2013-08-30"),
		(2,"Curso 2013-2014","2013-09-01","2014-08-30"),
		(3,"Curso 2014-2015","2014-09-01","2015-08-30"),
		(4,"Curso 2015-2016","2015-09-01","2016-08-30"),
		(5,"Curso 2016-2017","2016-09-01","2017-08-30"),
		(6,"Curso 2017-2018","2017-09-01","2018-08-30"),
		(7,"Curso 2018-2019","2018-09-01","2019-08-30"),
		(8,"Curso 2019-2020","2019-09-01","2020-08-30"),
		(9,"Curso 2020-2021","2020-09-01","2021-08-30");

insert into dbguarderia.clase(id, nombre, rango)
	values(1,"A1", "0 a 10 meses"),
		(2,"A2", "0 a 10 meses"),
		(3,"A3", "0 a 10 meses"),
		(4,"B1", "10 a 18 meses"),
		(5,"B2", "10 a 18 meses"),
		(6,"B3", "10 a 18 meses"),
		(7,"C1", "18 a 24 meses"),
		(8,"C2", "18 a 24 meses"),
		(9,"C3", "18 a 24 meses"),
		(10,"C3", "24 a 36 meses"),
		(11,"C3", "24 a 36 meses"),
		(12,"C3", "24 a 36 meses");

insert into dbguarderia.evento(id, nombre, descripcion, autorizacion)
	values(1,"Escursion Parque de Bolas","Desplazarse a un parque de bolas para que los alumnos jueguen",True),
		(2,"Fiesta de carnaval","Se realiza una fiesta de disfraces",false);

insert into dbguarderia.foto(id, nombre, direccion)
	values(1,"Escuela Infantil 1","xxx"),
		(2,"Escuela Infantil 2","xxx"),
		(3,"Yogur fresa","xxx"),
		(4,"Lentejas","xxx"),
		(5,"Helado","xxx"),
		(6,"Cocido","xxx"),
		(7,"Tortilla","xxx"),
		(8,"Clase 1","xxx"),
		(9,"Patio 1","xxx");

insert into dbguarderia.catalogo(id, nombre, foto)
	values(1,"Bottela de Agua",),
		(2,"Barra de Pan",),
		(3,"Cartulina",),
		(4,"Tijeras",),
		(5,"Pelota",),
		(6,"Vaso",),
		(7,"Pañal",),
		(8,"Toallita",),
		(9,"Plato",),
		(10,"Helado",5);

insert into dbguarderia.seccion(id, nombre)
	values(1,"Direccion"),
		(2,"Secretaria"),
		(3,"Cocina"),
		(4,"Patio"),
		(5,"Clase");

insert into dbguarderia.alumno(id, nombre, ap1, ap2, padre, madre)
	values(1,"Afrodita","Morales","Pino",1,2),
		(2,"Agata","Morales","Pino",1,2),
		(3,"Arturo","Jimenez","Jimenez",4,5),
		(4,"Amanda","Jimenez","Jimenez",4,5),
		(5,"Miguel","Muñoz","Rios",7,8),
		(6,"Jaime","Muñoz","Rios",7,8);

insert into dbguarderia.empleado(id, nombre, ap1, ap2, categoria)
	values(1,"Cristina","Pino","Ramirez",1),
		(2,"Samuel","Morales","Mangas",6),
		(3,"Monica","","",4),
		(4,"Paula","","",4),
		(5,"Ana","","",5);

insert into dbguarderia.menu(id, nombre, plato1, plato2, postre)
	values(1,"Lunes 1",1,4,7),
		(2,"Lunes 2",2,5,8),
		(3,"Lunes 3",3,6,9),
		(4,"Martes 1",1,5,9),
		(5,"Martes 2",2,4,8),
		(6,"Martes 3",3,6,7),
		(7,"Miercoles 1",3,4,8),
		(8,"Miercoles 2",2,6,7),
		(9,"Miercoles 3",1,5,9);

insert into dbguarderia.padre(id, nombre, ap1, ap2)
	values(1,"Samuel","Morales","Mangas"),
		(2,"Cristina","Prino","Ramirez"),
		(3,"Marina","Morales","Mangas"),
		(4,"Juan Miguel","Jimenez","Sanchez"),
		(5,"Jaira","Javier","Jimenez"),
		(6,"Rafael","Bravo","Perez"),
		(7,"Victor Tomas","Muñoz","Sanchez"),
		(8,"Macarena","Rios","Moreno"),
		(9,"Jose Ramon","Sanchez","Perez");

insert into dbguarderia.responsable(id, nombre, ap1, ap2, relacion)
	values(1,"Samuel","Morales","Mangas",1),
		(2,"Cristina","Prino","Ramirez",1),
		(3,"Marina","Morales","Mangas",3),
		(4,"Juan Miguel","Jimenez","Sanchez",1),
		(5,"Jaira","Javier","Jimenez",1),
		(6,"Rafael","Bravo","Perez",8),
		(7,"Victor Tomas","Muñoz","Sanchez",1),
		(8,"Macarena","Rios","Moreno",1);

insert into dbguarderia.nomina(id, empleado, fecha, cantidad)
	values(1,1,"2014-12-01",1000),
		(2,3,"2014-12-01",800),
		(3,4,"2014-12-01",800),
		(4,5,"2014-12-01",700),
		(5,1,"2015-01-01",1000),
		(6,3,"2015-01-01",800),
		(7,4,"2015-01-01",800),
		(8,5,"2015-01-01",700),
		(9,2,"2015-01-01",600);

insert into dbguarderia.contabilidad(id, fecha, nombre, descripcion, empleado, alumno, catalogo, debe, haber)
	values(),
		();

insert into dbguarderia.informe(id, fecha, memoria)
	values(),
		();

insert into dbguarderia.evolucion(id, fecha, alumno, curso, clase, descripcion, informe)
	values(),
		();

insert into dbguarderia.notificacion(id, nombre, fecha, texto, curso, clase, evento, alumno, fecha_limite)
	values(),
		();

insert into dbguarderia.almacen(id, producto, cantidad, seccion, alumno)
	values(),
		();

insert into dbguarderia.emple_alum(empleado, alumno, curso, clase)
	values(,,,),
		(,,,),
		(,,,),
		(,,,),
		(,,,),
		(,,,),
		(,,,),
		(,,,),
		(,,,);

insert into dbguarderia.menu_alum(menu, alumno, curso)
	values(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,);

insert into dbguarderia.resp_alum(responsable, alumno, curso)
	values(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,),
		(,,);

insert into dbguarderia.foto_alum(foto, alumno, curso)
	values(),
		();

insert into dbguarderia.even_alum(evento, alumno, curso, foto, informe)
	values(),
		();

insert into dbguarderia.even_empl(eveto, empleado, curso, informe)
	values(),
		();

insert into dbguarderia.noti_foto(notificacion, foto)
	values(),
		();
