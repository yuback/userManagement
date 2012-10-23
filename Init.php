<?php
	header("Content-type:text/html;charset=utf-8");//设置字符集
	define('USER_URL', 'http://localhost/userManagement0.3/index.php/user/');
	define('ADMIN_URL', 'http://localhost/userManagement0.3/index.php/admin/');
	define('AVATAR_URL','http://localhost/userManagement0.3/Image/avatar/');
	!defined('ROOT_PATH') && define('ROOT_PATH',  str_replace('\\','/',dirname(__FILE__)));
	require ROOT_PATH . '/Core/Request.php';
	require ROOT_PATH . '/Core/Dispatch.php';
	require ROOT_PATH . '/Core/Controller.php';
	require ROOT_PATH . '/Core/Model.php';
	require ROOT_PATH . '/Session/Session.php';
?>