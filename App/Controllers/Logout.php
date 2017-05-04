<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;

class Logout extends Controller{
    
    
    
    public function logout(){
        //echo out html view
        
        $loggedout = $this->setLogout();
        
        View::renderTemplate('logout.html', ['loggedout' => $loggedout]);
        
    }
    

    public function setLogout(){
        
        if(isset($_SESSION['login'])){
            
            unset($_SESSION['login']);
            unset($_SESSION['routerIp']);
            unset($_SESSION['routerUser']);
            unset($_SESSION['routerPass']);
            
        }
        
        
    }
    

    
}

?>