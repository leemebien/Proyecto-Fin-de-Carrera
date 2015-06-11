<?php

error_reporting(E_ALL);

try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";

    /**
     * Handle the request
     */
//    $application = new \Phalcon\Mvc\Application($di);
    $application = new \Phalcon\Mvc\Micro($di);    

    /*Incluimos las instrucciones para la tabla Tipo*/
    include __DIR__ . "/../app/rest/Tipo.php";

    /*Incluimos las instrucciones para la tabla Entidad*/
    include __DIR__ . "/../app/rest/Entidad.php";

    /*Incluimos las instrucciones para la tabla Personaresponsable*/
    include __DIR__ . "/../app/rest/Personaresponsable.php";

    /*Incluimos las instrucciones para la tabla Curso*/
    include __DIR__ . "/../app/rest/Curso.php";

    /*Incluimos las instrucciones para la tabla Rol*/
    include __DIR__ . "/../app/rest/Rol.php";

    /*Incluimos las instrucciones para la tabla Usuario*/
    include __DIR__ . "/../app/rest/Usuario.php";

    /*Incluimos las instrucciones para la tabla Plato*/
    include __DIR__ . "/../app/rest/Plato.php";

    /*Incluimos las instrucciones para la tabla Dieta*/
    include __DIR__ . "/../app/rest/Dieta.php";

    /*Incluimos las instrucciones para la tabla Etidaddieta*/
    include __DIR__ . "/../app/rest/Entidaddieta.php";

    /*Incluimos las instrucciones para la tabla Menu*/
    include __DIR__ . "/../app/rest/Menu.php";

    /*Incluimos las instrucciones para la tabla Lineamenu*/
    include __DIR__ . "/../app/rest/Lineamenu.php";

    /*Incluimos las instrucciones para la tabla Centro*/
    include __DIR__ . "/../app/rest/Centro.php";

    /*Incluimos las instrucciones para la tabla Sala*/
    include __DIR__ . "/../app/rest/Sala.php";

    /*Incluimos las instrucciones para la tabla Entidadcursosala*/
    include __DIR__ . "/../app/rest/Entidadcursosala.php";

    /*Incluimos las instrucciones para la tabla Articulo*/
    include __DIR__ . "/../app/rest/Articulo.php";

    /*Incluimos las instrucciones para la tabla Entidadarticulo*/
    include __DIR__ . "/../app/rest/Entidadarticulo.php";

    /*Incluimos las instrucciones para la tabla Informe*/
    include __DIR__ . "/../app/rest/Informe.php";

    /*Incluimos las instrucciones para la tabla Lineainforme*/
    include __DIR__ . "/../app/rest/Lineainforme.php";

    /*Incluimos las instrucciones para la tabla Entidadinforme*/
    include __DIR__ . "/../app/rest/Entidadinforme.php";

    /*Incluimos las instrucciones para la tabla Pedido*/
    include __DIR__ . "/../app/rest/Pedido.php";

    /*Incluimos las instrucciones para la tabla Lineapedido*/
    include __DIR__ . "/../app/rest/Lineapedido.php";

    /*Incluimos las instrucciones para la tabla Entidadpedido*/
    include __DIR__ . "/../app/rest/Entidadpedido.php";

    /*Incluimos las instrucciones para la tabla Factura*/
    include __DIR__ . "/../app/rest/Factura.php";

    /*Incluimos las instrucciones para la tabla Lineafactura*/
    include __DIR__ . "/../app/rest/Lineafactura.php";

    /*Incluimos las instrucciones para la tabla Entidadfactura*/
    include __DIR__ . "/../app/rest/Entidadfactura.php";

    /*Incluimos las instrucciones para la tabla Albaran*/
    include __DIR__ . "/../app/rest/Albaran.php";

    /*Incluimos las instrucciones para la tabla Lineaalbaran*/
    include __DIR__ . "/../app/rest/Lineaalbaran.php";

    /*Incluimos las instrucciones para la tabla Entidadalbaran*/
    include __DIR__ . "/../app/rest/Entidadalbaran.php";

    /*Incluimos las instrucciones para la tabla Pedidofacturaalbaran*/
    include __DIR__ . "/../app/rest/Pedidofacturaalbaran.php";

    /*Incluimos las instrucciones para la tabla Nomina*/
    include __DIR__ . "/../app/rest/Nomina.php";

    /*Incluimos las instrucciones para la tabla Lineanomina*/
    include __DIR__ . "/../app/rest/Lineanomina.php";

    /*Incluimos las instrucciones para la tabla Entidadnomina*/
    include __DIR__ . "/../app/rest/Entidadnomina.php";

    /*Incluimos las instrucciones para la tabla Librocontabilidad*/
    include __DIR__ . "/../app/rest/Librocontabilidad.php";

    /*Incluimos las instrucciones para la tabla Linealibrocontabilidad*/
    include __DIR__ . "/../app/rest/Linealibrocontabilidad.php";

//    echo $application->handle()->getContent();
    $application->handle();

} catch (\Exception $e) {
    echo $e->getMessage();
}
