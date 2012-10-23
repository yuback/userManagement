<?php
    class Dispatch{
        public function Run(){
            $request = new Request(); 
            $params  = $request -> getUrlParseResult();
            $control = $this -> _getController($params);
            $action  = $this -> _getAction($params);
            $this -> _loadFile($control);
            $instance = new $control($request); 
            $instance->$action();
        }

        private function _getController($params){
            $control = ucwords($params['control']);
            return $control;
        }

        private function _getAction($params){
            $action = $params['action'];
            return $action;
        }

        private function _loadFile($control){
            $controlFile = ROOT_PATH . '/Controller/' . $control . 'Controller.php';
            if(!$controlFile){
                exit("控制器文件不存在");
            }
            include "$controlFile";
        }

    }

?>