<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

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
        return redirect()->route('contact.create')->with('success', 'Your message has been sent');
    }
    
}
