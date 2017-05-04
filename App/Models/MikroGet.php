<?php
/*
This is the class responsible for getting various information from the router, it extends the Mikrotik class.
*/
namespace App\Models;

use \Core\Mikrotik;
//this must be included to define the path of the mikrotik classes needed
use PEAR2\Net\RouterOS;

class MikroGet extends Mikrotik{
        
    
         //getting all online user 
        public static function getHotspotUsers(){
            $user = [];
            $ipAddress = [];
            $uptime = [];
            $onlineUsers = [];
            //get the router object
            $routerObj = MikroGet::routerConnect();
            //check if $routerObj is really an object
            if(is_object($routerObj)){
                $responses = $routerObj->sendSync(new RouterOS\Request('/ip/hotspot/active/print'));

                foreach ($responses as $response) {
                    if ($response->getType() === RouterOS\Response::TYPE_DATA) {

                        $user = $response->getProperty('user');
                        $ipAddress = $response->getProperty('address');
                        $uptime = $response->getProperty('uptime');
                        $onlineUsers[] = array('user' => $user, 'ipaddress' =>$ipAddress, 'uptime' =>$uptime);

                    }
                }

                return $onlineUsers;
            }else{
                //return the error message
                $error = $routerObj;
                return $error;
            }
            
        }
        
        //getting all online user 
        public static function getLogs(){
            $user = [];
            $routerObj = MikroGet::routerConnect();
            //check if $routerObj is really an object
            if(is_object($routerObj)){
                $responses = $routerObj->sendSync(new RouterOS\Request('/log/print'));

                foreach ($responses as $response) {
                    if ($response->getType() === RouterOS\Response::TYPE_DATA) {

                        $logs = $response->getProperty('message');

                    }
                }

                return $logs;
            }else{
                 //return the error message
                $error = $routerObj;
                return $error;
            }
            
        }
        
        //getting router name
        public static function getRouterName(){
            $routerObj = MikroGet::routerConnect();
            //check if $routerObj is really an object
            if(is_object($routerObj)){
                $getRouterName = $routerObj->sendSync(new RouterOS\Request('/system/identity/print'));
                $name = $getRouterName->getProperty('name');
                return $name;
                
            }else{
                //return the error message
                $error = $routerObj;
                return $error;
            }
            
            
        }
        
        public static function getHotspotAcc(){
            $username = [];
            $password = [];
            $userAndPass = [ ];
            //get the returned object from routerconnect method from the Mkrotik class with this class extends from
            $routerObj = MikroGet::routerConnect();
            //check if the returned object is really an object
            if(is_object($routerObj)){
                try{
                   //get the Request object
                $hotspotClients = $routerObj->sendSync(new RouterOS\Request('/tool/user-manager/user/print'));
                foreach ($hotspotClients as $response) {
                    if ($response->getType() === RouterOS\Response::TYPE_DATA) {

                        $usernameItem = $response->getProperty('username');
                        $passwordItem = $response->getProperty('password');
                        $userAndPass[] = array('username' => $usernameItem, 'password' =>$passwordItem);         
                    }
                }

                return $userAndPass; 
                }catch(Exception $e){
                    die('Unable to connect to the router.');
                }
                
            }else{
                //return the error message
                $error = $routerObj;
                return $error;
            }
            
        }
}


?>