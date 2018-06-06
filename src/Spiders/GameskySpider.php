<?php
namespace Spiders;

class GameskySpider extends BaseSpider
{
    public function __construct()
    {

    }

    public function getNews()
    {
        $url = "http://www.gamersky.com/steam/news/";
        return $this->getPostList($url);
    }

    public function getSales()
    {
        $url = "http://www.gamersky.com/steam/sales/";
        return $this->getPostList($url);
    }

    public function getPostList($url = "")
    {
        if(empty($url)) throw new Exception(__function__.' input $url is empty');

        $html = $this->getHtml($url);
        $dom  = $this->getDom($html);
        $result = [];
        $lis = $dom->find("ul")[0]->find('li');

        foreach($lis as $one){
            $two = $one->find("div")[0]->find('a')[0];

            $result[] = [
                'title' => $two->getAttribute("title"),
                'href' => $two->getAttribute("href")
            ];
        }
        return $result;
    }
}