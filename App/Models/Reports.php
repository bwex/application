<?php
namespace App\Models;
    
    use PDO;
    use \Core\ModelCore;
    /*this collects data from the radius accounting table */
    class Reports extends ModelCore {
    
    //mysqli 
      //method that gets the required database   
    public static function get(){
        
        try{
            
            $db = ModelCore::getDB();

            /*$sql = "select username, nasipaddress, acctstarttime, acctstoptime, acctoutputoctets, acctoutinputoctets, framedipaddress, callingstationid from radacct";*/
            
            $sql2 = "select * from radacct";
            
            $results = mysqli_query($db, $sql2);
            
            //print_r($results) ;
            
            return $results;
            
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        
     }
               
        
        
        
    }

?>

