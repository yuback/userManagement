<?php	
	class User extends Controller{
		private $type = 'user';
		private $userName;
		private $userPassword;
		private $email;
		private $user;
		private $confirmPassword;
		/*
		* 登入
		*/
		public function login(){
			$this -> display('login');
		}
		/*
		* 退出
		*/
		public function logout(){
			//退出前把相关信息插入数据库中
			Session :: start();
			// var_dump($_SESSION);
			$userId = Session :: get('userId');
			$user = $this -> loadModel('User');
			$isOK = $user -> recordActivity($userId);
			// if(!$isOK){
			// 	echo "活动记录失败";
			// }
			Session :: delSession();
			$this -> display('logout');
		}
		/*
		* 注册
		*/
		public function regist(){
			$this -> display('regist');
		}
		/*
		* 显示用户个人信息
		*/
		public function userProfile(){
			if($this -> checkSession()){
				$user_id = $this -> getId();
				$user = $this -> loadModel('User');
				$userInfoArr = $user -> getUserInfo($user_id);
				if(is_array($userInfoArr)){
					$this -> display('userInfo',$userInfoArr,$this -> type);
				}else{
					$error = "糟糕，出了点状况！";
					$role = 'error';
					$this -> display($role,$error);
					exit();
				}
			}
		}
		/*
		* 显示用户活动信息
		*/
		public function timeline(){
			if($this -> checkSession()){
				$userId = $this -> getId();
				$user = $this -> loadModel('User');
				$activities = $user -> getUserActivity($userId);
				// var_dump($activities);
				if($activities){//记录不为空
					$this -> display('userTimeLine',$activities,$this -> type);
				}else{//记录为空
					$notice = "很抱歉，暂时没有您的活动记录。";
					$role = 'error';
					$this -> display($role,$notice);
					exit();
				}
			}
		}
		/*
		* 校对登入信息
		*/
		public function checkLogin(){
			// echo "why can not?";
			if($this -> checkForm()){
				$userInfo = $this -> checkForm();
				$this -> userName = $userInfo['userName'];
				$this -> userPassword = $userInfo['userPassword'];
			}
			if(empty($this -> userName)){
				$error = "用户名忘记填写！";
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}elseif(empty($this -> userPassword)){
				$error = "密码忘记填写！";
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}
			$this -> user = $this -> loadModel('User');
			$userArr = $this -> user -> login($this -> userName,$this -> userPassword);
			if(is_array($userArr)){
				Session :: startSession($userArr['user_id'],$this -> userName,$this -> userPassword);
				$id = $userArr['user_id'];
				// $this -> close();
				header("Location:http://localhost/userManagement0.3/index.php/user/userProfile/uid/$id");
			}else{
				// $this -> close();
				$error = '登入失败,用户名或者密码写错！';
				$role = 'error';
				$this -> display($role,$error);
			}
		}
		/*
		* 校对注册信息
		*/
		public function checkRegist(){
			$flag = $this -> checkForm();
			if($flag){
				$userInfo = $flag;
				$this -> userName 			= $this -> _array_item($userInfo,'userName');
				$this -> userPassword 		= $this -> _array_item($userInfo,'userPassword');
				$this -> confirmPassword 	= $this -> _array_item($userInfo,'confirmPassword');
				$this -> email 	 			= $this -> _array_item($userInfo,'email');
				$this -> phone 				= $this -> _array_item($userInfo,'phone');
				$this -> avatarUrl			= $this -> _array_item($userInfo,'avatarUrl');
			}

			if(!$this -> userName){
				$error = "用户名忘记填写！";
				$role = 'error';
				$this ->  display($role,$error);
				exit();
			}

			if($this -> email){
				//判断邮箱是否有效的验证代码
				$this -> _checkEmail($this -> email);
			}else{//邮箱地址为空
				$error = "邮箱忘记填写！";
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}

			if($this -> phone){
				//如果电话号码不为空
				//判断电话号码是否有效的验证代码
				// echo $this -> phone;
				$this -> _checkPhone($this -> phone);
			}
			if($this -> userPassword != $this -> confirmPassword){
				$error = "两次密码不一致,请重新填写！";
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}
			$user = $this -> loadModel('User');
			if($user -> regist($this -> userName,$this -> userPassword,$this -> email,$this -> phone,$this -> avatarUrl)){
				$success = '注册成功！';
				$role = 'success';
				$this -> display($role,$success);
			}else{
				$error = '注册失败！';
				$role = 'error';
				$this -> display($role,$error);
			}
		}
		/*
		* 检查表单
		*/
		public function checkForm(){
			$subscriber = $this -> getUserPost();
			$imgFile 	= $this -> getUserFile();
			$imgFile 	= $this -> _array_item($imgFile,'imgFile');
			if(isset($subscriber['submit'])){
				$userInfo = array();
				$userInfo['userName'] = trim($subscriber['name']);
				$userInfo['userPassword'] = trim($subscriber['password']);
				// var_dump($userInfo['userPassword']);
				if($subscriber['txtemail']){
					$userInfo['email'] = trim($subscriber['txtemail']);
				}
				if($subscriber['phone']){
					$userInfo['phone'] = trim($subscriber['phone']);
				}
				if($subscriber['confirmPassword']){
					$userInfo['confirmPassword'] = trim($subscriber['confirmPassword']);
					// var_dump($userInfo['confirmPassword']);
				}
				//加入判断用户上传头像的代码验证
				if($imgFile){
					$flag = $this -> _checkImage($imgFile);
					if($flag){
						$userInfo['avatarUrl'] = $flag;
					}
				}
				return $userInfo;
			}else{
				$error = '无数据提交！';
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}
		}
		
		/*
		*检测数组中是否含有指定键
		*/
		private function _array_item($ar,$key){
			if(is_array($ar) && array_key_exists($key, $ar)){
				return $ar[$key];
			}else{
				return null;
			}
		}
		/*
		*用户上传的图片规格验证
		*/
		private function _checkImage($imgFile){
			if(is_array($imgFile)){
				// var_dump($imgFile);
				$picName = $imgFile['name'];//需要进行重命名，减少安全隐患
				$picType = $imgFile['type'];//文件类型
				$picSize = $imgFile['size'];//文件大小
				$upperr	 = $imgFile['error'];//错误代号
				$temFile = $imgFile['tmp_name'];
				switch($picType){
					case "image/gif":
					$mime = "GIF Image";break;
					case "image/jpeg":
					case "image/pjpeg":
					$mime = "JPEG Image";break;
					case "image/png":
					case "image/x-png":
					$mime = "PNG Image";break;
					default:
					$mime = "unknow";
				}
				if(!$temFile or $upperr or $mime == "unknow" or !is_uploaded_file($temFile)){
					$string = "<p>糟糕，图片上传过程发生了错误：可能是图片太大
								或者是图片格式不对。</p>";
					exit($string);
				}else{
					/*$file = fopen($temFile,'rb');
					$imagedata = fread($file, $picSize);
					fclose($file);
					$image = $imagedata; 
					return $image;*/
					/*echo $picName;
					echo "<hr/>";
					echo $temFile;*/
					$avatarUrl = $this -> _setAvatarPath($picName);
					// $image = file_put_contents($avatarUrl, $temFile);
					$imageOriginal = copy($temFile, $avatarUrl[1]);
					$image = copy($temFile,$avatarUrl[2]);
					if(!$imageOriginal && !$image){
						$string = "图片保存失败，请再试一次！";
						exit($string);
					}
					return $avatarUrl[0];//路径只保留变化的部分，其他的用常量定义补充
				}
			}else{
				return FALSE;
			}
		}
		/*
		*设置图像路径
		*/
		private function _setAvatarPath($name){
			// echo dirname(__FILE__);
			//生成头像保存路径,使用系统全局变量进行改进
			//copy函数无法打开文件名含有中文字符的文件
			$avatarUrl = array();
			$time = time();//用时间来记录图片的ID，可以改为用用户名和其他字符的组合
			$avatarUrl[] = $time;
			$avatarUrl[] = 'E:/wamp/www/userManagement0.3/Image/avatarOriginal/'."$time"."_"."$name";//图片原来的名字_时间序列
			$avatarUrl[] = 'E:/wamp/www/userManagement0.3/Image/avatar/'."$time.png";//这个是重新命名的图片url
			return $avatarUrl;
		}

		/*
		*手机号码的验证
		*/
		private function _checkPhone($phone){
			if(is_numeric($phone)){
				$pattern = "/^13[0-9]{9}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/";
				if(preg_match($pattern, $phone)){
					//电话号码格式正确
					return ;
				}else{
					exit("这个电话号码 $phone 无效");
				}
			}else{
				$str = "请输入13位有效的电话号码";
				exit($str);
			}
		}

		/*
		*电子邮件的验证
		*/
		private function _checkEmail($email){
			if(filter_var($email,FILTER_VALIDATE_EMAIL)){
				// $str ="email有效";
				return ;
			}else{
				$str = "email无效";
				exit($str);
			}
		}
		
	}
?>