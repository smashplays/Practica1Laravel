<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('sanctum')->check()) {
            $response = [
                'success' => false,
                'message' => "The user was already logged in",
                'data' => null
            ];
            return response($response, 200);
        } else if (Auth::attempt($data)) {
            $response = [
                'success' => true,
                'message' => "Token created succesfully",
                'data' => Auth::user()->createToken("token")
            ];
            return response($response, 201);
        }
        $response = [
            'success' => false,
            'message' => "The credentials are incorrect",
            'data' => null
        ];

        return response($response, 401);
    }

    public function withoutLogin(Request $request)
    {
        $response = [
            'success' => true,
            'message' => "You don't need to be logged in to access here",
            'data' => null
        ];
        return response($response, 200);
    }

    public function whoAmI(Request $request)
    {
        $response = [
            'success' => true,
            'message' => "User obtained succesfully",
            'data' => Auth::guard('sanctum')->user()
        ];
        return response($response, 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('sanctum')->user()->tokens()->delete();

        $response = [
            'success' => true,
            'message' => "The session has been closed",
            'data' => null
        ];
        return response($response, 200);
    }
}
