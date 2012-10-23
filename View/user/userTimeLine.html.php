<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>活动记录</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>   
<body>
<h1>您的活动记录</h1>
<tr><th>时间</th>
	<th>事件</th>
</tr>
<br />
<tr>
<?php foreach($notic as $value){?>
<td><?=date('Y/m/d H:s',$value['activity_time'])?></td>
<td>
<?php
	if($value['activity_flag']){
		echo '登入系统';
	}else{
		echo '退出系统';
	}
?>
</td><br />
<?php }?>
</body>
</html>