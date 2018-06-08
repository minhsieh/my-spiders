<?php
namespace Spiders;

class LotterySpider extends BaseSpider
{
    public function getBig()
    {
        $url = "http://www.taiwanlottery.com.tw/Lotto/Lotto649/history.aspx";
        return $this->getParse($url,"big");
    }

    public function getPower()
    {
        $url = "http://www.taiwanlottery.com.tw/lotto/superlotto638/history.aspx";
        return $this->getParse($url,"power");
    }

    public function getDafu()
    {
        $url = "http://www.taiwanlottery.com.tw/Lotto/Lotto740/history.aspx";
        return $this->getParse($url,"dafu");
    }

    public function getParse($url , $type)
    {
        $html = $this->getHtml($url);
        $dom = $this->getDom($html);

        $tables_org = $dom->find('.table_org');
        $tables_gre = $dom->find('.table_gre');

        $tables = [];

        foreach($tables_org as $k => $one){
            $tables[] = $one;
            if(!empty($tables_gre[$k])) $tables[] = $tables_gre[$k];
        }

        $result = [];

        switch($type){
            case "power":
                $key_ball_fall = 4;
                $key_ball_size = 5;
                $key_prize = 7;
                break;
            
            case "big":
                $key_ball_fall = 3;
                $key_ball_size = 4;
                $key_prize = 6;
                break;

            case "dafu":
                $key_ball_fall = 3;
                $key_ball_size = 4;
                $key_prize = 6;
                break;
        }

        foreach($tables as $k => $table){
            //日期
            $date = $table->find('tr')[1]->find('td')[1]->text(true);

            //期數
            $loto_no = $table->find('tr')[1]->find('td')[0]->text(true);

            //銷售總額
            $total_sell = $table->find('tr')[1]->find('td')[3]->text(true);

            //落球順序
            $ball_fall_dom = $table->find('tr')[$key_ball_fall]->find('td');
            $ball_fall = [];
            foreach($ball_fall_dom as $one){
                $ball_fall[] = $one->text(true);
            }
            unset($ball_fall[0]);

            //大小順序
            $ball_size_dom = $table->find('tr')[$key_ball_size]->find('td');
            $ball_size = [];
            foreach($ball_size_dom as $one){
                $ball_size[] = $one->text(true);
            }
            unset($ball_size[0]);

            //獎金分配
            $prizes     = $table->find('tr')[$key_prize]->find('td');
            $prizes_qty = $table->find('tr')[$key_prize + 2]->find('td');
            $prizes_amt = $table->find('tr')[$key_prize + 3]->find('td');

            $prize_result = [];
            foreach($prizes as $k => $prize){
                $prize_result[] = [
                    'prize' => $prize->text(true),
                    'qty' => $prizes_qty[$k]->text(true),
                    'amt' => $prizes_amt[$k]->text(true)
                ];
            }
            unset($prize_result[0]);
            
            $result[] = [
                'date' => $date,
                'id' => $loto_no,
                'total_sell' => $total_sell,
                'ball_fall' => $ball_fall,
                'ball_size' => $ball_size,
                'prize' => $prize_result
            ];
        }
        return $result;
    }
}