<?php

namespace App\Controllers;

use App\Models\RestApiModel;
use \Core\Controller;

class Rest extends RestApiModel{
    
    public function runRest(){
        
        
        $verb = $_SERVER['REQUEST_METHOD'];

        if($verb == 'GET'){
            if(isset($_GET['user'])){
                
                $user = json_encode($this->getUser($_GET['user']));
                
                if($user == $_GET['user']){
                    header("Content-Type: application/json");
                }else{
                    header("HTTP/1.0 404 Not Found");
                    header("Content-Type: application/json");
                }
                 
            }

        //do get stuff
        }elseif($verb == 'POST'){

        //do post stuff

        }elseif($verb == 'PUT'){

        //do put stuff
        }elseif($verb == 'DELETE'){

        //do delete stuff
        }
      
          
    }
    
    
    
    
}



?>