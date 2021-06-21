<?php

use App\Models as Model;
use Config\Services;
use Firebase\JWT\JWT;

function getJWTFromRequest($authenticationHeader): string
{
    if (is_null($authenticationHeader)) { //JWT is absent
        throw new Exception('Masukan Bearer Token yang sudah diberikan');
    }
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $userModel = new Model\Model_token();
    $userModel->where(['username' => $decodedToken->username])->first();
}


function getSignedJWTForUser(string $username)
{
    $issuedAtTime = time();
    $payload = [
        'username' => $username,
        'iat' => $issuedAtTime,
    ];
    return JWT::encode($payload, Services::getSecretKey());
}

?>