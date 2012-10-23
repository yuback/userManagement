<?php
	class Admin extends Controller{
		private $type = 'admin';

		/**
		* 显示用户和群组
		*
		*/
		public function profile(){

			$this -> display('profile',null,$this -> type);
		}
		/**
		* 增加群组
		*
		*/
		public function addGroup(){
			echo "这是添加分组的页面";
			if($this -> checkSession()){
				$this -> display('addGroup',null,$this -> type);
			}
		}
		/**
		* 确认添加组
		*
		*/
		public function checkAddGroup(){
			$subscriber = $this -> getUserPost();
			if(isset($subscriber['submit'])){
				$groupName = trim($subscriber['name']);
			}
			if(strlen($groupName) < 4){
				$error = "群名称不能太短哦！";
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}
			$adminModel = $this -> loadModel('Admin');
			if($adminModel -> addGroups($groupName)){
				$adminModel -> close();
				$success = '添加成功！';
				$role = 'success';
				$this -> display($role,$success);
			}else{
				$adminModel -> close();
				$error = '添加失败！';
				$role = 'error';
				$this -> display($role,$error);
			}
		}
		/**
		* 删除群组
		*
		*/
		public function delGroup(){
			if($this -> checkSession()){
				$adminModel = $this -> loadModel('Admin');
				$id = $this -> getId();
				if($adminModel -> del('groups',$id)){
					$adminModel -> close();
					$success = '删除成功！';
					$role = 'success';
					$this -> display($role,$success);			
				}else{
					$adminModel -> close();
					$error = '删除失败！';
					$role = 'error';
					$this -> display($role,$error);
				}
			}
		}
		/**
		* 修改群信息
		*
		*/
		public function updateGroup(){
			echo "修改群信息的页面";
		}
		/**
		* 增加用户到某群组
		* 
		*/
		public function addUser(){
			echo "这是添加新成员的页面";
			if($this -> checkSession()){
				$gid = $this -> getId();
				$adminModel = $this -> loadModel('Admin');
				$userInfoArr = $adminModel -> getInfo('users');
				$adminModel -> close();
				if(is_array($userInfoArr)){
					$this -> display('addGroupUser',$userInfoArr,$this -> type,$gid);
				}else{
					$error = "糟糕，出了点状况！";
					$role = 'error';
					$this -> display($role,$error);
					exit();
				}
			}
		}
		/**
		* 确认添加组
		*
		*/
		public function checkAddUser(){
			$subscriber = $this -> getUserPost();
			$user_ids = array();
			if(isset($subscriber['uid'])){
				$user_ids = $subscriber['uid'];
			}
			$group_id = $subscriber['gid'];
			if(empty($user_ids)){
				$error = "你还没有选择任何人！";
				$role = 'error';
				$this -> display($role,$error);
				exit();
			}
			$adminModel = $this -> loadModel('Admin');
			if($adminModel -> addGroupUsers($user_ids,$group_id)){
				$adminModel -> close();
				$success = '添加新成员成功！';
				$role = 'success';
				$this -> display($role,$success);
			}else{
				$adminModel -> close();
				$error = '添加新成员失败！';
				$role = 'error';
				$this -> display($role,$error);
			}
		}

		/**
		* 修改用户
		*
		*/
		public function updateUser(){
			$user_id = $this -> getId();
			$user = $this -> loadModel('User');
			$userInfoArr = $user -> getUserInfo($user_id);
			if(is_array($userInfoArr)){
				$this -> display('userMod',$userInfoArr,$this -> type);
			}
		}

		/**
		* 确认修改用户
		*
		*/
		public function checkUpdateUser(){
			$subscriber = $this -> getUserPost();
			$adminModel = $this -> loadModel('User');
			$isOK = $adminModel -> updateUserInfo($subscriber);
			if($isOK){
					$adminModel -> close();
					$success = '更新成功！';
					$role = 'success';
					$this -> display($role,$success);			
				}else{
					$adminModel -> close();
					$error = '更新失败！';
					$role = 'error';
					$this -> display($role,$error);
				}
		}

		/**
		* 删除用户
		*
		*/
		public function delUser(){
			if($this -> checkSession()){
				$adminModel = $this -> loadModel('Admin');
				$id = $this -> getId();
				switch ($id[0]) {
					case 'g':
						$isOK = $adminModel -> del('users_groups',substr($id,1));
						break;
					default:
						$isOK = $adminModel -> del('user',$id);
						break;
				}
				if($isOK){
					$adminModel -> close();
					$success = '删除成功！';
					$role = 'success';
					$this -> display($role,$success);			
				}else{
					$adminModel -> close();
					$error = '删除失败！';
					$role = 'error';
					$this -> display($role,$error);
				}
			}
		}
		/**
		* 显示所有用户的信息
		*
		*/
		public function getAllUserInfo(){
			if($this -> checkSession()){
				$adminModel = $this -> loadModel('Admin');
				$userInfoArr = $adminModel -> getInfo('users');
				$adminModel -> close();
				if(is_array($userInfoArr)){
					$this -> display('allUserInfo',$userInfoArr,$this -> type);
				}else{
					$error = "糟糕，出了点状况！";
					$role = 'error';
					$this -> display($role,$error);
					exit();
				}
			}
		}
		/**
		* 显示所有群组的信息
		*
		*/
		public function getAllGroupInfo(){
			if($this -> checkSession()){
				$adminModel = $this -> loadModel('Admin');
				$groupInfoArr = $adminModel -> getInfo('groups');
				$adminModel -> close();
				if(is_array($groupInfoArr)){
					$this -> display('allGroupInfo',$groupInfoArr,$this -> type);
				}else{
					$error = "糟糕，出了点状况！";
					$role = 'error';
					$this -> display($role,$error);
					exit();
				}
			}
		}
		/**
		*	显示某一群组的信息
		*
		*/
		public function getOneGroupInfo(){
			if($this -> checkSession()){
				$gid = $this -> getId();
				$adminModel = $this -> loadModel('Admin');
				$groupUserInfoArr = $adminModel -> getInfo('users_groups',$gid);
				$adminModel -> close();
				if($groupUserInfoArr !== null){
					$this -> display('oneGroupInfo',$groupUserInfoArr,$this -> type,$gid);
				}else{
					$error = "差一点就成功了！";
					$role = 'error';
					$this -> display($role,$error);
					exit();
				}
			}
		}
	}
?>