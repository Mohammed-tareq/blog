<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $searchBy = request()->keyword;
        $sortBy = request()->sort_by ?? 'id';
        $orderBy = request()->order ?? 'desc';
        $limit = request()->paginate ?? 10;
        $status = request()->status;
        $users = User::when($searchBy, fn($q) => $q->where('name', 'like', '%' . $searchBy . '%')
            ->orWhere('email', 'like', '%' . $searchBy . '%'))
            ->when(!is_null($status), fn($q) => $q->where('status', $status))
            ->orderby($sortBy, $orderBy)
            ->paginate($limit);


        return view('admin.user.index', compact('users'));
    }


    public function create()
    {
        return view('admin.user.create');
    }


    public function store(StoreRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $request->merge([
                'email_verified_at' => $request->email_verify == 1 ? now() : null,
            ]);

            $user = User::create($request->except('image', '_token', 'password_confirmation'));

            if (!$user) {
                noty()->error('Try again later');
                return redirect()->route('admin.users.create');
            }
            ImageManegment::storeImage($request, null, $user);

            DB::commit();
            noty()->success('User Created Successfully');


        } catch (\Exception $e) {
            DB::rollBack();
            noty()->error($e->getMessage());
        }

        return redirect()->route('admin.users.index');

    }


    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
            'email_verify' => 'required|in:0,1',
        ]);
        $user = User::findOrfail($id);
        $user->update([
            'email_verified_at' => $request->email_verify == 1 ? now() : null,
            'status' => $request->status == 1 ? 1 : 0,
        ]);

        noty()->success('User Updated Successfully');
        return redirect()->route('admin.users.index');
    }


    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        ImageManegment::deleteImageFormLocal($user->image);
        $user->delete();
        noty()->success('User Deleted Successfully');
        return redirect()->route('admin.users.index');

    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status === 1) {
            $user->update([
                'status' => 0
            ]);
            noty()->success('User Blocked Successfully');
        } else {
            $user->update([
                'status' => 1
            ]);
            noty()->success('User Unblocked Successfully');
        }

        return redirect()->route('admin.users.index');
    }


}
