<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('Murid', ['controller' => 'MuridController']);
$routes->post('Murid/ubah/(:num)', 'MuridController::update/$1');

// yg kgak dikelompokin
// $routes->get('Murid', 'MuridController::index');
// $routes->get('Murid/(:num)', 'MuridController::show/$1');
// $routes->post('Murid', 'MuridController::create');
// $routes->put('Murid/(:num)', 'MuridController::update/$1');
// $routes->delete('Murid/(:num)', 'MuridController::delete/$1');