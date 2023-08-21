<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $access_token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $access_token,
                'message' => 'User logged-in successfully'
            ]);
        } else {
            return response()->json([
                'success' => false, 
                'message' => 'Wrong username or password'
            ]);
        }
    }


    public function register(Request $request)
    {
       
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User already exists'
            ]);
        }
    }
}
