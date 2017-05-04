<?php

    namespace App\Models;
    
    use PDO;
    use \Core\ModelCore;
    /*this is the password reset model class, it is used by the PasswordReset controller to check the username and mobile number of the user in order to reset the password. basically it updates the password field after generating a new one. this new password must be sent to user via sms */
    class PassReset extends ModelCore {
        
     //method that inserts data into database   
    public static function checkUser(){
        
        try{
            //get the database object
            $db = ModelCore::getDB();
            // prepare the statment
            $query1 = "SELECT users.mobileNo, radcheck.username FROM users INNER JOIN radcheck ON radcheck.user_id = users.user_id ";
            if(empty($query1)){
                $error = "somthing wrong with internal mysql query";
               return $error ;
                
            }else{
                $results = mysqli_query($db, $query1);
                //result set
                return $results;
            
            }
           
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        
    }//close of checkUser
       
        
        
     //method that inserts data into database   
    public static function updatePass($newPass, $username){
        
        try{
            //get the database object
            $db = ModelCore::getDB();
            // password update query
            $query1 = "UPDATE radcheck set value ='".$newPass."' WHERE username ='".$username."' ";
            
            if(empty($query1)){
                $error = "somthing wrong with internal mysql query";
                return $error ;
                
            }else{
                $results = mysqli_query($db, $query1);
                //result set
                return $results;
            
            }
           
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        
    }//close of checkUser
    
        
        
        
}



?>