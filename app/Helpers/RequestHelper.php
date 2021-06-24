<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class RequestHelper
{
    private $accessId = '';
    private $accessKey = '';
    private $baseUrl = '';
    private $baseUrlStore = '';

    public function __construct()
    {
        $this->accessId = env("ACCESS_ID");
        $this->accessKey = env('ACCESS_KEY');
        $this->baseUrl = env('BASE_URL');
        $this->baseUrlStore = env('BASE_URL_STORE');
    }

    public function post($path, $data)
    {
        $method = 'POST';
        $url = $this->baseUrl.$path;
        $epoch = round(microtime(true) * 1000);

        $data_string = json_encode($data, true);

        $requestVars = $method.$epoch.$data_string.$path;//$httpVerb . $epoch . $data_string . $resourcePath;

        //Generate Signature
        $signature = base64_encode(hash_hmac('sha256', $requestVars, $this->accessKey));

        //Setup headers
        $auth = 'LMv1 '.$this->accessId.':'.$signature.':'.$epoch;

        $headers = [
            'Authorization' => [
                $auth,
            ],
        ];

        $client = new Client();
        $request = new Request($method, $url, $headers, json_encode($data));

        return $client->send($request)->getBody()->getContents();
    }

    public function get($path)
    {
        $url = $this->baseUrl.$path;
        $epoch = round(microtime(true) * 5000);
        $httpVerb = "GET";

        $requestVars = $httpVerb.$epoch.$path;

        $sig = base64_encode(hash_hmac('sha256', $requestVars, $this->accessKey));

        $auth = 'LMv1 '.$this->accessId.':'.$sig.':'.$epoch;

        $headers = [
            'Content-Type: application/json',
            'Authorization: '.$auth,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function put($path, $data)
    {
        $method = 'PUT';
        $url = $this->baseUrl.$path;
        $epoch = round(microtime(true) * 1000);

        $data_string = json_encode($data, true);

        $requestVars = $method.$epoch.$data_string.$path;//$httpVerb . $epoch . $data_string . $resourcePath;

        //Generate Signature
        $signature = base64_encode(hash_hmac('sha256', $requestVars, $this->accessKey));

        //Setup headers
        $auth = 'LMv1 '.$this->accessId.':'.$signature.':'.$epoch;

        $headers = [
            'Authorization' => [
                $auth,
            ],
        ];

        $client = new Client();
        $request = new Request($method, $url, $headers, json_encode($data));

        return $client->send($request)->getBody()->getContents();
    }

    public function getWithParam($path, $queryParam)
    {
        $url = $this->baseUrl.$path.'?'.$queryParam;
        $epoch = round(microtime(true) * 5000);
        $httpVerb = "GET";

        $requestVars = $httpVerb.$epoch.$path;

        $sig = base64_encode(hash_hmac('sha256', $requestVars, $this->accessKey));

        $auth = 'LMv1 '.$this->accessId.':'.$sig.':'.$epoch;

        $headers = [
            'Content-Type: application/json',
            'Authorization: '.$auth,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function postToStore($path, $data)
    {
        $method = 'POST';
        $url = $this->baseUrlStore.$path;

        $client = new Client();
        $request = new Request($method, $url, [
            'device_data' => [
                'device_id' => 10,
                'device_name' => 'Device Test Name',
                'uuid' => true,
            ],
        ]);

        return $client->send($request)->getBody()->getContents();
    }
}
