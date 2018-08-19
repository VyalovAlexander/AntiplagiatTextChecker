<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape;

use GuzzleHttp\ClientInterface;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\AbstractDriver;
use VyalovAlexander\AntiplagiatTextChecker\ResultParserInterface;


class Driver extends AbstractDriver
{
    protected $username;

    public function __construct(ClientInterface $client)
    {
        parent::__construct($client);
        $this->api_key = getenv('COPYSCAPE_API_KEY');
        $this->url = getenv('COPYSCAPE_URL');
        $this->username = getenv('COPYSCAPE_USERNAME');
    }

    public function check(string $text): ResultParserInterface
    {
        $url= $this->url . '?u='. $this->username .
            '&k='. $this->api_key .'&o=csearch&c=4';
        if($this->test_env)
        {
            $url .= '&x=1';
        }
        $response = $this->client->request('POST', $url,
            [
                'form_params' => [$text]
            ]
        );

        $resultOfCheck = new Parser($response->getStatusCode(), $response->getBody());

        return $resultOfCheck;
    }


}