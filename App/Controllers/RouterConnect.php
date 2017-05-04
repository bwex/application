<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use \Core\Mikrotik;
use App\Models\MikroGet;

class RouterConnect extends Controller{
    
    static $isConnected = false;
    
    public function connect(){
        //echo out html view
        
        $routerVar = $this->getRouterVar(); 
     
        
        if(isset($this->route_params["submit"])){
            
            //Mikrotik::routerDisconnect();
            Mikrotik::setRouterVariables($routerVar['ip'], $routerVar['user'], $routerVar['pass'] );

            //;
            
            $mikroConnection = Mikrotik::routerConnect();
            
            if(is_object($mikroConnection)){
                try{
                    //setting the isconnected to true will redirect user back to admin page on successfull router connection
                    if(isset($_SESSION['routerObj'])){
                        $_SESSION['routerObj'] = $mikroConnection;
                    }
                    static::$isConnected = true;
                    //for testing
                    print_r($routerVar);
                    
                }catch(Exception $e){
                    die('Unable to connect to the router.');
                }
                
            }else{
               echo("<script type='text/javascript'>alert('router connected failed'); </script>");  
            }
        }
        
        
        View::renderTemplate('routerconnection.html', ['isConnected' => RouterConnect::$isConnected]);
        
    }
    
    public function checkIfSet(){
        
    }
    
    public function getRouterVar(){
        
        if(isset($this->route_params["routerIp"]) && isset($this->route_params["routerUser"]) && isset($this->route_params["routerPass"])){
            
            $routerIp = $this->route_params["routerIp"];
            $routerUser = $this->route_params["routerUser"];
            $routerPass = $this->route_params["routerPass"];
            
            return $routerVar = ['ip' => $routerIp, 'user' => $routerUser, 'pass' => $routerPass];
        }
    }
    

       
}

?>