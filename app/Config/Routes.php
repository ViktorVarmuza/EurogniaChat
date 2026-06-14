<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', function () {
    return redirect()->to('login');
});

$routes->get('logout', 'AuthController::logout');

//kontrola jestli nejsou uz prihlaseni pokud ano presmerovani primo do roomky
$routes->group('', ['filter' => 'unauth'], function ($routes) {
    $routes->post('register', 'AuthController::registerProcess');

    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::loginProcess');
});

//kontrola jestli jsou prihlaseni pokud ne presmerovani na /login
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('chat', 'ChatController::show');
    $routes->get('api/messages', 'Api\ApiController::index');
    $routes->post('api/send', 'Api\ApiController::create');
});
