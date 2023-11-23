<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Product::index');
$routes->get('/product', 'Product::index');
$routes->get('/product/create', 'Product::create');
$routes->post('/product/create-product', 'Product::saveProduct');
$routes->get('/product/edit/(:num)', 'Product::edit/$1');
$routes->post('/product/edit-product', 'Product::saveEdit');
$routes->get('/product/find/(:alphanum)', 'Product::findProduct/$1');
