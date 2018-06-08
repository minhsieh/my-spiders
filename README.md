Spiders - 爬蟲區
=================
一些平常自己在用的爬蟲，將其package起來方便其他服務使用。


### 爬蟲們（？

- ```Spiders\NTFDFireSpider  ``` 用來撈取新北市消防局的案件派遣資訊的
- ```Spiders\GameskySpider  ``` 抓取Gamesky文章
- ```Spiders\PttSpider  ``` 用來抓取PTT網頁版指定版別的最新幾頁文章

### Install

可以透過composer來安裝這些爬蟲

```
composer require minhsieh/my-spiders
composer install
```

### Usage
```php
require "vendor/autoload.php";


#GameSky
use Spiders\GameskySpider;

$spider = new GameskySpider;
$sales_news = $spider->getSales(); //取得Steam特惠文章
$news = $spider->getNews();  //取得Steam相關新聞

print_r($news);

#NTFD 新北市消防局派遣消息
use Spiders\NTFDFireSpider;

$spider_2 = new NTFDFireSpider;
$alarms = $spider_2->getFireAlarms();
print_r($alarms);

#PTT文章
use Spiders\PttSpider;

$spider_ptt = new PttSpider;
$posts = $spider_ptt->getPost("Steam",2); //getPost(版名,頁數)
print_r($posts);

```

### TODO

**一些正在開發的爬蟲：**

- 統一發票
- 樂透彩（威力彩、大樂透...等等）
- 運動彩券
