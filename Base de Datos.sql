
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

