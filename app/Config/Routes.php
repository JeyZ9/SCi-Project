<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('usercontroller/index', 'UserController::index');
$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
    $routes->get('create-default-roles', 'User::createDefaultRoles');
});

$routes->group("api/activity", function ($routes) {
    $routes->get('/', 'Activity::index');
    $routes->get('(:num)', 'Activity::getActivityById/$1');
    $routes->post('/', 'Activity::addActivity');
});
