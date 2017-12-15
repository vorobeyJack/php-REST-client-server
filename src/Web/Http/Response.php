<?php
declare(strict_types=1);

namespace App\Web\Http;

/**
 * Class Response
 * @package App\Web\Http
 */
class Response extends AbstractHttp
{
    /**
     * Response constructor.
     *
     * @param null       $uri
     * @param null       $method
     * @param array|null $headers
     * @param array|null $data
     * @param array|null $cookies
     */
    public function __construct(
        $uri = null,
        $method = null,
        array $headers = null,
        array $data = null,
        array $cookies = null
    ) {
        $this->uri     = $uri;
        $this->method  = $method;
        $this->headers = $headers;
        $this->data    = $data;
        $this->cookies = $cookies;
        $this->setScheme();
    }
}