<?php

error_reporting(E_ALL);
 ini_set('display_errors', 1);
/**
 * Add your routes here
 */
$app->get('/', function () use ($app) {
    echo $app['view']->getRender(null, 'index');
});

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->getRender(null, '404');
});

/**
 * get all users
 */
$app->get('/empresa', function () use ($app) {
    $phql = "select e.idEmpresa,e.nombreEmpresa from Empresas e";
    $empresas = $app->modelsManager->executeQuery($phql);
    $data = array();
    if (!empty($empresas)) {
        foreach ($empresas as $empresa) {
            $data[] = array(
                'id' => $empresa->idEmpresa,
                'name' => $empresa->nombreEmpresa
                
            );
        }
    }
    echo json_encode($data);
});



/**
 * get all users
 */
$app->get('/empresap', function () use ($app) {
   
            $data[] = array(
                'id' => 1,
                'name' => 'moises'
            );
        
    
    echo json_encode($data);
});