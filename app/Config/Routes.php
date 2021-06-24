<?php

namespace Config;

use App\Controllers\BaseController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('Modules\Frontend\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('api', function ($routes) {
    $routes->group('auth', ['namespace' => '\App\Controllers'], function ($routes) {
        $routes->post('login', 'Auth::login');
        $routes->post('register', 'Auth::register');
        $routes->post('forget_password', 'Auth::forgetPassword');
    });

    $routes->group('user', ['namespace' => '\App\Controllers', 'filter' => 'api_auth'], function ($routes) {
        $routes->get('/', 'User::index');
    });

    $routes->group('pengaduan', ['namespace' => '\App\Controllers', 'filter' => 'api_auth'], function ($routes) {
        $routes->group('jalan', function ($routes) {
            $routes->get('/', 'Pengaduan_jalan::index');
            $routes->post('/', 'Pengaduan_jalan::create');
            $routes->delete('(:any)', 'Pengaduan_jalan::delete/$1');
        });
        $routes->group('jembatan', function ($routes) {
            $routes->get('/', 'Pengaduan_jembatan::index');
            $routes->post('/', 'Pengaduan_jembatan::create');
            $routes->delete('(:any)', 'Pengaduan_jembatan::delete/$1');
        });
    });
    $routes->group('aplikasi', ['namespace' => '\App\Controllers', 'filter' => 'api_auth'], function ($routes) {
        $routes->get('banner', 'Banner::index');
        $routes->get('running_text', 'Running_text::index');
        $routes->get('news', 'News::index');
        $routes->get('profile_unit', 'Unit::index');
    });

    $routes->group('database', ['namespace' => '\App\Controllers', 'filter' => 'api_auth'], function ($routes) {
        $routes->get('jalan', 'Data_jalan::index');
        $routes->get('jembatan', 'Data_jembatan::index');
    });
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Include Modules Routes Files
 * --------------------------------------------------------------------
 */
if (file_exists(ROOTPATH . 'modules')) {
    $modulesPath = ROOTPATH . 'modules/';
    $modules = scandir($modulesPath);

    foreach ($modules as $module) {
        if ($module === '.' || $module === '..')
            continue;
        if (is_dir($modulesPath) . '/' . $module) {
            $routesPath = $modulesPath . $module . '/Config/Routes.php';
            if (file_exists($routesPath)) {
                require($routesPath);
            } else {
                continue;
            }
        }
    }
}