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
$routes->group('jalan', ['namespace' => '\Modules\Jalan\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->post('load_data_table', 'Data_jalan::loadDataTable');
    $routes->get('load_data_jalan', 'Data_jalan::loadDataJalan');
    $routes->get('load_data_koordinat', 'Data_jalan::loadDataKoordinat');
    $routes->get('load_kondisi/(:num)/(:num)', 'Data_jalan::loadKondisiJalan/$1/$2');

    $routes->group('input_data', function ($routes) {
        $routes->get('/', 'Input_data::index');
        $routes->get('form_add', 'Input_data::formAdd');
        $routes->get('detail', 'Input_data::formAdd');
        $routes->post('add_data', 'Input_data::addData');
    });
    $routes->group('detail', function ($routes) {
        $routes->get('/', 'Detail::index');
        $routes->post('add_kondisi', 'Detail::addKondisi');
    });
});
