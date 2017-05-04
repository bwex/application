<?php

    namespace App\Models;
    
    use PDO;
    use \Core\ModelCore;
    /*this is the accounts model class, it is used by the radiusaccounts controller to collect data from the radius database. this class extends the model core class. the model core class is what establishes connection to database */
    class Accounts extends ModelCore {
        
     //method that gets the required database   
    public static function getAllUsers(){
        
        try{
            
            $db = ModelCore::getDB();
            
            $sql = 'SELECT * FROM radcheck';
            
            $results = mysqli_query($db, $sql);
            
            return $results;
            
        }catch(PDOException $e){
            
            echo $e->getMessage();
        }
        
    }
        
        
        
        
    }



?>