<?php

require 'vendor/autoload.php';
use VyalovAlexander\AntiplagiatTextChecker\Checker;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$checker = new Checker(new GuzzleHttp\Client());
/*$result = $checker->addDriver('ContentWatch', \VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch\Driver::class)
    ->useDriver('ContentWatch')->check('Article 20, paragraph 10, regards appeals for the public concerned on decisions on the basis of the Environmental management act for which section 3.5 of the General administrative law act does not apply (see also the responce to question 28 (c) below).');*/

$result = $checker->addDriver('ContentWatch', \VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape\Driver::class)
    ->useDriver('ContentWatch')->check('Article 20, paragraph 10, regards appeals for the public concerned on decisions on the basis of the Environmental management act for which section 3.5 of the General administrative law act does not apply (see also the responce to question 28 (c) below).');

var_dump($result);