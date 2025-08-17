<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fornt\ContectRequest;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        $setting = Setting::first();
        return view('front.contact' , compact('setting'));
    }

    public function store(ContectRequest $request){
        $request->validated();
        $request->merge([
            'ip_address' => $request->ip(),
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'body' => $request->body,
            'phone' => $request->phone,
            'ip_address' => $request->ip_address,
        ]);
        if (!$contact) {
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }

        Session::flash('success', 'Your message has been sent successfully');
        return redirect()->back();

    }
}
