<?php
set_time_limit(0); 
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');
define('RESFUN_ROOT',dirname(__FILE__).RF_OFFDIR);
//ssq 33 16



//载入xlu框架
include_once(XLU_ROOT.RF_OFFDIR.'xlu.php');
//define('CSS_BASE',RESFUN_ROOT.RF_OFFDIR.'resource'.RF_OFFDIR.'css'.RF_OFFDIR.'base');

$db = xlu::object(array(
		'class'=>'xlu\lib\db\DbConnection',
		'username' =>'root',
		'password'  => '',
		'dsn'=>'mysql:host=127.0.0.1;dbname=test',
		'charset' =>'utf8'
));


$sql = 'select * from fun_ssq order by ssqid desc limit 30';

$tmp = $db->createCommand($sql);
$data = $tmp->queryAll();

//var_dump($data);


//<link rel="stylesheet" type="text/css" href="http://www.webtest.com/resfun/resource/css/base/base.css?id=<?php echo rand()
?>

<html>
<head>

</head>
<style>
* {
    font-family: "微软雅黑";
    font-weight: normal;
    margin: 0;
    outline: medium none;
    overflow-wrap: break-word;
    padding: 0;
    word-break: break-all;
}

	
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
	width:25px;
	height:auto;
	text-align:center;
	//background-color:blueviolet;
	margin-left: 5px;
	border:1px solid blue;
}
.blueclear{
	width:25px;
	height:auto;
	text-align:center;
	//background-color:blueviolet;
	margin-left: 5px;
	//border:1px solid blue;
}

.one{
	width:25px;
	height:auto;
	text-align:center;
	//background-color:#00AEAE;
	margin-left: 5px;
	border:1px solid red;
}

.oneclear{
	width:25px;
	height:auto;
	text-align:center;
	//background-color:#00AEAE;
	margin-left: 5px;
	//border:1px solid red;
}

.claer{
	clear: both;
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
    width:1560px;
}	

.line:hover
{ 
background-color:white;
cursor:hand;
}
	
</style>

	
<body>
			
	<div class ="center" >	
		<div class="page blank">
			
			
		</div>
		<div class='page claer'>	
		
		<?php foreach ($data as $key => $value) { ?>
			<div class ="line claer" >
				
							
				<span class="number" >	
				<?php echo $value['sys_number'] ?>				
				</span>
				
				
				<?php for($i=1;$i<=33;$i++){				
					$for_array = $value;
					unset($for_array['ssqid']);
					unset($for_array['sys_number']);
					unset($for_array['blue_1']);
					unset($for_array['create_time']);
				?>
				
				<?php  if(array_search($i,$for_array) !== false) { ?>
				<span class="one" >	
				<?php echo $i ?>				
				</span>
					
				<?php }else{  ?> 
				<span class="oneclear" >	
				<?php echo $i ?>				
				</span>				
				<?php } ?>			
				<?php  } ?>	
					
				<?php for($i=1;$i<=16;$i++){ ?>
					
				<?php if($i == $value['blue_1']) {?>
									
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