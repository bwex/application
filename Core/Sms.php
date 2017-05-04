<?php

    namespace Core;
    
    abstract class Sms{
        
        
    //The REST API Client is used to make requests to the Twilio REST API
    use Twilio\Rest\Client;

    //Account SID and Auth Token from twilio.com/console
    static $sid = 'ACf0f564e6bb5668dec692fe70cf211e04';
    static $token = 'b2826af80df9518cacb536ad44e1b44c';
    $smsClient = new Client($sid, $token);
        
    }

    


?>