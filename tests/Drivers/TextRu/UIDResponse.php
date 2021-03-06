<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 27.08.18
 * Time: 12:49
 */

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\TextRu;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class UIDResponse implements ResponseInterface
{
    public function getStatusCode()
    {
        return 200;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }

    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    public function getBody()
    {
        return "{
            'error_desc' : '',
            'text_uid' : 1359,
        }";
    }

    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }


}