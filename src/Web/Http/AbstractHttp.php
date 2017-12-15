<?php
declare(strict_types=1);

namespace App\Web\Http;

/**
 * Class AbstractHttp
 */
class AbstractHttp
{
    const METHOD_GET                    = 'GET';
    const METHOD_POST                   = 'POST';
    const METHOD_PUT                    = 'PUT';
    const METHOD_DELETE                 = 'DELETE';
    const CONTENT_TYPE_HTML             = 'text/html';
    const CONTENT_TYPE_JSON             = 'application/json';
    const CONTENT_TYPE_FORM_URL_ENCODED =
        'application/x-www-form-urlencoded';
    const HEADER_CONTENT_TYPE           = 'Content-Type';
    const TRANSPORT_HTTP                = 'http';
    const TRANSPORT_HTTPS               = 'https';
    const STATUS_200                    = '200';
    const STATUS_401                    = '401';
    const STATUS_500                    = '500';

    protected $uri;
    protected $method;
    protected $headers;
    protected $cookies;
    protected $metaData;
    protected $scheme;
    protected $data = [];

    /**
     * @param string $key
     * @param string $value
     */
    public function setHeaderByKey(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getHeaders(string $key)
    {
        return $this->headers[$key] ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param $key
     *
     * @return string
     */
    public function getDataByKey($key): string
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @param $key
     *
     * @return null
     */
    public function getMetaDataByKey($key): string
    {
        return $this->metaData[$key] ?? null;
    }

    /**
     * @param string     $uri
     * @param array|null $params
     */
    public function setUri(string $uri, array $params = null): void
    {
        $this->uri = $uri;
        if ($params) {
            $this->uri .= '?' . http_build_query($params);
        }
    }

    /**
     * @return string
     */
    public function getDataEncoded()
    {
        return http_build_query($this->getData());
    }

    /**
     * @param null $scheme
     */
    public function setScheme($scheme = null): void
    {
        if ($scheme) {
            $this->scheme = $scheme;
        } else {
            if (substr($this->uri, 0, 5) == self::TRANSPORT_HTTPS) {
                $this->transport = self::TRANSPORT_HTTPS;
            } else {
                $this->transport = self::TRANSPORT_HTTP;
            }
        }
    }
}