<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mail()
    {
        $data = array('name' => "Danish");
        Mail::send('mail', $data, function($message) {
            $message->to('danishrabbani1806@gmail.com', 'Danish')->subject('Test Mail from Selva');
            $message->from('danishrabbani2003@gmail.com', 'Rabb');
        });
        echo "Email Sent. Check your inbox.";
    }
}
