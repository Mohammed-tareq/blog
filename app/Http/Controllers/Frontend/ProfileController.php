<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StorePostRequest;
use App\Utils\ImageManegment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.index');
    }

    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->validated();
            $request->commrnt_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
            $post = auth()->user()->posts()->create($request->except('_token', 'images'));

            ImageManegment::storeImage($request, $post);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::alert($e->getMessage());

        }
        Session::flash('success', 'Post created successfully');
        return redirect()->back();
    }
}










