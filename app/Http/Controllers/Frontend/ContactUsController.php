<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Models\Contact;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('frontend.contact-us');
    }

    public function store(ContactRequest $request)
    {
       $request->validated();


        $request->merge([
            'ip_address' => $request->ip(),
        ]);


        $cleanData = array_map(function($q){
            return is_string($q)? strip_tags($q) : $q;
        },$request->all());


        $contact = Contact::create($cleanData);


        if(!$contact){
            session()->flash('error', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        session()->flash('success', 'Your message has been sent successfully.');
        return redirect()->back();
    }
}
