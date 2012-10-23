<?php
	class Controller{
		private $request;
		private $userPost;
		private $userFile;

		public function __construct($request){
			$this -> request  = $request;
			$this -> userPost = $this -> request -> getPost();
			$this -> userFile = $this -> request -> getFile();
		}

		public function display($role,$info = null,$fileType = null,$id = null){
			// if(is_array($info) || $info == '0'){
				$notic = $info;
				$gid   = $id;
			// }
			if($fileType == null){
				include ROOT_PATH.'/View/common/'.$role.'.html.php';
			}else{
				include ROOT_PATH.'/View/'.$fileType.'/'.$role.'.html.php';
			}
		}

		public function loadModel($model){
			static $models = array();
			if(empty($models[$model])){
				include ROOT_PATH . '/Model/'.$model.'Model.php';
				$modelName = $model.'Model';
				$models[$model] = new $modelName();
			}
			return $models[$model];
		}

		public function getUserPost(){
			return $this -> userPost;
		}

		public function getUserFile(){
			return $this -> userFile;
		}

		public function getId(){
			$params = $this -> request -> getUrlParseResult();
			return $params['Id'];
		}

		public  function checkSession(){
			Session :: start();
			//获取session值
			$userId 	 	 = Session :: get('userId');
			$userName 	 	 = Session :: get('userName');
			$userPassword 	 = Session :: get('userPassword');
			// //获取数据库中的用户相关信息
			$userModel 	 = $this -> loadModel('User');
			$userInfoArr = $userModel -> getUserInfo($userId);
			// var_dump($userInfoArr[0]);
			// echo $userName."<BR/>";
			// echo $userPassword;
			//比较session的值与数据库中的值
			if($userInfoArr[0]['user_name']==$userName AND
				$userInfoArr[0]['user_password']==$userPassword){
				return true;
			}else{
				exit("抱歉，无法进行相关操作");
			}
		}
	}
?>