<?php
    //this is a controller for a page for must have this namespace
    namespace App\Controllers;
    //the view core class renders the content
    use \Core\View;
    use \Core\Controller;
    // the accounts model class gets the required accounts information from database
    use App\Models\MikroGet;

    class OnlineUsers extends Controller{
        
         public function onlineUsers(){
        //run the getallusers method from the Accounts model class
        $routerOnlineUsers = MikroGet::getHotspotUsers();
        // render twig template, passing the data from the database
        //print_r($routerOnlineUsers);
             
        View::renderTemplate('onlineusers.html', ['onlineUsers' =>$routerOnlineUsers]);
        
    }
        
        
    }



?>

