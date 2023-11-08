<?php

namespace Reservation\Libraries;

use Firebase\JWT\JWT;

defined('BASEPATH') or exit('No direct script access allowed');

class Authentication
{

    public function __construct()
    {
        // Get the CodeIgniter reference
        // $this->_CI = &get_instance();
    }

    public static function getJWTFromRequest(string $authenticationHeader)
    {
        if (is_null($authenticationHeader)) { //JWT is absent
            return false;
        } else {
            return explode(' ', $authenticationHeader)[1];
        }
    }

    public static function validateJWTFromRequest(string $encodedToken)
    {

        try {
            $key = $_ENV['SECRET_KEY'];
            return JWT::decode($encodedToken, $key, ['HS256']);
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getSignedJWTForUser(string $public_id)
    {

        try {
            $issuedAtTime = time();
            $tokenTimeToLive = $_ENV['TIME_T0_LIVE'];
            $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
            $payload = [
                'public_id' => $public_id,
                'iat' => $issuedAtTime,
                'exp' => $tokenExpiration,
            ];

            return JWT::encode($payload, $_ENV['SECRET_KEY'], 'HS256');
        } catch (\Exception $e) {
            return false;
        }
    }
}
