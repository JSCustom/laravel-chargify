<?php

namespace JSCustom\Chargify\Helpers;

define('CHARGIFY_BASE_API', env('CHARGIFY_BASE_API_URL'));
define('CHARGIFY_API', env('CHARGIFY_API_KEY'));

class ChargifyHelper
{
    private static $credentials = [
        'baseApiUrl' => CHARGIFY_BASE_API,
        'key' => CHARGIFY_API,
        'password' => 'X',
    ];
    public static function get(String $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::$credentials['baseApiUrl'] . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 90,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic " . base64_encode(self::$credentials['key'] . ':' . self::$credentials['password']),
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ['error' => $err];
        } else {
            return $response;
        }
    }
    public static function post(String $url, array $data, String $method = 'POST')
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::$credentials['baseApiUrl'] . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 90,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic " . base64_encode(self::$credentials['key'] . ':' . self::$credentials['password']),
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_encode(['error' => $err]);
        } else {
            return $response;
        }
    }
    public static function put(String $url, array $data)
    {
        return self::post($url, $data, 'PUT');
    }
    public static function delete(String $url, array $data = [])
    {
        return self::post($url, $data, 'DELETE');
    }
}
