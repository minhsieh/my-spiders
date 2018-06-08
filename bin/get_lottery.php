<?php
require dirname(__DIR__)."/vendor/autoload.php";

use Spiders\LotterySpider;

$spider = new LotterySpider;

$alarms = $spider->getDafu();

print_r($alarms);