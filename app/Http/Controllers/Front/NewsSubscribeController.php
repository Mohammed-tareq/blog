<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Front\NewSubscribeMail;
use App\Models\NewsSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewsSubscribeController extends Controller
{
    public function subscribe(Request $request)
    {

        $request->validate([
            'email' => 'required|email:rfc,dns',  /** |unique:news_subscribes,email */
        ], [
            // 'email.unique' => 'This email is already subscribed.',
            'email.email' => 'Please enter a valid email address.',
            'email.required' => 'Email is required.',
        ]);


        if ( NewsSubscribe::where('email', $request->email)->exists()) {

            Session::flash('error', 'Email already exist');
            return redirect()->back();
        }
        NewsSubscribe::create([
            'email' => $request->email
        ]);

        Mail::to($request->email)->later(now()->addSeconds(5), new NewSubscribeMail($request->email));

        Session::flash('success', 'You have successfully subscribed our news letter');
        return redirect()->back();
    }
}
