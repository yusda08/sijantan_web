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
    $routes->group('kategori_jalan', function ($routes) {
        $routes->get('/', 'Kategori_jalan::index');
        $routes->get('load_json', 'Kategori_jalan::loadJson');
        $routes->post('add_data', 'Kategori_jalan::addData');
        $routes->post('delete_data', 'Kategori_jalan::deleteData');
    });
    $routes->group('kondisi_jembatan', function ($routes) {
        $routes->get('/', 'Kondisi_jembatan::index');
        $routes->get('load_json', 'Kondisi_jembatan::loadJson');
        $routes->post('add_data', 'Kondisi_jembatan::addData');
        $routes->post('delete_data', 'Kondisi_jembatan::deleteData');
    });
    $routes->group('tipekondisi_jembatan', function ($routes) {
        $routes->get('/', 'TipeKondisi_jembatan::index');
        $routes->get('load_json', 'TipeKondisi_jembatan::loadJson');
        $routes->post('add_data', 'TipeKondisi_jembatan::addData');
        $routes->post('delete_data', 'TipeKondisi_jembatan::deleteData');
    });
    $routes->group('kategori_jembatan', function ($routes) {
        $routes->get('/', 'Kategori_jembatan::index');
        $routes->get('load_json', 'Kategori_jembatan::loadJson');
        $routes->post('add_data', 'Kategori_jembatan::addData');
        $routes->post('delete_data', 'Kategori_jembatan::deleteData');
    });
});
