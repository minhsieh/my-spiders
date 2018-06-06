<?php
namespace Spiders;

use Curl\Curl;
use PHPHtmlParser\Dom;

class BaseSpider
{
    public function getHtml($url)
    {
        $curl = new Curl;
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST,2);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER,false);
        $curl->setOpt(CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36');
        $curl->get($url);

        if($curl->error){
            throw new Exception("CurlError: ".$curl->errorCode."##".$curl->errorMessage);
        }
        $html = $curl->response;
        $curl->close();
        return $html;
    }

    public function getDom($html)
    {
        $dom = new Dom;
        $dom->load($html);
        return $dom;
    }
}