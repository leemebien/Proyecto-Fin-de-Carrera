<?php

use Phalcon\Mvc\Micro;

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
    $app = new Micro($di);

    /**
    * Incluimos las instruccion para la tabla Usuarios
    */
    include __DIR__ . "/../app/rest/Usuarios.php";

    /**
    * Incluimos las instruccion para la tabla Sesiones
    */
    include __DIR__ . "/../app/rest/Sesiones.php";

    /**
    * Incluimos las instruccion para la tabla Roles
    */
    include __DIR__ . "/../app/rest/Roles.php";

    /**
    * Incluimos las instruccion para la tabla Alumnos
    */
    include __DIR__ . "/../app/rest/Alumnos.php";


//    echo $application->handle()->getContent();
    echo $app->handle();

} catch (\Exception $e) {
    echo $e->getMessage();
}
