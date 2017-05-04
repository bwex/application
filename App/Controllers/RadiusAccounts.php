<?php
    //this is a controller for a page for must have this namespace
    namespace App\Controllers;
    //the view core class renders the content
    use \Core\View;
    use \Core\Controller;
    // the accounts model class gets the required accounts information from database
    use App\Models\Accounts;

    class RadiusAccounts extends Controller{
        
         public function accounts(){
        //run the getallusers method from the Accounts model class
        $radiusacc = Accounts::getAllUsers();
        // render twig template, passing the data from the database     
        View::renderTemplate('radiusaccounts.html', ['radiusaccounts' => $radiusacc]);
        
    }
        
        
    }



?>

