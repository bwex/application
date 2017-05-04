<?php
    /*This is the core router class, resposible for routing all pages of the application. it will take the request urls 
    and based on the information provided in the url, a controller will be called 
    which then runs an action. An action is just a method in that controller class, that runs a rendering method from twig templating engine. The rendering method from twig displays the actual view, which is just an html page.
    */
    namespace Core;
    
    class Router{
        
        //associative array of routes (the routing table)
        
        protected $routes =[];
        
        //passed params from the url
        protected $params = [];
        
        //add a route to the routing table
        public function addroute($route, $params){
            //params are controller, action and other
            $this->routes[$route] = $params;
        }
        
        //get routes from routing table
        
        public function getRoutes(){
            
            return $this->routes;
        }
        
        //matching the router to the controller, and action therafter instantiating the required objects
        public function dispatch($url){
            //remove url string varibales
            $url = $this->removeQueryVariables($url);
            //echo $url;
            //check if the passed params match with stored params in routing table
            if($this->match($url)){
                //get the passed controller param
                $controller = $this->params['controller'];
                //convert $controller to studly caps
                $controller = $this->convertToStudlyCaps($controller);
                //add namespace for the controller class
                $controller = "App\Controllers\\$controller";
                //check if class by the name of $controller exists
                if(class_exists($controller)){
                    //create new instance of the class, passing the post variables. this is used to collect any passed form data.
                    $controller_object = new $controller($_POST);
                    //get the passed action params
                    $action = $this->params['action'];
                    //convert to camelcase
                    $action = $this->convertToCamelCase($action);
                    //check of method is callable
                    if(is_callable([$controller_object, $action])){
                        //call method from the controller class
                        
                        $controller_object->$action();
                        
                    }else{
                        echo "Method $action (in controller $controller) not found";
                    }
                }else{
                  header("Location: pagenotfound");
                }
            }else{
                //echo 'No route matched';
                header("Location: pagenotfound");
            }
        }
        
        //convert the string with hyphens to StudlyCaps
        protected function convertToStudlyCaps($string){
            //removing the '-' from $string, then capalize every word
            return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
            
        }
        
        //convert the string to camelcase
         protected function convertToCamelCase($string){
            //removing the '-' from $string, then capalize every word
            return lcfirst($this->convertToStudlyCaps($string));
            
        }
        
        //remove string variables from the url
        protected function removeQueryVariables($url){
            
            if($url != ''){
                //get the url and sub divide it the & position
                $parts = explode('&', $url, 2);
                //check if the first division has the '=', if it does not have then its a url. if it has then its url string varibale
                if(strpos($parts[0], '=') ===false){
                    $url = $parts[0];
                }else{
                    //if there is '=' then its not a url, hence set it an empty string
                    $url = '';
                }
                
            }
            return $url;
            
        }
        
        //method to check the route if it matches with one in routing table
        public function match($url){
            
            foreach($this->routes as $route => $params){
                //check the route passed in the url if it matches any route stored in the routing table
                if($url == $route){
                    //the params empty array is filled with the obtained params from the url
                    $this->params = $params;
                    return true;
                }
            }
            
            return false;
        }
        
        //get params if needed
        public function getParams(){
            
            return $this->params;
        }
        
    }

?>