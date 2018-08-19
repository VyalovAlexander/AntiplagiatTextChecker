<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRU;

use GuzzleHttp\ClientInterface;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\AbstractDriver;
use VyalovAlexander\AntiplagiatTextChecker\ResultParserInterface;


class Driver extends AbstractDriver
{
    protected $timeout;

    public function __construct(ClientInterface $client)
    {
        parent::__construct($client);
        $this->api_key = getenv('TEXT_RU_API_KEY');
        $this->url = getenv('TEXT_RU_URL');
        $this->timeout = getenv('TEXT_RU_TIMEOUT');
    }

    public function check(string $text): ResultParserInterface
    {
        $result = new Parser();
        $data = [
            'userkey' => $this->api_key,
            'text' => $text
        ];

        $response = $this->client->request('POST', $this->url, [ 'form_params' => $data]);
        $textUid = $result->parseUid($response->getStatusCode(), $response->getBody());
        if ($textUid)
        {
            $data = [
                'userkey' => $this->api_key,
                'uid' => $textUid
            ];
            sleep($this->timeout);
            $response = $this->client->request('POST', $this->url, [ 'form_params' => $data]);
            $result->parse($response->getStatusCode(), $response->getBody());
        }
        return $result;
    }


}