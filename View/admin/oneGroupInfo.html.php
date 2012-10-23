<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>群组用户信息</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
</head>   
<body>
<h1>群组用户信息</h1>
<table border="1">
	<?php if(is_array($notic)){?>
	<tr> 
		<th>id</th>
		<th>大名</th>
		<th>相关操作</th>
	</tr>
		<?php foreach($notic as $value){ ?>
	<tr>
		<td><?=$value['user_id'] ?></td>
		<td><?=$value['user_name'] ?></td>		
		<td><a href="<?php ADMIN_URL?>delUser/uid/g<?php echo $value['user_id']?>">删除</a> 
		</td>
	</tr>
		<?php } ?>
	<?php } else{
			echo "本组暂无成员，可以点击下面链接进行添加";
		} ?>
</table>
</table>
<hr />
<a href="<?php echo ADMIN_URL?>addUser/gid/<?php echo $gid ?>">添加成员</a>
</body>   
</html>