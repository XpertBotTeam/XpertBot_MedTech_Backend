<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {


            $user = User::where('email', $request->email)->first();
            if (is_null($user)) {
                if ($request->confirmpassword == $request->password) {
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
                        'message' => 'confirm password error'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User already exists'
                ]);
            }
        }
    }
}
