<?php

namespace App\Controllers;

use \Core\View;

class Home{
    
    public function index(){
        //echo out html view
        View::renderTemplate('index.html');
        
    }
    
    
}


?>