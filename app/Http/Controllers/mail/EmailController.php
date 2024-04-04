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
        /* RECUPERO TUTTO DALLA REQUEST */
        $data= $request->all();
        
        /* CREO UN NOVA ISTANZA DELLA CLASSE NEWCONTACT E ASSEGNO QUESTI 3 ARGOMENTI */
        $mail = new NewContact($data['email'], $data['name'], $data['text']);
        
        /* INVIO EMAIL */
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);

        /* RISPOSTA DI SUCCESSO */
        return response(null, 204);
        
    }
}