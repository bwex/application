<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use App\Models\MikroGet;
use App\Models\Accounts;

class Admin extends Controller{
    
     public function adminPage(){
         $routerName = "Please connect router";
         $logs = "Please connect router";
         $OnlineUsers = "Please connect router";
         $radiusacc = "Please connect router";
         $OnlineUsers = "Please connect router";
        //echo out html view
        //the login status is passed to the view or template for varification
        $loginSession = $this->checkLogin();
        //get the status of the session
        $routerSession = $this->checkRouter();
         if($routerSession){
            //get router name
            $routerName = MikroGet::getRouterName();
            //get router logs
            $logs = MikroGet::getLogs();
            //total user accounts from the database
            $radiusacc = count(Accounts::getAllUsers());
            //get number of online users
            $OnlineUsers = count(MikroGet::getHotspotUsers()); 
         }else{
             echo "router not cnnected";
         }
       

        //render the twig view
        View::renderTemplate('admin.html', ['checklogin' =>$loginSession, 'checkRouter' => $routerSession, 'routername' => $routerName, 'onlineUsers' => $OnlineUsers, 'userAccounts' => $radiusacc, 'logs' => $logs]);  
        
    }
    
    public function checkLogin(){
        
        if(!isset($_SESSION['login'])){
            
            return false;
            
        }else{
            return true;
        }
        
    }
    
    public function checkRouter(){
         if(!isset($_SESSION['routerIp'])){

            return false;
        }else{
             return true;
         }
    }
    
    //$ip = Mikrotik::getIp();
    //$user = Mikrotik::getUser();
    //$pass = Mikrotik::getPass();

    //$routerName = Mikrotik::getRouterName(Mikrotik::mikroConnect());

    //echo "Connected to :".$routerName."";
    
}


?>