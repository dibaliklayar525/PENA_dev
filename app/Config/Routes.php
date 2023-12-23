<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


# Authentikasi Login
$routes->get('/', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->post('auth-login', 'Auth::login');
$routes->get('forgot-password', 'Auth::forgot_password');

# after login
$routes->get('home', 'Home::index', ['filter' => 'Filter_auth']);
$routes->get('home', 'Home::index', ['filter' => 'Filter_auth']);

# kategori
$routes->match(['get', 'post'], 'kategori', 'KategoriController::index', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'kategori/add', 'KategoriController::add', ['filter' => 'Filter_auth']);
$routes->post('kategori/edit/(:num)', 'KategoriController::edit/$1', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'kategori/delete', 'KategoriController::delete', ['filter' => 'Filter_auth']);

# departemen
$routes->match(['get', 'post'], 'departemen', 'DepartemenController::index', ['filter' => 'Filter_auth']);
$routes->post('departemen/add', 'DepartemenController::add', ['filter' => 'Filter_auth']);
$routes->post('departemen/edit/(:num)', 'DepartemenController::edit/$1', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'departemen/delete', 'DepartemenController::delete', ['filter' => 'Filter_auth']);

# departemen select
$routes->match(['get', 'post'], 'get_dep', 'UserController::tbl_dep', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'sub_dep_byId', 'UserController::tbl_sub_dep', ['filter' => 'Filter_auth']);

#user
$routes->match(['get', 'post'], 'user', 'UserController::index', ['filter' => 'Filter_auth']);
$routes->get('user/edit/(:any)', 'UserController::edit/$1', ['filter' => 'Filter_auth']);
$routes->get('user/add', 'UserController::add', ['filter' => 'Filter_auth']);
$routes->post('user/insert', 'UserController::insert', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'user/delete', 'UserController::delete', ['filter' => 'Filter_auth']);

# Arsip
$routes->match(['get', 'post'], 'arsip', 'ArsipController::index', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'arsip/add', 'ArsipController::add', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'arsip/serverSide', 'ArsipController::serverSide', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'arsip/delete', 'ArsipController::delete', ['filter' => 'Filter_auth']);
$routes->match(['get', 'post'], 'arsip/edit', 'ArsipController::edit', ['filter' => 'Filter_auth']);
$routes->get('arsip/view/(:any)', 'ArsipController::viewPdf/$1', ['filter' => 'Filter_auth']);

$routes->get('arsip/printbyId/(:any)', 'ArsipController::printbyId/$1', ['filter' => 'Filter_auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
