<?php
require dirname(__DIR__)."/vendor/autoload.php";
use Spiders\GameskySpider;

$spider = new GameskySpider;

$alarms = $spider->getSales();

print_r($alarms);

