<?php

    namespace App\Models;
    
    use PDO;
    use \Core\Model;
    /*this is the add model class, it is used by the addUsers controller to insert data into the radius database. this class extends the model core class. the model core class is what establishes connection to database */
    class UserCheck extends ModelCore {
        
  
        
      //method that inserts data into database   
    public static function check($username, $mobileNo){
        
        try{
            
            $db = Model::getDB();
            
           // prepare the statment
            $sql = "select * from login where username='".$username."' AND mobileNo='".$mobileNo."' LIMIT 1";
            //bind data
             $results = mysqli_query($db, $sql);
            
            //print_r($results) ;
            
            return $results;
            
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        
    }
        
        
        
        
    }



?>