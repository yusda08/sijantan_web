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
    $routes->group('input_data', function ($routes) {
        $routes->get('/', 'Input_data::index');
        $routes->get('form_add', 'Input_data::formAdd');
        $routes->post('add_data', 'Input_data::addData');
    });
});
