<?php

namespace Core;

class View{
    
    
  
    //render view using twig
    public static function renderTemplate($template, $arg=[]){
        
        static $twig = null;
        
        if($twig === null){
            $loader = new \Twig_Loader_Filesystem('./App/Views');
            $twig = new \Twig_Environment($loader, array(
            'debug' => true, 'strict_variables' => true));
                                          
            //$twig->addExtension(new Twig_Extension_Debug());
        }
        
        echo $twig->render($template, $arg);
    }
    
    
}


?>