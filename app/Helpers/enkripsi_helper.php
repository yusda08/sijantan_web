<?php

function enkripsiText($text) {
    $encrypter = \Config\Services::encrypter();
    return $encrypter->encrypt($text);
}

function deskripsiText($text) {
    $encrypter = \Config\Services::encrypter();
    return $encrypter->decrypt($text);
}
