<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SettingProfileUserRequest;
use App\Models\User;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function App\Http\Helper\apiResponse;
use function Pest\Laravel\delete;

class ProfileController extends Controller
{
    public function update(SettingProfileUserRequest $request)
    {
        $request->validated();
        if ($request->has('password')) {
            Request()->validate($this->validatePassword());
        }

        $user = User::find($request->user()->id);
        if (!$user) {
            return apiResponse(404, "User Not Found");
        }

        if ($request->has('password')) {
            return $this->storePassword($user, $request);
        }

        $user->update($request->except('_method', 'image'));


        if ($request->hasFile('image')) {
            ImageManegment::storeImage($request, null, $user);
        }
        return apiResponse(200, "Profile Updated Successfully");
    }


    public function updatePassword(Request $request)
    {
        $request->validate($this->validatePassword());

        $user = User::find(auth()->user()->id);
        if (!$user) {
            return apiResponse(404, "User Not Found");
        }

        if ($user && Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            $token = auth()->user()->currentAccessToken();
            $user->tokens()->where('id', '!=', $token->id)->delete();
            return apiResponse(200, "Password Updated Successfully");
        }
        return apiResponse(401, "Invalid Current Password");

    }


    private function validatePassword()
    {
        return [
            'password' => 'required|string|max:30|min:8|confirmed',
            'password_confirmation' => 'required|string|max:30|min:8',
            'current_password' => 'required|string|max:30|min:8',
        ];
    }

    private function storePassword($user, $request)
    {
        if ($user && Hash::check($request->current_password, $user->password)) {
            $user->update($request->except('_method', 'image', 'current_password', 'password_confirmation'));

            $token = auth()->user()->currentAccessToken();
            $user->tokens()->where('id', '!=', $token->id)->delete();
            return apiResponse(200, "Profile Updated Successfully");
        } else {
            return apiResponse(401, "Invalid Current Password");
        }

    }
}
