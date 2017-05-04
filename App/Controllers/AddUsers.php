<?php
    //this is a controller for a page for must have this namespace
    namespace App\Controllers;
    //the view core class renders the content
    use \Core\View;
    use \Core\Controller;
    // the accounts model class gets the required accounts information from database
    use App\Models\Add;
    use App\Models\SendSms;

    class AddUsers extends Controller{
        
         public function add(){
             //when submit button is clicked the if statment runs
            if(isset($this->route_params["submit"])){
                //get the entered details
                $userDetails = $this->getUserDetails();
                //for testing
                print_r($userDetails);
                $fname = $userDetails['fname'];
                $lname = $userDetails['lname'];
                $mobileNo = $userDetails['mobileNo'];
                //username and password is generated from the same user information entered
                $userPass = $this->userPassGen();
                //for testing
                print_r($userPass);
                //get the generated username password from the array
                $user = $userPass['username'];
                $pass = $userPass['password'];
                //call the addUser method from the Add model class. this inserts the captured user information
                Add::addUsers($fname, $lname, $mobileNo, $user, $pass);
                 
                //send sms to mobile number provided
                SendSms::sendNewUser($mobileNo, $user, $pass, $fname, $lname);
                echo("<script type='text/javascript'>alert('Text message sent to new user'); </script>");
            }

            // render twig template    
            View::renderTemplate('addusers.html'); 
        
        
        
    }
           
        
        //set the firstname
        public function getUserDetails(){
        //check if the get varibles have been set
        if(isset($this->route_params['firstName']) && isset($this->route_params['lastName']) && isset($this->route_params['mobileNo']) ){
            //collect data from the get variables
            $firstName = $this->route_params['firstName']; 
            $lastName = $this->route_params['lastName']; 
            $mobileNo = $this->route_params['mobileNo']; 
            //return an array of three user details passed from the form
            return $userDetails = ['fname' => $firstName, 'lname' => $lastName, 'mobileNo' => $mobileNo];
        }
        
     }
      
    
        public function userPassGen(){
            $details = $this->getUserDetails();
            $pass = '';
            //change first name to array
            $newFname = str_split($details['fname']);
            //get the first letter
            $firstNameInitial = $newFname[0];
            //make sure it is underscore
            $firstNameIni = strtolower($firstNameInitial);
            //get the firstname initial and concatenate to last name
            $username = $firstNameIni.$details['lname'];
            //add the newly created username and mobile number
            $charactors = $username.$details['mobileNo'];
            //get the lenth of the charactors and use it as limiter in for loop if you want.
            $charLen = strlen($charactors);
            //split the charactors into an array
            $charArray = str_split($charactors);
            
            for($i=0; $i < 8; $i++){
                
               $randChar = array_rand($charArray);
                
                $pass .=''.$charArray[$randChar];   
            }
            return $userPass = ['username' => $username, 'password' => $pass ];
        }
        
        
        
        
    }



?>
