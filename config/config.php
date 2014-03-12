<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => '173.194.82.189',
        'username' => 'root',
        'password' => 'palenrafe',
        'dbname' => 'dbProyectos',
    ),
    'application' => array(
        'modelsDir' => __DIR__ . '/../models/',
        'viewsDir' => __DIR__ . '/../views/',
        'baseUri' => '/',
    )
));

