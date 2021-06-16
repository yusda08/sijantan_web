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
//Setting  User
$routes->group('utility', ['namespace' => '\Modules\Utility\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->group('permukaan_jalan', function ($routes) {
        $routes->get('/', 'Permukaan_jalan::index');
        $routes->get('load_json', 'Permukaan_jalan::loadJson');
        $routes->post('add_data', 'Permukaan_jalan::addData');
        $routes->post('delete_data', 'Permukaan_jalan::deleteData');
    });

    $routes->group('lebar_jalan', function ($routes) {
        $routes->get('/', 'Lebar_jalan::index');
        $routes->get('load_json', 'Lebar_jalan::loadJson');
        $routes->post('add_data', 'Lebar_jalan::addData');
        $routes->post('delete_data', 'Lebar_jalan::deleteData');
    });

    $routes->group('kondisi_jalan', function ($routes) {
        $routes->get('/', 'Kondisi_jalan::index');
        $routes->get('load_json', 'Kondisi_jalan::loadJson');
        $routes->post('add_data', 'Kondisi_jalan::addData');
        $routes->post('delete_data', 'Kondisi_jalan::deleteData');
    });

    $routes->group('klasifikasi_jalan', function ($routes) {
        $routes->get('/', 'Klasifikasi_jalan::index');
        $routes->get('load_json', 'Klasifikasi_jalan::loadJson');
        $routes->post('add_data', 'Klasifikasi_jalan::addData');
        $routes->post('delete_data', 'Klasifikasi_jalan::deleteData');
    });
});
