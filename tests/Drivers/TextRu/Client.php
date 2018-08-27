<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Tests\Drivers\TextRu;

use GuzzleHttp\ClientInterface;
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
                if (array_key_exists('userkey', $options['form_params']) && !empty($options['form_params']['userkey'])) {
                    if (array_key_exists('text', $options['form_params']) && !empty($options['form_params']['text'])) {
                        return new UIDResponse();

                    } elseif (array_key_exists('uid', $options['form_params']) && !empty($options['form_params']['uid'])) {

                        return new Response();

                    } else {
                        throw new \Exception('request form_params must contains "text" or "uid"');
                    }
                } else {
                    throw new \Exception('request form_params must contains "userkey"');
                }
            } else {
                throw new \Exception('request must contains "form_params"');
            }

        } else {
            throw new \Exception('Wrong method, must be GET');
        }
    }

    public function requestAsync($method, $uri, array $options = [])
    {

    }

    public function getConfig($option = null)
    {
        // TODO: Implement getConfig() method.
    }


}