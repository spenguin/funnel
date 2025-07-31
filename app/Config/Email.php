<?php

namespace Config;

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require_once APPPATH.'ThirdParty/PHPMailer/src/Exception.php';
require_once APPPATH.'ThirdParty/PHPMailer/src/PHPMailer.php';
require_once APPPATH.'ThirdParty/PHPMailer/src/SMTP.php';
 
class Email 
{ 
    public function sendEmail($to, $subject, $body) 
    { 
        // Load Composer's autoloader 
        require_once APPPATH . '../vendor/autoload.php'; 
 
        $mail   = new PHPMailer(true); // Instance of PHPMailer 
        $env    = getenv( 'CI_ENVIRONMENT' ) . '.';
 
        try { 
            // Server settings 
            $mail->isSMTP(); // Set mailer to use SMTP 
            $mail->Host = getenv($env . 'SMTPServer'); // Specify main and backup SMTP servers 
            $mail->SMTPAuth = TRUE; // Enable SMTP authentication 
            $mail->Username = getenv($env . 'Username'); // SMTP username 
            $mail->Password = getenv( $env . 'Password'); // SMTP password 
            $mail->SMTPSecure = getenv($env . 'Protocol'); //PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption 
            $mail->Port = getenv($env . 'Port'); // TCP port to connect to 


            // Recipients 
            $from = getenv($env . 'Email'); //die($env . 'Email');
            $mail->setFrom($from, $from );
            $mail->addAddress($to); // Add a recipient 
 
            // Content 
            $mail->isHTML(TRUE); // Set email format to HTML 
            $mail->Subject = $subject; 
            $mail->Body = $body; 

            //Debug 
            $mail->SMTPDebug = FALSE;

            $_res = $mail->send(); //die(pvd($_res));
            // return $_res; 
            return true; // Email sent successfully 
        } catch (Exception $e) { //var_dump($e);
            return false; // Email sending failed 
        } 
    } 
}
