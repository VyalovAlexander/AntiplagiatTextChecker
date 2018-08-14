<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.08.18
 * Time: 15:52
 */

namespace VyalovAlexander\AntiplagiatTextChecker;


interface DriverInterface
{
    public function check(string $text);

    //public function getResultOfLastCheck() : ResultOfCheckInterface;
}