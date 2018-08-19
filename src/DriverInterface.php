<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.08.18
 * Time: 15:52
 */

namespace VyalovAlexander\AntiplagiatTextChecker;

use GuzzleHttp\ClientInterface;

interface DriverInterface
{

    public function __construct(ClientInterface $client);

    public function check(string $text): ResultParserInterface;

}