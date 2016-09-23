<?php
/*
 * @双色球练习篇
 * 此项目主要为了练习
 * 期数
 * 红球1-33 选6
 * 篮球1-16 选1
 * */
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');
//载入xlu框架
include_once(XLU_ROOT.RF_OFFDIR.'xlu.php');


//test 初步测试框架
//彩票500采集
//$res = xlu::object('xlu\lib\resource',array(array('res_name'=>'http://datachart.500.com/ssq/?expect=100','res_type'=>'url')));
//历史url
//url http://datachart.500.com/ssq/history/newinc/history.php?start=1&end=2
$url = 'http://datachart.500.com/ssq/history/newinc/history.php?start=10000&end=10001';

$res = xlu::object('xlu\lib\resource',array(array('res_name'=>$url,'res_type'=>'url')));

$obj_res = $res->getObject();

//获得双色球的原始数据
$orig_html = $obj_res->read();

//echo $orig_html;

//var_export($orig_html);

//获得需要的html
/*
 * 
 *没有/s修饰符 .不会匹配换行符
 *
 */
//获得全部格式
preg_match_all ('/<tbody id="tdata">([\s\S]*)<\/tbody>/ims',$orig_html,$need_html ,  PREG_PATTERN_ORDER );



//格式拆分
$need_html = trim($need_html[1][0]);

//期数
preg_match_all ('/<td>([\s\S]*?)<\/td>/ims',$need_html,$sq_html ,  PREG_PATTERN_ORDER );
$sq = $sq_html[1][1];
echo '期数：'.$sq.'<br>';

//红球
preg_match_all ('/<td class="t_cfont2">([\s\S]*?)<\/td>/ims',$need_html,$red_html ,  PREG_PATTERN_ORDER );
$red_data = $red_html[1];
var_dump($red_data);

//蓝球
preg_match_all ('/<td class="t_cfont4">([\s\S]*?)<\/td>/ims',$need_html,$blue_html ,  PREG_PATTERN_ORDER );
$blue_data = $blue_html[1][0];
var_dump($blue_data);



var_dump($need_html);

	
	
	
?>