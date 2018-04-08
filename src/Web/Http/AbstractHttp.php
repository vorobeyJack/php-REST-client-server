<?php declare(strict_types = 1);

namespace vrba\rest\Web\Http;

/**
 * Class AbstractHttp
 *
 * @package vrba\rest\Web\Http
 */
class AbstractHttp
{
    public const METHOD_GET                    = 'GET';
    public const METHOD_POST                   = 'POST';
    public const METHOD_PUT                    = 'PUT';
    public const METHOD_DELETE                 = 'DELETE';
    public const CONTENT_TYPE_HTML             = 'text/html';
    public const CONTENT_TYPE_JSON             = 'application/json';
    public const CONTENT_TYPE_FORM_URL_ENCODED = 'application/x-www-form-urlencoded';

    public const HEADER_CONTENT_TYPE           = 'Content-Type';
    public const TRANSPORT_HTTP                = 'http';
    public const TRANSPORT_HTTPS               = 'https';
    public const STATUS_200                    = '200';

    /** @var string $uri **/
    protected $uri;

    /** @var string $method **/
    protected $method;

    /** @var string $scheme **/
    protected $scheme;

    /** @var array $headers **/
    protected $headers = [];

    /** @var array $metaData **/
    protected $metaData = [];

    /** @var array $data **/
    protected $data = [];

    /**
     * @param string $key
     * @param string $value
     * @return AbstractHttp
     */
    public function setHeaderByKey(string $key, string $value) : AbstractHttp
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * @param $data
     * @return AbstractHttp
     */
    public function setMetaData($data) : AbstractHttp
    {
        $this->metaData = $data;

        return $this;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getHeaderByKey(string $key) : ?string
    {
        return $this->headers[$key] ?? null;
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getDataByKey(string $key) : ?string
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @param $key
     * @return string|null
     */
    public function getMetaDataByKey($key) : ?string
    {
        return $this->metaData[$key] ?? null;
    }

    /**
     * @param string $uri
     * @param array|null $params
     * @return AbstractHttp
     */
    public function setUri(string $uri, array $params = null) : AbstractHttp
    {
        $this->uri = $uri;
        if ($params) {
            $this->uri .= '?' . http_build_query($params);
        }

        return $this;
    }

    /**
     * @param array $data
     * @return AbstractHttp
     */
    public function setData(array $data) : AbstractHttp
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataEncoded() : string
    {
        return http_build_query($this->getData());
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return AbstractHttp
     */
    public function setMethod(string $method) : AbstractHttp
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param string|null $scheme
     * @return AbstractHttp
     */
    public function setScheme(string $scheme = null): AbstractHttp
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

        return $this;
    }

    /**
     * @return string
     */
    public function getScheme() : string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getUri() : string
    {
        return $this->uri;
    }
}