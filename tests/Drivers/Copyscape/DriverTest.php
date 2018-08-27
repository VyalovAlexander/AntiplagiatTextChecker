<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\Copyscape;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape\Parser;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape\Driver;


final class DriverTest extends TestCase
{

    private $text = 'Some text';

    private function setENV()
    {
        putenv("COPYSCAPE_API_KEY=123456");
        putenv("COPYSCAPE_URL=http://localhost");
        putenv("COPYSCAPE_USERNAME=username");
    }

    public function testCheck()
    {
        $this->setENV();
        $driver = new Driver(new Client());
        $result = $driver->check($this->text);
        $this->assertInstanceOf(Parser::class, $result);
    }
}