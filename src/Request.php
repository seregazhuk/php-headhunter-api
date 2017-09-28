<?php

namespace seregazhuk\HeadHunterApi;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request
{
    const BASE_URL = 'https://api.hh.ru/';

    /**
     * @var Client
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

        if ($token) $this->setToken($token);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = [])
    {
        $uri = $this->makeUriWithQuery($uri, $params);

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
     * @param array $params
     * @return array|null
     */
    public function delete($uri, $params = [])
    {
        $uri = $this->makeUriWithQuery($uri, $params);

        return $this->executeRequest('DELETE', $uri);
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

	    return json_decode($response->getBody(), true);
    }

    /**
     * @param string $locale
     * @return $this
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

        // Merge specified params with defaults
        $params = array_merge(
            $customOptions,
            $params
        );

        return http_build_query($params);
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
	    $this->headers = ['Authorization' => 'Bearer ' . $token];

        return $this;
    }

    /**
     * @param string $uri
     * @param array $params
     * @return string
     */
    protected function makeUriWithQuery($uri, array $params = [])
    {
        if (!empty($params)) {
            $uri .= '?' . $this->makeQueryString($params);
        }

        return $uri;
    }
}
