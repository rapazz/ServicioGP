<?php
date_default_timezone_set("Chile/Continental");
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
$app->get('/listas/empresa', function () use ($app) {

    $phql = "select e.idEmpresa,e.nombreEmpresa from Empresas e";
    $empresas = $app->modelsManager->executeQuery($phql);
    $data = array();
    $response = new Phalcon\Http\Response();

    if (!empty($empresas)) {
        foreach ($empresas as $empresa) {
            $data[] = array(
                'id' => $empresa->idEmpresa,
                'nombre' => $empresa->nombreEmpresa

                
            );
        }
    }
    $response ->setJsonContent(array(
        'status'=>'FOUND',
        'Empresas'=>$data
    ));

    return $response;
});


$app->get('/listas/tipoAdjunto', function () use ($app) {

    $tipoAdjunto = Tipoadjunto::find();

    $response = new Phalcon\Http\Response();

    $data = array();

    if (!empty($tipoAdjunto)) {
        foreach ($tipoAdjunto as $e) {
            $data[] = array(
                'id' => $e->idtipoAdjunto,
                'nombre' => $e->tipoAdjunto


            );
        }
    }
    $response ->setJsonContent(array(
        'status'=>'FOUND',
        'tipoAdjunto'=>$data
    ));

    return $response;
});




$app->get('/listas/estrategiaProyecto', function () use ($app) {


    $estrategia = estrategiaProyecto::find();



    $data = array();
    $response = new Phalcon\Http\Response();
    if (!empty($estrategia)) {
        foreach ($estrategia as $e) {
            $data[] = array(
                'id' => $e->idEstrategia,
                'nombre' => $e->estrategiaProyecto


            );
        }
    }
    $response ->setJsonContent(array(
        'status'=>'FOUND',
        'Estrategia'=>$data
    ));

    return $response;
});

$app->get('/listas/salud', function () use($app){
    $phql = "select idsaludProyecto,saludProyecto from Saludproyecto";
    $saludProyecto = $app->modelsManager->executeQuery($phql);
    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($saludProyecto)) {
        foreach ($saludProyecto as $salud) {

            $data[] = array(
                'id' => $salud->idsaludProyecto,
                'nombre' => $salud->saludProyecto,

            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'saludProyecto'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;

});

$app->get('/listas/statusProyecto', function () use($app){
    $phql = "select idstatusProyecto,statusProyecto from Statusproyecto";
    $Statusproyecto = $app->modelsManager->executeQuery($phql);
    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($Statusproyecto)) {
        foreach ($Statusproyecto as $status) {

            $data[] = array(
                'id' => $status->idstatusProyecto,
                'nombre' => $status->statusProyecto,

            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'statusProyecto'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;

});


$app->get('/listas/etapaProyecto', function () use($app){
    $phql = "select idetapaProyecto,etapaProyecto from Etapaproyecto";
    $etapaProyecto = $app->modelsManager->executeQuery($phql);
    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($etapaProyecto)) {
        foreach ($etapaProyecto as $etapa) {

            $data[] = array(
                'id' => $etapa->idetapaProyecto,
                'nombre' => $etapa->etapaProyecto,

            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'etapaProyecto'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;

});





$app->get('/Users/{email}', function ($email) use($app){

 $phql = "select u.idUsers,u.rol,u.bP from Users u WHERE  u.idUsers = :email:";

    $users = $app->modelsManager->executeQuery($phql, array(
        'email'=>$email))->getFirst();
     $response = new Phalcon\Http\Response(); 

   if (!$users){
 $response->setStatusCode(401, "Usuario no Valido");
$response->setJsonContent(array('status'=>'USER-NOT-FOUND'));
   }else {
       $response->setStatusCode(200, "ok");
 // Crea tokens de usuario
$response->setHeader('token',$app->security->getToken() );
 $response->setHeader('tokenKey',$app->security->getTokenKey() );


$response ->setJsonContent(array(
'status'=>'USER-FOUND',
'user'=>array(
'id' => $users->idUsers,
'rol' =>$users->rol,
'bp' => $users ->bP

    )



    ));

   }


return $response;

});



$app->post('/proyecto/Planificacion', function() use ($app) {
    $request = new \Phalcon\Http\Request();
    $response = new Phalcon\Http\Response();


    $planificacion = new Planificacion();
    $planificacion->idproyecto=$request->get("idproyecto");
    $planificacion->mes1=$request->get("mes1");
    $planificacion->mes2=$request->get("mes2");
    $planificacion->mes3=$request->get("mes3");
    $planificacion->mes4=$request->get("mes4");
    $planificacion->estadoMes1=$request->get("estadoMes1");
    $planificacion->estadoMes2=$request->get("estadoMes2");
    $planificacion->estadoMes3=$request->get("estadoMes3");
    $planificacion->estadoMes4=$request->get("estadoMes4");
    $planificacion->fechacreacion=date('Y-m-d');
    $planificacion->activo =1;

    //Elimina los registros actuales

    Planificacion::find("idproyecto=" . $request->get("idproyecto"))->delete();

    if ($planificacion->create() != false) {
        $response->setStatusCode(201, "Created");



        $response->setJsonContent(array('status' => 'OK'));

    }
    else
    {

        $response->setStatusCode(409, "Conflict");

        //Send errors to the client
        $errors = array();
        foreach ($planificacion->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }

        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));

    }

    return $response;


});








$app->get('/proyecto/{id}/file',function($id) use ($app){

    $anexos = Anexos::find("idProyecto=" . $id);



    $data = array();
    $response = new Phalcon\Http\Response();
    if (!empty($anexos)) {
        foreach ($anexos as $e) {
            $data[] = array(
                'nombre' => $e->nombreAnexo,
                'url' =>'http://localhost/~mbravo/gestiondeProyectos/ServicioGP/public/'. $e->urlAnexo,
                'tipo' =>$e->Tipoadjunto->tipoAdjunto


            );
        }
    }
    $response ->setJsonContent(array(
        'status'=>'FOUND',
        'anexos'=>$data
    ));

    return $response;


});

$app ->post('/proyecto/{id}/file',function($id) use ($app){

    $response = new Phalcon\Http\Response();

   $request =  new \Phalcon\Http\Request();

   if ($request->hasFiles() == true) {

        //$fi = new finfo(FILEINFO_MIME, '../adjuntos/');
        foreach ($request->getUploadedFiles() as $file) {
            $objAnexo= json_decode($request->get("myObj"));
            $anexo = new Anexos();
            $anexo->idProyecto=$objAnexo->idProyecto;
            $anexo->idTipoAnexo= $objAnexo->tipoAdjunto;
            $anexo->activo=1;
            $anexo->nombreAnexo=$objAnexo->descripcion;
            $anexo->fechaCreacion =date('Y-m-d H:i:s');
            $anexo->urlAnexo='/adjuntos/'. $file->getName();



           $file->moveTo('adjuntos/' . $file->getName());

            if ($anexo->create() != false) {
                $response->setStatusCode(201, "Created");



                $response->setJsonContent(array('status' =>'OK'));

            }
            else
            {

                $response->setStatusCode(409, "Conflict");

                //Send errors to the client
                $errors = array();
                foreach ($anexo->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));

            }

        }

    }
else
{
    $response->setStatusCode(409, 'No se pudo cargar el archivo');



}



    return $response;

});

$app->post('/proyectos', function() use ($app) {

    $request = new \Phalcon\Http\Request();
    $response = new Phalcon\Http\Response();

    $proyecto = new Proyecto();
     $proyecto->nombreProyecto=$request->get("nombreProyecto");
     $proyecto->descripcionProyecto=$request->get("resumenEjecutivo");

     $proyecto->bpProyecto=$request->get("bpProyecto");
     $proyecto->fechaSolicitud=$request->get("fechaSolicitud");
     $proyecto->fechaTermino=$request->get("fechaTermino");
     $proyecto->nombreSolicitante=$request->get("nombreSolicitante");
     $proyecto->idEmpresa=$request->get("empresa");
     $proyecto->financiadoPor=$request->get("financiadoPor");
     $proyecto->idTipoProyecto=$request->get("idTipoProyecto");
     $proyecto->areaCliente=$request->get("areaCliente");
     $proyecto->costoOneOff=$request->get("costoOneOff");
     $proyecto->costoOnGoing=$request->get("costoOnGoing");
    $proyecto->beneficios=$request->get("beneficios");
    $proyecto->idTipoProyecto=$request->get("tipoProyecto");
     $proyecto ->avance =0;
     $proyecto -> comentarioAlcance = 0;
     $proyecto ->idSaludProyecto = $request->get("saludProyecto");
     $proyecto ->idEtapaProyecto= $request->get("etapaProyecto");
     $proyecto ->idStatusProyecto = 1; //$request->get("estadoProyecto");
    $proyecto ->jefeProyecto = $request->get("jefeProyecto");
     $proyecto -> bpProyecto = $request->get("jefeProyecto");  //$request->get("bP");
$proyecto -> idTipoEstrategiaProyecto =1;
     $proyecto ->desviacionPresupuesto = 0;
     $proyecto ->desviacionAlcance = 0;
     $proyecto ->desviacionTiempo =0;

    if ($proyecto->create() != false) {
        $response->setStatusCode(201, "Created");



        $response->setJsonContent(array('status' => 'OK'));

    }
    else
    {

        $response->setStatusCode(409, "Conflict");

        //Send errors to the client
        $errors = array();
        foreach ($proyecto->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }

        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));

    }

    return $response;
});




//Carga Proyecto por salud para el dashboard
$app->get('/{User}/Proyectos/Salud', function ($User) use($app){
    $response = new Phalcon\Http\Response();
    // Count employees grouping results by their area
$group = Proyecto::count(array( "conditions" => "(bpProyecto='" .$User ."' or jefeProyecto= '" .$User ."')","group" => "idSaludProyecto"));
    $data = array();
    if (!empty($group)) {
foreach ($group as $row) {
$data[] = array (
        'Tipo' => $row->idSaludProyecto,
        'cantidad' => $row->rowcount,
    );
}



    $response ->setJsonContent(array(

        'status'=>'FOUND',
        'porSalud'=>$data
    ));
    }
    else
    {

        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));
    }
    return $response;
});



$app->get('/{User}/Proyectos/listadoBP', function ($User) use($app){


    $phql = "select p.idProyecto, p.nombreProyecto,p.beneficios,e.nombreEmpresa, p.costoOneoff,p.costoOnGoing,s.saludProyecto,es.statusProyecto, ep.etapaProyecto,
     p.desviacionPresupuesto,p.desviacionAlcance,p.desviacionTiempo, epro.estrategiaProyecto, p.comentarioAlcance from Proyecto p JOIN Empresas e JOIN Saludproyecto s JOIN Statusproyecto es JOIN Etapaproyecto ep JOIN estrategiaProyecto epro
     where (bpProyecto='" .$User ."' or jefeProyecto= '" .$User ."')";

    $proyectos = $app->modelsManager->executeQuery($phql);

    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($proyectos)) {
        foreach ($proyectos as $proyecto) {

            $data[] = array(
                'idProyecto' => $proyecto->idProyecto,
                'nombreProyecto' => $proyecto->nombreProyecto,
                'nombreEmpresa' => $proyecto->nombreEmpresa,
                'beneficios' => $proyecto->beneficios,
                'costoOneoff' => $proyecto->costoOneoff,
                'costoOneGoing' => $proyecto->costoOnGoing,
                'saludProyecto' => $proyecto->saludProyecto,
                'statusProyecto' => $proyecto->statusProyecto,
                'etapaProyecto' => $proyecto->etapaProyecto,
                'desviacionPresupuesto' => $proyecto->desviacionPresupuesto,
                'desviacionAlcance' => $proyecto->desviacionAlcance,
                'desviacionTiempo' => $proyecto->desviacionTiempo,
                'estrategiaProyecto' =>$proyecto ->estrategiaProyecto,
                'comentarioAlcance' =>$proyecto ->comentarioAlcance
            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'proyectos'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;
});


$app->get('/{User}/Proyectos/listadoProgramacion', function ($User) use($app){


    $phql = "select p.nombreProyecto, pl.mes1, pl.mes2, pl.mes3, pl.mes4, e.etapaProyecto a, e2.etapaProyecto b, e3.etapaProyecto c, e4.etapaProyecto d, pl.activo from  Planificacion pl join Proyecto p join Etapaproyecto e on pl.estadoMes1=e.idetapaProyecto
    join Etapaproyecto e2 on pl.estadoMes2=e2.idetapaProyecto join Etapaproyecto e3 on pl.estadoMes3=e3.idetapaProyecto join Etapaproyecto e4 on pl.estadoMes4=e4.idetapaProyecto
    where (bpProyecto='" .$User ."' or jefeProyecto= '" .$User ."') and pl.activo=1";
    $programacion = $app->modelsManager->executeQuery($phql);

    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($programacion)) {
        foreach ($programacion as $prog) {

            $data[] = array(
                'nombreProyecto' => $prog->nombreProyecto,
                'mes1' => $prog->mes1,
                'mes2' => $prog->mes2,
                'mes3' => $prog->mes3,
                'mes4' => $prog->mes4,
                'estadoMes1' => $prog->a,
                'estadoMes2' => $prog->b,
                'estadoMes3' => $prog->c,
                'estadoMes4' => $prog->d

            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'programacion'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;
});


$app->get('/{User}/Proyectos/porTipo', function ($user) use($app){
    $response = new Phalcon\Http\Response();
    $phql = "select count(*) as rowcount,idEtapaProyecto, idStatusProyecto from Proyecto where (bpProyecto='" .$user ."' or jefeProyecto= '" .$user ."') group by idEtapaProyecto, idStatusProyecto ";
    $group = $app->modelsManager->executeQuery($phql);

    $phql = "select idetapaProyecto,etapaProyecto from Etapaproyecto";
    $etapaProyecto = $app->modelsManager->executeQuery($phql);

    $phql = "select idstatusProyecto,statusProyecto from Statusproyecto";
    $Statusproyecto = $app->modelsManager->executeQuery($phql);

    $tabla =array();

    $registro =array();
    foreach ($etapaProyecto as $row) {
        $status = array();
        foreach ($Statusproyecto as $s) {
            $valor =0;
            foreach ($group as $g) {
        if ($g->idStatusProyecto==$s->idstatusProyecto && $g->idEtapaProyecto==$row ->idetapaProyecto){
            $valor = $g->rowcount;

        }

            }

            $status[] =  $valor;
        }
        $tabla[]=array('etapa'=>$row->etapaProyecto,
            $Statusproyecto[0]-> statusProyecto=>$status[0],
        $Statusproyecto[1]-> statusProyecto=>$status[1],
            $Statusproyecto[2]-> statusProyecto=>$status[2],
            $Statusproyecto[3]-> statusProyecto=>$status[3]

        );


    }

    $response ->setJsonContent(array(
        'status'=>'FOUND',
        'porTipo'=>$tabla

    ));

    return $response;
});



$app->get('/proyecto/{id}/Planificacion', function ($id) use($app){


    $phql = "select p.nombreProyecto, pl.mes1, pl.mes2, pl.mes3, pl.mes4, e.etapaProyecto a, e2.etapaProyecto b, e3.etapaProyecto c, e4.etapaProyecto d, pl.fechacreacion,pl.activo from  Planificacion pl join Proyecto p join etapaproyecto e on pl.estadoMes1=e.idetapaProyecto
    join etapaproyecto e2 on pl.estadoMes2=e2.idetapaProyecto join etapaproyecto e3 on pl.estadoMes3=e3.idetapaProyecto join etapaproyecto e4 on pl.estadoMes4=e4.idetapaProyecto
    where (p.idProyecto= '" .$id ."') order by idPlanificacion";
    $programacion = $app->modelsManager->executeQuery($phql);

    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($programacion)) {
        foreach ($programacion as $prog) {

            $data[] = array(
                'fechaCreacion' => $prog->nombreProyecto,

                'mes1' => $prog->mes1,
                'mes2' => $prog->mes2,
                'mes3' => $prog->mes3,
                'mes4' => $prog->mes4,
                'estadoMes1' => $prog->a,
                'estadoMes2' => $prog->b,
                'estadoMes3' => $prog->c,
                'estadoMes4' => $prog->d,
                'fechacreacion'=>$prog->fechacreacion,
                'activo' =>$prog->activo

            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'programacion'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;
});


//NUEVOS METODOS


// Busca un proyecto  en base al ID

$app->get('/proyectos/{id}', function($id) use ($app) {

    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    $request = new \Phalcon\Http\Request();

    $token = $request->getHeader('TOKEN');
    $tokenKey = $request->getHeader('TOKENKEY');

  //  $token ='caa8a37dea732db5753027f80f3e4ed2';
  //  $tokenKey=null;



    if (!($app->security->checkToken($tokenKey,$token)) || $token==null || $tokenKey==null)
    {
        $response->setStatusCode(401,'Usuario sin autorizacion');
        $response->setJsonContent(array('status' => 'Error', 'messages' => 'Sin Autorizacion'));
return $response;
    }

// Proyecto
    $proyecto = Proyecto::findFirst("idProyecto=" . $id);


//programacion
    $phql = "select p.nombreProyecto, pl.mes1, pl.mes2, pl.mes3, pl.mes4, e.etapaProyecto a, e2.etapaProyecto b, e3.etapaProyecto c, e4.etapaProyecto d, pl.fechacreacion,pl.activo from  Planificacion pl join Proyecto p join etapaproyecto e on pl.estadoMes1=e.idetapaProyecto
    join etapaproyecto e2 on pl.estadoMes2=e2.idetapaProyecto join etapaproyecto e3 on pl.estadoMes3=e3.idetapaProyecto join etapaproyecto e4 on pl.estadoMes4=e4.idetapaProyecto
    where (p.idProyecto= '" .$id ."')";
    $programacion = $app->modelsManager->executeQuery($phql);

    $dataProgramacion = array();




    if (!empty($programacion)) {
        foreach ($programacion as $prog) {

            $dataProgramacion[] = array(
                'fechaCreacion' => $prog->nombreProyecto,

                'mes1' => $prog->mes1,
                'mes2' => $prog->mes2,
                'mes3' => $prog->mes3,
                'mes4' => $prog->mes4,
                'estadoMes1' => $prog->a,
                'estadoMes2' => $prog->b,
                'estadoMes3' => $prog->c,
                'estadoMes4' => $prog->d,
                'fechacreacion'=>$prog->fechacreacion,
                'activo' =>$prog->activo

            );

        }

    }


//Anexos
    $anexos = Anexos::find("idProyecto=" . $id);
    $dataAnexos = array();
    $response = new Phalcon\Http\Response();
    $request = new \Phalcon\Http\Request();
    if (!empty($anexos)) {
        foreach ($anexos as $e) {
            $dataAnexos[] = array(
                'nombre' => $e->nombreAnexo,
                'url' =>'http://localhost/~mbravo/gestiondeProyectos/ServicioGP/public/'. $e->urlAnexo,
                'tipo' =>$e->Tipoadjunto->tipoAdjunto


            );
        }
    }

    if ($proyecto != false) {
        $data = array(
            'id' => $proyecto->idProyecto,
            'nombreProyecto' =>$proyecto->nombreProyecto,
            'descripcionProyecto'=>$proyecto->descripcionProyecto,
            'jefeProyecto'=>$proyecto ->jefeProyecto,
            'bpProyecto'=>$proyecto->bpProyecto,
            'fechaSolicitud'=>$proyecto->fechaSolicitud,
            'fechaTermino'=>$proyecto->fechaTermino,
            'nombreSolicitante'=>$proyecto->nombreSolicitante,
            'idEmpresa'=>$proyecto->idEmpresa,
            'nombreEmpresa'=>$proyecto->Empresas->nombreEmpresa,
            'financiadoPor'=>$proyecto->financiadoPor,
            'areaCliente'=>$proyecto->areaCliente,
            'costoOneOff'=>$proyecto->costoOneOff,
            'costoOnGoing'=>$proyecto->costoOnGoing,
            'beneficios'=>$proyecto->beneficios,
            'idStatusProyecto'=>$proyecto->idStatusProyecto,
            'estatusProyecto'=>$proyecto->Statusproyecto->statusProyecto,
            'idEtapaProyecto'=>$proyecto->idEtapaProyecto,
            'etapaProyecto' =>$proyecto->Etapaproyecto->etapaProyecto,
            'idSaludProyecto'=>$proyecto->idSaludProyecto,
            'saludProyecto'=>$proyecto->Saludproyecto->saludProyecto,
            'idTipoEstrategiaProyecto'=>$proyecto->idTipoEstrategiaProyecto,
            'estrategiaProyecto'=>$proyecto->estrategiaProyecto->estrategiaProyecto,
            'avance' => $proyecto ->avance,
            'comentario' => $proyecto->comentarioAlcance,
            'desviacionPresupuesto' => $proyecto ->desviacionPresupuesto,
            'desviacionAlcance' =>  $proyecto ->desviacionAlcance,
            'desviacionTiempo' =>$proyecto ->desviacionTiempo,
            'anexos' =>$dataAnexos,
            'programacion' => $dataProgramacion

        );
        $response->setStatusCode(200,'Ok');
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'proyecto'=> $data

         ));
    }
    else
    {
        $response->setStatusCode(409, "Conflict");
        //Send errors to the client
        $errors = array();
        foreach ($proyecto->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }
        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));

    }

    return $response;

});



$app->post('/proyectos/{id}/avance', function($id) use ($app) {




    $request = new \Phalcon\Http\Request();
    $objHistorico= json_decode($request->get("proyecto"));


    // $avance = $app->request->getJsonRawBody();
    // Update Proyecto

  $historico = new  Historialproyecto();

    $historico->idProyecto = $id;
        $historico->  fechaCreacion =date('Y-m-d H:i:s');
          $historico->avance = $objHistorico->avance;
          $historico->comentario = $objHistorico->comentario;
          $historico->idSaludProyecto =$objHistorico->idSaludProyecto;
          $historico->idEtapaProyecto =$objHistorico->idEtapaProyecto;
          $historico->idStatusProyecto = $objHistorico->idStatusProyecto;
          $historico->desviacionPresupuesto =$objHistorico->desviacionPresupuesto;
          $historico->desviacionAlcance = $objHistorico->desviacionAlcance;
          $historico->desviacionTiempo = $objHistorico->desviacionTiempo;

    $response = new Phalcon\Http\Response();

    //Check if the insertion was successful
    if ($historico->create() != false) {

        $proyecto = Proyecto::findFirst("idProyecto=" . $id);

        if ($proyecto != false) {


            $proyecto ->avance =$objHistorico->avance;
            $proyecto -> comentarioAlcance = $objHistorico->comentario;
            $proyecto ->idSaludProyecto = $objHistorico->idSaludProyecto;
            $proyecto ->idEtapaProyecto= $objHistorico->idEtapaProyecto;
            $proyecto ->idStatusProyecto = $objHistorico->idStatusProyecto;
            $proyecto ->desviacionPresupuesto = $objHistorico->desviacionPresupuesto;
            $proyecto ->desviacionAlcance = $objHistorico->desviacionAlcance;
            $proyecto ->desviacionTiempo = $objHistorico->desviacionTiempo;

            if ($proyecto->update() != false) {
                $response->setStatusCode(201, "Created");





                $response->setJsonContent(array('status' => 'OK' ));

            }
            else
            {

                $response->setStatusCode(409, "Conflict");

                //Send errors to the client
                $errors = array();
                foreach ($status->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(array('status' => 'ERROR', 'messages' =>$errors));

            }
        }

        //Change the HTTP status


    } else {

        //Change the HTTP status
        $response->setStatusCode(409, "Conflict");

        //Send errors to the client
        $errors = array();
        foreach ($status->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }

        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));
    }

    return $response;
});

$app->get('/proyectos/{id}/avance', function ($id) use($app){

    $response = new Phalcon\Http\Response();
$historial = historialProyecto::findFirst(array("idProyecto=" . $id,"order"=>"fechaCreacion DESC"));

    if ($historial != false) {
        $data = array(

            'idStatusProyecto'=>$historial->idStatusProyecto,
            'estatusProyecto'=>$historial->Statusproyecto->statusProyecto,
            'idEtapaProyecto'=>$historial->idEtapaProyecto,
            'etapaProyecto' =>$historial->Etapaproyecto->etapaProyecto,
            'idSaludProyecto'=>$historial->idSaludProyecto,
           'saludProyecto'=>$historial->Saludproyecto->saludProyecto,
            'avance' => $historial ->avance,
            'comentario' => $historial->comentario,
            'desviacionPresupuesto' => $historial ->desviacionPresupuesto,
            'desviacionAlcance' =>  $historial ->desviacionAlcance,
            'desviacionTiempo' =>$historial ->desviacionTiempo

        );
              $response ->setJsonContent(array(
                  'status'=>'FOUND',
                  'avance'=> $data
              ));
    }

    return $response;


});

//trae el listado de proyectos para un usuario.
$app->get('/{User}/proyectos', function ($User) use($app){


    $phql = "select p.idProyecto, p.nombreProyecto,e.nombreEmpresa,p.fechaTermino,
     p.costoOneoff,p.costoOnGoing,s.saludProyecto,es.statusProyecto, ep.etapaProyecto
     from Proyecto p JOIN Empresas e JOIN Saludproyecto s JOIN Statusproyecto es JOIN
     Etapaproyecto ep where jefeProyecto='" .$User ."'";
    $proyectos = $app->modelsManager->executeQuery($phql);

    $data = array();
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'UTF-8');
    if (!empty($proyectos)) {
        foreach ($proyectos as $proyecto) {

            $data[] = array(
                'idProyecto' => $proyecto->idProyecto,
                'nombreProyecto' => $proyecto->nombreProyecto,
                'nombreEmpresa' => $proyecto->nombreEmpresa,
                'fechaTermino' => $proyecto->fechaTermino,
                'costoOneoff' => $proyecto->costoOneoff,
                'costoOneGoing' => $proyecto->costoOnGoing,
                'saludProyecto' => $proyecto->saludProyecto,
                'statusProyecto' => $proyecto->statusProyecto,
                'etapaProyecto' => $proyecto->etapaProyecto
            );

        }
        $response ->setJsonContent(array(
            'status'=>'FOUND',
            'proyectos'=>$data
        ));
    }
    else
    {
        $response->setJsonContent(array('status'=>'NOT-FOUND'));
    }
    return $response;
});

