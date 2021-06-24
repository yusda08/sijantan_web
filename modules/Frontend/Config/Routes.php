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
$routes->group('frontend', ['namespace' => '\Modules\Frontend\Controllers'], function ($routes) {
    $routes->group('home', function ($routes) {
        $routes->get('/', 'Home::index');
        $routes->get('aktivasi/(:any)', 'Home::aktivasi/$1');
        $routes->get('forget_password/(:any)', 'Home::forgetPassword/$1');
        $routes->post('update_password', 'Home::updatePassword');
    });
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
    $routes->group('jembatan', function ($routes) {
        $routes->get('/', 'Data_jembatan::index');
        $routes->get('detail', 'Data_jembatan::detail');
        $routes->post('load_data_table', 'Data_jembatan::loadDataTable');
        $routes->get('load_data_jembatan', 'Data_jembatan::loadDataJembatan');
        $routes->get('load_data_jembatan/(:num)', 'Data_jembatan::loadDataJembatan/$1');
        $routes->get('load_spesifikasi_jembatan', 'Data_jembatan::loadSpesifikasiJembatan');
        $routes->get('load_tipekondisi_jembatan', 'Data_jembatan::loadTipeKondisiJembatan');
        $routes->get('load_kondisi_jembatan', 'Data_jembatan::loadKondisiJembatan');
    });
});
