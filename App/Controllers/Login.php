<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use App\Models\AdminLogin;

class Login extends Controller{
    
    
    public function login(){
        //echo out html view
        
        static $logged = null;
        if(isset($this->route_params["submit"])){
            //call setLogin

               $logged = $this->setLogin(); 
            
        } 
        
        View::renderTemplate('login.html', ['loggedin' => $logged]);
        
    }
    

    public function setLogin(){
         if(isset($this->route_params['username']) && isset($this->route_params['password'])){
             
            $user = $this->route_params['username'];
            $pass = $this->route_params['password'];
             //userLogin is a static method from the AdminLogin class. this method returns an array of the result set from the database.
            $loginDetails = AdminLogin::userLogin($user, $pass);
            //$loginDetails at this point hold the result set of the mysql query
             if(!empty($loginDetails)){
                 
                     foreach($loginDetails as $row){
                    if($row['username'] == $user && $row['password'] == $pass){
                        if(!isset($_SESSION['login']))
                            //save the user in the session
                            $_SESSION['login'] = $user;

                            echo 'session set';

                            print_r($_SESSION['login']);

                            return true;

                        } 
                    else {
                        unset($_SESSION['login']);
                        session_destroy();
                        }

                    }//end of foreach 
                 
             }else{
                 echo("<script type='text/javascript'>alert('database connection error. Please check connected to database'); </script>");
             }
            
         }//isset check
        
        
    }
    

    
}

?>