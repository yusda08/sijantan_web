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
$routes->group('referensi', ['namespace' => '\Modules\Referensi\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->group('desa', function ($routes) {
        $routes->get('/', 'Desa::index');
        $routes->post('add_data', 'Desa::addData');
        $routes->post('delete_data', 'Desa::deleteData');
        $routes->get('load_kecamatan', 'Desa::loadKecamatan');
    });
    $routes->group('kecamatan', function ($routes) {
        $routes->get('/', 'Kecamatan::index');
        $routes->post('add_data', 'Kecamatan::addData');
        $routes->post('delete_data', 'Kecamatan::deleteData');
    });
    $routes->group('kabupaten', function ($routes) {
        $routes->get('/', 'Kabupaten::index');
        $routes->post('add_data', 'Kabupaten::addData');
        $routes->post('delete_data', 'Kabupaten::deleteData');
    });
});
