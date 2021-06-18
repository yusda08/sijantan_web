<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routes
 *
 * @author Yusda Helmani
 */

$routes->group('home', ['namespace' => '\Modules\Home\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
});
$routes->group('frontend', ['namespace' => '\Modules\Frontend\Controllers'], function ($routes) {
    $routes->group('jalan', function ($routes) {
        $routes->get('/', 'Data_jalan::index');
        $routes->get('detail', 'Data_jalan::detail');
        $routes->post('load_data_table', 'Data_jalan::loadDataTable');
        $routes->get('load_data_jalan', 'Data_jalan::loadDataJalan');
        $routes->get('load_data_jalan/(:num)', 'Data_jalan::loadDataJalan/$1');
        $routes->get('load_data_koordinat', 'Data_jalan::loadDataKoordinat');
        $routes->get('load_kondisi_jalan', 'Data_jalan::loadKondisiJalan');
        $routes->get('load_kondisi/(:num)/(:num)', 'Data_jalan::loadKondisiJalan/$1/$2');
        $routes->get('load_permukaan/(:num)/(:num)', 'Data_jalan::loadPermukaanJalan/$1/$2');
    });
});