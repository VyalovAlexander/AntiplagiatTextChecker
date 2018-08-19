<?php

namespace VyalovAlexander\AntiplagiatTextChecker\Drivers;

use VyalovAlexander\AntiplagiatTextChecker\ResultParserInterface;

abstract class ResultParser implements ResultParserInterface
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var string
     */
    private $error = '';

    /**
     * @var int
     */
    private $result = 0;

    /**
     * @param string $code
     * @param string $body
     * @return mixed
     */
    abstract public function __construct(string $code, string $body);

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error)
    {
        $this->error = $error;
    }

    /**
     * @return float
     */
    public function getResult(): float
    {
        return $this->result;
    }

    /**
     * @param float $result
     */
    public function setResult(float $result)
    {
        $this->result = $result;
    }

}