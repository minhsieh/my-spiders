<?php
require dirname(__DIR__)."/vendor/autoload.php";

use Spiders\NTFDFire;

$spider = new NTFDFire;

$alarms = $spider->getFireAlarms();

print_r($alarms);