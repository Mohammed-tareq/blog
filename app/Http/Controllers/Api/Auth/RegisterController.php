<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function App\Http\Helper\apiResponse;

class RegisterController extends Controller
{
    public function register(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $user = User::create($this->createUser($request));
            if (!$user) {
                return apiResponse('400', 'bad request');
            }

            if ($request->hasFile('image')) {
                ImageManegment::storeImage($request, null, $user);
            }
            DB::commit();

            $token = $user->createToken('user_token', [], now()->addWeek())->plainTextToken;
            return apiResponse('200', 'Register Successfully', ['token' => $token]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::alert('form register ' . $e->getMessage());
            return apiResponse('500', 'Internal Server Error');

        }

    }

    public function registerOnly(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $user = User::create($this->createUser($request));
            if (!$user) {
                return apiResponse('400', 'bad request');
            }

            if ($request->hasFile('image')) {
                ImageManegment::storeImage($request, null, $user);
            }
            DB::commit();

            return apiResponse('200', 'Register Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::alert('form register ' . $e->getMessage());
            return apiResponse('500', 'Internal Server Error');

        }

    }


    private function createUser($request)
    {
        return [
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'street' => $request->street,
        ];
    }
}
