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

    public function testJoin(){
        // $re = mb_substr($temp_str,1);
        // dump($re);
        // $re = $this->GBsubstr($temp_str,0,2);
        // dump(实打实的);
        // dump(ord($temp_str));
        // dump($this->utf_substr('我阿什顿麻将搭了靠；来看看了','2'));
        echo str_replace("world","baidu","Hello world!"); 
        echo strtr("Hello world!","world","baidu"); 
        exit;
        $temp_str = '撒旦的所得税';
        $temp_str = substr($temp_str, 3);
        dump($temp_str);
        dump(ord($temp_str));
        dump(ord('撒'));
        exit;
        $re = $this->utf_substr($temp_str,5);
        dump($re);
    }

    private function utf_substr($str, $len) {
        for ($i = 0; $i < $len; $i++) {
            
            if (ord($temp_str) > 127) {
                $new_str[] = substr($str, 0, 3);
                $str = substr($str, 3);
            } else {
                $new_str[] = substr($str, 0, 1);
                $str = substr($str, 1);
            }
        }
        return join($new_str);
    }

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

    public function level(){
        $items = array( 
              2 => array('id' => 2, 'pid' => 0, 'name' => '黑龙江省'),
              4 => array('id' => 4, 'pid' => 2, 'name' => '哈尔滨市'),
              5 => array('id' => 5, 'pid' => 2, 'name' => '鸡西市'), 
              6 => array('id' => 6, 'pid' => 4, 'name' => '香坊区'), 
              7 => array('id' => 7, 'pid' => 4, 'name' => '南岗区'), 
              8 => array('id' => 8, 'pid' => 6, 'name' => '和兴路'), 
              9 => array('id' => 9, 'pid' => 7, 'name' => '西大直街'), 
              20 => array('id' => 20, 'pid' => 0, 'name' => '广东省'), 
              21 => array('id' => 21, 'pid' => 20, 'name' => '广州市'),
            ); 
        // $items = M('news')->select();
        $t = array(); 
        foreach ($items as $id => $item) { 
          if ($item['pid']) { 
            $items[$item['pid']][$item['id']] = &$items[$item['id']];
            dump($items[$item['pid']][$item['id']]);
            exit;
            $t[] = $id; 
          } 
        } 
        foreach($t as $u) { 
          unset($items[$u]); 
        } 
        echo "<pre>"; 
        print_r($items);
        exit;
        $re = M('news')->select();
        dump($re);
            // $space = str_repeat ( '1111111111', 2 );
            // dump($space);
            // exit;
        // foreach ($re as $key => $value) {
        //     if ($value['path'] === '0') {
        //         echo $value['name'].'</br>'.'</br>';
        //         foreach ($re as $key1 => $value1) {
        //             if ($value1['path'] == $value['id']) {
        //                 echo '--'.$value1['name'].'</br>'.'</br>';
        //                 foreach ($re as $key2 => $value2) {
        //                     if ($value2['path'] == $value1['id']) {
        //                         echo '----'.$value2['name'].'</br>'.'</br>';
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        foreach ($re as $key => $value) {
            /**0
              * 第一种展示方法
             */
            /*$space = str_repeat ( '&nbsp;&nbsp;&nbsp;&nbsp;', count ( explode ( '-', $row ['abspath'] ) ) - 1 );
            echo $space . $row ['name'] . '<br>';*/
            /**
             * 第二种展示方法
             */
            $space = str_repeat ( '&nbsp;&nbsp;&nbsp;&nbsp;', count ( explode ( '-', $value ['path'] ) ) - 1 );

            $option .= '<option value="' . $value ['id'] . '">' . $space . $value ['name'] . '</option>';
        }
        echo '<select name="opt">' . $option . '</select>';
    }
}