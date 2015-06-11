<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

use Phalcon\Mvc\Dispatcher as PhDispatcher;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter(array(
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        'charset' => $config->database->charset
    ));
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Creamos un Dispatcher para servicios o acciones no encontradas
 */
$di->set('dispatcher', function() use ($di) {
    //creamos el administrador de eventos
    $evManager = $di->getShared('eventsManager');
    //Enviar todos los eventos de Excpcion producidos en el Dispatcher al plugin de NotFount
    $evManager->attach('dispatch:beforeException', new NotFoundPlugin($di));
    //Enviar todos los eventos de Sesion producidos en el Dispatcher al plugin de Session
    $evManager->attach('dispatch:beforeDispatcher', new RolPlugin($di));
    //Creamos el Dispacher
    $dispatcher = new PhDispatcher();
    //Asociamos el manejador de eventos al Dispacher
    $dispatcher->setEventsManager($evManager);
    //Devolvemos el Dispacher
    return $dispatcher;
},true);


/**
* Registrar un servicio Flash con una clase CSS custom
*/
$di->set('flash', function() {
    return new Phalcon\Flash\Direct(array('error' => 'alert alert-error',
                                            'success' => 'alert alert-success',
                                            'notice' => 'alert alert-info'
                                        )
                                    );
});