<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>添加用户</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
</head>   
<body>
<h1>以下是所有用户注册信息</h1>
<form action="<?php echo ADMIN_URL?>checkAddUser" method="post">
<table border="1">
	<tr> 
		<th>选择</th>
		<th>id</th>
		<th>大名</th>
		<th>邮箱</th>
		<th>类别</th>
	</tr>
	<tr>
		<?php foreach($notic as $value){ ?>
		<td><input type="checkbox" name="uid[ ]" value="<?=$value['user_id'] ?>" /></td>
		<td><?=$value['user_id'] ?></input></td>
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
	</tr>
		<?php } ?>
</table>
<input name="gid" type="hidden" value ="<?=$gid?>" />
<input name="reset" type="reset" value="清空" /> 
<input name="submit" type="submit" value="提交" />
</form>
</body>   
</html>