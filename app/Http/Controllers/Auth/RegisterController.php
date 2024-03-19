<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'min:15', 'max:30'],
            'username' => ['required', 'min:6', 'max:15'],
            'name' => ['required', 'min:5', 'max:25'],
            'password' => ['required', 'min:8', 'max:15', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'max:15']
        ]);

        if ($request) {
            User::create([
                'email' => $request->email,
                'username' => $request->username,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json('You`re have been registered!');
        } else {
            return response()->json(ValidationException::withMessages(['Data doesn`t match!']));
        }
    }
}
