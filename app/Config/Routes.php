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

$routes->group('',['filter' => 'AlreadyLoggedIn'], function ($routes) {
    $routes->get( 'campaigns', 'Campaigns::index' );
    $routes->get( 'emails', 'Emails::index' );
    $routes->get('admin', 'Admin::index' );
});

$routes->get('/login', 'Auth::index' );
$routes->post('/login', 'Auth::index' );
$routes->get('/logout', 'Auth::logout' );
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');
$routes->get('/migrate/status', 'Migrate::status' );
$routes->get('/migrate/seed/(:segment)', 'Migrate::seed/$1');
$routes->get('/migrate/seed', 'Migrate::seed');
$routes->get('/migrate/rollback', 'Migrate::rollback');
$routes->get('/migrate', 'Migrate::index' );

// Desktop
$routes->get('admin', 'Admin::index' );

// Payment Gateway
// $routes->get('donate', 'PaymentController::donate');
// $routes->post('stripe/payment', 'PaymentController::payment');
// $routes->get('stripe/payment-success/', 'PaymentController::payment_success');
// $routes->get('stripe/payment-cancel', 'PaymentController::payment_cancel');
$routes->post('payment', 'PaymentGateway::payment');

// Campaigns
$routes->get('campaigns', 'Campaigns::index' );
// $routes->get('campaigns/create', 'Campaigns::create' );
$routes->get('campaigns/create', 'Campaigns::edit' );
$routes->post('campaigns', 'Campaigns::store' );
// $routes->get('campaigns/(:num)', 'Campaigns::show/$1' );
$routes->get('campaigns/(:num)', 'Campaigns::edit/$1' );
$routes->post('campaigns/(:num)', 'Campaigns::update/$1' );
$routes->delete('campaigns/(:num)', 'Campaigns::destroy/$i' );

$routes->get('preview/(:any)', 'Funnel::preview/$1' );
$routes->post('preview/(:any)', 'Funnel::signup/$1' );
$routes->get('special-offer/(:any)', 'Funnel::special_offer/$1' );
$routes->post('special-offer/(:any)', 'Funnel::special_offer_taken/$1' );
$routes->get('payment-successful', 'Funnel::payment_successful' );

// Emails
$routes->get('emails', 'Emails::index' );
$routes->get('emails/create', 'Emails::edit' );
$routes->post('emails', 'Emails::store' );
// $routes->get('campaigns/(:num)', 'Campaigns::show/$1' );
$routes->get('emails/(:num)', 'Emails::edit/$1' );
$routes->post('emails/(:num)', 'Emails::update/$1' );
$routes->delete('emails/(:num)', 'Emails::destroy/$i' );

// Email Cron Job
$routes->get('emails', 'Emails::daily' );

// $routes->post('admin', 'Admin::store' );
// $routes->get('admin/(:num)', 'Admin::show/$1' );
// $routes->post('admin/(:num)', 'Admin::update/$1' );
// $routes->delete('client/(:num)', 'Admin/destroy/$1' );


// $routes->get('/admin/edit/(:num)', 'Admin::edit/$1' );
// $routes->post('/admin/edit/(:num)', 'Admin::edit/$1' );
// $routes->get('/admin/edit', 'Admin::edit' );
// $routes->post('admin/edit', 'Admin::edit' );


$routes->get('(:any)', 'Pages::view/$1');