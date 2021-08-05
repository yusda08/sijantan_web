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

$routes->group('home', ['namespace' => '\Modules\Home\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('profil', 'Profil::index');
    $routes->post('forget_password', 'Profil::forgetPassword');
    $routes->post('verifikasi_password', 'Profil::verifikasi_password');
    $routes->post('update_user', 'Profil::updateUser');
    $routes->post('set_session_tahun', 'Home::setSessionTahun');
});

$routes->group('login', ['namespace' => '\Modules\Home\Controllers'], function ($routes) {
    $routes->get('/', 'Login::index');
    $routes->get('logout', 'Login::logout');
    $routes->post('validasi_login', 'Login::validasiLogin');
});
