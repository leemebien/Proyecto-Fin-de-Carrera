
/*Insertando valores de pruebas*/

INSERT INTO dbguarderia.tipo(id, clave, nombre, descripcion)
	VALUES(1,"enttip1","empleado_director","Director de empresa o centro"),
		(2,"enttip2","empleado_administrativo","Administrativo"),
		(3,"enttip3","empleado_profesor","Profesor"),
		(4,"enttip4","empleado_tecnico","Tecnico"),
		(5,"enttip5","empleado_auxiliar","Auxiliar"),
		(6,"enttip6","empleado_cocinero","Cocinero"),
		(7,"enttip7","alumno","Alumno"),
		(8,"enttip8","padre","Padre"),
		(9,"enttip9","persona_responsable","Persona responsable"),
		(10,"enttip10","proveedor","Proveedor"),
		(11,"enttip11","administrativo_publica","Administracion Publica"),

		(12,"restip1","padre","Padre de Alumno"),
		(13,"restip1","madre","Madre de Alumno"),
		(14,"restip1","abuelo","Abuelo de Alumno"),

		(15,"lmeord1","primero","Primer Plato"),
		(16,"lmeord2","segundo","Segundo Plato"),
		(17,"lmeord3","postre","Postre"),
		(18,"lmeord4","desayuno","Desayulo"),
		(19,"lmeord5","merienda","Merienda"),

		(20,"saltip1","Oficina","Oficina"),
		(21,"saltip2","Cocina","Cocina"),
		(22,"saltip3","Patio","Patio"),
		(23,"saltip4","Aula","Aula"),

		(24,"salest1","Cerrada","Cerrada"),
		(25,"salest2","Sucia","Sucia"),
		(26,"salest3","Limpia","Limpia"),

		(27,"arttip1","Alimento","Alimento"),
		(28,"arttip2","Oficina","Material de Oficina"),
		(29,"arttip3","Escolar","Material Escolar"),
		(30,"arttip4","Padres","Material de Padres ñam sí"),
		(31,"arttip5","Servicios","Servicios"),
		(32,"arttip6","Limpieza","Material de Limpieza"),
		(33,"arttip7","Menaje","Menaje"),
		(34,"arttip8","Prestacion","Prestacion"),

		(35,"inftip1","Notificacion","Notificacion"),
		(36,"inftip2","Evaluacion","Evaluacion"),
		(37,"inftip3","Alerta","Alerta"),
		(38,"inftip4","Noticia","Noticia"),
		(39,"inftip5","Simple","Informe Simple"),

		(40,"infest1","Enviado","Enviado"),
		(41,"infest2","Recibido","Recibido"),
		(42,"infest3","Leido","Leido"),
		(43,"infest4","Respondido","Respondido"),

		(44,"pedest1","Pendiente","Pendiente"),
		(45,"pedest2","Proceso","En proceso"),
		(46,"pedest3","Confirmar","Por confirmar"),
		(47,"pedest4","Terminado","Terminado"),

		(48,"facest1","Pendiente","Pendiente"),
		(49,"facest2","Proceso","En proceso"),
		(50,"facest3","Confirmar","Por confirmar"),
		(51,"facest4","Terminado","Terminado"),

		(52,"albest1","Pendiente","Pendiente"),
		(53,"albest2","Proceso","En proceso"),
		(54,"albest3","Confirmar","Por confirmar"),
		(55,"albest4","Terminado","Terminado"),

		(56,"nomest1","Pendiente","Pendiente"),
		(57,"nomest2","Proceso","En proceso"),
		(58,"nomest3","Confirmar","Por confirmar"),
		(59,"nomest4","Terminado","Terminado"),
		
		(60,"contip1","Pag_Home","Pagina Home"),
		(61,"contip2","Pag_About","Pagina About"),
		(62,"contip3","Pag_Contact","Pagina Contact"),
		(63,"contip4","Pag_xxx","Pagina xxx"),
		(64,"contip5","Pag_xxx","Pagina xxx");


INSERT INTO dbguarderia.entidad(id, tipo, dni, nombre, apellido1, apellido2, direccion, telefono, movil, email, sexo, fechanacimiento, cuenta, salario)
	VALUES(1,1,"00000000A","Administrador","Administrador","Administrador","Calle1",000000001,000000002,"Administrador@guarde.com",'v','2015-08-31',"cuenta",123450),
		(2,1,"00000000A","Director","Director","Director","Calle2",000000003,000000004,"Director@guarde.com",'v','2015-08-31',"cuenta",1001),
		(3,2,"00000000A","Administrativo","Administrativo","Administrativo","Calle3",000000005,000000006,"Administrativo@guarde.com",'v','2015-08-31',"cuenta",1002),
		(4,3,"00000000A","Profesor","Profesor","Profesor","Calle4",000000007,000000008,"Profesor@guarde.com",'v','2015-08-31',"cuenta",1003),
		(5,4,"00000000A","Tecnico","Tecnico","Tecnico","Calle5",000000009,000000010,"Tecnico@guarde.com",'v','2015-08-31',"cuenta",1004),
		(6,5,"00000000A","Auxiliar","Auxiliar","Auxiliar","Calle6",000000011,000000012,"Auxiliar@guarde.com",'v','2015-08-31',"cuenta",1005),
		(7,6,"00000000A","Cocinero","Cocinero","Cocinero","Calle7",000000013,000000014,"Cocinero@guarde.com",'v','2015-08-31',"cuenta",1006),
		(8,7,"00000000A","Alumno","Alumno","Alumno","Calle8",000000015,000000016,"Alumno@guarde.com",'v','2015-08-31',"cuenta",7),
		(9,8,"00000000A","Padre","Padre","Padre","Calle9",000000017,000000018,"Padre@guarde.com",'v','2015-08-31',"cuenta",1008),
		(10,9,"00000000A","Persona responsable","Persona responsable","Persona responsable","Calle10",000000019,000000020,"Persona_responsable@guarde.com",'v','2015-08-31',"cuenta",1009),
		(11,10,"00000000A","Proveedor","Proveedor","Proveedor","Calle11",000000021,000000022,"Proveedor@guarde.com",'v','2015-08-31',"cuenta",1010),
		(12,11,"00000000A","Administracion Publica","Administracion Publica","Administracion Publica","Calle12",000000023,000000024,"Administracion_Publica@guarde.com",'v','2015-08-31',"cuenta",1011),

		(13,7,"00000000A","Alumno2","Alumno2","Alumno2","Calle13",000000025,000000026,"Alumno2@guarde.com",'v','2015-08-31',"cuenta",12),
		(14,7,"00000000A","Alumno3","Alumno3","Alumno3","Calle14",000000027,000000028,"Alumno3@guarde.com",'m','2015-08-31',"cuenta",13),
		(15,7,"00000000A","Alumno4","Alumno4","Alumno4","Calle15",000000029,000000030,"Alumno4@guarde.com",'m','2015-08-31',"cuenta",14);


INSERT INTO dbguarderia.personaresponsable(id, alumno, responsable, tipo)
	VALUES(1,8,9,12),
		(2,8,10,14);


INSERT INTO dbguarderia.curso(id, nombre, descripcion, fechainicio, fechafin)
	VALUES(1,"Curso 14-15","Curso lectivo 2014-2015",'2014-09-01','2015-08-31'),
		(2,"Curso 15-16","Curso lectivo 2015-2016",'2015-09-01','2016-08-31'),
		(3,"Curso 16-17","Curso lectivo 2016-2017",'2016-09-01','2017-08-31');


INSERT INTO dbguarderia.rol(id, nombre, descripcion, nivel)
	VALUES(1,"dios","Usuario con plenos poderes",10),
		(2,"super_usuario","Super Usuario",9),
		(3,"administrativo","Usuario Administrativo",8),
		(4,"educador","Usuario Educador",5),
		(5,"padre","Usuario Padre",1);


INSERT INTO dbguarderia.usuario(id, nombre, password, entidad, rol, estado)
	VALUES(1,"dios","dios",1,1,true),
		(2,"director","director",2,2,true),
		(3,"administrativo","administrativo",3,3,true),
		(4,"padre","padre",9,5,true),
		(5,"profe","profe",4,4,true);


INSERT INTO dbguarderia.plato(id, nombre, descripcion, ingredientes)
	VALUES(1,"colacao","Vaso de leche con colacao","Leche, Colacao"),
		(2,"Sopa de fideos","sopa de pollo con fideos","Fideos, pollo, sal"),
		(3,"Tortilla de patatas","tortilla de patatas sin huevo","patata, huevo para alergicos"),
		(4,"Macarrones con atun","Macarrones con tomate y atun","macarrones, tomate, atun, oregano, sal"),
		(5,"Enblanco","Sopa de pencado","Pencado, patata, arroz"),
		(6,"Cocido","Potaje de garbanzos","Garbanzos, patata, pollo"),
		(7,"Lentejas","Potaje de lentejas","Lentejas, patata, chorizo, ajo, cebolla, tomate, pimiento verde, colorante alimenticio"),
		(8,"Pollo a la plancha","Filetes de pollo a la plancha con patatas fritas","pollo, perejil, sal, patata"),
		(9,"Yogur","Yogur de sabores","Leche, saborizante"),
		(10,"Fruta","Fruta de temporada","Fruta"),
		(11,"Flan","Flan de huevo","Huevo, leche, azucar"),
		(12,"Helado","Helados de diferentes sabores","Leche, azucar, saborizante"),
		(13,"Galletas","Galletas maria","Huevo, leche, azucar, harina, aceite, sal"),
		(14,"Madalenas","Madalenas de diferentes tamaños","Huevo, leche, azucar, harina, aceite, sal"),
		(15,"Tostadas de aceite y azucar","Revanadas de pan de molde tostado con un poco de aceite y azucar","Pan de molde, aceite, azucar");


INSERT INTO dbguarderia.dieta(id, nombre, descripcion)
	VALUES(1,"Normal","Dieta estandar"),
		(2,"Alergico a huevo","Dieta diseñada para alergicos al huevo"),
		(3,"Celiaco","Dieta diseñada para celiacos");


INSERT INTO dbguarderia.entidaddieta(id, alumno, dieta)
	VALUES(1,8,1),
		(2,13,2),
		(3,14,3),
		(4,15,1);


INSERT INTO dbguarderia.menu(id , nombre, descripcion, dieta)
	VALUES(1,"S1D1","Semana 1 Dia 1",1),
		(2,"S1D2","Semana 1 Dia 2",1),
		(3,"S1D3","Semana 1 Dia 3",1),
		(4,"S1D4","Semana 1 Dia 4",1),
		(5,"S1D5","Semana 1 Dia 5",1),
		(6,"S1D1","Semana 1 Dia 1",2),
		(7,"S1D2","Semana 1 Dia 2",2),
		(8,"S1D3","Semana 1 Dia 3",2),
		(9,"S1D4","Semana 1 Dia 4",2),
		(10,"S1D5","Semana 1 Dia 5",2),
		(11,"S1D1","Semana 1 Dia 1",3),
		(12,"S1D2","Semana 1 Dia 2",3),
		(13,"S1D3","Semana 1 Dia 3",3),
		(14,"S1D4","Semana 1 Dia 4",3),
		(15,"S1D5","Semana 1 Dia 5",3);


INSERT INTO dbguarderia.lineamenu(id, nombre, descripcion, menu, plato, orden)
	VALUES(1,"desayuno","Desayuno",1,1,18),
		(2,"comida","Comida",1,2,15),
		(3,"merienda","Merienda",1,14,19),
		(4,"desayuno","Desayuno",2,13,18),
		(5,"comida","Comida",2,3,16),
		(6,"postre","Postre",2,9,17),
		(7,"comida","Comida",3,8,15),
		(8,"postre","Postre",3,10,17),
		(9,"merienda","Merienda",3,15,19),
		(10,"desayuno","Desayuno",4,15,18),
		(11,"comida","Comida",4,7,16),
		(12,"postre","Postre",4,12,17),
		(13,"comida","Comida",5,6,15),
		(14,"postre","Postre",5,11,17),
		(15,"merienda","Merienda",5,13,19),

		(16,"desayuno","Desayuno",6,1,18),
		(17,"comida","Comida",6,8,16),
		(18,"merienda","Merienda",6,15,19),
		(19,"comida","Comida",7,2,15),
		(20,"postre","Postre",7,9,17),
		(21,"merienda","Merienda",7,10,19),
		(22,"desayuno","Desayuno",8,10,18),
		(23,"comida","Comida",8,7,16),
		(24,"merienda","Merienda",8,1,19),
		(25,"desayuno","Desayuno",9,15,18),
		(26,"comida","Comida",9,6,15),
		(27,"postre","Postre",9,10,17),
		(28,"desayuno","Desayuno",10,1,18),
		(29,"comida","Comida",10,8,16),
		(30,"postre","Postre",10,12,17),

		(31,"comida","Comida",11,2,15),
		(32,"postre","Postre",11,10,17),
		(33,"merienda","Merienda",11,10,19),
		(34,"desayuno","Desayuno",12,1,18),
		(35,"comida","Comida",12,8,16),
		(36,"merienda","Merienda",12,10,19),
		(37,"comida","Comida",13,6,15),
		(38,"postre","Postre",13,12,17),
		(39,"merienda","Merienda",13,10,19),
		(40,"desayuno","Desayuno",14,1,18),
		(41,"comida","Comida",14,8,16),
		(42,"postre","Postre",14,10,17),
		(43,"comida","Comida",15,7,15),
		(44,"postre","Postre",15,12,17),
		(45,"merienda","Merienda",15,10,19);


INSERT INTO dbguarderia.centro(id, nombre, descripcion, direccion, telefono)
	VALUES(1,"Centro1","Primer Centro","Calle 1",000000001),
		(2,"Centro2","Segundo Centro","Calle 2",000000002),
		(3,"Centro3","Tercer Centro","Calle 3",000000003);


INSERT INTO dbguarderia.empresa(id, centro, nombre, direccion, telefono, contacto)
	VALUES(1,0,"Grupo Gruarderias S.A.","calle guarderias",123456789, 2),
		(2,1,"Centro1","Calle 1",987654321,3),
		(3,2,"Centro2","Calle 2",147852369,4),
		(4,3,"Centro3","Calle 3",963258741,5);
		

INSERT INTO dbguarderia.contenidoweb(id, empresa, centro, tipo, orden, mensaje)
	VALUES(1,1,0,60,1,"Mensaje de la empresa para Home"),
		(2,1,0,61,1,"Mensaje de la empresa para About"),
		(3,1,0,62,1,"Mensaje de la empresa para Contact"),
		(4,2,1,60,1,"Mensaje de la Centro1 para Home"),
		(5,2,1,61,1,"Mensaje de la Centro1 para About"),
		(6,2,1,62,1,"Mensaje de la Centro1 para Contact"),
		(7,3,2,60,1,"Mensaje de la Centro2 para Home"),
		(8,3,2,61,1,"Mensaje de la Centro2 para About"),
		(9,3,2,62,1,"Mensaje de la Centro2 para Contact"),
		(10,4,3,60,1,"Mensaje de la Centro3 para Home"),
		(11,4,3,61,1,"Mensaje de la Centro3 para About"),
		(12,4,3,62,1,"Mensaje de la Centro3 para Contact");


INSERT INTO dbguarderia.sala(id, nombre, descripcion, aforo, tipo, estado, centro)
	VALUES(1,"Administracion","Administracion",1,20,26,1),
		(2,"Cocina","Cocina",1,21,26,1),
		(3,"Patio","Patio",30,22,25,1),
		(4,"Sandia","Aula Sandia",15,23,26,1),
		(5,"Manzana","Aula Manzana",15,23,26,1),
		(6,"Administracion","Administracion",1,20,26,2),
		(7,"Cocina","Cocina",1,21,26,2),
		(8,"Patio","Patio",30,22,25,2),
		(9,"Fresa","Aula Fresa",15,23,26,2),
		(10,"Cereza","Aula Cereza",15,23,26,2),
		(11,"Administracion","Administracion",1,20,25,3),
		(12,"Cocina","Cocina",1,21,25,3),
		(13,"Patio","Patio",30,22,26,3),
		(14,"Pera","Aula Pera",15,23,26,3),
		(15,"Melon","Aula Melon",15,23,24,3);


INSERT INTO dbguarderia.entidadcursosala(id, entidad, curso, sala)
	VALUES(1,1,1,1),
		(2,2,1,1),
		(3,4,1,4),
		(4,5,1,5),
		(5,7,1,2),
		(6,8,1,4),
		(7,13,1,5);


INSERT INTO dbguarderia.articulo(id, nombre, descripcion, cantidad, tipo)
	VALUES(1,"Patata","Patata",10,27),
		(2,"Yogur","Yogur",10,27),
		(3,"Grapadora","Grapadora",2,28),
		(4,"Ceras","Ceras de Colores",15,29),
		(5,"Pañales","Pañales",10,30),
		(6,"Aula Matinal","Aula Matinal",1,31),
		(7,"Lejia","Lejia",3,32),
		(8,"Olla","Olla",5,33),
		(9,"Almuerzo","Almuerzo",1,34),
		(10,"Body","Body",10,30),
		(11,"Parque de Bolas","Parque de Bolas",1,31),
		(12,"Salario","Salario",1,34);


INSERT INTO dbguarderia.entidadarticulo(id, entidad, articulo, precio)
	VALUES(1,11,1,2),
		(2,11,2,3),
		(3,11,3,6),
		(4,11,4,9),
		(5,9,5,0),
		(6,2,6,7),
		(7,11,7,3),
		(8,11,8,30),
		(9,2,9,10),
		(10,9,10,0),
		(11,4,12,1003),
		(12,5,12,1004),
		(13,4,9,6),
		(14,5,9,6);


INSERT INTO dbguarderia.informe(id, nombre, concepto, fechacreacion, fechaultimamodificacion, tipo, estado)
	VALUES(1,"Aviso","Aviso de inscripcion",'2014-09-01','2014-09-01',38,40),
		(2,"Evaluacion","Evaluacion Mensual",'2014-09-01','2014-09-01',36,41),
		(3,"Alergia","Comida Alergica",'2014-09-01','2014-09-01',37,42),
		(4,"Reposicion","Reponer material de alumno",'2014-09-01','2014-09-01',35,40),
		(5,"Limpieza","Limpiar la aula",'2014-09-01','2014-09-01',39,40);


INSERT INTO dbguarderia.lineainforme(id, descripcion, informe)
	VALUES(1,"El alumno ha comido huevo por accidente cuando otro alumno le ha ofrecido comida.",3),
		(2,"El alumno mejora sus aptitudes segun lo previsto en la planificacion anual.",2),
		(3,"La empresa informa que ya se ha abierto el plazo de matricula para el año que viene.",1),
		(4,"Se le solicita que suministre pañales para reponer la casilla del alumno.",4),
		(5,"Es necesario realizar la limpieza del aula.",5);


INSERT INTO dbguarderia.entidadinforme(id, informe, usuariocreador, usuarioultimamodificacion, articulo, sala, entidad)
	VALUES(1,3,5,5,null,null,13),
		(2,2,4,4,null,null,8),
		(3,1,3,3,null,null,null),
		(4,4,5,5,5,null,null),
		(5,5,6,6,null,4,null);


INSERT INTO dbguarderia.pedido(id, fecha, saldo, estado)
	VALUES(1,'2015-04-29',34,44),
		(2,'2015-04-30',0,46);


INSERT INTO dbguarderia.lineapedido(id, articulo, cantidad, precio, pedido)
	VALUES(1,1,2,2,1),
		(2,8,1,30,1),
		(3,5,2,0,2),
		(4,10,2,0,2);


INSERT INTO dbguarderia.entidadpedido(id, pedido, creador, destinatario)
	VALUES(1,1,7,11),
		(2,2,5,9);


INSERT INTO dbguarderia.factura(id, fecha, saldo, estado)
	VALUES(1,'2015-04-29',34,48),
		(2,'2015-04-30',0,50);


INSERT INTO dbguarderia.lineafactura(id, articulo, cantidad, precio, factura)
	VALUES(1,1,2,2,1),
		(2,8,1,30,1),
		(3,5,2,0,2),
		(4,10,2,0,2);


INSERT INTO dbguarderia.entidadfactura(id, factura, creador, destinatario)
	VALUES(1,1,7,11),
		(2,2,5,9);


INSERT INTO dbguarderia.albaran(id, fecha, saldo, estado)
	VALUES(1,'2015-04-29',34,52),
		(2,'2015-04-30',0,54);


INSERT INTO dbguarderia.lineaalbaran(id, articulo, cantidad, precio, albaran)
	VALUES(1,1,2,2,1),
		(2,8,1,30,1),
		(3,5,2,0,2),
		(4,10,2,0,2);


INSERT INTO dbguarderia.entidadalbaran(id, albaran, creador, destinatario)
	VALUES(1,1,7,11),
		(2,2,5,9);


INSERT INTO dbguarderia.pedidofacturaalbaran(id, fecha, pedido, factura, albaran)
	VALUES(1,'2015-04-29',1,1,1),
		(2,'2015-04-30',2,2,2);


INSERT INTO dbguarderia.nomina(id, fecha, saldo, estado)
	VALUES(1,'2015-04-29',1021,57),
		(2,'2015-04-29',1022,57);


INSERT INTO dbguarderia.lineanomina(id, articulo, cantidad, precio, nomina)
	VALUES(1,12,1,1003,1),
		(2,9,3,6,1),
		(3,12,1,1004,2),
		(4,9,3,6,2);


INSERT INTO dbguarderia.entidadnomina(id, nomina, creador, destinatario)
	VALUES(1,1,3,4),
		(2,2,3,5);


INSERT INTO dbguarderia.librocontabilidad(id, fecha, debe, haber, saldo)
	VALUES(1,'2014-09-01',1100,1500,400);


INSERT INTO dbguarderia.linealibrocontabilidad(id, fecha, conceptop, conceptof, concepton, descripcion, debe, haber, libro)
	VALUES(1,'2014-09-01',null,null,1,"una nomina",1100,0,1),
		(2,'2014-09-02',null,1,null,"una factura",0,1500,1),
		(3,'2015-04-29',1,null,null,"pedido al proveedor",0,34,1),
		(4,'2015-04-29',null,null,2,"nomina trabajador",1022,0,1);


/*----------------------------------------------------------------*/
INSERT INTO dbguarderia.menuweb(id, menu, private, ordenaparicion)
	VALUES(1,'index',0,1),
		(2,'about',0,3),
		(3,'blog',0,4),
		(4,'contact',0,5),
		(5,'usuario',0,0),
		(6,'errors',0,0),
		(7,'trabajo',1,2);


INSERT INTO dbguarderia.menuwebaction(id, action, menuweb)
	VALUES(1,'index',1),
		(2,'index',2),
		(3,'index',3),
		(4,'index',4),
		(5,'login',5),
		(6,'end',5),
		(7,'show401',6),
		(8,'show404',6),
		(9,'show500',6),
		(10,'index',7);
		

INSERT INTO dbguarderia.menuwebrol(id, menuweb, rol)
	VALUES(1,1,1),
		(2,1,2),
		(3,1,3),
		(4,1,4),
		(5,1,5);



