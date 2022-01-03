<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        # code...
        return view('contact');
    }
    
    public function store()
    {
        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'nullable|min:3|max:50',
            'message' => 'required|min:5|max:500',
        ]);

        Contact::create($attributes);

        Mail::to(env('ADMIN_EMAIL'))->send(new ContactMail(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['subject'],
            $attributes['message'],
        ));

        if (Mail::failures() != 0) {
            return redirect()->route('contact.create')->with('success', 'Your message has been sent');
        }
        return "Oops! There was some error sending the email.";        
    }
    
}
