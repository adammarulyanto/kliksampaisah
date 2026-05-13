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

// Undangan
$routes->get('/check-url', 'Dashboard::checkUrl');
$routes->post('/buat-undangan/save', 'Dashboard::save_undangan');
$routes->get('/undangan/(:any)/edit', 'Undangan::edit_undangan/$1');
$routes->post('/undangan/update/(:num)', 'Undangan::update/$1');

// Template
$routes->get('/cek-template', 'Dashboard::cek_template');
$routes->get('/cek-template/load/(:any)', 'Dashboard::loadTemplate/$1');
$routes->get('/template/preview/(:num)', 'Undangan::live_preview/$1');
$routes->post('/template/purchase', 'Template::purchase');

// Guest List
$routes->get('undangan/(:any)/guest-list', 'Guest::index/$1');
$routes->post('undangan/(:any)/guest-list/filter', 'Guest::filter/$1');
$routes->post('undangan/(:any)/guest-list/add', 'Guest::addGuest/$1');
$routes->put('undangan/(:any)/guest-list/edit/(:num)', 'Guest::editGuest/$1/$2');
$routes->delete('undangan/(:any)/guest-list/delete/(:num)', 'Guest::deleteGuest/$1/$2');
$routes->post('undangan/(:any)/guest-list/send-wa', 'Guest::sendWhatsApp/$1');
$routes->get('undangan/(:any)/guest-list/templates', 'Guest::getTemplates/$1');
$routes->get('undangan/(:any)/guest-list/events', 'Guest::getEvents/$1');



// Undangan Member
$routes->get('(:any)', 'Undangan::index/$1');