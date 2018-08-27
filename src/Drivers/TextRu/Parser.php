<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRu;

use VyalovAlexander\AntiplagiatTextChecker\Drivers\ResultParser;

class Parser extends ResultParser
{

    public function parse(string $code, string $body)
    {
        if ($code == 200) {
            $result = json_decode(trim($body));
            if (!empty($result->error_desc))
            {
                $this->setError('Возникла ошибка: ' . $result->error_desc);
            } else {
                $this->setResult($result->text_unique);
                $this->setSuccess(true);
            }
        } else {
            $this->setError('Ошибка ' . $code);
        }
    }

    public function parseUid(string $code, string $body)
    {
        if ($code == 200) {
            $result = json_decode(trim($body));
            if (!empty($result->error_desc)) {
                $this->setError('Возникла ошибка: ' . $result->error_desc);

            } else {
                if (isset($result->text_uid)) {
                    return $result->text_uid;
                }
                else {
                    $this->setError('Возникла ошибка');
                }
            }
        } else {
            $this->setError('Ошибка ' . $code);
        }
        return false;
    }

}