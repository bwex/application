<?php

    namespace Core;

    use PDO;
    use App\Config;

    /*This a base class for the model, main connection to the database shall be established here. all classes that need database connection will have to extend this class*/
    abstract class ModelCore{
        
         //method to open db connection
    protected static function  getDB(){
        
                
                try{
                    $db = new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, COnfig::DB_NAME);
                    
                    return $db;
                    
                }catch(Exception $e){
                    
                    echo $e->errorMessage();
                }
           

    }
    
 
    }


?>