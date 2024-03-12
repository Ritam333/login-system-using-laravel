<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailcontroller extends Controller
{
    //
    public function forgot(){
        return view('forgot');
      }

      public function postforgot(Request $request){

        require base_path("vendor/autoload.php");

        $mail = new PHPMailer(true); // Passing `true` enables exceptions
       
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username =  // Your Gmail address
            $mail->Password =  // Your Gmail password or app password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Sender and recipient
            $mail->setFrom('ritamhit24@gmail.com', 'Your Name');
            $mail->addAddress($request->input('email')); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body    = 'Hello, this is a password reset email.';
           
            // Send the email
            $mail->send();
            
            return "success: Email has been sent.";
        } catch (Exception $e) {
            return "error: {$e->getMessage()}";
        }
    }
}


