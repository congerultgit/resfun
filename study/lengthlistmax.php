<?php

var_dump($argv);


unset($argv[0]);
$input = $argv;
$output = func1($input);
echo $output;

function func1($array){

	$max = 0;
	$now = 0;
	$i =0;$j =0;$k=0;
	$len = count($array);
	for($i;$i<$len;$i++){
		for($j;$j<$len;$j++){
		
			for($k=$i;$k<=$j;$k++){
				$now += $array[$k];
			}
				if($now > $max){
					$max= $now;
				}
 

			
		}
	
	}
	return  $max;




}








?>
