<?php
    /*
    This is the class responsible for collecting the paramaters needed to connect to router, thereafter connect to the router and instantiate an object to be used for all the router related tasks.
    The setRouterVariables method is called and passed the ip address, username and password login details for a paticular router. These variables are stored in sessions so that they can be used in other php scripts. The routerConnect method is where connection to the router is established.
    */
    namespace Core;

    use PEAR2\Net\RouterOS;
    //require_once("RouterOS_API.phar");
    
   
    class Mikrotik{
         
        //call this first so as to set variables needed for connection
        public static function setRouterVariables($routerIp, $routerUser, $routerPass){
            //set the passed data into the class properties
            if(!isset($_SESSION['routerIp']) && !isset($_SESSION['routerUser']) && !isset($_SESSION['routerPass'])){

                $_SESSION['routerIp'] = $routerIp;
                $_SESSION['routerUser'] = $routerUser;
                $_SESSION['routerPass'] = $routerPass;
                
            }
            
        }
    
        //get ip address
        public static function getIp(){
            if(isset($_SESSION['routerIp'])){
                return $_SESSION['routerIp'];
            }
             
        }
        //get username
        public static function getUser(){
            if(isset($_SESSION['routerUser'])){
               return $_SESSION['routerUser']; 
                }
                
            }
        //get password
        public static function getPass(){
            if(isset($_SESSION['routerPass'])){
                return $_SESSION['routerPass'];
                }
                
            }
        
        //connecting to router
       
        public static function routerConnect(){
            
             //get the parameters;
                $ip = self::getIp();
                $user = self::getUser();
                $pass = self::getPass();
                $error = "error";
            //check if the parameters are not null
                if($ip===null && $user===null && $pass===null){
                    
                    return $error;
                       
                }else{
                    //create the router class object if parameters are set
                    try {
                    $client = new RouterOS\Client($ip, $user, $pass);
                    //echo 'connected to router';
                    
                    //if all was successfull a client object will be returned
                    return $client;
                        
                    } catch(Exception $e) {

                        die('Unable to connect to the router.');
                    }
                    
                }
                
         
        }
        
        public static function routerDisconnect(){
            unset($_SESSION['routerIp']);
            unset($_SESSION['routerUser']);
            unset($_SESSION['routerPass']);
            
        }
        
       

    }
?>