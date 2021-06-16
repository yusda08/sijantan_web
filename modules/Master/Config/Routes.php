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
$routes->group('master', ['namespace' => '\Modules\Master\Controllers', 'filter' => 'ceklogin'], function ($routes) {
    $routes->group('koordinat', function ($routes) {
        $routes->get('/', 'Koordinat::index');
        $routes->get('load_json_koordinat', 'Koordinat::loadJsonKoordinat');
        $routes->get('load_geojson_jalan', 'Koordinat::loadGeoJsonJalan');
    });
});
