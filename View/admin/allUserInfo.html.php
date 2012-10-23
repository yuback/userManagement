<?php
/*	echo '这是用户信息显示页面，只有管理员才能看得到';

	var_dump($notic);*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>用户信息</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
</head>   
<body>
<h1>所有用户注册信息</h1>
<table border="1">
	<tr> 
		<th>id</th>
		<th>大名</th>
		<th>邮箱</th>
		<th>类别</th>
		<th>相关操作</th>
	</tr>
	<tr>
		<?php foreach($notic as $value){ ?>
		<td><?=$value['user_id'] ?></td>
		<td><?=$value['user_name'] ?></td>
		<td><?=$value['user_email'] ?></td>
		<td>
			<?php 
				if($value['isadmin']){
					echo '管理员';
				}
				else{
					echo '普通用户';
				}
			?>
		</td>
		<td><a href="<?php echo ADMIN_URL?>delUser/uid/<?php echo $value['user_id']?>">删除</a> 
			<a href="<?php echo ADMIN_URL?>updateUser/uid/<?php echo $value['user_id']?>">修改</a>
		</td>
	</tr>
		<?php } ?>
</table>
</body>   
</html>