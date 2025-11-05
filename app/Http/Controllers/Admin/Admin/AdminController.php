<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Authoriz;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.read')->only('index');
        $this->middleware('can:admin.create')->only('create', 'store');
        $this->middleware('can:admin.update')->only('edit', 'update');
        $this->middleware('can:admin.delete')->only('destroy');
        $this->middleware('can:admin.status')->only('changeStatus');
    }

    public function index()
    {
        $searchBy = request()->keyword;
        $sortBy = request()->sort_by ?? 'id';
        $orderBy = request()->order ?? 'desc';
        $limit = request()->paginate ?? 10;
        $status = request()->status;
        $admins = Admin::where('id', "!=", auth('admin')->id())->when($searchBy, fn($q) => $q->where('name', 'like', '%' . $searchBy . '%')
            ->orWhere('email', 'like', '%' . $searchBy . '%'))
            ->when(!is_null($status), fn($q) => $q->where('status', $status))
            ->orderby($sortBy, $orderBy)
            ->paginate($limit);

        return view('admin.admin.index', compact('admins'));
    }


    public function create()
    {
        $authoriz = Authoriz::all();
        return view('admin.admin.create', compact('authoriz'));
    }


    public function store(StoreAdminRequest $request)
    {
        $request->validated();

        $admin = Admin::create($request->except('_token', 'password_confirmation'));
        if (!$admin) {
            noty()->error('Try again later');
            return redirect()->route('admin.admins.create');
        }

        noty()->success('Admin Created Successfully');
        return redirect()->route('admin.admins.index');

    }


    public function edit(string $id)
    {
        $authoriz = Authoriz::all();
        $admin = Admin::find($id);
        return view('admin.admin.edit', compact('authoriz', 'admin'));
    }


    public function update(UpdateAdminRequest $request, string $id)
    {
        $request->validated();
        $admin = Admin::find($id);
        if (!$request->password) {
            $admin->update($request->except('_token', 'password_confirmation', 'password'));
        }
        $request->merge([
            'password' => Hash::make($request->password),
        ]);
        $admin->update($request->except('_token', 'password_confirmation'));
        if (!$admin) {
            noty()->error('Try again later');
            return redirect()->route('admin.admins.edit', $id);
        }

        noty()->success('Admin Updated Successfully');
        return redirect()->route('admin.admins.index');
    }


    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            noty()->error('Try again later');
            return redirect()->route('admin.admins.index');
        }
        $admin->delete();
        noty()->success('Admin Deleted Successfully');
        return redirect()->route('admin.admins.index');
    }

    public function changeStatus($id)
    {
        $admin = Admin::find($id);
        if ($admin->authoriz_id == 1 && auth('admin')->user()->authoriz_id != 1) {
            noty()->error('You can not change status of this admin');
            return redirect()->back();
        }
        $admin->update([
            'status' => !$admin->status,
        ]);
        noty()->success('Admin Status Updated Successfully');
        return redirect()->back();
    }

}
