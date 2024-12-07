<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Mail;
 
class EmailController extends Controller
{
      
    public function send() {
 
        $data = array('name'=>'Test Name');
        Mail::send('mail', $data, function($message) {
            $message->to('your-email@gmail.com', 'Test Name')->subject('Test Mail from MailMug');
            $message->from('info@name.com','your Name');
        });
        echo "Email Sent. Check your inbox.";
         
    }
}