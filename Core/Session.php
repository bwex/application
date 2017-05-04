<?php
namespace Core;
    
class Session {
    
    
    public $signed_in = false;
    public $router_connected = false;
    private $login_user;
    private $router_connection;
    
    //start session in constructor 
    function __construct(){
        session_start();
        //call this function automatically
        $this->check_the_login();
        $this->check_the_router();
    }
    //check if user is signed in
    public function is_signed_in(){
        
        return $this->signed_in; 
    }
    
    //check if router is connected
    public function is_router_connected(){
        
        return $this->router_connected; 
    }
    
    //login function
    public function login(){
           
        $this->login_user = $_SESSION['login_user'];
        $this->signed_in = true; 
        
        }        
    
     //logout function
    public function logout(){
        
            unset($_SESSION['login_user']);
            unset($_SESSION['ip']);
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
            $this->signed_in = false;
            $this->router_connected = false;
            
        
    }
    
    //setting and checking the session
    private function check_the_login(){
        
        if(isset($_SESSION['login_user'])){
            
            $this->login_user = $_SESSION['login_user'];
            $this->signed_in = true;
            
        }else{
            unset($this->login_user);
            $this->signed_in = false;
        }
        
    }//end of check_the_login
    
    //check router connection session
    private function check_the_router(){
        
        if(isset($_SESSION['routerVariables'])){
            
            $this->router_connection = $_SESSION['routerVariables'];
            $this->router_connected = true;
            
        }else{
            unset($this->router_connection);
            $this->router_connected = false;
        }
        
    }//end of check_the_login
    
}


?>