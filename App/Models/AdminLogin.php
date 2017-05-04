<?php
namespace App\Models;
    
    use PDO;
    use \Core\ModelCore;
    /*this is the admin login model class, it is used by the login controller to varifiy login details in the database. this class extends the model core class. the model core class is what establishes connection to database */
    class AdminLogin extends ModelCore {
    
    //mysqli 
      //method that gets the required database   
    public static function userLogin($username, $password){
        
        try{
            
            $db = ModelCore::getDB();
            
           $sql = "select * from admin where password='".$password."' AND password='".$username."' LIMIT 1";
            
            $results = mysqli_query($db, $sql);
            
            //print_r($results) ;
            
            return $results;
            
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        
     }
               
        
        
        
    }

?>

