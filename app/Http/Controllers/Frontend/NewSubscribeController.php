<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\NewSubscriderMail;
use App\Models\NewSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewSubscribeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:new_subscribes,email'
        ]);

        $subscriber = NewSubscribe::create([
            'email' => $request->email,
        ]);
        if(!$subscriber){
            Session::flash('error', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        Mail::to($request->email)->send(new NewSubscriderMail());
        Session::flash('success', 'You have successfully subscribed to our newsletter.');
        return redirect()->back();

    }
}
