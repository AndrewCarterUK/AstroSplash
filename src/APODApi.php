<?php

namespace Application;

use GuzzleHttp\ClientInterface;

class APODApi
{
    private $client;
    private $endpoint;
    private $apiKey;

    public function __construct(ClientInterface $client, $endpoint, $apiKey)
    {
        $this->client   = $client;
        $this->endpoint = $endpoint;
        $this->apiKey   = $apiKey;
    }

    public function getPictureOfTheDay($date = null)
    {
        $query = [
            'api_key'      => $this->apiKey,
            'concept_tags' => 'true',
        ];

        if (null !== $date) {
            $query['date'] = $date;
        }

        $response = $this->client->request('GET', $this->endpoint, ['query' => $query]);

        if (200 !== $response->getStatusCode()) {
            throw new \RuntimeException('API returned non 200 status code: '.$response->getStatusCode());
        } elseif (!in_array('application/json', $response->getHeader('Content-Type'))) {
            throw new \RuntimeException('API did not return JSON, instead: '.$response->getHeaderLine('Content-Type'));
        }

        $result = json_decode((string) $response->getBody(), true);

        if (null === $result) {
            throw new \RuntimeException('Could not decode response as JSON');
        }

        return $result;
    }
}
