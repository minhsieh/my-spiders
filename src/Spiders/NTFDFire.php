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

        foreach($tds as $key => $one){
            $two = $one->find("td");

            $result[] = [
                'time' => str_replace ("&nbsp;&nbsp;&nbsp;&nbsp;"," ",$two[0]->text(true)),
                'type' => $two[1]->text(true),
                'team' => $two[2]->text(true),
                'status' => $two[3]->text(true),
                'location' => $two[4]->text(true),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        return $result;
    }
}