<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use function App\Http\Helper\apiResponse;

class LoginController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = $this->validateData($request);

        if (RateLimiter::tooManyAttempts($request->ip(), 2)) {
            $time = RateLimiter::availableIn($request->ip());
            return apiResponse('429', 'You are sending too many requests please try again in ' . $time . ' seconds');
        }
        RateLimiter::increment($request->ip());
        $remin = RateLimiter::remaining($request->ip(), 2);
        $user = User::whereEmail($data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            RateLimiter::clear($request->ip());
            $token = $user->createToken('user_token', [], now()->addWeek())->plainTextToken;
            return apiResponse('200', 'Login Successfully', ['token' => $token]);
        }

        return apiResponse('401', 'Invalid Email or Password', ['remaining' => $remin]);
    }

    private function validateData($request)
    {
        return $request->validate([
            'email' => 'required|email|string|max:50',
            'password' => 'required|string|max:30',
        ]);
    }
}
