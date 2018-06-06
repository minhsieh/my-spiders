<?php
namespace Spiders;

class NTFDFire extends BaseSpider
{
    protected $ntfd_url = "http://minhsieh.info/api/firealarm/";
    protected $base_path;

    public function __construct($ntfd_url = "" , $base_path = "")
    {
        if(!empty($ntfd_url)) $this->ntfd_url = $ntfd_url;
        if(!empty($base_path)) $this->base_path = $base_path;
    }

    public function getFireAlarms()
    {
        $html  =  $this->getHtml($this->ntfd_url);
        $dom   =  $this->getDom($html);

        $tds = $dom->find("table tr[style=\"height: 25px\"]");

        $result = [];

        foreach($table as $key => $one){
            $two = $one->find("td");

            $result[] = [
                'time' => str_replace ("&nbsp;&nbsp;&nbsp;&nbsp;"," ",$two[0]->plaintext),
                'type' => $two[1]->plaintext,
                'team' => $two[2]->plaintext,
                'status' => $two[3]->plaintext,
                'location' => $two[4]->plaintext,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        return $result;
    }
}