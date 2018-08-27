<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\ContentWatch;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch\Driver;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch\Parser;

final class DriverTest extends TestCase
{
    private $text = 'Some text';

    private function setENV()
    {
        putenv("CONTENT_WATCH_API_KEY=123456");
        putenv("CONTENT_WATCH_URL=http://localhost");
    }

    public function testCheck()
    {
        $this->setENV();
        $driver = new Driver(new Client());
        $result = $driver->check($this->text);
        $this->assertInstanceOf(Parser::class, $result);
    }






}