<?php
	class Session{

		public static function start(){
			// //清除session.auto_start
			// if(session_id()){
			// 	session_unset();
			// 	session_destroy();
			// }
			session_start();
		}

		public static function set($key,$value,$encode=false){
			if($encode){
				$value = md5($value);
			}
			$_SESSION[$key] = $value;
			return true; 
		}

		public static function get($key){
			if (isset($_SESSION[$key])){
				return $_SESSION[$key];
			}
			exit("您无权访问！");
		}

		public static function del($keyArr){
			//session_unset();
			foreach($keyArr as $key){
				if(isset($_SESSION[$key])){
					unset($_SESSION[$key]);	
				}else{
					exit('抱歉，出错了');
				}
			}
			session_destroy();
		}
		/*
		* 启动、设置session
		*/
		public static function startSession($id,$name,$password){
			Session :: start();
			Session :: set('userId',$id);
			Session :: set('userName',$name);
			Session :: set('userPassword',$password,ture);
		}
		/*
		*注销session
		*/
		public static function delSession(){
			$keyArr = array('userId','userName','userPassword');
			Session :: start();
			Session :: del($keyArr);
		}
	}
?>