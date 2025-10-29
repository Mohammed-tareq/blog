<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchBy = request()->keyword;
        $sortBy = request()->sort_by ?? 'id';
        $orderBy = request()->order ?? 'desc';
        $limit = request()->paginate ?? 10;
        $status = request()->status;
        $admins = Admin::when($searchBy, fn($q) => $q->where('name', 'like', '%' . $searchBy . '%')
            ->orWhere('email', 'like', '%' . $searchBy . '%'))
            ->when(!is_null($status), fn($q) => $q->where('status', $status))
            ->orderby($sortBy, $orderBy)
            ->paginate($limit);

        return view('admin.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
            $request->validated();

           $admin = Admin::create($request->except('_token', 'password_confirmation'));
           if(!$admin){
               noty()->error('Try again later');
               return redirect()->route('admin.admins.create');
           }

            noty()->success('Admin Created Successfully');
            return redirect()->route('admin.admins.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function changeStatus($id)
    {
        $admin = Admin::find($id);
        $admin->update([
            'status' => !$admin->status,
        ]);
        noty()->success('Admin Status Updated Successfully');
        return redirect()->back();
    }

}
