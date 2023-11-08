<?php

namespace Reservation\Libraries;

date_default_timezone_set("Asia/Jakarta");

/*
 *  Author : Jivanly Vrincent
 *  Created :  12.01.2020
*/

class Template
{
    public function __construct() {
    }

    public static function http($url, array $params, $options = [])
    {

        // var_dump($url);
        // die();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($options['method'] == 'GET') {
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer ' . $options['token'];
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        } else {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer ' . $options['token'];
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        if (is_resource($ch)) {
            curl_close($ch);
        }

        log_message('error', $error);
        log_message('error', $response);
        log_message('error', json_encode($response));

        try {
            return [
                'res' => json_decode($response),
                'status' => (json_decode($response) == NULL)?false:true
            ];
        } catch (\RuntimeException $e) {
            return [
                'res' => $error,
                'status' => false
            ];
        } catch(\Exception $e) {
            return [
                'res' => $error,
                'status' => false
            ];
        }
        
    }

}
