<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use App\Models\AdminLogin;

class PageNotFound extends Controller{
    
    
    
    public function notFound(){
        //echo out html view
        
        View::renderTemplate('pageNotFound.html');
        
    }
  

    
}

?>