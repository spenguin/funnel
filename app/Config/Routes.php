<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::index' );
$routes->post('/login', 'Auth::index' );
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');
$routes->get('/migrate/status', 'Migrate::status' );
$routes->get('/migrate/seed/(:segment)', 'Migrate::seed/$1');
$routes->get('/migrate/seed', 'Migrate::seed');
$routes->get('/migrate', 'Migrate::index' );
$routes->get('/admin', 'Admin::index' );
$routes->get('/admin/edit/(:segment)', 'Admin::edit/$1' );
$routes->post('/admin/edit/(:segment)', 'Admin::edit/$1' );
$routes->get('/admin/edit', 'Admin::edit' );
$routes->post('admin/edit', 'Admin::edit' );


$routes->get('(:any)', 'Pages::view/$1');

// $routes->get('/landing', 'Funnel::index' );

// $routes->get('/admintools/migrate', 'Admintools::migrate');
// $routes->get('/admintools', 'Admintools::index' );
// $routes->get('/login', 'Gateway::index' );

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
