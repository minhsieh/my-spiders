<?php
require dirname(__DIR__)."/vendor/autoload";

use Spiders\NTFDFire;

$spider = new NTFDFire;

$alarms = $spider->getFireAlarms();

print_r($alarms);