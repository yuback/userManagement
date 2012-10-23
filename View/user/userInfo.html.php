<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>用户信息</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>   
<body>
<h1>用户注册信息</h1>
<table border="1">
	<tr> 
		<th>id</th>
		<th>大名</th>
		<th>邮箱</th>
		<th>类别</th>
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
	</tr>
</table>
<hr />
头像：
<tr><td><img src="<?php echo AVATAR_URL;echo $value['user_avatar']?>.png" width="100" height="100" alt="用户头像" /></td></tr>
<hr />
<a href="<?php echo ADMIN_URL?>updateUser/uid/<?php echo $value['user_id']?>">点击修改个人信息</a><br />
<a href="<?php echo USER_URL?>timeline/uid/<?php echo $value['user_id']?>">点击查看个人活动信息</a><br />
<?php
	if($value['isadmin']){
?>
<hr />
<a href="<?php echo ADMIN_URL?>profile">后台管理</a>
<?php } ?>
<?php } ?>
<a href="<?php echo USER_URL?>logout">退出系统</a>
</body>   
</html>