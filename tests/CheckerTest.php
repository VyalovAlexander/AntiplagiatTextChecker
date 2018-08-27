<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Checker;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch\Driver;
use VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\ContentWatch\Client;

final class CheckerTest extends TestCase
{

    public function testAddDriver()
    {
        $checker = new Checker(new Client());
        $checker1 = $checker->addDriver('ContentWatch', Driver::class);
        $this->assertSame($checker, $checker1);
    }


    public function testUseDriver()
    {
        $checker = new Checker(new Client());
        $checker1 = $checker->addDriver('ContentWatch', Driver::class)->useDriver('ContentWatch');
        $this->assertSame($checker, $checker1);
    }

    public function checkTest()
    {
        $checker = new Checker(new Client());
        $result = $checker->addDriver('ContentWatch', Driver::class)->useDriver('ContentWatch')->check("Some text");
        $this->assertEquals(20, $result->getResult());
    }


}