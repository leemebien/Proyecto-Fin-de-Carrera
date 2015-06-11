
/*Creando la Base de Datos*/
CREATE DATABASE dbguarderia
	DEFAULT CHARACTER SET utf8
  	DEFAULT COLLATE utf8_general_ci;


/*Creando las tablas*/

	/* Almacena los diferentes tipos que se usan para clasificar entidades, articulos u otras cosas del sistema */	
CREATE TABLE dbguarderia.tipo(
	id INT AUTO_INCREMENT,
	clave VARCHAR(255), /*  la "clave" será un identificador compuesto por las 3 primeras letras de la tabla a la que hace referencia seguido de otras 3 letras que hacen referencia al campo y de un numero consecutivo. Ejemplo (ent1, ent2, ...., ent23) */
	nombre VARCHAR(255),
	descripcion VARCHAR(255),
	PRIMARY KEY (id)
);

	/* Guarda cualquier persona fisica o juridica */
CREATE TABLE dbguarderia.entidad(
	id INT AUTO_INCREMENT,
	tipo INT, /* El tipo indica si es proveerdor, alumno, padre, profesora, etc */
	dni VARCHAR(255),
	nombre VARCHAR(255),
	apellido1 VARCHAR(255),
	apellido2 VARCHAR(255),
	direccion VARCHAR(255),
	telefono INT,
	movil INT,
	email VARCHAR(255),
	sexo ENUM('v','m'),
	fechanacimiento DATETIME,
	cuenta VARCHAR(255), /*Cuenta bancaria del empleado o de los proveedores y padres*/
	salario INT, /*El salario del empleado*/
	PRIMARY KEY (id),
	CONSTRAINT fk_entidad_tipo FOREIGN KEY (tipo) REFERENCES tipo(id)
);

	/*Guarda la relacion entre las diferentes entidades. Ejemplo: Alumno-Padre*/
CREATE TABLE dbguarderia.personaresponsable(
	id INT AUTO_INCREMENT, 
	alumno INT, 
	responsable INT, 
	tipo INT, /* El tipo indica que relacion existe entre la entidad 1 y la 2.*/
	PRIMARY KEY (id),
	CONSTRAINT fk_responsable_alumno FOREIGN KEY (alumno) REFERENCES entidad(id),
	CONSTRAINT fk_responsable_responsable FOREIGN KEY (responsable) REFERENCES entidad(id),
	CONSTRAINT fk_responsable_tipo FOREIGN KEY (tipo) REFERENCES tipo(id)
);

	/*Guarda los cursos que se dan en la empresa*/
CREATE TABLE dbguarderia.curso(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	fechainicio DATETIME, 
	fechafin DATETIME,
	PRIMARY KEY (id)
);

	/*Guarda los diferentes roles que pueden trabajar con el sistema*/
CREATE TABLE dbguarderia.rol(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255),  
	nivel INT NOT NULL DEFAULT 1,/* El nivel indica, en una escala del 1 al 10, las restricciones que tiene el rol. el 1 tiene todas als restricciones y el 10 ninguna restriccion. */
	PRIMARY KEY (id)
);

	/*Guarda los usuarios que tienen acceso al sistema*/
CREATE TABLE dbguarderia.usuario(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255),
	password VARCHAR(255),
	entidad INT, 
	rol INT, 
	estado BOOLEAN NOT NULL DEFAULT True, /* El estado indica si es un usuario activo o no. */
	PRIMARY KEY (id),
	CONSTRAINT fk_usuario_entidad FOREIGN KEY (entidad) REFERENCES entidad(id),
	CONSTRAINT fk_usuario_rol FOREIGN KEY (rol) REFERENCES rol(id)
);

	/*Guarda los diferentes platos que se realizan en la cocina*/
CREATE TABLE dbguarderia.plato(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	ingredientes VARCHAR(255),
	PRIMARY KEY (id)
);

	/*Guarda las digerentes dietas que pueden hacerse para los alumnos*/
CREATE TABLE dbguarderia.dieta(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255),
	PRIMARY KEY (id)
);

	/*Guarda la relacion entre los alumnos y las dietas*/
CREATE TABLE dbguarderia.entidaddieta(
	id INT AUTO_INCREMENT, 
	alumno INT, 
	dieta INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidaddieta_entidad FOREIGN KEY (alumno) REFERENCES entidad(id),
	CONSTRAINT fk_entidaddieta_dieta FOREIGN KEY (dieta) REFERENCES dieta(id)
);

	/*Guarda los diferentes menus que tiene cada dieta*/
CREATE TABLE dbguarderia.menu(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	dieta INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_menu_dieta FOREIGN KEY (dieta) REFERENCES dieta(id)
);

	/*Guarda el numero de platos que tiene cada menu*/
CREATE TABLE dbguarderia.lineamenu(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	menu INT, 
	plato INT, 
	orden INT,/* El orden indica el tipo de plato que es. Si es un primero, segundo o postre. */
	PRIMARY KEY (id),
	CONSTRAINT fk_lineamenu_menu FOREIGN KEY (menu) REFERENCES menu(id),
	CONSTRAINT fk_lineamenu_plato FOREIGN KEY (plato) REFERENCES plato(id),
	CONSTRAINT fk_lineamenu_tipo FOREIGN KEY (orden) REFERENCES tipo(id)
);

	/*Guarda los difetenes centros de los que se compone la empresa*/
CREATE TABLE dbguarderia.centro(
	id INT AUTO_INCREMENT,
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	direccion VARCHAR(255), 
	telefono INT,
	PRIMARY KEY (id)
);

	/* Guarda los datos de la empresa y de cualquier centro */
CREATE TABLE dbguarderia.empresa(
	id INT AUTO_INCREMENT,
	centro INT, /* Indica a cual centro pertenecen los datos que se muestran. 0 es la empresa */
	nombre VARCHAR(255), 
	direccion VARCHAR(255), 
	telefono INT,
	contacto INT, /* identificador de la persona de contacto */
	PRIMARY KEY (id),
	CONSTRAINT fk_empresa_entidad FOREIGN KEY (contacto) REFERENCES entidad(id)
);

	/* Guarda los mensajes que se muestran en la web de la empresa y de cada centro */
CREATE TABLE dbguarderia.contenidoweb(
	id INT AUTO_INCREMENT,
	empresa INT, /* identificador de la tabla empresa */
	centro INT, /* identificador de la tabla centro. 0 es la empresa */
	tipo INT, /* Indica en cual pagina se va a mostrar el mensaje */
	orden INT, /* Indica en cual orden de visualizacion se va a mostrar el mensaje */
	mensaje VARCHAR(2255),
	PRIMARY KEY (id),
	CONSTRAINT fk_contenidoweb_empresa FOREIGN KEY (empresa) REFERENCES empresa(id),
	/*CONSTRAINT fk_contenidoweb_centro FOREIGN KEY (centro) REFERENCES centro(id),*/
	CONSTRAINT fk_contenidoweb_tipo FOREIGN KEY (tipo) REFERENCES tipo(id)
);

	/*Guarda las salas que tiene la empresa*/
CREATE TABLE dbguarderia.sala(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	aforo INT, 
	tipo INT, /* El tipo indica si es aula, patio, comedor.... */
	estado INT, /* El estado indica si esta abierta, cerrada, limpia, sucia.... */
	centro INT, /* El centro indicará a cual escuela educativa pertenece la sala*/
	PRIMARY KEY (id),
	CONSTRAINT fk_sala_tipo_t FOREIGN KEY (tipo) REFERENCES tipo(id),
	CONSTRAINT fk_sala_tipo_e FOREIGN KEY (estado) REFERENCES tipo(id),
	CONSTRAINT fk_sala_centro FOREIGN KEY (centro) REFERENCES centro(id)
);

	/*Guarda un historico de cursos que ha tenido la empresa y los alumnos que han dado */
CREATE TABLE dbguarderia.entidadcursosala(
	id INT AUTO_INCREMENT, 
	entidad INT, 
	curso INT, 
	sala INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadcursosala_entidad FOREIGN KEY (entidad) REFERENCES entidad(id),
	CONSTRAINT fk_entidadcursosala_curso FOREIGN KEY (curso) REFERENCES curso(id),
	CONSTRAINT fk_entidadcursosala_sala FOREIGN KEY (sala) REFERENCES sala(id)
);

	/*Guarda los diferentes articulos con los que se trabaja en la empresa*/
CREATE TABLE dbguarderia.articulo(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	descripcion VARCHAR(255), 
	cantidad INT, 
	tipo INT, /* Tipo hace referencia a si es un articulo de cocina, material, etc */
	PRIMARY KEY (id),
	CONSTRAINT fk_articulo_tipo FOREIGN KEY (tipo) REFERENCES tipo(id)
);

	/*Guarda la relacion entre los articulos y las entidades como proveedores o padres.*/
CREATE TABLE dbguarderia.entidadarticulo(
	id INT AUTO_INCREMENT, 
	entidad INT, 
	articulo INT, 
	precio INT,/* El precio indica cuanto cuesta el articulo segun el proveedor que tenga. */
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadarticulo_entidad FOREIGN KEY (entidad) REFERENCES entidad(id),
	CONSTRAINT fk_entidadarticulo_articulo FOREIGN KEY (articulo) REFERENCES articulo(id)
);

	/*Guarda los informes que se van generando en la empresa*/
CREATE TABLE dbguarderia.informe(
	id INT AUTO_INCREMENT, 
	nombre VARCHAR(255), 
	concepto VARCHAR(255), 
	fechacreacion DATETIME, 
	fechaultimamodificacion DATETIME, 
	tipo INT, /*El tipo indica si es una notificacion, evaluacion, alerta, noticia o informe simplemente.*/
	estado INT, /*El estado indica si el informe se ha recibido, leido, respondido, etc.*/
	PRIMARY KEY (id),
	CONSTRAINT fk_informe_tipo FOREIGN KEY (tipo) REFERENCES tipo(id),
	CONSTRAINT fk_informe_estado FOREIGN KEY (estado) REFERENCES tipo(id)
);

	/*Guarda la descripcion del informe*/
CREATE TABLE dbguarderia.lineainforme(
	id INT AUTO_INCREMENT, 
	descripcion VARCHAR(255), 
	informe INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_lineainforme_informe FOREIGN KEY (informe) REFERENCES informe(id)
);

	/*Guarda la relacion que tienen los informes con las entidades o los articulos.*/
CREATE TABLE dbguarderia.entidadinforme(
	id INT AUTO_INCREMENT, 
	informe INT, 
	usuariocreador INT, 
	usuarioultimamodificacion INT, 
	articulo INT, 
	sala INT, 
	entidad INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadinforme_informe FOREIGN KEY (informe) REFERENCES informe(id),
	CONSTRAINT fk_entidadinforme_entidad_uc FOREIGN KEY (usuariocreador) REFERENCES entidad(id),
	CONSTRAINT fk_entidadinforme_entidad_uum FOREIGN KEY (usuarioultimamodificacion) REFERENCES entidad(id),
	CONSTRAINT fk_entidadinforme_articulo FOREIGN KEY (articulo) REFERENCES articulo(id),
	CONSTRAINT fk_entidadinforme_sala FOREIGN KEY (sala) REFERENCES sala(id),
	CONSTRAINT fk_entidadinforme_entidad_e FOREIGN KEY (entidad) REFERENCES entidad(id)
);

	/*Guarda los pedidos que se hacen*/
CREATE TABLE dbguarderia.pedido(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	saldo INT, 
	estado INT, /*El estado indica si esta pendiente, en proceso, por confirmar, etc*/
	PRIMARY KEY (id),
	CONSTRAINT fk_pedido_tipo FOREIGN KEY (estado) REFERENCES tipo(id)
);

	/*Guarda cada uno de los articulos que estan asociados al pedido*/
CREATE TABLE dbguarderia.lineapedido(
	id INT AUTO_INCREMENT, 
	articulo INT, 
	cantidad INT, 
	precio INT, 
	pedido INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_lineapedido_articulo FOREIGN KEY (articulo) REFERENCES articulo(id),
	CONSTRAINT fk_lineapedido_pedido FOREIGN KEY (pedido) REFERENCES pedido(id)
);

	/*Guarda la relacion entre el pedido y las entidades creadoras o proveedoras*/
CREATE TABLE dbguarderia.entidadpedido(
	id INT AUTO_INCREMENT, 
	pedido INT,
	creador INT, 
	destinatario INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadpedido_pedido FOREIGN KEY (pedido) REFERENCES pedido(id),
	CONSTRAINT fk_entidadpedido_entidad_c FOREIGN KEY (creador) REFERENCES entidad(id),
	CONSTRAINT fk_entidadpedido_entidad_d FOREIGN KEY (destinatario) REFERENCES entidad(id)
);

	/*Guarda las facturas que tiene la empresa*/
CREATE TABLE dbguarderia.factura(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	saldo INT, 
	estado INT, /*El estado indica si esta pendiente, en proceso, por confirmar, etc.*/
	PRIMARY KEY (id),
	CONSTRAINT fk_factura_tipo FOREIGN KEY (estado) REFERENCES tipo(id)
);

	/*Guarda cada uno de los articulos, o servicios, que estan asociados a la factura*/
CREATE TABLE dbguarderia.lineafactura(
	id INT AUTO_INCREMENT, 
	articulo INT, 
	cantidad INT, 
	precio INT, 
	factura INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_lineafactura_articulo FOREIGN KEY (articulo) REFERENCES articulo(id),
	CONSTRAINT fk_lineafactura_factura FOREIGN KEY (factura) REFERENCES factura(id)
);

	/*Guarda la relacion entre la factura y las entidades creadoras o acreedoras*/
CREATE TABLE dbguarderia.entidadfactura(
	id INT AUTO_INCREMENT, 
	factura INT,
	creador INT, 
	destinatario INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadpedido_factura FOREIGN KEY (factura) REFERENCES factura(id),
	CONSTRAINT fk_entidadfactura_entidad_c FOREIGN KEY (creador) REFERENCES entidad(id),
	CONSTRAINT fk_entidadfactura_entidad_d FOREIGN KEY (destinatario) REFERENCES entidad(id)
);

	/*Guarda los albaranes que tiene la empresa*/
CREATE TABLE dbguarderia.albaran(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	saldo INT, 
	estado INT, /*El estado indica si esta pendiente, en proceso, por confirmar, etc.*/
	PRIMARY KEY (id),
	CONSTRAINT fk_albaran_tipo FOREIGN KEY (estado) REFERENCES tipo(id)
);

	/*Guarda cada uno de los articulos que estan asociados al albaran*/
CREATE TABLE dbguarderia.lineaalbaran(
	id INT AUTO_INCREMENT, 
	articulo INT, 
	cantidad INT, 
	precio INT, 
	albaran INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_lineaalbaran_articulo FOREIGN KEY (articulo) REFERENCES articulo(id),
	CONSTRAINT fk_lineaalbaran_albaran FOREIGN KEY (albaran) REFERENCES albaran(id)
);

	/*Guarda la relacion entre el albaran y las entidades creadoras o proveedoras*/
CREATE TABLE dbguarderia.entidadalbaran(
	id INT AUTO_INCREMENT, 
	albaran INT,
	creador INT, 
	destinatario INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadpedido_albaran FOREIGN KEY (albaran) REFERENCES albaran(id),
	CONSTRAINT fk_entidadalbaran_entidad_c FOREIGN KEY (creador) REFERENCES entidad(id),
	CONSTRAINT fk_entidadalbaran_entidad_d FOREIGN KEY (destinatario) REFERENCES entidad(id)
);

	/*Guarda la relacion que existe entre los padidos, facturas y albaranes*/
CREATE TABLE dbguarderia.pedidofacturaalbaran(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	pedido INT, 
	factura INT, 
	albaran INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_pedidofacturaalbaran_pedido FOREIGN KEY (pedido) REFERENCES pedido(id),
	CONSTRAINT fk_pedidofacturaalbaran_factura FOREIGN KEY (factura) REFERENCES factura(id),
	CONSTRAINT fk_pedidofacturaalbaran_albaran FOREIGN KEY (albaran) REFERENCES albaran(id)
);

	/*Guarda las nominas de la empresa*/
CREATE TABLE dbguarderia.nomina(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	saldo INT, 
	estado INT, /*El estado indica si esta pendiente, en proceso, por confirmar, etc.*/
	PRIMARY KEY (id),
	CONSTRAINT fk_nomina_tipo FOREIGN KEY (estado) REFERENCES tipo(id)
);

	/*Guarda cada uno de los articulos, servicios o prestaciones que estan asociados a la nomina*/
CREATE TABLE dbguarderia.lineanomina(
	id INT AUTO_INCREMENT, 
	articulo INT, 
	cantidad INT, 
	precio INT, 
	nomina INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_lineanomina_articulo FOREIGN KEY (articulo) REFERENCES articulo(id),
	CONSTRAINT fk_lineanomina_nomina FOREIGN KEY (nomina) REFERENCES nomina(id)
);

	/*Guarda la relacion entre la nomina y las entidades creadoras o destinataria*/
CREATE TABLE dbguarderia.entidadnomina(
	id INT AUTO_INCREMENT, 
	nomina INT,
	creador INT, 
	destinatario INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_entidadpedido_nomina FOREIGN KEY (nomina) REFERENCES nomina(id),
	CONSTRAINT fk_entidadnomina_entidad_c FOREIGN KEY (creador) REFERENCES entidad(id),
	CONSTRAINT fk_entidadnomina_entidad_d FOREIGN KEY (destinatario) REFERENCES entidad(id)
);

	/*Guarda el libro de contabilidad de la empresa*/
CREATE TABLE dbguarderia.librocontabilidad(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	debe INT, 
	haber INT, 
	saldo INT,
	PRIMARY KEY (id)
);

	/*Guarda cada uno de los movimientos contables de la empresa*/
CREATE TABLE dbguarderia.linealibrocontabilidad(
	id INT AUTO_INCREMENT, 
	fecha DATETIME, 
	conceptop INT,  /*El concepto hace referencia al pedido, factura o nomina. */
	conceptof INT,  /*El concepto hace referencia al pedido, factura o nomina. */
	concepton INT,  /*El concepto hace referencia al pedido, factura o nomina. */
	descripcion VARCHAR(255), /*La descripcion hace referencia a un pequeño texto que describe el concepto por si es necesario.*/
	debe INT, 
	haber INT, 
	libro INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_linealibrocontabilidad_librocontabilidad FOREIGN KEY (libro) REFERENCES librocontabilidad(id),
	CONSTRAINT fk_linealibrocontabilidad_pedido FOREIGN KEY (conceptop) REFERENCES pedido(id),
	CONSTRAINT fk_linealibrocontabilidad_factura FOREIGN KEY (conceptof) REFERENCES factura(id),
	CONSTRAINT fk_linealibrocontabilidad_nomina FOREIGN KEY (concepton) REFERENCES nomina(id)
);



