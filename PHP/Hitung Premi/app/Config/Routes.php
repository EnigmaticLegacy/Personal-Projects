<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->get('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/history', 'DashboardController::history');
$routes->post('/login','AuthController::authenticate');
$routes->post('/register','AuthController::register_user');
$routes->post('/submit_nasabah','DashboardController::submit_nasabah');
$routes->post('/printout','DashboardController::print_out');