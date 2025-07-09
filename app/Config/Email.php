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
 
        $mail = new PHPMailer(true); // Instance of PHPMailer 
 
        try { 
            // Server settings 
            $mail->isSMTP(); // Set mailer to use SMTP 
            $mail->Host = getenv('SMTPServer'); // Specify main and backup SMTP servers 
            $mail->SMTPAuth = true; // Enable SMTP authentication 
            $mail->Username = getenv('Username'); // SMTP username 
            $mail->Password = getenv('Password'); // SMTP password 
            $mail->SMTPSecure = getenv('Protocol'); //PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption 
            $mail->Port = getenv('Port'); // TCP port to connect to 

            // Recipients 
            $mail->setFrom(getenv('Username'), getenv('Username')); 
            $mail->addAddress($to); // Add a recipient 
 
            // Content 
            $mail->isHTML(true); // Set email format to HTML 
            $mail->Subject = $subject; 
            $mail->Body = $body; 
 
            $_res = $mail->send();
            return $_res; 
            //return true; // Email sent successfully 
        } catch (Exception $e) { 
            return false; // Email sending failed 
        } 
    } 
}
