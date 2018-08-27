<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\TextRu;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRu\Driver;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRu\Parser;

final class DriverTest extends TestCase
{

    private $text = 'Some text';

    private function setENV()
    {
        putenv("TEXT_RU_API_KEY=123456");
        putenv("CONTENT_WATCH_URL=http://localhost");
        putenv('TEXT_RU_TIMEOUT=1');
    }

    public function testCheck()
    {
        $this->setENV();
        $driver = new Driver(new Client());
        $result = $driver->check($this->text);
        $this->assertInstanceOf(Parser::class, $result);
    }
}