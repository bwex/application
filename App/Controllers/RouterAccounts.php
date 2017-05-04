<?php
    //this is a controller for a page for must have this namespace
    namespace App\Controllers;
    //the view core class renders the content
    use \Core\View;
    use \Core\Controller;
    // the accounts model class gets the required accounts information from database
    use App\Models\MikroGet;

    class RouterAccounts extends Controller{
        
         public function routerAccounts(){
        //run the getallusers method from the Accounts model class
        if(is_object(MikroGet::getHotspotAcc())){
           $routerAccounts = MikroGet::getHotspotAcc(); 
            View::renderTemplate('routeraccounts.html', ['routerAccounts' =>$routerAccounts]);
        }
        if(is_string(MikroGet::getHotspotAcc())){
            $error = MikroGet::getHotspotAcc();
            View::renderTemplate('routeraccounts.html', ['routerAccounts' =>$error]);
        }
        
        // render twig template, passing the data from the database
        //print_r($routerOnlineUsers);
             
        
        
    }
        
        
    }



?>