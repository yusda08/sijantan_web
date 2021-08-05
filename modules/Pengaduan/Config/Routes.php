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
        $routes->get('load_pengaduan_aset', 'Pengaduan_jalan::loadPengaduanJalanAset');
        $routes->post('add_data', 'Pengaduan_jalan::addData');
        $routes->post('delete_data', 'Pengaduan_jalan::deleteData');
        $routes->post('delete_data_tiket', 'Pengaduan_jalan::deleteDataTiket');
        $routes->post('load_data_table', 'Pengaduan_jalan::loadDataTable');
    });
    $routes->group('jembatan', function ($routes) {
        $routes->get('/', 'Pengaduan_jembatan::index');
        $routes->get('detail', 'Pengaduan_jembatan::detail');
        $routes->post('add_data', 'Pengaduan_jembatan::addData');
        $routes->post('delete_data', 'Pengaduan_jembatan::deleteData');
        $routes->post('delete_data_tiket', 'Pengaduan_jembatan::deleteDataTiket');
        $routes->post('load_data_table', 'Pengaduan_jembatan::loadDataTable');
    });
});
