<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\ContentWatch;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch\Parser;

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
        $this->assertEquals(20, $parser->getResult());
    }

    public function responseProvider()
    {
        return [
            [200, '{"error" : "", "percent" : 20}', ''],
            [404, '', 'Ошибка 404'],
            [200, '{"error" : "TestError"}', 'Возникла ошибка: TestError'],
            [200, '{}', 'Ошибка запроса']
        ];
    }

}