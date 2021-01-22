<?php
namespace AR\MagicSms\Concrete;

use GuzzleHttp\Client as HTTP;

/**
 * Class Client
 * @package AR\MagicSms\Concrete
 */
class Client {
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $requestType;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var HTTP
     */
    private $response;

    /**
     * This send request to endpoint
     *
     * @return HTTP $http
     */
    public function send() {
        $http = new HTTP();

        $http = $http->request($this->getRequestType(), $this->getEndpoint(), [
            'query' => $this->getParameters(),
            'headers' => $this->getHeaders()
        ]);

        $this->setResponse($http);

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * @param string $requestType
     * @return $this;
     */
    public function setRequestType($requestType)
    {
        $this->requestType = $requestType;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return $this;
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get all of the request headers
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * return all response includes [ Headers | Body ]
     * @return HTTP
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param HTTP $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * return Body of response
     *
     * @return mixed
     */
    public function getBody() {
        return (string)$this->response->getBody();
    }

    /**
     * check response type
     *
     * @return string
     */
    public function responseType() {
        $response = $this->getBody();
        
        $json = json_decode($response);        

        if ($json && $response != $json) {
            return 'json';
        }

        if(is_string($response)) {
            return 'string';
        }

        return 'unKnown';
    }

    /**
     * check response return as Json content
     *
     * @return string
     */
    public function isJson() {
        return $this->responseType() == 'json';
    }

    /**
     * check response return as Json content
     *
     * @return string
     */
    public function isString() {
        return $this->responseType() == 'string';
    }

    /**
     * Get all of the response headers
     *
     * @return mixed
     */
    public function getResponseHeaders() {
        return $this->response->getHeaders();
    }

    /**
     * Get all of the response headers
     *
     * @param string $key
     * @param string $default
     * @return mixed
     */
    public function getResponseHeader($key, $default = null) {
        return $this->response->getHeader($key) ?? $default;
    }

    /**
     * get get Status Code from response
     * @return mixed
     */
    public function getStatusCode($type = 'code') {
        return $type == 'code' ? $this->response->getStatusCode() : $this->response->getReasonPhrase();
    }

}