<?php

namespace App\Models;

use \Core\ModelCore;

  class RestApiModel extends ModelCore {
    
      
        public static function getUser($username){

            try{

            $db = ModelCore::getDB();

            $sql = "select * from radcheck where username ='".$username."' LIMIT 1";

            $results = mysqli_query($db, $sql);

            //print_r($results) ;

            return $results;

            }catch(Exception $e){

            echo $e->getMessage();
            }

         }
               
      
        
    }


?>