<?php

namespace VyalovAlexander\AntiplagiatTextChecker;

use GuzzleHttp\ClientInterface;

class Checker
{

    /**
     * @var array
     */
    protected $drivers;
    /**
     * @var \GuzzleHttp\ClientInterface;
     */
    protected $httpClient;
    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * @var array
     */
    protected $ignoredURL = [];


    public function __construct(ClientInterface $client)
    {
        $this->httpClient = $client;
    }


    /**
     * @param string $driverName
     * @param string $className
     * @return Checker
     */
    public function addDriver(string $driverName, string $className) : Checker
    {
        $this->drivers[$driverName] = [$className];

        return $this;
    }

    /**
     * @param string $driverName
     * @return Checker
     * @throws \Exception
     */
    public function useDriver(string $driverName) : Checker
    {
        if (array_key_exists($driverName, $this->drivers))
        {
            $class = $this->drivers[$driverName][0];
            $this->driver = new $class($this->httpClient);
        }
        else
        {
            throw new \Exception('Driver not found');
        }

        return $this;
    }

    /**
     * @param array $ignoredURls
     * @return Checker
     */
    public function addIgnoredURLs(array $ignoredURls): Checker
    {
        $this->drivers = array_merge($ignoredURls, $this->drivers);

        return $this;
    }

    /**
     * @param string $text
     * @return float
     */
    public function check(string $text): ResultParserInterface
    {
        return $this->driver->check($text);
    }
}