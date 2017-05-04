<?php

    

    namespace Core;

    abstract class Controller{
        
        protected $route_params = [];
        
        public function __construct($route_params){
            //passed variables from the post php variable
            $params = $this->route_params = $route_params;
            //start sessions from the contructor so that its applied in all the controllers
            session_start();
        }
        
        
    }

?>