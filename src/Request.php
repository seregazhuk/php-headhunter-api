<?php

namespace seregazhuk\HeadHunterApi;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $headers = [];

    protected $locale = 'RU';

    public function __construct($baseUrl, $token = null)
    {
        $this->client = new Client(['base_uri' => $baseUrl]);

        if ($token) $this->setHeaders(['Authorization' => 'Bearer ' . $token]);
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
    private function parseResponse(ResponseInterface $response)
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
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
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
        $params['locale'] = $this->locale;

        return http_build_query($params);
    }
}