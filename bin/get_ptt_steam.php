<?php
require dirname(__DIR__)."/vendor/autoload.php";
use Spiders\PttSpider;

$spider = new PttSpider;

$alarms = $spider->getPosts("Gossiping",3);

print_r($alarms);

