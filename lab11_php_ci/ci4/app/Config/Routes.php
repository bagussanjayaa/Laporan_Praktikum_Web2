<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================================
// PUBLIC ROUTES
// ==========================================
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// ==========================================
// USER / AUTH ROUTES
// ==========================================
$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

// ==========================================
// ADMIN ROUTES (dilindungi filter auth)
// ==========================================
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

// ==========================================
// AJAX ROUTES
// ==========================================
$routes->group('admin/ajax', ['filter' => 'auth'], function($routes) {

    $routes->get('/', 'AjaxController::index');

    $routes->get('getData', 'AjaxController::getData');

    $routes->delete('delete/(:num)', 'AjaxController::delete/$1');

});

// ==========================================
// API ROUTES
// ==========================================

// Login API (tanpa token)
$routes->post(
    'api/login',
    'Api\Auth::login'
);


$routes->options(
    'api/login',
    'Api\Auth::options'
);


// Artikel API
$routes->group('post', function($routes){

    // GET semua artikel
    $routes->get('/', 'Post::index');


    // GET detail artikel
    $routes->get('(:segment)', 'Post::show/$1');


    // Tambah artikel wajib token
    $routes->post(
        '/',
        'Post::create',
        [
            'filter'=>'apiauth'
        ]
    );


    // Update artikel wajib token
    $routes->put(
        '(:segment)',
        'Post::update/$1',
        [
            'filter'=>'apiauth'
        ]
    );


    // Delete artikel wajib token
    $routes->delete(
        '(:segment)',
        'Post::delete/$1',
        [
            'filter'=>'apiauth'
        ]
    );

});


$routes->options('post', 'Post::index');
$routes->options('post/(:segment)', 'Post::show/$1');