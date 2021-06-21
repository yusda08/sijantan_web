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
$routes->group('jembatan', ['namespace' => '\Modules\Jembatan\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->post('load_data_table', 'Data_jembatan::loadDataTable');
    $routes->get('load_data_jembatan', 'Data_jembatan::loadDataJembatan');
    $routes->get('load_spesifikasi_jembatan', 'Data_jembatan::loadSpesifikasiJembatan');
    $routes->get('load_tipekondisi_jembatan', 'Data_jembatan::loadTipeKondisiJembatan');

    $routes->group('input_data', function ($routes) {
        $routes->get('/', 'Input_data::index');
        $routes->get('form_add', 'Input_data::formAdd');
        $routes->get('detail', 'Input_data::formAdd');
        $routes->post('add_data', 'Input_data::addData');
        $routes->get('form_update', 'Input_data::formUpdate');
        $routes->post('delete_data', 'Input_data::deleteData');
        $routes->post('update_data', 'Input_data::updateData');
    });
    $routes->group('detail', function ($routes) {
        $routes->get('/', 'Detail::index');
        $routes->post('add_kondisi', 'Detail::addKondisi');
        $routes->post('upload_foto', 'Detail::uploadFoto');
        $routes->post('delete_foto', 'Detail::deleteFoto');
    });
});
