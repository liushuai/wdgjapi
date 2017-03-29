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
