<<<<<<< HEAD
<?php
/*
 * @探路者
 * 此项目主要为了采集一些信息
 * */
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');
//载入xlu框架
include_once(XLU_ROOT.RF_OFFDIR.'xlu.php');


//test 初步测试框架

$res = xlu::object('xlu\lib\resource',array(array('res_name'=>'http://www.baidu.com','res_type'=>'url')));

$obj_res = $res->getObject();


var_dump($obj_res->read());

	
	
	
=======
<?php
/*
 * @探路者
 * 此项目主要为了采集一些信息
 * */
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');
//载入xlu框架
include_once(XLU_ROOT.RF_OFFDIR.'xlu.php');


//test 初步测试框架

$res = xlu::object('xlu\lib\resource',array(array('res_name'=>'http://www.baidu.com','res_type'=>'url')));

$obj_res = $res->getObject();


var_dump($obj_res->read());

	
	
	
>>>>>>> da7bd17d5ac508c30edd2b2830af9dc5c647a793
?>