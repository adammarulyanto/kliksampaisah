<?php

namespace Config;

$routes = \Config\Services::routes(true);

// Auth Routes
$routes->get('/', 'Home');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::processLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::processRegister');
$routes->get('/verify', 'Auth::verify');
$routes->post('/verify', 'Auth::processVerify');
$routes->post('/resend-code', 'Auth::resendCode');
$routes->get('/auth/google', 'Auth::googleAuth');
$routes->get('/auth/googleCallback', 'Auth::googleAuth');
$routes->get('/logout', 'Auth::logout');

// Home Routes
$routes->get('/profile', 'Home::profile');

// Debug
$routes->get('/debug', 'Debug::checkDB');

// Dashboard
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/undangan-saya', 'Dashboard::undangan_saya');
$routes->get('/buat-undangan', 'Dashboard::buat_undangan');
$routes->get('/template', 'Dashboard::template');
$routes->post('/buat-undangan/save', 'Dashboard::save_undangan');
$routes->get('/check-url', 'Dashboard::checkUrl');

// Template
$routes->get('/cek-template', 'Dashboard::cek_template');
$routes->get('/cek-template/load/(:any)', 'Dashboard::loadTemplate/$1');
$routes->get('(:any)', 'Undangan::index/$1');