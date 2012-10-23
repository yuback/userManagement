<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>修改用户信息</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
</head>   
<body>
<h1>更新用户信息</h1>
<form action = "<?php echo ADMIN_URL?>checkUpdateUser" method = "post" >
<table border="1">
	<tr> 
		<th>id</th>
		<td><input type="text" name="id" value="<?=$notic[0]['user_id'] ?>" readonly /></td>
	</tr>
	<tr> 
		<th>头像</th>
		<td align="center"><img src="<?php echo AVATAR_URL?><?=$notic[0]['user_avatar']?>.png" 
			width="100" height="100" alt="用户头像" /></td>
	</tr>
	<tr>
		<th>大名</th>
		<td><input type="text" name="name" value="<?=$notic[0]['user_name'] ?>" readonly /></td>
	</tr>
	<tr>
		<th>邮箱</th>
		<td><input type="text" name="email" value="<?=$notic[0]['user_email'] ?>" /></td>
	</tr>
	<tr>
		<th>类别</th>
		<td>
			<input type="radio" name="usertype" value="0" checked/>普通用户
			<input type="radio" name="usertype" value="1"/>管理员
		</td>
	</tr>
</table>
<tr><th>上传新头像：<input type="file" name="imagfile" /></th></tr><br/>
<input type="reset" value="重置"/>
<input type="submit" value="更新"/>
</form>
</body>   
</html>