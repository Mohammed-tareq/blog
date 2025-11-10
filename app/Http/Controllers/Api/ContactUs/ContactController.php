<?php

namespace App\Http\Controllers\Api\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\AdminContactNotify;
use Illuminate\Support\Facades\Notification;
use function App\Http\Helper\apiResponse;

class ContactController extends Controller
{
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

        $contact = Contact::create($cleanData);
        if (!$contact) {
            return apiResponse(400, 'Something went wrong. Please try again later.');
        }

        $admins = Admin::whereHas('authoriz', function ($q) {
            $q->whereJsonContains('permissions', 'contact.update');
        })->get();
        Notification::send($admins, new AdminContactNotify($contact));

        return apiResponse(200, 'Your message has been sent successfully.');


    }
}
