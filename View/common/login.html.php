<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

	body {
		background-color: #f2f1e8;
	}

    form {
	width: 960px;
	padding: 20px;
	margin: 20px auto;
	background-color: #f2f1e8;
	}

	h1 {
		color: #696969;
		text-shadow: ;
	}

	fieldset {
		margin: 0 0 15px 0;
		border: none;
	}

	label {
		display: block;
		margin: 0 0 3px 0;
		font-size: 20px;
		font-weight: bold;
	}

	fieldset input,
	fieldset textarea {
		width: 400px;
		padding: 5px;
		font-size: 1.4em;
		border: none;
		border-bottom: 1px solid #fff;
		border-right: 1px solid #fff;
		background: #e2e1d7;
		border-radius: 5px;
	}

	fieldset input:hover,
	fieldset textarea:hover {
		background: #a9a9a9;
	}

	fieldset input:focus,
	fieldset textarea:focus {
		background: #fff;
	}

	p {
		margin: 20px 0 0 5px;
		font-size: 15px;
		color: #555;
	}

	a {		
		font-size: 20px;
		color: blue;
		text-decoration: none;
	}

	p:hover {
		text-decoration: underline;
	}

	a:hover {
		font-style: italic;
		color: green;
	}

	input[type="reset"],
	input[type="submit"] {
		display: inline-block;
		width: 120px;
		line-height: 40px;
		margin-left: 30px;
		font-size: 20px;
		font-family: Arial, sans-serif;
		text-decoration: none;
		text-align: center;
		color: #595858;
		border: 1px solid #9c9d9d;
		background-color: #e4e6e9;

		background-image: -moz-linear-gradient(top,  rgba(255,255,255,0.24) 0%, rgba(0,0,0,0.3) 100%); /* FF3.6+ */
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.24)), color-stop(100%,rgba(0,0,0,0.3))); /* Chrome,Safari4+ */
		background-image: -webkit-linear-gradient(top,  rgba(255,255,255,0.24) 0%,rgba(0,0,0,0.3) 100%); /* Chrome10+,Safari5.1+ */
		background-image: -o-linear-gradient(top,  rgba(255,255,255,0.24) 0%,rgba(0,0,0,0.3) 100%); /* Opera 11.10+ */
		background-image: -ms-linear-gradient(top,  rgba(255,255,255,0.24) 0%,rgba(0,0,0,0.3) 100%); /* IE10+ */
		background-image: linear-gradient(to bottom,  rgba(255,255,255,0.24) 0%,rgba(0,0,0,0.3) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3dffffff', endColorstr='#66000000',GradientType=0 ); /* IE6-9 */

		-webkit-box-shadow: inset 0px 1px 1px 0px rgba(255, 255, 255, 0.25);
		-moz-box-shadow: inset 0px 1px 1px 0px rgba(255, 255, 255, 0.25);
		box-shadow: inset 0px 1px 1px 0px rgba(255, 255, 255, 0.25);

		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}



	input[type="reset"]:hover,
	input[type="submit"]:hover {
		color: #333;
		background-color: #eeeded;
		cursor: pointer;
	}

	input[type="reset"]:active,
	input[type="submit"]:active {
		background-color: #eeeded;
		cursor: pointer;

		background-image: -moz-linear-gradient(top,  rgba(0,0,0,0.4) 0%, rgba(255,255,255,0.24) 100%); /* FF3.6+ */
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.4)), color-stop(100%,rgba(255,255,255,0.24))); /* Chrome,Safari4+ */
		background-image: -webkit-linear-gradient(top,  rgba(0,0,0,0.4) 0%,rgba(255,255,255,0.24) 100%); /* Chrome10+,Safari5.1+ */
		background-image: -o-linear-gradient(top,  rgba(0,0,0,0.4) 0%,rgba(255,255,255,0.24) 100%); /* Opera 11.10+ */
		background-image: -ms-linear-gradient(top,  rgba(0,0,0,0.4) 0%,rgba(255,255,255,0.24) 100%); /* IE10+ */
		background-image: linear-gradient(to bottom,  rgba(0,0,0,0.4) 0%,rgba(255,255,255,0.24) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#66000000', endColorstr='#3dffffff',GradientType=0 ); /* IE6-9 */

		-webkit-box-shadow: inset 1px 4px 5px 3px rgba(13, 76, 115, 0.30);
		-moz-box-shadow: inset 1px 4px 5px 3px rgba(13, 76, 115, 0.30); 
		box-shadow: inset 1px 4px 5px 3px rgba(13, 76, 115, 0.30);
	}




</style>
</head>
<body>	
	<form id="login" action="user/checkLogin" method="post" >
		<h1>用户登入</h1>
		<fieldset>
			<label for="realname">帐 号</label>
			<input type="text" name="name" id="name" />
		</fieldset>		
		<fieldset>
			<label for="password">密 码</label>
			<input type="password" id="password" name="password" />
		</fieldset>
		<input type = "reset" value = "重 写" />
		<input type = "submit" name = "submit" value = "登 入" />
		<p>如果你还不是系统用户，请先点击<a href = "http://localhost/usermanagement0.3/index.php/user/regist"> 这 里 </a>进行注册</p>
	</form>
</body>
</html>