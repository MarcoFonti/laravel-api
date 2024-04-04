<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email(Request $request)
    {  
        $data= $request->all();
        
        $mail = new NewContact($data['email'], $data['name'], $data['text']);
        
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);

        return response(null, 204);
        
    }
}