<?php

namespace VyalovAlexander\AntiplagiatTextChecker;

use Dotenv\Dotenv;

class Checker
{
    private $driver;

    public function __construct(string $pathToEnvFile)
    {
        $dotenv = new Dotenv($pathToEnvFile);
        $dotenv->load();
        $dotenv->required(['DRIVER_NAME']);
        $this->driver = $this->getDriver(getenv('DRIVER'));
    }


    private function getDriver(string $service): DriverInterface
    {
        switch ($service)
        {
            case 'text.ru':
                return new TextRuDriver();
                break;
            case 'content-watch.ru':
                return new TextRuDriver();
                break;

        }
    }

    public function check(string $text)
    {

    }
}