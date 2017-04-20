# 网店管家api接口

## Installation

**install with composer**
```php
composer require andyliu/wdgjapi
```

## Usage
**example**

```php
require './vendor/autoload.php';
use wdgjapi;
$data = array(
    'method'=>'wdgj.erp.stock.query',
    'accesstoken'=>'accesstoken',
    'appkey'=>'appkey',
    'page_no'=>1,
    'page_size'=>10,
    'url'=>'http://api.wdgj.com/wdgjcloud/api',
    'app_secret'=>'app_secret',
    'BarCode'=>'1111'
);
echo '<pre>';
$wdgjapi = new wdgjapi\wdgjapi($data);

$r = $wdgjapi->send();
var_dump($r);
exit;
```

## 注意
目前测试了下面两个接口 其他接口兼容性没有做验证
wdgj.erp.stock.query
wdgj.com.goods.create
