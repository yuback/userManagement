<?php
	class AdminModel extends Model{
		private $name;
		private $content;
		private $mysqli;
		private $affectRow;
		
		public function __construct(){
			parent :: __construct();
		}

		//增加新群组
		public function addGroups($name){
			$name = $this -> escape($name);
			$sql = sprintf("INSERT INTO `groups` SET `groups_name`='%s'",$name);
			$this -> affectRow = $this -> insert($sql);
			if($this -> affectRow){
				return 1;
			}else{
				return 0;
			}
		}
		//增加新用户到某群
		public function addGroupUsers($user_ids,$group_id){
			$values = "";
			foreach($user_ids as $ids){
				$values .= "($ids,$group_id),";
			}
			$values = rtrim($values,",");
			$sql = sprintf("INSERT INTO `users_groups`(`user_id`,`group_id`) VALUES%s",$values);
			$this -> affectRow = $this -> insert($sql);
			if($this -> affectRow){
				return 1;
			}else{
				return 0;
			}
		}
		//删除某用户，或者某群组的一成员
		public function del($tablename,$id){
			$tablename = $this -> escape($tablename);
			$id = $this -> escape($id);
			if($tablename=='users_groups'){
				$uid = 'user_id';
			}else{
				$uid = $tablename.'_id';
			}
			$sql = sprintf("DELETE FROM `%s` WHERE `%s`= %u",$tablename,$uid,$id);
			echo $sql;
			$this -> affectRow = $this -> insert($sql);
			if($this -> affectRow){
				return 1;
			}else{
				return 0;
			}
		}

		/*public function updateUser($id){
			//这是管理员更新用户的函数 区别于userModel的updateUser
		}
*/
		//获取用户信息，或者群组的成员信息
		public function getInfo($tablename,$id=null){
			$tablename = $this -> escape($tablename);
			if($id == null){
				$sql = sprintf("SELECT * FROM `%s`",$tablename);
			}else{
				$id = $this -> escape($id);
				$sql = sprintf("SELECT * FROM `users` WHERE `user_id` IN (
						SELECT `user_id` FROM `%s` WHERE `group_id`=%u)",$tablename,$id);
			}
			$arr = $this -> fetchRows($sql);
			if(empty($arr)){
				return $arr = 0;
			}else{
				return $arr;
			}
		}

	}
?>
