<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', function () {
    return redirect()->to('login');
});

$routes->get('logout', 'AuthController::logout');


$routes->group('', ['filter' => 'unauth'], function ($routes) {
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::registerProcess');

    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::loginProcess');
});


$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('chat', 'ChatController::show');
    $routes->post('chat/send', 'ChatController::sendMessage');
});
