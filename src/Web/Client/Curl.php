<?php

namespace App\Web\Client;

use App\Web\Http\Request;
use App\Web\Http\Response;

class Curl
{
    /**
     * @param \App\Web\Http\Request $request
     */
    public static function send(Request $request)
    {
        $data     = $request->getDataEncoded();
        $response = new Response();
        switch ($request->getMethod()) {
            case Request::METHOD_GET :
                $uri     = ($data)
                    ? $request->getUri() . '?' . $data
                    : $request->getUri();
                $options = [
                    CURLOPT_URL            => $uri,
                    CURLOPT_HEADER         => 0,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT        => 4
                ];
                break;
            case Request::METHOD_POST :
                $options = [
                    CURLOPT_POST           => 1,
                    CURLOPT_HEADER         => 0,
                    CURLOPT_URL            => $request->getUri(),
                    CURLOPT_FRESH_CONNECT  => 1,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FORBID_REUSE   => 1,
                    CURLOPT_TIMEOUT        => 4,
                    CURLOPT_POSTFIELDS     => $data
                ];
                break;
        }
    }

    /**
     * @param \App\Web\Http\Response $response
     * @param                        $payload
     */
    protected static function getResults(Response $response, $payload)
    {
        $type = $response->getMetaDataByKey('content_type');
        if ($type) {
            switch (true) {
                case (stripos($type, Response::CONTENT_TYPE_JSON) !== false):
                    $response->setData(json_decode($payload));
                    break;
                default :
                    $response->setData($payload);
                    break;
            }
        }
    }
}