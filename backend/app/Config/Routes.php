<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->resource('Admin');

$routes->post('/admin/validate', 'Admin::validateform');
$routes->post('/admin/indexi', 'Admin::indexi');
$routes->get('/admin/index', 'Admin::index');
$routes->get('/admin/logout', 'Admin::logout');
$routes->get('/admin/login', 'Admin::login');
$routes->get('/colors', 'Colors::index');
$routes->delete('/colors/delete/(:num)', 'Colors::delete/$1');

$routes->post('/colors/update', 'Colors::update');
$routes->post('/models/update/(:num)', 'Models::update/$1');
$routes->post('/product/show', 'Product::show');
$routes->get('/size/show', 'Size::show');
$routes->get('/product/count', 'Product::count');
$routes->get('/models', 'Models::index');
$routes->get('/size', 'Size::index');
$routes->get('/Product', 'Product::index');
$routes->post('/product/update/(:num)', 'Product::update/$1');
// $routes->post('/colors/add', 'Colors::create');
$routes->post('/models/add', 'Models::create');
$routes->resource('Models');
$routes->resource('Colors');
$routes->resource('Size');
$routes->resource('Product');

$routes->post('/product/add', 'Product::create');
