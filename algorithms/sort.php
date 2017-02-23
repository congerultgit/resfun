<?php

//var_dump($argv);
//var_dump($argc);
$param_num = $argc;
$param = $argv;
unset($param[0]);

//check
if($param_num<=1){
	echo 'input error';
	exit;
}

//整理
$sort_array = array();
$finish_array = array();

//预处理
$sort_array = reArray($param);




var_dump(insertSort($sort_array));


//func
//插入排序 254613
function insertSort($array=array()){


	//$return = array();
	for($i=0;$i<=(count($array)-1);$i++){

		//$j = $i-1;
		//$value = $array[$i];
		$key = $i
		for($j=$i-1;$j>=0;){
			 if($array[$j]>$array[$j+1]){
				$tmp = $array[$j];
				$array[$j] = $array[$j+1];
				$array[$j+1] = $tmp;		 	
			 }			
			 $j--;
		}
		var_dump($array);
		//exit;
	}
	return $array;
}

//冒泡排序
function bubbleSort($array=array()){
	//$return = array();
	for($i=1;$i<=(count($array)-1);$i++){

		for($j=0;$j<=count($array);$j++){
			 $tmp = '';
			 if($array[$j]>$array[$i]){
				$tmp = $array[$j];
				$array[$j] = $array[$i];
				$array[$i] = $tmp;		 	
			 }
		}
		var_dump($array);
	}
	return $array;

}

function reArray($array){
	$return = array();
	foreach ($array as $key => $value) {
		$return[] = $value;
	}
	return $return;
}




?>