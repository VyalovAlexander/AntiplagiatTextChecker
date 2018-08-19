<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch;

use VyalovAlexander\AntiplagiatTextChecker\Drivers\ResultParser;

class Parser extends ResultParser
{
    public function __construct(string $code, string $body)
    {
        if ($code == 200) {
            $result = json_decode(trim($body));
            if (!isset($result->error)) {
                $this->setError('Ошибка запроса');

            } else if (!empty($result->error)) {
                $this->setError('Возникла ошибка: ' . $result->error);

            } else {
                $this->setSuccess(true);
                $this->setResult($result->percent);
            }
        } else {
            $this->setError('Ошибка ' . $code);
        }
    }

}