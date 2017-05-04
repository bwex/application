<?php

    namespace App\Models;
    
    use PDO;
    use \Core\ModelCore;
    /*this is the add model class, it is used by the addUsers controller to insert data into the radius database. this class extends the model core class. the model core class is what establishes connection to database */
    class Add extends ModelCore {
        
     //method that inserts data into database   
    public static function addUsers($firstName, $lastName, $mobileNo, $user, $pass){
        
        try{
            //get the database object
            $db = ModelCore::getDB();
            //begin sql transation
            $db->begin_transaction();
            
            // prepare the statment
            $query1 = $db->prepare("INSERT INTO users (firstName, lastName, mobileNo) VALUES (?, ?, ?)");
            $query2 = $db->prepare("INSERT INTO radcheck ( username, value, user_id) VALUES( ?, ?, ( SELECT user_id FROM users WHERE users.mobileNo = ? ))");
           
            //bind data
            $query1->bind_param("ssi", $firstName, $lastName, $mobileNo);
            $query2->bind_param("ssi", $user, $pass, $mobileNo);
            //execute insert query
            $query1->execute();
            $query2->execute();
            
            //commit the data
            $db->commit();
            //close database
            $db->close();
            
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        
    }
        
        
        
}



?>