<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/data_produk', 'Produk::index');
$routes->get('/data_produk/create', 'Produk::create');
$routes->post('/data_produk/store', 'Produk::store');
$routes->get('/data_produk/edit/(:num)', 'Produk::edit/$1');
$routes->post('/data_produk/update/(:num)', 'Produk::update/$1');
$routes->get('/data_produk/delete/(:num)', 'Produk::delete/$1');

// app/Config/Routes.php
$routes->get('/data_transaksi', 'Transaksi::index');
$routes->get('/data_transaksi/create', 'Transaksi::create');
$routes->post('/data_transaksi/store', 'Transaksi::store');
$routes->get('/data_transaksi/edit/(:num)', 'Transaksi::edit/$1');
$routes->post('/data_transaksi/update/(:num)', 'Transaksi::update/$1');
$routes->get('/data_transaksi/delete/(:num)', 'Transaksi::delete/$1');
$routes->get('/data_transaksi/bayar/(:num)', 'Transaksi::bayar/$1');
$routes->post('/data_transaksi/bayar/(:num)', 'Transaksi::processPayment/$1');





