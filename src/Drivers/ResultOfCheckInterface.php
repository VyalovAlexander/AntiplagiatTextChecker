<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.08.18
 * Time: 17:14
 */

namespace VyalovAlexander\AntiplagiatTextChecker;


interface ResultOfCheckInterface
{
    public function isSucess(): bool;

    public function resultObtained(): bool;

    public function getUniquenessRate(): float;
}