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
        // if we have a github access token we shall use it :)
        $github_token = env('GITHUB_ACCESS_TOKEN');
        $token = '';

        if ($github_token) {
            $sep = strpos($endpoint, '?') ? '&' : '?';
            $token = $sep . 'access_token=' . $github_token;
        }

        $rq = $this->client->request('GET', $endpoint . $token);

        return [
            'code' => $rq->getStatusCode(),
            'data' => json_decode($rq->getBody()->getContents())
        ];
    }
}