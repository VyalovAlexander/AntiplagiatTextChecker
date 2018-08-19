<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRU;

use GuzzleHttp\ClientInterface;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\AbstractDriver;
use VyalovAlexander\AntiplagiatTextChecker\ResultParserInterface;


class Driver extends AbstractDriver
{
    public function __construct(ClientInterface $client)
    {
        parent::__construct($client);
        $this->api_key = getenv('TEXT_RU_API_KEY');
        $this->url = getenv('TEXT_RU_URL');
    }

    public function check(string $text): ResultParserInterface
    {
        $this->client->request();
    }


}