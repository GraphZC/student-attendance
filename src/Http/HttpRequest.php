<?php
namespace Src\Http;

class HttpRequest {
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $query;

    /**
     * @var array
     */
    private $body;

    /**
     * @var array
     */
    private $params;

    public function __construct($uri, $method, $query, $params, $body) {
        $this->uri = $uri;
        $this->method = $method;
        $this->query = $query;
        $this->body = $body;
        $this->params = $params;
    }   

    /**
     * Get the value of uri
     *
     * @return  string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * Get the value of method
     *
     * @return  string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * Get the value of query
     *
     * @return  array
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * Get the value of body
     *
     * @return  array
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Get the value of params
     *
     * @return  array
     */
    public function getParams() {
        return $this->params;
    }
}