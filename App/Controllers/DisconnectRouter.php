<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;

class DisconnectRouter extends Controller{
    
    
    
    public function disconnect(){
        //echo out html view
        
        $disconnected = $this->disconnectRouter();
        
        View::renderTemplate('disconnectrouter.html', ['disconnect' => $disconnected]);
        
    }
    

    public function disconnectRouter(){
        
        unset($_SESSION['routerIp']);
        unset($_SESSION['routerUser']);
        unset($_SESSION['routerPass']);
        return true;
    }
    

    
}



?>