
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
