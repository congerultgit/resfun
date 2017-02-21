<?php
set_time_limit(0); 
/*
 * @双色球练习篇
 * 此项目主要为了练习
 * 期数
 * 红球1-33 选6
 * 篮球1-16 选1
 * */
//lxtest
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');

//confing
header("Content-type: text/html; charset=utf-8");    


//载入xlu框架
include_once(XLU_ROOT.RF_OFFDIR.'xlu.php');


$db = xlu::object(array(
		'class'=>'xlu\lib\db\DbConnection',
		'username' =>'root',
		'password'  => '',
		'dsn'=>'mysql:host=127.0.0.1;dbname=test',
		'charset' =>'utf8'
));


//test 初步测试框架
//彩票500采集
//$res = xlu::object('xlu\lib\resource',array(array('res_name'=>'http://datachart.500.com/ssq/?expect=100','res_type'=>'url')));
//历史url
//url http://datachart.500.com/ssq/history/newinc/history.php?start=1&end=2
$start = 16025;
$end = 16025;

$limit = 1;
while(1==1){
//$limit++;
//if($limit == 10)break;
usleep(1000);
$url = 'http://datachart.500.com/ssq/history/newinc/history.php?start='.$start.'&end='.$end.'';
$res = xlu::object('xlu\lib\resource',array(array('res_name'=>$url,'res_type'=>'url')));
echo $url.'</br>';
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
echo 'id:'.$sq.'<br>';
if(empty($sq)){
	echo ($sq-1);
	echo 'down';
	exit;
}
//红球
preg_match_all ('/<td class="t_cfont2">([\s\S]*?)<\/td>/ims',$need_html,$red_html ,  PREG_PATTERN_ORDER );
$red_data = $red_html[1];
echo '<pre>';
var_dump($red_data);
echo '</pre>';
//蓝球
preg_match_all ('/<td class="t_cfont4">([\s\S]*?)<\/td>/ims',$need_html,$blue_html ,  PREG_PATTERN_ORDER );
$blue_data = $blue_html[1][0];
echo '<pre>';
var_dump($blue_data);
echo '</pre>';

//生成SQL 'insert into fun_ssq(sys_number,red_1,red_2,red_3,red_4,red_5,red_6,blue_1,create_time) values("1",1,1,1,1,1,1,1,'.time().')';






$check = true;
$check_number = $sq;

$check_sql = 'select * from ssq_log where sys_number ='.$check_number;
$tmp_db = $db->createCommand($check_sql);
$data = $tmp_db->queryAll();
if($data){
	$check = false;
}
//var_dump($data);

if($check == true){ 
	$sub_sql = '';
	$sub_sql .= $sq;
	$red_format = '';
	$blue_format = '';
	$count = 1;
	foreach($red_data as $key=>$val){
		
		$val = trim($val);
		if(substr($val,0,1) == 0){
			$val = substr($val,1);
		}
		$sub_sql .=','.$val;
		$red_format .= ' red_'.$val.',';
		$count++;
		if($count ==7){
			break;
		}
	}
	if(substr($blue_data,0,1) == 0){
			$blue_data = substr($blue_data,1);
	}

	
	$red_format .= 'blue_'.$blue_data;
	
	$sub_sql .= ','.$blue_data.','.time();
	
	//$insert = 'insert into fun_ssq(sys_number,red_1,red_2,red_3,red_4,red_5,red_6,blue_1,create_time) values('.$sub_sql.')';
	$insert = 'insert into ssq_log(sys_number,'.$red_format.',create_time) values('.$sub_sql.')';
		
	echo $insert.'<br>';	
	
	$tmp = $db->createCommand($insert);
	$num = $tmp->execute();
	
	
	echo '<pre>';
	var_dump($num);
	echo '</pre>';
}else{
	echo '<pre>';
	var_dump($sq.'已经存在了');
	echo '</pre>';	
}
$start++;
$end++;

}
?>