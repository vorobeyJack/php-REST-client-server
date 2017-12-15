<?php
declare(strict_types=1);

namespace App\Web\Client;

use App\Web\Http\Request;
use App\Web\Http\Response;

/**
 * Class Streams
 * @package App\Web\Client
 */
class Streams
{
    const BYTES_TO_READ = 4096;

    /**
     * @param \App\Web\Http\Request $request
     *
     * @return mixed
     */
    public static function send(Request $request)
    {
        $data     = $request->getDataEncoded();
        $response = new Response();
        switch ($request->getMethod()) {
            case Request::METHOD_GET :
                if ($data) {
                    $request->setUri($request->getUri() . '?' . $data);
                }
                $resource = fopen($request->getUri(), 'r');
                break;
            case Request::METHOD_POST :
                $opts     = [
                    $request->getScheme() =>
                        [
                            'method'  => Request::METHOD_POST,
                            'header'  => Request::HEADER_CONTENT_TYPE
                                         . ': ' . Request::CONTENT_TYPE_FORM_URL_ENCODED,
                            'content' => $data
                        ]
                ];
                $resource = fopen($request->getUri(), 'w',
                                  stream_context_create($opts));
                break;
        }

        return self::getResults($response, $resource);
    }

    /**
     * @param \App\Web\Http\Response $response
     * @param                        $resource
     *
     * @return mixed
     */
    protected static function getResults(Response $response, $resource)
    {
        $response->setMetaData(stream_get_meta_data($resource));
        $data = $response->getMetaDataByKey('wrapper_data');
        if (!empty($data) && is_array($data)) {
            foreach ($data as $item) {
                if (preg_match('!^HTTP/\d\.\d (\d+?) .*?$!',
                               $item, $matches)) {
                    $response->setHeaderByKey('status', $matches[1]);
                } else {
                    list($key, $value) = explode(':', $item);
                    $response->setHeaderByKey($key, trim($value));
                }
            }
        }
        $payload = '';
        while (!feof($resource)) {
            $payload .= fread($resource, self::BYTES_TO_READ);
        }
        if ($response->getHeaderByKey(Response::HEADER_CONTENT_TYPE)) {
            switch (true) {
                case stripos($response->getHeaderByKey(
                        Response::HEADER_CONTENT_TYPE),
                             Response::CONTENT_TYPE_JSON) !== false:
                    $response->setData(json_decode($payload));
                    break;
                default :
                    $response->setData($payload);
                    break;
            }
        }

        return $response;
    }
}