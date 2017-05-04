<?php
    //this is a controller for a page for must have this namespace
    namespace App\Controllers;
    //the view core class renders the content
    use \Core\View;
    use \Core\Controller;
    // the accounts model class gets the required accounts information from database
    use App\Models\Reports;

    class GetAccounting extends Controller{
        
         public function getReports(){
        $data = Reports::get(); 
        if(!empty($data)){
            
             View::renderTemplate('reports.html', ['data' =>$data]);
        }else{
            $noData = "no data found, please check database connection";
            View::renderTemplate('reports.html', ['data' =>$noData]);
        }
             
       
        
    }
        
        
    }



?>

