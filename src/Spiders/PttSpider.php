<?php
namespace Spiders;

use Spiders\BaseSpider;

class PttSpider extends BaseSpider
{
    public function getPosts($target_board,$pages = 1)
    {
        $ptt_url = "https://www.ptt.cc";
        $url = $ptt_url."/bbs/".$target_board."/index.html";
        $result = [];

        for($i = 0 ; $i < $pages ; $i++){
            $html = $this->getHtml($url,['cookies' => ['over18' => 1]]);
            $dom = $this->getDom($html);
            $posts = $dom->find('.r-ent');
            $result_tmp = [];
            foreach($posts as $post){
                try{
                    $a = $post->find(".title")->find("a");
                    if(count($a) == 0) continue;
                    $href   =  $ptt_url.$a->getAttribute("href");
                    $title  =  $a->text(true);
                    $likes  =  $post->find(".nrec")->find("span");
                    $author =  $post->find(".meta")[0]->find(".author")[0]->text(true);
                    $date   =  $post->find(".meta")[0]->find(".date")[0]->text(true);

                    if(count($likes) > 0){
                        $likes = $likes->text(true);
                        if($likes == "爆"){
                            $likes = 99;
                        }else{
                            $likes = intval($likes);
                        }
                    }else{
                        $likes = 0;
                    }
                    
                    $result_tmp[] = [
                        'title' => $title,
                        'href' => $href,
                        'author' => $author,
                        'date' => $date,
                        'likes' => $likes,
                    ];
                }catch(Exception $ex){
                    echo $ex.PHP_EOL;
                }   
            }
            $result = array_merge($result,array_reverse($result_tmp));
        
            $btn = $dom->find('.btn-group-paging')->find('.btn')[1];
            $url = $ptt_url.$btn->getAttribute('href');
        }
        return $result;
    }
}