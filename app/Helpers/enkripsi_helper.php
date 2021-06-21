<?php

function enkripsiText($text) {
    $encrypter = \Config\Services::encrypter();
    return $encrypter->encrypt($text);
}

function deskripsiText($text) {
    $encrypter = \Config\Services::encrypter();
    return $encrypter->decrypt($text);
}

function encodeUrl($string) {
    $encrypter = \Config\Services::encrypter();
    $entext = base64_encode($encrypter->encrypt($string));
    $enc = strtr($entext, '+/=', '-_,');
    return $enc;
}

function decodeUrl($string = null) {
    $dec = '';
    if (!empty($string)) {
        $encrypter = \Config\Services::encrypter();
        $detext = strtr($string, '-_,', '+/=');
        $dec = $encrypter->decrypt(base64_decode($detext));
    }
    return $dec;
}
