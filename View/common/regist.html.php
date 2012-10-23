<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body>
	<h1>用 户 注 册</h1>
	<form action = "checkRegist" method = "post" enctype = "multipart/form-data">
		用户名：<input type = "text" name = "name" maxlength = "20" size = "20" /><br />
		电子邮箱：<input type = "text" name = "txtemail" maxlength = "30"size = "20" /><br />
		电话：<input type = "text" name = "phone" maxlength = "11" size = "11" />
		<small>请输入13位手机号码</small><br/>
		密  码：<input type = "password" name = "password" /><br />
		确认密码：<input type = "password" name = "confirmPassword" /><br />
		上传头像：<input name = "imgfile" type = "file"  /><br />
		<small>图片大小超过200KB无法正常上传！图片格式为：PNG, JPEG and GIF</small><br />
		<input type ="hidden" value="204800" name="MAX_FILE_SIZE" />
		<input type = "reset" value = "重 写" />
		<input type = "submit" name = "submit" value = "注 册" /> 
	</form>
</body>
</html>