<?php
    //this is a controller for a page for must have this namespace
    namespace App\Controllers;
    //the view core class renders the content
    use \Core\View;
    use \Core\Controller;
    // the accounts model class gets the required accounts information from database
    use App\Models\PassReset;
    use App\Models\SendSms;

    class PasswordReset extends Controller{
        
        

        public function passReset(){
         
        if(isset($this->route_params["submit"])){   
            //run the method to generate new password
            $newPassword = $this->resetPass();
            //if newpassword is empty it means there was no match in the data b
            if(empty($newPassword)){
                echo("<script type='text/javascript'>alert('Username not found'); </script>");
            }else{
                
                try{
                    
                    SendSms::sendPassReset($this->route_params['mobileNo'], $newPassword);
                    echo("<script type='text/javascript'>alert('passwor reset was successful, check text message'); </script>");
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    echo("<script type='text/javascript'>alert('error while sending sms'); </script>");
                    
                }
              
            }  
            
            
        }
            
        View::renderTemplate('passwordreset.html');

        }


        public function resetPass(){
            //check if the post varibales are set first
            if(isset($this->route_params['username']) && isset($this->route_params['mobileNo'])){
                //if they are get the passed data
                $username = $this->route_params['username'];
                $mobileNo = $this->route_params['mobileNo'];
                
                //call checkuser from PassReset model class, to get details from database
                $userAndMobileNo = PassReset::checkUser();
                //check if the retuned object is not empty
                if(empty($userAndMobileNo)){
                    
                    echo "result set is empty";
                    
                }else{
                    //run a loop to retreive data from userandmobileno which is a returned array from the checkUser method of passreset class
                    foreach($userAndMobileNo as $row){
                        //compare what is entered to what is recieved from the database
                        if($row['username'] == $username && $row['mobileNo'] == $mobileNo){
                            //call passgen to generate a new password if the username and mobile number match with details in the database
                           $newPass = $this->passGen($username,$mobileNo);
                            //update password in the database
                            PassReset::updatePass($newPass, $username);
                            //return the newly generated password
                            return $newPass;
                        }

                    }//close of foreach
                    
                }//close of else   

            }//close of first if

        }//close of getresetdetails method
        
        
        //password generator
        public function passGen($user, $mobileNo){
            $pass = '';
            $charactors = $user.$mobileNo;
            //split the concatinated username and mobile number
            $charArray = str_split($charactors);
            //run loop to randomly select an item from the array
            for($i=0; $i < 8; $i++){

                $randChar = array_rand($charArray);

                $pass .=''.$charArray[$randChar];   
            }
            return $pass;
        }//close of passGen
        
        
        
        
        
        

    }//close of main class



?>