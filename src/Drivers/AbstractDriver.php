<?php
/**
 * Created by PhpStorm.
 * User: vyalov
 * Date: 19.08.18
 * Time: 14:33
 */

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers;


use GuzzleHttp\ClientInterface;
use VyalovAlexander\AntiplagiatTextChecker\DriverInterface;

abstract class AbstractDriver implements DriverInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    protected $url;

    protected $api_key;

    protected $test_env;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->test_env = getenv('TEST_ENV');
    }
}