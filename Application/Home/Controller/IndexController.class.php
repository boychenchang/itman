<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        vendor('Hprose.HproseHttpClient');
        $client = new \HproseHttpClient('http://localhost/test/index.php/Home/Service/index');
        $result = $client->test2();
        dump($result);
    }
    /**
     * [setredis description]
     * @return [type] [description]
     */
    public function setredis(){
        $redis = new \Redis();
    	$redis->connect('127.0.0.1', 6379);
    	$redis->set('name_list4','bb1');
    	// $redis->lpush('name_list3','cc2');
    	// $redis->lpush('name_list3','cc3');
    	// $redis->lpush('name_list3','cc4');
    	if($redis->ping() == '+PONG'){
    		echo 'ok';
    	}
    }

    public function getredis(){
        $redis = new \Redis();
    	$redis->connect('127.0.0.1', 6379);
    	// $rp = $redis->lrem('name_list3','cc4','1');
    	// dump($rp);
    	$re = $redis->lrange('name_list',0,-1);
        dump($re);
        // exit;
    	echo '===============================';
    	$br = $redis->brpoplpush('name_list','name_list2','3');
    	dump($br);
    	echo "===============================";
    	$re = $redis->lrange('name_list2',0,-1);
        dump($re);
    }
}