<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('/registration','RegistrationController@onRegister');
$router->post('/login','LoginController@onLogin');
//$router->post('/tokenTest',['middleware'=>'auth','uses'=>'LoginController@tokenTest']);
$router->get('/',function(){
    return "hello world this is a phone book project ";

});

$router->post('/insert',['middleware'=>'auth','uses'=>'PhonebookController@onInsert']);
$router->post('/select',['middleware'=>'auth','uses'=>'PhonebookController@onSelect']);
$router->post('/delete',['middleware'=>'auth','uses'=>'PhonebookController@onDelete']);