<?php

namespace App\Http\Controllers\Admin\Authoriz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authoriz\StoreRequest;
use App\Models\Authoriz;
use Illuminate\Http\Request;

class AuthorizController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role.read')->only('index');
        $this->middleware('can:role.create')->only('create', 'store');
        $this->middleware('can:role.update')->only('edit', 'update');
        $this->middleware('can:role.delete')->only('destroy');
    }

    public function index()
    {
        $authorizations = Authoriz::paginate(10);
        return view('admin.authoriz.index', compact('authorizations'));
    }


    public function create()
    {
        return view('admin.authoriz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $request->validated();
        $authoriz = Authoriz::create($request->only('role', 'permissions'));
        if (!$authoriz) {
            noty()->error('Try again later');
            return redirect()->route('admin.authorizations.create');
        }
        noty()->success('Role Created Successfully');
        return redirect()->route('admin.authorizations.create');
    }


    public function edit($id)
    {
        $authoriz = Authoriz::findorFail($id);
        return view('admin.authoriz.edit', compact('authoriz'));
    }


    public function update(StoreRequest $request, $id)
    {
        $authoriz = Authoriz::find($id);
        $authoriz->update($request->only('role', 'permissions'));
        noty()->success('Role Updated Successfully');
        return redirect()->route('admin.authorizations.index');
    }


    public function destroy($id)
    {
        $authoriz = Authoriz::findorFail($id);
        if($authoriz->admins->count() > 0){
            noty()->error('You can not delete this role because it has admins');
            return redirect()->route('admin.authorizations.index');
        }
        noty()->success('Role Deleted Successfully');
        return redirect()->route('admin.authorizations.index');
    }
}
