<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function PostContactDetails(Request $request){
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        
        date_default_timezone_set('Asia/Kabul');
        $contact_time = date('h:i:sa');
        $contact_date = date('d-m-Y');

        $result = Contact::insert([
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'contact_date' => $contact_date,
            'contact_time' => $contact_time,
        ]);

        return $result;

    }
}
