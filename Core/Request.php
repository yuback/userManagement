<?php
	class Request{

		private $query   = array();
        private $url     = array();
		private $data    = array();
		private $params  = array();
        private $file    = array();

        private function parse(){
            $C = include ROOT_PATH . '/Config/Config.php';

            if($C['URL_MODE'] == 1){ //普通模式
                $this -> params['control'] = !empty($_GET['c']) ? trim($_GET['c']) : '';
                $this -> params['action']  = !empty($_GET['a']) ? trim($_GET['a']) : '';
            }elseif($C['URL_MODE'] == 2){//PATH_INFO模式
                if(isset($_SERVER['PATH_INFO'])){
                    $this -> url = trim($_SERVER['PATH_INFO'], '/');
                    $this -> url  = explode('/', $this -> url);
                    $this -> params['control'] = array_shift($this -> url);
                    $this -> params['action']  = array_shift($this -> url);
                    $this -> params['Id']  = array_pop($this -> url);
                }
            }

            if(empty($this -> params['control'])){
            	$this -> params['control'] = $C['DEFAULT_CONTROL'];
            }
            if(empty($this -> params['action'])){
            	$this -> params['action'] = $C['DEFAULT_ACTION'];
            }

            // return $this -> params;
        }

        public function getUrlParseResult(){
            $this -> parse();
            return $this -> params;
        }

        public function getPost(){
            $this -> data = $this -> _filter($_POST);
            return $this -> data;
        }

        public function getQuery(){
            $this -> query = $this -> _filter($_GET);
            return $this -> query;
        }

        public function getFile(){
            /*$this -> file = $this -> _filter($_FILES);
            var_dump($this->file);
            return $this -> file;*/
            // var_dump($_FILES);
            return $_FILES;
        }

        private function _filter($dataType){
            // 做一些过滤 array_walk_recursive(),htmlspecialchars()
            $result = array();
            foreach($dataType as $key => $value){
                $result[$key] = htmlspecialchars($value,ENT_QUOTES);
            }
            return $result;
        }

	}
?>