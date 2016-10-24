<?php
set_time_limit(0); 
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');
define('RESFUN_ROOT',dirname(__FILE__).RF_OFFDIR);
//ssq 33 16

//set 
header("Content-type: text/html; charset=utf-8");     


//载入xlu框架
include_once(XLU_ROOT.RF_OFFDIR.'xlu.php');
//define('CSS_BASE',RESFUN_ROOT.RF_OFFDIR.'resource'.RF_OFFDIR.'css'.RF_OFFDIR.'base');

$get = $_GET;
$limit = '';
$limit_num = false;
if(isset($get['limit'])&& is_numeric($get['limit'])  && (int)$get['limit'] != false){
	$limit = ' limit '.(int)$get['limit'];
	$limit_num = (int)$get['limit'];
		
}



$order = ' order by sys_number desc';

$db = xlu::object(array(
		'class'=>'xlu\lib\db\DbConnection',
		'username' =>'root',
		'password'  => '',
		'dsn'=>'mysql:host=127.0.0.1;dbname=test',
		'charset' =>'utf8'
));

//获得全部数据
$sql = 'select * from ssq_log'.$order.$limit;

$tmp = $db->createCommand($sql);
$data = $tmp->queryAll();

//概率统计总数
$data_count_sql = "select count(1) as count from fun_ssq".$order.$limit;
$tmp = $db->createCommand($data_count_sql);
$count_data = $tmp->queryOne();
$count_data = $count_data['count'];
if($limit_num != false){
	$count_data = (int)$get['limit'];
}


//分别计算每个球出现的概率
$rate_data = array();
for($i=1;$i<=33;$i++){
	//$rate_data[$i] = '';
	if($limit_num){		
	     $tmp_sql = 'SELECT count(1) as count from  ( select * from ssq_log '.$order.$limit. ') a where a.red_'.$i.' ='.$i;
	}else{
		$tmp_sql = 'select count(1) as count from ssq_log where red_'.$i.'= '.$i.$order.$limit;
	}
	$tmp = $db->createCommand($tmp_sql);
	$tmp_data = $tmp->queryOne();
	$rate_data[$i] = $tmp_data['count'];		
}



//分别计算每个球出现的概率
$rate_blue_data = array();
for($i=1;$i<=16;$i++){
	//$rate_data[$i] = '';
	if($limit_num){		
	     $tmp_sql = 'SELECT count(1) as count from  ( select * from ssq_log '.$order.$limit. ') a where a.blue_'.$i.' ='.$i;
	}else{
		$tmp_sql = 'select count(1) as count from ssq_log where blue_'.$i.'= '.$i.$order.$limit;
	}
	$tmp = $db->createCommand($tmp_sql);
	$tmp_data = $tmp->queryOne();
	$rate_blue_data[$i] = $tmp_data['count'];		
}



//var_dump($data);


//<link rel="stylesheet" type="text/css" href="http://www.webtest.com/resfun/resource/css/base/base.css?id=<?php echo rand()
?>

<html>
<head>

<link rel="stylesheet" type="text/css" href="http://www.webtest.com/resfun/resource/css/base/base.css?id=<?php echo rand();?>" >
<script type="text/javascript" src="http://www.webtest.com/resfun/resource/js/base/jquery.js" ></script>	
<style>
	
.center{
	width:100%;
	height:100%;
	text-align:center;
	//background-color: beige;

}		

.line{
	/*width:px;*/
	height:auto;
	text-align:center;
	background-color:whitesmoke;
	/*margin-top: 20px;*/
	/*margin-bottom: 20px;*/
    height:35px;
    padding-top;2px;
    /*line-height: 28px;*/
}

.line span {
	float: left;
	margin-top: 6px;
	margin-bottom: 6px;
}

.number{
	width:60px;
	height:auto;
	text-align:center;
	background-color:cyan;
	margin-left: 10px;
}
.blue{
	width:28px;
	height:auto;
	text-align:center;
	//background-color:blueviolet;
	margin-left: 5px;
	border:1px solid blue;
}
.blueclear{
	width:30px;
	height:auto;
	text-align:center;
/*	//background-color:blueviolet;*/
	margin-left: 5px;
/*	//border:1px solid blue;*/
}

.one{
	width:28px;
	height:auto;
	text-align:center;
/*	//background-color:#00AEAE;*/
	margin-left: 5px;
	border:1px solid red;
}

.oneclear{
	width:30px;
	height:auto;
	text-align:center;
/*	//background-color:#00AEAE;*/
	margin-left: 5px;
/*	//border:1px solid red;*/
}

.basered{
	width:30px;
	height:auto;
	text-align:center;
	/*background-color:red;*/
	margin-left: 5px;
	/*border:1px solid red;*/
}
.baseblue{
	width:30px;
	height:auto;
	text-align:center;
	/*background-color:cornflowerblue;*/
	margin-left: 5px;
	/*border:1px solid red;*/
}





.claer:after {display: block;content: '';clear: both;}

.blank{
	width: 100%;
	height: 20px;
}
.page {
    margin: auto;
    //position: relative;
    z-index: 2;
    width:1860px;
}

.pagecount {
    margin: auto;
    //position: relative;
    z-index: 2;
    width:1860px;
    font-size: 12px;
}		

.line:hover
{ 
background-color:white;
cursor:hand;
}

/*.one:hover{
	background-color:red;
	cursor:hand;
}*/

</style>

</head>	
<body>
			
	<div class ="center" >	
		<div class="page blank">
			
			
		</div>
		
		<div class='pagecount claer'>
		
		<div class="line clear">
		<form action="">
			<p><input type="text" name="limit" value="<?php echo $limit_num ?>" />
			   <input type="submit" value="查询条数" />
			</p>
		</from>
			
		</div>	

		<div class="line clear">
			
		<span class="number" >	
		号码			
		</span>
			
		<?php for($i=1;$i<=33;$i++){ ?>
				<span class="basered" >	
				<?php echo $i ?>				
				</span>		
		
		<?php } ?>
		<?php for($i=1;$i<=16;$i++){ ?>
				<span class="baseblue" >	
				<?php echo $i ?>				
				</span>		
		
		<?php } ?>		
			
		</div>
		
		<div class="line clear">
			
		<span class="number" >	
		概率			
		</span>
			
		<?php for($i=1;$i<=33;$i++){ ?>
				<span class="basered" >	
				<?php echo round($rate_data[$i]/$count_data,2)*100; ?>%				
				</span>		
		
		<?php } ?>
		<?php for($i=1;$i<=16;$i++){ ?>
				<span class="baseblue" >	
				<?php echo round($rate_blue_data[$i]/$count_data,2)*100; ?>%					
				</span>		
		
		<?php } ?>		
			
		</div>	
		</div>		
		
		
		
		
		<div class='page claer'>
		
		<?php foreach ($data as $key => $value) { ?>
			

			<div class ="line claer" >
				
							
				<span class="number" >	
				<?php echo $value['sys_number'] ?>				
				</span>
				
				<?php $css_num = 1?>
				
				<?php for($i=1;$i<=33;$i++){				
					$for_array = $value;
					unset($for_array['ssqid']);
					unset($for_array['sys_number']);
					unset($for_array['blue_1']);
					unset($for_array['create_time']);
				?>
				
				<?php  if($value['red_'.$i] == $i) { ?>
				<span class="one red<?php echo $css_num++?>" >	
				<?php echo $i ?>				
				</span>
					
				<?php }else{  ?> 
				<span class="oneclear" >	
				<?php echo $i ?>				
				</span>				
				<?php } ?>
								
				<?php  } ?>	
					
				<?php for($i=1;$i<=16;$i++){ ?>
					
				<?php if($i == $value['blue_'.$i]) {?>
									
				<span class="blue" >	
				<?php echo $i ?>				
				</span>
				
				<?php }else{ ?>
				
				<span class="blueclear" >	
				<?php echo $i ?>				
				</span>			
					
				<?php } ?>				
				<?php } ?>
			</div>
			<?php }  ?>
		</div>
		
						
	</div>	
</body>
</html>
<script>
	
	$('.one').mousemove(function(){
		
		var css_class='',css_red='';
		css_class = $(this).attr('class');
		css_class = css_class.split(" ");
		css_red = css_class[1];		
		$('.'+css_red).css('background-color','red');
	}).mouseout(function(){
		
		var css_class='',css_red='';
		css_class = $(this).attr('class');
		css_class = css_class.split(" ");
		css_red = css_class[1];	
		$('.'+css_red).css('background-color','whitesmoke');		

	});
	
</script>