<?php

$router = new \Bramus\Router\Router();
session_start();



$router ->get('/',function(){
    echo "Inicio como estamos";
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