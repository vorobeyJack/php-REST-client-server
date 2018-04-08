<?php declare(strict_types=1);

namespace vrba\rest\Web\Http;

/**
 * Class Request
 * @package App\Web
 */
class Request extends AbstractHttp
{
    public function __construct(
        $uri = null,
        $method = null,
        array $headers = null,
        array $data = null,
        array $cookies = null
    ) {
        if (!$headers) {
            $this->headers = $_SERVER ?? [];
        } else {
            $this->headers = $headers;
        }
        if (!$uri) {
            $this->uri = $this->headers['PHP_SELF'] ?? '';
        } else {
            $this->uri = $uri;
        }
        if (!$method) {
            $this->method =
                $this->headers['REQUEST_METHOD'] ?? self::METHOD_GET;
        } else {
            $this->method = $method;
        }
        if (!$data) {
            $this->data = $_REQUEST ?? [];
        } else {
            $this->data = $data;
        }
        if (!$cookies) {
            $this->cookies = $_COOKIE ?? [];
        } else {
            $this->cookies = $cookies;
        }
        $this->setScheme();
    }
}