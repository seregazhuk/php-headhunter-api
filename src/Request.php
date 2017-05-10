<?php

namespace seregazhuk\HeadHunterApi;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request
{
    const BASE_URL = 'https://api.hh.ru/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $locale = 'RU';

    /**
     * @var string
     */
    protected $host = 'hh.ru';

    /**
     * @param string $token
     */
    public function __construct($token = null)
    {
        $this->client = new Client([
            'base_uri'    => self::BASE_URL,
            'http_errors' => false,
        ]);

        if ($token) $this->addAuthHeader($token);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = [])
    {
        if (!empty($params)) {
            $uri .= '?' . $this->makeQueryString($params);
        }

        return $this->executeRequest('GET', $uri);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function post($uri, $params = [])
    {
        return $this->executeRequest(
            'POST', $uri, ['query' => $params]
        );
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function postJson($uri, $params = [])
    {
        return $this->executeRequest(
            'POST', $uri, ['json' => $params]
        );
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function postFile($uri, $params = [])
    {
        return $this->executeRequest(
            'POST', $uri, ['multipart' => $params]
        );
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function put($uri, $params = [])
    {
        return $this->executeRequest(
            'PUT', $uri, ['query' => $params]
        );
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function putJson($uri, $params = [])
    {
        return $this->executeRequest(
            'PUT', $uri, ['json' => $params]
        );
    }

    /**
     * @param string $uri
     * @return array|null
     */
    public function delete($uri)
    {
        return $this->executeRequest('DELETE', $uri);
    }

    /**
     * @param ResponseInterface $response
     * @return array|null
     */
    protected function parseResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array|null
     */
    protected function executeRequest($method, $uri, array $options = [])
    {
        $request = new GuzzleRequest($method, $uri, $this->headers);

        $response = $this->client->send($request, $options);

        return $this->parseResponse($response);
    }

    /**
     * @param string $locale
     * @return Request
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param $params
     * @return string
     */
    protected function makeQueryString($params = [])
    {
        $customOptions = [
            'host'   => $this->host,
            'locale' => $this->locale,
        ];

        $params = array_merge(
            $params, $customOptions
        );

        return http_build_query($params);
    }

    /**
     * @param string $host
     * @return Request
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param string $token
     */
    protected function addAuthHeader($token)
    {
        $this->headers = ['Authorization' => 'Bearer ' . $token];
    }
}