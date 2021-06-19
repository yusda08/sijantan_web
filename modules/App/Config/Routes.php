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
$routes->group('aplikasi', ['namespace' => '\Modules\App\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->group('running_text', function ($routes) {
        $routes->get('/', 'Running_text::index');
        $routes->post('add_data', 'Running_text::addData');
        $routes->post('update_status', 'Running_text::updateStatus');
    });
});
