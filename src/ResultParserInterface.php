<?php

namespace VyalovAlexander\AntiplagiatTextChecker;

Interface ResultParserInterface
{

    public function isSuccess(): bool;

    public function getResult(): float;

    public function getError(): string;
}