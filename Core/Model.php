<?php
	class Model{
		private $mysqli;
		private $msg;
		private $query_id;

		public function __construct(){
			$C = include ROOT_PATH . '/Config/Config.php';
			$this -> connection($C);
 		}

 		public function connection($C){
 			$this -> mysqli = new mysqli($C['DB_HOST'],$C['DB_USER'],$C['DB_PWD'],$C['DB_NAME']);
			$this -> mysqli -> set_charset($C['DB_CHAR']);
			if(mysqli_connect_errno()){ //检查是否可以正确打开数据库
    			die("数据库连接失败");
 			}
 		}

 		public function insert($sql){
 			$this -> query_id = $this -> mysqli -> query($sql);
 			// var_dump($this->query_id);
 			if($this -> query_id){
 				return 1;
 			}else{
 				return 0;
 			}
 		}

 		public function find($sql){
 			$restult = $this -> mysqli -> query($sql);
 			$affectRow = $restult -> num_rows;
 			if($affectRow >= 1){
 				return $restult -> fetch_array(MYSQLI_ASSOC);
 			}else{
 				return 0;
 			}
 		}

 		public function fetchRows($sql){
 			$restult = $this -> mysqli -> query($sql);
 			$arr = array();
 			$i = 0;
 			while( $row = $restult -> fetch_array() ){
 				$arr[$i] = $row;
 				$i++;
 			}
 			return $arr;
 		}
		
		public function close(){
			$this -> mysqli ->close();
		}

		public function escape($string){
			if(!is_numeric($string)){
				$string = $this -> mysqli -> real_escape_string($string);
				// $string = "'".$string."'";
			}
			return $string;
		}
	}
?>