<?php
use User\Backend\controllers\Home;
use User\Backend\controllers\tpController;
$router = new \Bramus\Router\Router();
session_start();

$router->mount('/api/typeproduct', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new tpController();
        $controller->index();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new tpController();
        $controller->addTP($_POST,$_FILES);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new tpController();
        $controller->viewTP($id);
    });
    //editar un objeto por id
    $router->post('/{id}', function($id) {
        $controller = new tpController();
        $controller->editTP($_POST,$_FILES,$id);
    });
    //eliminar objeto por id
    $router->delete('/{id}', function($id) {
        $controller = new tpController();
        $controller->deleteTP($id);
    });
});

$router ->get('/',function(){
    $controller = new Home();
    $controller->index();
});
$router ->post('/login',function(){
    echo "Hello World";
});
$router ->post('/register',function(){
    echo "Inicio como estamos";
});
$router ->get('/logout',function(){
    echo "Inicio como estamos";
});
$router->get('/user/{username}',function($username){
    echo "Inicio amigo como estamos ".$username;
});

$router->run();
/// https://youtu.be/4Nuyyoc2bPI?t=1284
//https://meet.google.com/vei-ybbg-evc?authuser=1