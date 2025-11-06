<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactAdminCotroller extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contact.read')->only('index');
        $this->middleware('can:contact.update')->only('show');
        $this->middleware('can:contact.delete')->only('destroy');
    }

    public function index()
    {
        $keyword = request()->keyword;
        $sortBy = request()->sort_by ?? 'id';
        $orderBy = request()->order ?? 'desc';
        $limit = request()->paginate ?? 10;
        $status = request()->status;

        $contacts = Contact::when($keyword, fn($q) => $q->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('title', 'like', '%' . $keyword . '%'))
            ->when(!is_null($status), fn($q) => $q->where('status', $status))
            ->orderby($sortBy, $orderBy)
            ->paginate($limit);

        Auth::guard('admin')->user()->unreadNotifications->markAsRead();

        return view('admin.contact.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        if (!$contact) {
            noty()->error('Contact Not Found');
            return redirect()->route('admin.contacts.index');
        }

//        $contact->update(['status' => 1]);
        return view('admin.contact.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        noty()->success('Contact Deleted Successfully');
        return redirect()->route('admin.contacts.index');

    }
}
