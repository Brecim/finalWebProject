<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/film/(:num)', 'Home::showFilm/$1');

$routes->get('/login', 'LoginController::login');
$routes->post('/auth', 'LoginController::auth');

$routes->group('admin', ['filter' => 'auth'] , static function ($routes){
    $routes->get('films', 'FilmManagementController::index');
	$routes->get('films/new', 'FilmManagementController::createForm');
	$routes->post('films', 'FilmManagementController::create');
	$routes->get('films/(:num)/edit', 'FilmManagementController::edit/$1');
	$routes->post('films/(:num)/update', 'FilmManagementController::update/$1');
	$routes->post('films/(:num)/delete', 'FilmManagementController::delete/$1');

});