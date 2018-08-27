<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\Copyscape;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape\Parser;

class ParserTest extends TestCase
{

    /**
     * @dataProvider  responseProvider
     */
    public function testParse($code, $body, $expected)
    {
        $parser = new Parser();
        $parser->parse($code, $body);
        $this->assertEquals($expected, $parser->getError());
    }

    public function testParsePercent()
    {
        $parser = new Parser();
        $provider = $this->responseProvider();
        $parser->parse($provider[0][0], $provider[0][1]);
        $this->assertEquals(50, $parser->getResult());
    }

    public function responseProvider()
    {
        return [
            [200, '<?xml version="1.0" encoding="utf-8"?><response><error></error><querywords>200</querywords><count>100</count></response>', ''],
            [404, '', 'Ошибка 404'],
            [200, '<?xml version="1.0" encoding="utf-8"?><response><error>TestError</error></response>', 'Возникла ошибка: TestError'],
        ];
    }
}