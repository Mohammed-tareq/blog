<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function App\Http\Helper\apiResponse;

class LoginController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = $this->validateData($request);

        $user = User::whereEmail($data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('user_token',[],now()->addWeek())->plainTextToken;
            return apiResponse('200', 'Login Successfully', ['token' => $token]);
        }

        return apiResponse('401', 'Invalid Email or Password');
    }

    private function validateData($request)
    {
       return $request->validate([
            'email' => 'required|email|string|max:50',
            'password' => 'required|string|max:30',
        ]);
    }
}
