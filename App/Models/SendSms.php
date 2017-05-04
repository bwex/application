<?php

    namespace App\Models;
    
    
    //The REST API Client is used to make requests to the Twilio REST API
    use Twilio\Rest\Client;
    /*this is the sms model class, it is used to send sms text messages */
    class SendSms {
        
     //sending sms to new user   
    public static function sendNewUser($number, $username, $password, $fname, $lname){
        
        //Account SID and Auth Token from twilio.com/console
        static $sid = 'ACf0f564e6bb5668dec692fe70cf211e04';
        static $token = 'b2826af80df9518cacb536ad44e1b44c';
        
        $smsClient = new Client($sid, $token);
        //code obtained from https://www.twilio.com/docs/libraries/php
        $smsClient->messages->create(
            // the number you'd like to send the message to
            '+260'.$number,
            array(
                // A Twilio phone number that was purchased at twilio.com/console
                'from' => '+447481346249',
                // the body of the text message
                'body' => "Hello ".$fname." ".$lname.", your username is ".$username." and password is ".$password.". Use these credentials to log into the shcool hotspot system."
            )
        );

    }
        
    //sending sms after password reset
    public static function sendPassReset($number, $newPassword){
        
        //Account SID and Auth Token from twilio.com/console
        static $sid = 'ACf0f564e6bb5668dec692fe70cf211e04';
        static $token = 'b2826af80df9518cacb536ad44e1b44c';
        
        $smsClient = new Client($sid, $token);
        //code obtained from https://www.twilio.com/docs/libraries/php
        $smsClient->messages->create(
            // the number you'd like to send the message to
            '+260'.$number,
            array(
                // A Twilio phone number that was purchased at twilio.com/console
                'from' => '+447481346249',
                // the body of the text message
                'body' => "Password reset was succefull, your new password is ".$newPassword.""
            )
        );

    }
     
        
        
        
}



?>
