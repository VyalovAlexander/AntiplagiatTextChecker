<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\ContentWatch;

use GuzzleHttp\ClientInterface;
use PHPUnit\Runner\Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class Client implements ClientInterface
{
    public function send(RequestInterface $request, array $options = [])
    {
        // TODO: Implement send() method.
    }

    public function sendAsync(RequestInterface $request, array $options = [])
    {
        // TODO: Implement sendAsync() method.
    }

    public function request($method, $uri, array $options = [])
    {
        if ($method === 'POST') {
            if (array_key_exists('form_params', $options)) {
                if (array_key_exists('key', $options['form_params']) && array_key_exists('text', $options['form_params']) && !empty($options['form_params']['key']) && !empty($options['form_params']['text'])) {
                    return new Response();

                } else {
                    throw new Exception('request form_params must contains "key" and "text"');
                }
            } else {
                throw new Exception('request must contains "form_params"');
            }

        } else {
            throw new Exception('Wrong method, must be GET');
        }
    }

    public function requestAsync($method, $uri, array $options = [])
    {
        // TODO: Implement requestAsync() method.
    }

    public function getConfig($option = null)
    {
        // TODO: Implement getConfig() method.
    }


}