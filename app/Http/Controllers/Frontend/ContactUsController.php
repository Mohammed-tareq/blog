<?php

namespace App\Http\Controllers\Frontend;

use App\Notifications\AdminContactNotify;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Support\Facades\Notification;

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
            'status' => false,
        ]);


        $cleanData = array_map(function ($q) {
            return is_string($q) ? strip_tags($q) : $q;
        }, $request->all());

        $admins = Admin::whereHas('authoriz', function ($q) {
            $q->whereJsonContains('permissions', 'contact.update');
        })->get();


        $contact = Contact::create($cleanData);
        Notification::send($admins, new AdminContactNotify($contact));

        if (!$contact) {
            session()->flash('error', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        session()->flash('success', 'Your message has been sent successfully.');
        return redirect()->back();
    }
}
