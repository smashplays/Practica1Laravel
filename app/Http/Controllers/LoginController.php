<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDOException;

class LoginController extends Controller
{

    public function signUp(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $response = [
                'success' => true,
                'message' => "User Created",
                'data' => User::find(DB::getPdo()->lastInsertId())
            ];

            return response($response, 201);
        } catch (PDOException $ex) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];

            return response($response, 500);
        }
    }
    public function login(Request $request)
    {
        $option = '';

        if ($request->has('name')) {
            $option = 'name';
        } else if ($request->has('email')) {
            $option = 'email';
        }

        $data = $request->validate([
            $option => 'required|string',
            'password' => 'required|',
        ]);

        if (Auth::guard('api')->check()) {
            $response = [
                'success' => false,
                'message' => "The user was already logged in",
                'data' => null
            ];
            return response($response, 200);
        } else if (Auth::attempt($data)) {
            $token = Auth::user()->createToken("token");
            $response = [
                'success' => true,
                'message' => "Token created succesfully",
                'data' => $token
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
            'data' => Auth::guard('api')->user()
        ];
        return response($response, 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('api')->user()->tokens()->delete();

        $response = [
            'success' => true,
            'message' => "The session has been closed",
            'data' => null
        ];
        return response($response, 200);
    }
}
