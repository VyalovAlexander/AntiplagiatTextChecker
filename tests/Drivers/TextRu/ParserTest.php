<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\TextRu;

use PHPUnit\Framework\TestCase;
use VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRu\Parser;

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
            [200, '{"error_desc" : "", "text_unique" : 20}', ''],
            [404, '', 'Ошибка 404'],
            [200, '{"error_desc" : "TestError"}', 'Возникла ошибка: TestError'],
        ];

    }

    /**
     * @dataProvider  UidresponseProvider
     */
    public function testParseUid($code, $body, $expected)
    {
        $parser = new Parser();
        $parser->parseUid($code, $body);
        $this->assertEquals($expected, $parser->getError());
    }

    public function testGetParsedUid()
    {
        $parser = new Parser();
        $provider = $this->UidResponseProvider();
        $uid = $parser->parseUid($provider[0][0], $provider[0][1]);
        $this->assertEquals('12345', $uid);
    }

    public function UidResponseProvider()
    {
        return [
            [200, '{"error_desc" : "", "text_uid" : "12345"}', ''],
            [404, '', 'Ошибка 404'],
            [200, '{"error_desc" : "TestError"}', 'Возникла ошибка: TestError'],
            [200, '{"error_desc" : ""}', 'Возникла ошибка']
        ];

    }
}