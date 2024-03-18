<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:6', 'max:15'],
            'password' => ['required', 'min:8', 'max:15'],
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationValidationException::withMessages([
                'email' => "The credential are incorrect!",
            ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken('web-token')->plainTextToken;

        return (new UserResource($user))
            ->additional(compact('token'));
    }
}