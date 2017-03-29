<?php
namespace wdgjapi;
use Curl;

/**
 * Class wdgjapi
 * @package wdgjapi
 * example
 * $data = array(
 *  'method'=>'wdgj.erp.stock.query',
 *  'accesstoken'=>'accesstoken',
 *  'appkey'=>'appkey',
 *  'page_no'=>1,
 *  'page_size'=>10,
 *  'url'=>'http://api.wdgj.com/wdgjcloud/api',
 *  'app_secret'=>'app_secret'
 *  );
 * $wdgjapi = new wdgjapi($data);
 * $r = $wdgjapi->send();
 * var_dump($r);
 * exit;
 */

class wdgjapi {
    protected $conf=array();
    protected $app_secret='';
    protected $curl;
    protected $url='http://api.wdgj.com/wdgjcloud/api';
    function __construct($conf){
        $this->conf = $conf;
        $this->set_secret($conf);
        $this->set_url($conf);
        $this->merage_params();
        $this->curl = new Curl\Curl();
    }

    protected function set_url(){
        if(isset($this->conf['url'])){
            $this->url = $this->conf['url'];
            unset($this->conf['url']);
        }
    }

    protected function set_secret(){
        if(isset($this->conf['app_secret'])){
            $this->app_secret = $this->conf['app_secret'];
            unset($this->conf['app_secret']);
        }else {
            return json_encode(array('error_code'=>'-1','error_info'=>'App_secret does not exist'));
        }
    }

    protected function merage_params(){
        $pre_params = array(
            'timestamp'=>strval(time()),
            'versions'=>'1.0',
            'format'=>'json'
        );
        $this->conf = array_merge($this->conf,$pre_params);
    }

    private function create_sign(){
        $new_d = $this->conf;
        sort($new_d,SORT_STRING);
        $d = $this->app_secret;
        $d.=join('',$new_d);
        $d.=$this->app_secret;
        $sign = strtolower(md5($d));
        $this->conf['Sign'] = $sign;
        foreach($this->conf as $k=>$v ){
            $this->conf[$k] = urlencode($v);
        }
    }

    public function send(){
        $this->create_sign();
        $this->curl->post($this->url, $this->conf);
        if ($this->curl->error) {
            return json_encode(array('error_code'=>'-1','error_info'=>$this->curl->error_message));
        } else {
            return $this->curl->response;
        }
    }



}