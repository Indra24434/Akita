<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
   return redirect()->to(base_url('index.html'));

});


$routes->get('agenda', 'Agenda::index');
$routes->post('agenda', 'Agenda::create');
$routes->put('agenda/(:num)', 'Agenda::update/$1');
$routes->delete('agenda/(:num)', 'Agenda::delete/$1');



$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::doLogin');
$routes->get('auth/logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('kelola', function () {
        return view('admin/kelola');
    });
});

