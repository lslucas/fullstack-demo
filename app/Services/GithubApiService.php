<?php namespace App\Services;

use GuzzleHttp\Client;

class GithubApiService
{
    public $client;

    public function __construct()
    {
        $this->startup();

        return $this->client;
    }

    public function startup()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
            'timeout'  => 10,
        ]);
    }

    public function get($endpoint)
    {
        $rq = $this->client->request('GET', $endpoint);

        return [
            'code' => $rq->getStatusCode(),
            'body' => json_decode($rq->getBody()->getContents())
        ];
    }
}