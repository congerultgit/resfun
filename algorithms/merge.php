<?php

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


$tmp_array = array(8,7,6,5,4,3,2,1);
var_dump(mergeSort($tmp_array));
exit;
//var_dump(insertSort($sort_array));

/**
merge sort87654321 
*/
function mergeSort($array=array()){
	$sort = $array;
	$count_num = count($array);
	if((int)$count_num === 1){
		return $array;
	}
	$tmp = array();

	$split_num = intval($count_num/2);
	$tmp_l = array();
	$tmp_r = array();
	for($i=0;$i<$count_num;$i++){
		if($i<$split_num){
			$left_array[] = $array[$i];
		}else{
			$right_array[] = $array[$i];		
		}
	}
	//var_dump($left_array);
	//var_dump($right_array);
    $l = mergeSort($left_array);
	$r = mergeSort($right_array);
	return mergeArray($l,$r);
}

function mergeArray($leftArray,$rightArray){
var_dump($leftArray);
var_dump($rightArray);
    
 $count_l = count($leftArray);
 $connt_r = count($rightArray);
 $count = $count_l+$count_r;
 $sort = array();
 $i = 0;
 $j = 0;
 while((int)count($sort)<=(int)$count){
	if((int)$leftArray[$i]>(int)$rightArray[$j]){
		$sort[] = $rightArray[$j];
		$j++;
	}else{	
		$sort[] = $leftArray[$i];
		$i++;
	
	} 
 }
 var_dump($sort);
 return $sort;

}



//func
//插入排序 254613
function insertSort($array=array()){


	//$return = array();
	for($i=0;$i<=(count($array)-1);$i++){

		//$j = $i-1;
		//$value = $array[$i];
		//$key = $i
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
