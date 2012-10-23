<?php
/*	echo '这是群组信息显示页面，只有管理员才能看得到';

	var_dump($notic);*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<title>用户信息</title>      
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
</head>   
<body>
<h1>所有群组信息</h1>
<table border="1">
	<tr> 
		<th>堂号</th>
		<th>名称</th>
		<th>相关操作</th>
	</tr>
	<tr>
		<?php foreach($notic as $value){ ?>
		<td><?=$value['groups_id'] ?></td>
		<td><?=$value['groups_name'] ?></td>
		<td>
		<a href="<?php echo ADMIN_URL?>delGroup/gid/<?php echo $value['groups_id']?>">删除</a> 
		<a href="<?php echo ADMIN_URL?>updateGroup/gid/<?php echo $value['groups_id']?>">修改</a>
		<a href="<?php echo ADMIN_URL?>getOneGroupInfo/gid/<?php echo $value['groups_id']?>">查看</a>
		</td>
	</tr>
		<?php } ?>
</table>
<hr />
<a href="<?php echo ADMIN_URL?>addGroup">添加分组</a>
</body>   
</html>