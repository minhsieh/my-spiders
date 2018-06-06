<?php
require "../vendor/autoload.php";

use PHPHtmlParser\Dom;
use Curl\Curl;


// Check there is no other process running
$files = __DIR__."/proc";
$files = array_diff(scandir($files), array('..', '.'));

foreach($files as $one){
        if(file_exists("/proc/".$one)){
                echo "*** This job is running with pid: $one now , exit. ***\n";
                exit();
        }else{
                //Pendding job, remove it.
                unlink(__DIR__."/proc/".$one);
        }
}
//Start a job with pid
file_put_contents(__DIR__."/proc/".getmypid() , date('Y-m-d H:i:s'));


$url = "";

$curl = new Curl;
$curl->setOpt(CURLOPT_SSL_VERIFYHOST,2);
$curl->setOpt(CURLOPT_SSL_VERIFYPEER,false);
$curl->setOpt(CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36');
$curl->get($url);

if($curl->error){
    echo "CurlError: ".$curl->errorCode."##".$curl->errorMessage.PHP_EOL;
    exit;
}

$html = $curl->response;

$dom = new Dom;
$dom->load($html);


