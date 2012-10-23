<?php
	class UserModel extends Model{

		private $name;
		private $password;
		private $affectRow;
		private $email;
		private $phone;
		private $avatar;
		
		public function __construct(){
			parent :: __construct();
		}

		public function login($name,$password){
			$this -> name = $this -> escape($name);
			$this -> password = md5($this -> escape($password));
			$sql = sprintf("SELECT * FROM `users` WHERE `user_name`='%s' AND 
					`user_password`='%s'",$this -> name,$this -> password);
			$this -> affect = $this -> find($sql);
			
			if(is_array($this -> affect)){
				//把登入信息填入数据库
				$this -> recordActivity($this->affect['user_id'],true);
				return $this -> affect;
			}else{
				return 0;
			}
		}

		public function regist($name,$password,$email=null,$phone=null,$avatar=null){
			$this -> name = $this -> escape($name);
			$this -> password = md5($this -> escape($password));
			$this -> email = $this -> escape($email);
			$this -> phone = $this -> escape($phone);
			$this -> avatar = $this -> escape($avatar);
			$sql = sprintf("INSERT INTO `users` SET `user_name` = '%s',`user_password` = '%s',
					`user_email` = '%s',`user_phone` = '%s',`user_avatar` = '%s'",$this -> name,
					$this -> password,$this -> email,$this -> phone,$this -> avatar);
			// echo $sql;
			$this -> affectRow = $this -> insert($sql);
			
			if($this -> affectRow){
				return 1;	
			}else{
				return 0;
			}
		}

		public function getUserInfo($user_id){
			$user_id = $this -> escape($user_id);
			$sql = sprintf("SELECT * FROM `users` WHERE `user_id` = %u",$user_id);
			$arr = $this -> fetchRows($sql);
			if(empty($arr)){
				return $arr = 0;
			}else{
				return $arr;
			}
		}

		public function updateUserInfo($arr){
			foreach ($arr as $key => $value) {
				$arr[$key] = $this -> escape($value);
			}
			$sql = sprintf("UPDATE `users` SET `user_name`='%s',`user_email`='%s',`isadmin`=%u 
					WHERE `user_id`=%u",$arr['name'],$arr['email'],$arr['usertype'],$arr['id']);
			$this -> affectRow = $this -> insert($sql);
			
			if($this -> affectRow){
				return 1;	
			}else{
				return 0;
			}
		}

		public function recordActivity($userId,$isLogin=null){
			$time = time();
			if($isLogin){
				$isLogin = '1';
			}else{
				$isLogin = '0';
			}
			$sql = sprintf("INSERT INTO `activities` SET `user_id`='%s',`activity_time`=
							'%d',`activity_flag`='%b'",$userId,$time,$isLogin);
			// echo $sql;
			$this -> affectRow = $this -> insert($sql);
			if($this -> affectRow){
				return 1;	
			}else{
				return 0;
			}
		}

		public function getUserActivity($user_id){
			$user_id = $this -> escape($user_id);
			$sql = sprintf("SELECT * FROM `activities` WHERE `user_id` = %u ORDER BY `activity_time`",$user_id);
			$arr = $this -> fetchRows($sql);
			if(empty($arr)){
				return $arr = 0;
			}else{
				return $arr;
			}
		}
	}
?>