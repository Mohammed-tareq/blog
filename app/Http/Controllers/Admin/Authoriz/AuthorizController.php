<?php

namespace App\Http\Controllers\Admin\Authoriz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authoriz\StoreRequest;
use App\Models\Authoriz;
use Illuminate\Http\Request;

class AuthorizController extends Controller
{

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



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $authoriz = Authoriz::findorFail($id);
        return   $authoriz->permissions;
        return view('admin.authoriz.edit', compact('authoriz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request , $id)
    {
        $authoriz = Authoriz::find($id);
        $authoriz->update($request->only('role', 'permissions'));
        noty()->success('Role Updated Successfully');
        return redirect()->route('admin.authorizations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Authoriz::findorFail($id)->delete();
        noty()->success('Role Deleted Successfully');
        return redirect()->route('admin.authorizations.index');
    }
}
