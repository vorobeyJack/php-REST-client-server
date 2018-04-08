<?php declare(strict_types = 1);

namespace vrba\rest\Web\Http;

/**
 * Class Request
 *
 * @package vrba\rest\Web\Http
 */
class Request extends AbstractHttp
{
    /**
     * Request constructor.
     *
     * @param string|null $uri
     * @param string|null $method
     * @param array|null $headers
     * @param array|null $data
     */
    public function __construct(
        string $uri = null,
        string $method = null,
        array $headers = null,
        array $data = null
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
            $this->method = $this->headers['REQUEST_METHOD'] ?? self::METHOD_GET;
        } else {
            $this->method = $method;
        }

        if (!$data) {
            $this->data = $_REQUEST ?? [];
        } else {
            $this->data = $data;
        }

        $this->setScheme();
    }
}