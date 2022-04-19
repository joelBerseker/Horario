<?php
use User\Backend\controllers\Home;
use User\Backend\controllers\tpController;
use User\Backend\controllers\aController;
use User\Backend\controllers\rController;
use User\Backend\controllers\resController;
use User\Backend\controllers\uController;
use User\Backend\controllers\pController;
use User\Backend\controllers\thController;
use User\Backend\controllers\tdController;
use User\Backend\controllers\logController;
use User\Backend\controllers\tController;
use User\Backend\controllers\homeController;
$router = new \Bramus\Router\Router();
session_start();
//TypeProduct
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
    $router->post('/edit/{id}', function($id) { //colocar todos 
        $controller = new tpController();
        $controller->editTP($_POST,$_FILES,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {// '/delete/{id}' falta eliminar archivos generados tanto al actualizar como al borrar
        $controller = new tpController();
        $controller->deleteTP($id);
    });
});
//Role
$router->mount('/api/role', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new rController();
        $controller->rindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new rController();
        $controller->addR($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new rController();
        $controller->viewR($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new rController();
        $controller->editR($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new rController();
        $controller->deleteR($id);
    });
});
//Resource
$router->mount('/api/resource', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new resController();
        $controller->resindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new resController();
        $controller->addRes($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new resController();
        $controller->viewRes($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new resController();
        $controller->editRes($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new resController();
        $controller->deleteRes($id);
    });
});
//User
$router->mount('/api/user', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new uController();
        $controller->uindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new uController();
        $controller->addU($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new uController();
        $controller->viewU($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new uController();
        $controller->editU($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new uController();
        $controller->deleteU($id);
    });
});
//Access
$router->mount('/api/access', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new aController();
        $controller->aindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new aController();
        $controller->addA($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new aController();
        $controller->viewA($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new aController();
        $controller->editA($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new aController();
        $controller->deleteA($id);
    });
});
//Product
$router->mount('/api/product', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new pController();
        $controller->pindex($_GET);
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new pController();
        $controller->addP($_POST,$_FILES);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new pController();
        $controller->viewP($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new pController();
        $controller->editP($_POST,$_FILES,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new pController();
        $controller->deleteP($id);
    });
});
//TicketHeader
$router->mount('/api/ticketheader', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new thController();
        $controller->thindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new thController();
        $controller->addTH($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new thController();
        $controller->viewTH($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new thController();
        $controller->editTH($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new thController();
        $controller->deleteTH($id);
    });
});//Tabl
$router->mount('/api/tabl', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new tController();
        $controller->tindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new tController();
        $controller->addT($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new tController();
        $controller->viewT($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new tController();
        $controller->editT($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new tController();
        $controller->deleteT($id);
    });
});
//TickerDetail
$router->mount('/api/ticketdetail', function() use ($router) {
    //Obtener todos
    $router->get('/', function() {
        $controller = new tdController();
        $controller->tdindex();
    });
    //insertar objeto
    $router->post('/', function() {
        $controller = new tdController();
        $controller->addTD($_POST);
    });
    //obtener objeto por id
    $router->get('/{id}', function($id) {
        $controller = new tdController();
        $controller->viewTD($id);
    });
    //editar un objeto por id
    $router->post('/edit/{id}', function($id) {
        $controller = new tdController();
        $controller->editTD($_POST,$id);
    });
    //eliminar objeto por id
    $router->post('/delete/{id}', function($id) {
        $controller = new tdController();
        $controller->deleteTD($id);
    });
});

$router ->get('/user/active',function(){
    $user = unserialize($_SESSION['user']);
    $controller = new homeController($user);
    $controller->homeindex();
});
$router ->post('/login',function(){
    $controller = new logController();
    $controller->login($_POST);
});

$router ->get('/logout',function(){
    $controller = new logController();
    $controller->logout();
});

$router->run();
/// https://youtu.be/4Nuyyoc2bPI?t=1284
//https://meet.google.com/vei-ybbg-evc?authuser=1