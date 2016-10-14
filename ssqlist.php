<?php
set_time_limit(0); 
define('RF_OFFDIR',DIRECTORY_SEPARATOR);
define('RF_ROOT',dirname(__FILE__));
define('XLU_ROOT',dirname(dirname(__FILE__)).RF_OFFDIR.'xlu');
define('RESFUN_ROOT',dirname(__FILE__).RF_OFFDIR);




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


$sql = 'select * from fun_ssq order by ssqid desc';

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
	width:960px;
	height:auto;
	text-align:center;
	background-color:#333333;
	//margin-top: 20px;
	//margin-bottom: 20px;
    height:35px;
    //line-height: 28px;
}

.one{
	width:25px;
	height:auto;
	text-align:center;
	float: left;
	background-color:cyan;
	margin-left: 20px;
}
.claer{
	both:clear;
}

.blank{
	width: 100%;
	height: 20px;
}
.page {
    margin: auto;
    //position: relative;
    z-index: 2;
    width: 960px;
}	
	
</style>

	
<body>
			
	<div class ="center" >	
		<div class="page blank">
			
			
		</div>
		<div class='page'>	
		
		<?php foreach ($data as $key => $value) { ?>
			<div class ="line" >		
				<div class="one" >	
				<?php echo $value['red_1'] ?>				
				</div>
				<div class="one" >	
				<?php echo $value['red_2'] ?>				
				</div>			
				<div class="one" >	
				<?php echo $value['red_3'] ?>				
				</div>									
				<div class="one" >	
				<?php echo $value['red_4'] ?>				
				</div>	
				<div class="one" >	
				<?php echo $value['red_5'] ?>				
				</div>					
				<div class="one" >	
				<?php echo $value['red_6'] ?>				
				</div>					
				<div class="one" >	
				<?php echo $value['blue_1'] ?>				
				</div>				
			
			</div>
			<div class="claser"></div>
			<?php }  ?>		
		
		</div>
		
						
	</div>	
</body>
</html>