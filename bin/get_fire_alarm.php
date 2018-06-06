<?php
require dirname(__DIR__)."/vendor/autoload.php";

use Spiders\NTFDFireSpider;

$spider = new NTFDFireSpider;

$alarms = $spider->getFireAlarms();

print_r($alarms);