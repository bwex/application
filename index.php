<?php
    /*This is the entry point to the entire application, all the required classes are autoloaded from here. Another important task being done from here is, autoloading of the twig templating engine. This engine is used for creating the views of the application. An sms REST client called twilio is also used in the application. these third party code libraries are kept in the vendor's folder, and autoloaded from this index page.*/
    
    //twig autoloader
    /*code library obtained from https://twig.sensiolabs.org/doc/1.x/api.html.
    installation instractions obtained from https://twig.sensiolabs.org/doc/2.x/installation.html
    */
    require_once ('/Vendor/Twig/lib/Twig/Autoloader.php');
    Twig_Autoloader::register();

    

    /*twilio sms REST client auto loader. 
    code library obtained from https://www.twilio.com/docs/libraries/php
    */
    require_once ('/Vendor/twilio/Twilio/autoload.php');
    //creating application class autoloader. This autoloader loads all the classes for the application when thet are needed
    spl_autoload_register(function($class){
       //get the parent directory of this.
        //$root directory at this point holds the parent directory of my current diretory
        $root = __DIR__ .'/';
        //replace the back slash with a forward slash
        $file = $root .'/'. str_replace('\\', '/', $class). '.php';
        //if the file obtained is readable
        if(is_readable($file)){
            //require the file in this case the name of the file is also the name of the php class inside the file
            require $root. str_replace('\\', '/', $class) . '.php';
        }
        
        
    });
    /*This is the mikrotik API client obtainedd from http://pear2.php.net/PEAR2_Net_RouterOS.
    This code library enables application to communicate with mikrotik routers, that are used for hotspot service.*/
    require_once('Vendor/RouterOS_API.phar');


    /*This router instance is passed to the spl_autoload_register function, to autoload the required class, the Router class that does all the routing to the defined pages.*/
    $router = new Core\Router();
    //addition of routes to pages
    //$router->addroute('', ['controller' => 'Home', 'action' => 'index']);
    $router->addroute('admin', ['controller' => 'Admin', 'action' => 'adminpage']);
    $router->addroute('routerconnect', ['controller' => 'Routerconnect', 'action' => 'connect']);
    $router->addroute('login', ['controller' => 'Login', 'action' => 'login']);
    $router->addroute('logout', ['controller' => 'Logout', 'action' => 'logout']);
    $router->addroute('radiusaccounts', ['controller' => 'RadiusAccounts', 'action' => 'accounts']);
    $router->addroute('addusers', ['controller' => 'addusers', 'action' => 'add']);
    //route to the not found page
    $router->addroute('pagenotfound', ['controller' => 'pagenotfound', 'action' => 'notfound']);
    //route to the routerconnect page
    $router->addroute('routerconnect', ['controller' => 'RouterConnect', 'action' => 'connect']);
    //route to router disconnect
    $router->addroute('disconnectrouter', ['controller' => 'DisconnectRouter', 'action' => 'disconnect']);
    //route to the online users page
    $router->addroute('onlineusers', ['controller' => 'OnlineUsers', 'action' => 'onlineusers']);
    //route to the router accounts page
    $router->addroute('routeraccounts', ['controller' => 'RouterAccounts', 'action' => 'routerAccounts']);
    //route to the password reset page
    $router->addroute('passwordreset', ['controller' => 'PasswordReset', 'action' => 'passReset']);
    //route to the reports page
    $router->addroute('reports', ['controller' => 'GetAccounting', 'action' => 'getReports']);
    //route to rest api
    $router->addroute('rest', ['controller' => 'Rest', 'action' => 'runRest']);




    //match the requested route
    $url = $_SERVER['QUERY_STRING'];
     
    /*a query string is passed to the dispatch method. the dispatch method gets the string, and checks for matching routes to requested pages.*/
    $router->dispatch($url);
    
?>