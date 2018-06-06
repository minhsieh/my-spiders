Spiders - 爬蟲區
=================
一些平常自己在用的爬蟲，將其package起來方便其他服務使用。


### 爬蟲們（？

- ```php Spiders\NTFDFireSpider  ``` 用來撈取新北市消防局的案件派遣資訊的
- ```php Spiders\GameskySpider  ``` 抓取Gamesky文章

### Install

可以透過composer來安裝這些爬蟲

```
composer require minhsieh/my-spiders
composer install
```

### Usage
```php
require "vendor/autoload.php";

use Spiders\GameskySpider;

$spider = new GameskySpider;
$sales_news = $spider->getSales();
print_r($sales_news);

use Spiders\NTFDFireSpider;

$spider_2 = new NTFDFireSpider;
$alarms = $spider_2->getFireAlarms();
print_r($alarms);
```

### TODO

**一些正在開發的爬蟲：**

- 統一發票
- PTT指定版面文章爬曲
- 樂透彩（威力彩、大樂透...等等）
- 運動彩券