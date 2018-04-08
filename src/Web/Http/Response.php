<?php declare(strict_types = 1);

namespace vrba\rest\Web\Http;

/**
 * Class Response
 *
 * @package vrba\rest\Web\Http
 */
class Response extends AbstractHttp
{
    /** @var string $uri **/
    private $uri;

    /** @var string $method **/
    private $method;

    /** @var array $headers **/
    private $headers;

    /** @var array $data **/
    private $data;

    /**
     * Response constructor.
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
        $this->uri     = $uri;
        $this->method  = $method;
        $this->headers = $headers;
        $this->data    = $data;
        $this->setScheme();
    }
}