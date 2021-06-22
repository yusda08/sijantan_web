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
$routes->group('pengaduan', ['namespace' => '\Modules\Pengaduan\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->group('jalan', function ($routes) {
        $routes->get('/', 'Pengaduan_jalan::index');
        $routes->get('detail', 'Pengaduan_jalan::detail');
        $routes->post('add_data', 'Pengaduan_jalan::addData');
        $routes->post('delete_data', 'Pengaduan_jalan::deleteData');
        $routes->post('delete_data_tiket', 'Pengaduan_jalan::deleteDataTiket');
        $routes->post('load_data_table', 'Pengaduan_jalan::loadDataTable');
    });
});
