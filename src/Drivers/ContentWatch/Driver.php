<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch;

use GuzzleHttp\ClientInterface;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\AbstractDriver;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\ResultParser;
use VyalovAlexander\AntiplagiatTextChecker\ResultParserInterface;


class Driver extends AbstractDriver
{
    public function __construct(ClientInterface $client)
    {
        parent::__construct($client);
        $this->api_key = getenv('CONTENT_WATCH_API_KEY');
        $this->url = getenv('CONTENT_WATCH_URL');
    }

    public function check(string $text): ResultParserInterface
    {
        $data = [
            'key' => $this->api_key,
            'text' => $text
        ];
        if($this->test_env)
        {
            $data['test'] = 0;
        }

        $response = $this->client->request('POST', $this->url,
            [
                'form_params' => $data

            ]);

        $resultOfCheck = new Parser();
        $resultOfCheck->parse($response->getStatusCode(), $response->getBody());

        return $resultOfCheck;
    }


}